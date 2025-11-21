<?php
require_once __DIR__ . '/config.php';
if (!isLoggedIn()) { header('Location: login.php'); exit; }
// update quantities if posted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qty'])) {
    foreach($_POST['qty'] as $pid => $q) {
        $pid = (int)$pid; $q = max(1,(int)$q);
        if (isset($_SESSION['cart'][$pid])) $_SESSION['cart'][$pid]['qty'] = $q;
    }
}
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (!$cart) { header('Location: cart.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    // create order
    $user_id = (int)$_SESSION['user_id'];
    $address = $mysqli->real_escape_string(trim($_POST['address']));
    $phone = $mysqli->real_escape_string(trim($_POST['phone']));
    $total = 0; foreach($cart as $c) $total += $c['price']*$c['qty'];
    $mysqli->query("INSERT INTO orders (user_id,total,address,phone) VALUES ($user_id,$total,'$address','$phone')");
    $order_id = $mysqli->insert_id;
    foreach($cart as $c) {
        $pid = (int)$c['id']; $qty = (int)$c['qty']; $price = $c['price'];
        $mysqli->query("INSERT INTO order_items (order_id,product_id,qty,price) VALUES ($order_id,$pid,$qty,$price)");
    }
    unset($_SESSION['cart']);
    header('Location: orders.php'); exit;
}

include 'header.php';
?>
<div class="container py-5">
    <h2>Checkout</h2>
    <form method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3"><label class="form-label">Alamat</label><input name="address" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">No. Telepon</label><input name="phone" class="form-control" required></div>
                <button name="confirm" class="btn btn-warning">Konfirmasi Pesanan</button>
            </div>
            <div class="col-md-6">
                <h4>Ringkasan</h4>
                <ul class="list-group">
                    <?php $total=0; foreach($cart as $c): $subtotal=$c['price']*$c['qty']; $total+=$subtotal; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo esc($c['title']); ?> x<?php echo $c['qty']; ?>
                            <span>Rp <?php echo number_format($subtotal,0,',','.'); ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between"><strong>Total</strong><strong>Rp <?php echo number_format($total,0,',','.'); ?></strong></li>
                </ul>
            </div>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>
<?php
require_once __DIR__ . '/config.php';
if (!isLoggedIn()) { header('Location: login.php'); exit; }
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$res = $mysqli->query("SELECT * FROM orders WHERE id=$id AND user_id=".(int)$_SESSION['user_id']);
if (!$res || !$res->num_rows) { header('Location: orders.php'); exit; }
$order = $res->fetch_assoc();
$items = [];
$ri = $mysqli->query("SELECT oi.*, p.title FROM order_items oi JOIN products p ON p.id=oi.product_id WHERE oi.order_id=$id");
if ($ri) while($r = $ri->fetch_assoc()) $items[] = $r;
include 'header.php';
?>
<div class="container py-5">
    <h2>Detail Pesanan #<?php echo $order['id']; ?></h2>
    <p>Status: <?php echo esc($order['status']); ?></p>
    <p>Alamat: <?php echo esc($order['address']); ?></p>
    <p>Phone: <?php echo esc($order['phone']); ?></p>
    <h4>Items</h4>
    <ul class="list-group">
        <?php foreach($items as $it): ?>
            <li class="list-group-item d-flex justify-content-between">
                <div><?php echo esc($it['title']); ?> x<?php echo $it['qty']; ?></div>
                <div>Rp <?php echo number_format($it['price'] * $it['qty'],0,',','.'); ?></div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php include 'footer.php'; ?>
<?php
require_once __DIR__ . '/config.php';
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
include 'header.php';
?>
<div class="container py-5">
    <h2 class="mb-4">Keranjang</h2>
    <?php if(!$cart): ?>
        <div class="alert alert-info">Keranjang kosong. <a href="menu.php">Lihat menu</a></div>
    <?php else: ?>
        <form method="post" action="checkout.php">
            <table class="table">
                <thead><tr><th>Produk</th><th>Harga</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead>
                <tbody>
                    <?php $total=0; foreach($cart as $id=>$item): $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>
                        <tr>
                            <td><?php echo esc($item['title']); ?></td>
                            <td>Rp <?php echo number_format($item['price'],0,',','.'); ?></td>
                            <td><input type="number" name="qty[<?php echo $id; ?>]" value="<?php echo $item['qty']; ?>" min="1" class="form-control" style="max-width:100px"></td>
                            <td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td>
                            <td><a href="?remove=<?php echo $id; ?>" class="btn btn-sm btn-outline-danger">Hapus</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="menu.php" class="btn btn-secondary">Lanjut Belanja</a>
                </div>
                <div>
                    <strong>Total: Rp <?php echo number_format($total,0,',','.'); ?></strong>
                    <button class="btn btn-warning ms-3">Checkout</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php
// handle remove via GET (quick)
if (isset($_GET['remove'])) {
    $rid = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$rid])) unset($_SESSION['cart'][$rid]);
    header('Location: cart.php'); exit;
}

// update qty on POST (handled by checkout.php after redirect if needed)
?>

<?php include 'footer.php'; ?>
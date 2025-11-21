<?php
require_once __DIR__ . '/config.php';
if (!isLoggedIn()) { header('Location: login.php'); exit; }
$user_id = (int)$_SESSION['user_id'];
$res = $mysqli->query("SELECT * FROM orders WHERE user_id=$user_id ORDER BY created_at DESC");
$orders = [];
if ($res) while($r = $res->fetch_assoc()) $orders[] = $r;
include 'header.php';
?>
<div class="container py-5">
    <h2>Pesanan Saya</h2>
    <?php if(!$orders): ?>
        <div class="alert alert-info">Belum ada pesanan.</div>
    <?php else: ?>
        <?php foreach($orders as $o): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Order #<?php echo $o['id']; ?> - <?php echo esc($o['status']); ?></h5>
                    <p>Total: Rp <?php echo number_format($o['total'],0,',','.'); ?> • <?php echo $o['created_at']; ?></p>
                    <a href="order_detail.php?id=<?php echo $o['id']; ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
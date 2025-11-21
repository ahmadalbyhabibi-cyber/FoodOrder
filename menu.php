<?php
require_once __DIR__ . '/config.php';
// fetch products
// If DB/tables missing, show friendly message instead of fatal exception
$missing = missingCoreTables($mysqli);
if (!empty($missing)) {
    include 'header.php';
    ?>
    <div class="container py-5">
        <div class="alert alert-danger">
            <h5 class="mb-2">Database belum terpasang atau tabel hilang</h5>
            <p>Sepertinya database atau tabel belum dibuat: <strong><?php echo esc(implode(', ', $missing)); ?></strong></p>
            <p>Silakan impor `database.sql` yang ada di folder project ke MySQL. Contoh perintah (PowerShell):</p>
            <pre><code>mysql -u root -p food_order &lt; c:\\xampp\\htdocs\\food_order\\database.sql</code></pre>
            <p>Atau buka `c:\xampp\htdocs\food_order\README.md` untuk petunjuk lebih lengkap.</p>
        </div>
    </div>
    <?php
    include 'footer.php';
    exit;
}

$res = $mysqli->query("SELECT p.*, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id=c.id ORDER BY p.created_at DESC");
$products = [];
if ($res) while($row = $res->fetch_assoc()) $products[] = $row;
include 'header.php';
?>
<div class="container py-5">
    <h2 class="mb-4">Menu</h2>
    <div class="row g-4">
        <?php foreach($products as $p): ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <?php if($p['image']): ?><img src="<?php echo esc($p['image']); ?>" class="card-img-top" style="height:200px;object-fit:cover"><?php endif; ?>
                    <div class="card-body">
                        <h5><?php echo esc($p['title']); ?></h5>
                        <p class="text-muted mb-1"><?php echo esc($p['category']); ?></p>
                        <p><?php echo esc(substr($p['description'],0,100)); ?></p>
                        <p class="fw-bold">Rp <?php echo number_format($p['price'],0,',','.'); ?></p>
                        <form method="post" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                            <div class="d-flex">
                                <input name="qty" type="number" value="1" min="1" class="form-control me-2" style="max-width:90px">
                                <button class="btn btn-warning">Tambah ke Keranjang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
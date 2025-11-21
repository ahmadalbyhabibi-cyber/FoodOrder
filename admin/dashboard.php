<?php
require_once __DIR__ . '/../config.php';
if (!isLoggedIn() || !isAdmin($mysqli)) { header('Location: ../login.php'); exit; }
$products = [];
$res = $mysqli->query("SELECT p.*, c.name AS category FROM products p LEFT JOIN categories c ON p.category_id=c.id ORDER BY p.created_at DESC");
if ($res) while($r = $res->fetch_assoc()) $products[] = $r;
include __DIR__ . '/../header.php';
?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin - Products</h2>
        <a href="product_form.php" class="btn btn-success">Tambah Produk</a>
    </div>
    <table class="table">
        <thead><tr><th>ID</th><th>Title</th><th>Category</th><th>Price</th><th></th></tr></thead>
        <tbody>
            <?php foreach($products as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo esc($p['title']); ?></td>
                    <td><?php echo esc($p['category']); ?></td>
                    <td>Rp <?php echo number_format($p['price'],0,',','.'); ?></td>
                    <td>
                        <a href="product_form.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="delete_product.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
<?php
require_once __DIR__ . '/../config.php';
if (!isLoggedIn() || !isAdmin($mysqli)) { header('Location: ../login.php'); exit; }
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$errors = [];
$title = $description = $price = $image = '';
$category_id = null;
if ($id) {
    $r = $mysqli->query("SELECT * FROM products WHERE id=$id");
    if ($r && $r->num_rows) {
        $p = $r->fetch_assoc();
        $title = $p['title']; $description = $p['description']; $price = $p['price']; $image = $p['image']; $category_id = $p['category_id'];
    }
}
$cats = [];$cres = $mysqli->query("SELECT * FROM categories"); if ($cres) while($c = $cres->fetch_assoc()) $cats[] = $c;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $mysqli->real_escape_string(trim($_POST['title']));
    $description = $mysqli->real_escape_string(trim($_POST['description']));
    $price = (float)$_POST['price'];
    $category_id = (int)$_POST['category_id'];
    $image = $mysqli->real_escape_string(trim($_POST['image']));
    if (!$title) $errors[] = 'Title dibutuhkan.';
    if (!$errors) {
        if ($id) {
            $mysqli->query("UPDATE products SET title='$title',description='$description',price=$price,category_id=".($category_id?:'NULL').",image='$image' WHERE id=$id");
        } else {
            $mysqli->query("INSERT INTO products (title,description,price,category_id,image) VALUES ('$title','$description',$price,".($category_id?:'NULL').",'$image')");
        }
        header('Location: dashboard.php'); exit;
    }
}
include __DIR__ . '/../header.php';
?>
<div class="container py-5">
    <h2><?php echo $id ? 'Edit' : 'Tambah'; ?> Produk</h2>
    <?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e) echo esc($e).'<br>' ;?></div><?php endif; ?>
    <form method="post">
        <div class="mb-3"><label class="form-label">Title</label><input name="title" class="form-control" value="<?php echo esc($title); ?>"></div>
        <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control"><?php echo esc($description); ?></textarea></div>
        <div class="mb-3"><label class="form-label">Price</label><input name="price" class="form-control" value="<?php echo esc($price); ?>"></div>
        <div class="mb-3"><label class="form-label">Category</label>
            <select name="category_id" class="form-control">
                <option value="">-- Pilih --</option>
                <?php foreach($cats as $c): ?>
                    <option value="<?php echo $c['id']; ?>" <?php if($c['id']==$category_id) echo 'selected'; ?>><?php echo esc($c['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3"><label class="form-label">Image URL</label><input name="image" class="form-control" value="<?php echo esc($image); ?>"></div>
        <button class="btn btn-success"><?php echo $id ? 'Update' : 'Tambah'; ?></button>
        <a href="dashboard.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
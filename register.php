<?php
require_once __DIR__ . '/config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $mysqli->real_escape_string(trim($_POST['name']));
    $email = $mysqli->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];
    if (!$name || !$email || !$password) {
        $errors[] = 'Semua field wajib diisi.';
    } else {
        // check email
        $res = $mysqli->query("SELECT id FROM users WHERE email='$email'");
        if ($res && $res->num_rows > 0) {
            $errors[] = 'Email sudah terdaftar.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $mysqli->query("INSERT INTO users (name,email,password) VALUES ('$name','$email','$hash')");
            $_SESSION['user_id'] = $mysqli->insert_id;
            header('Location: index.php'); exit;
        }
    }
}
include 'header.php';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Daftar</h4>
                    <?php if($errors): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errors as $e) echo esc($e).'<br>'; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" name="name"></div>
                        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" type="email"></div>
                        <div class="mb-3"><label class="form-label">Password</label><input class="form-control" name="password" type="password"></div>
                        <button class="btn btn-warning">Daftar</button>
                        <a href="login.php" class="ms-3">Sudah punya akun? Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
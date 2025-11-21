<?php
require_once __DIR__ . '/config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $mysqli->real_escape_string(trim($_POST['email']));
    $password = $_POST['password'];
    if (!$email || !$password) {
        $errors[] = 'Email dan password wajib diisi.';
    } else {
        $res = $mysqli->query("SELECT id,password FROM users WHERE email='$email'");
        if ($res && $res->num_rows) {
            $row = $res->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                header('Location: index.php'); exit;
            } else {
                $errors[] = 'Kredensial salah.';
            }
        } else {
            $errors[] = 'Kredensial salah.';
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
                    <h4 class="card-title">Login</h4>
                    <?php if($errors): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errors as $e) echo esc($e).'<br>'; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" type="email"></div>
                        <div class="mb-3"><label class="form-label">Password</label><input class="form-control" name="password" type="password"></div>
                        <button class="btn btn-warning">Login</button>
                        <a href="register.php" class="ms-3">Belum punya akun? Daftar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
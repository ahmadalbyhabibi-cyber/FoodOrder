<?php
require_once __DIR__ . '/config.php';
$user = currentUser($mysqli);
$isLoggedIn = isLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodOrder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: "Poppins", sans-serif; background-color: #f8f9fa; }
        .hero { background-image: url('https://images.unsplash.com/photo-1555993539-1732a51e0bff?auto=format&fit=crop&w=1950&q=80'); height: 100vh; background-size: cover; background-position: center; position: relative; }
        .hero::after { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.55); }
        .hero-content { position: relative; z-index: 2; text-align: center; top: 50%; transform: translateY(-50%); color: #fff; }
        .hero-content h1 { font-size: 4rem; font-weight: 800; }
        .category-card { border-radius: 12px; overflow: hidden; transition: 0.3s; }
        .category-card img { height: 200px; width: 100%; object-fit: cover; }
        .category-card:hover { transform: scale(1.05); box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        footer { background: #111; color: white; padding: 40px 0; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/food_order/">FoodOrder</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="/food_order/#menu" class="nav-link">Menu</a></li>
                <li class="nav-item"><a href="/food_order/#about" class="nav-link">Tentang</a></li>
                <li class="nav-item"><a href="/food_order/#contact" class="nav-link">Kontak</a></li>
                <li class="nav-item"><a href="/food_order/menu.php" class="nav-link">Lihat Menu</a></li>
                <?php if($isLoggedIn): ?>
                    <?php if(isAdmin($mysqli)): ?>
                        <li class="nav-item"><a href="/food_order/admin/dashboard.php" class="nav-link">Admin</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="/food_order/cart.php" class="nav-link">Cart</a></li>
                    <li class="nav-item ms-3">
                        <a href="/food_order/logout.php" class="btn btn-warning fw-bold">Logout (<?php echo esc($user['name']); ?>)</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-3">
                        <a href="/food_order/login.php" class="btn btn-warning fw-bold">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div style="height:70px;"></div>

<?php
require_once __DIR__ . '/config.php';
$isLoggedIn = isLoggedIn();
?>
<?php include 'header.php'; ?>

<section class="hero d-flex align-items-center">
    <div class="container hero-content">
        <h1>Rasakan Lezatnya<br>Makanan Premium</h1>
        <p class="lead">Pesan makanan favoritmu dengan mudah dan cepat</p>

        <?php if(!$isLoggedIn): ?>
            <a href="register.php" class="btn btn-warning btn-lg fw-bold px-4">Daftar Sekarang</a>
        <?php else: ?>
            <a href="menu.php" class="btn btn-warning btn-lg fw-bold px-4">Pesan Sekarang</a>
        <?php endif; ?>
    </div>
</section>

<!-- SECTION MENU -->
<section class="py-5" id="menu">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Kategori Terpopuler</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="category-card shadow-sm">
                    <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=800&q=80">
                    <div class="p-3 text-center">
                        <h5>Makanan Berat</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="category-card shadow-sm">
                    <img src="https://images.unsplash.com/photo-1551024601-bec78aea704b?auto=format&fit=crop&w=800&q=80">
                    <div class="p-3 text-center">
                        <h5>Minuman</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="category-card shadow-sm">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80">
                    <div class="p-3 text-center">
                        <h5>Dessert</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="py-5" id="about">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Tentang Kami</h2>
                <p>FoodOrder menghadirkan makanan berkualitas tinggi yang dibuat oleh chef profesional. Dengan bahan segar
                dan proses masak yang higienis, kami memberikan rasa terbaik untuk para pelanggan.</p>
                <a href="menu.php" class="btn btn-dark mt-2">Lihat Menu</a>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=900&q=80" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- CONTACT -->
<section class="py-5 text-center" id="contact">
    <div class="container">
        <h2 class="fw-bold mb-3">Hubungi Kami</h2>
        <p class="text-muted">Silakan hubungi kami kapan saja</p>
        <h4>📞 08133327577</h4>
        <h4></h4>
        <p>📍 Jl.Raya Tanggul - Semboro 
            kabupaten Jember, Jawa Timur
        </p>
    </div>
</section>

<?php include 'footer.php'; ?>
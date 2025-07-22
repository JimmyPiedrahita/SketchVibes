<?php
require_once __DIR__ . '/../config/config.php';

$title = 'SketchVibes - Galería de Arte Digital';
$bodyClass = 'landing-page';
$showNavbar = false;

ob_start();
?>

<div class="hero-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <img src="/SketchVibes/public/img/Logo.png" alt="SketchVibes" class="logo-hero mb-4">
                <h1 class="display-4 text-white mb-4">SketchVibes</h1>
                <p class="lead text-light mb-5">
                    Explora nuestro mundo de creatividad y arte. Descubre dibujos únicos y cautivadores 
                    creados por talentosos artistas. ¡Accede a la galería completa y adquiere tus obras favoritas hoy mismo!
                </p>
                
                <div class="hero-buttons">
                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <a href="/SketchVibes/public/home.php" class="btn btn-primary btn-lg me-3">
                            Explorar Galería
                        </a>
                        <a href="/SketchVibes/public/logout.php" class="btn btn-outline-light btn-lg">
                            Cerrar Sesión
                        </a>
                    <?php else: ?>
                        <a href="/SketchVibes/public/home.php" class="btn btn-primary btn-lg me-3">
                            Explorar Galería
                        </a>
                        <a href="/SketchVibes/public/login.php" class="btn btn-outline-light btn-lg me-3">
                            Iniciar Sesión
                        </a>
                        <a href="/SketchVibes/public/register.php" class="btn btn-success btn-lg">
                            Registrarse
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="features-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="feature-box">
                    <i class="fas fa-palette fa-3x text-primary mb-3"></i>
                    <h4>Arte Diverso</h4>
                    <p>Encuentra dibujos de diferentes categorías: artísticos, técnicos, geométricos y más.</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="feature-box">
                    <i class="fas fa-download fa-3x text-primary mb-3"></i>
                    <h4>Descarga Gratuita</h4>
                    <p>Descarga tus obras favoritas en alta calidad de forma completamente gratuita.</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="feature-box">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h4>Comunidad</h4>
                    <p>Únete a nuestra comunidad de artistas y amantes del arte digital.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$additionalCSS = '
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.landing-page {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.hero-section {
    padding: 100px 0;
    text-align: center;
}

.logo-hero {
    max-width: 200px;
    height: auto;
}

.hero-buttons .btn {
    margin: 0.5rem;
}

.features-section {
    background: white;
}

.feature-box {
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.feature-box:hover {
    transform: translateY(-5px);
}
</style>
';

include __DIR__ . '/../src/Views/layouts/main.php';
?>

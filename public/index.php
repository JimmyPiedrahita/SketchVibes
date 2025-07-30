<?php
require_once __DIR__ . '/../config/config.php';

$title = 'SketchVibes - Galería de Arte Digital';
$bodyClass = 'bg-primary';
$showNavbar = false;

ob_start();
?>

<div class="min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <img src="img/Logo.png" alt="SketchVibes" class="img-fluid mb-4" style="max-width: 200px;">
                <h1 class="display-4 text-white mb-4">SketchVibes</h1>
                <p class="lead text-light mb-5">
                    Explora nuestro mundo de creatividad y arte. Descubre dibujos únicos y cautivadores 
                    creados por talentosos artistas. ¡Accede a la galería completa y adquiere tus obras favoritas hoy mismo!
                </p>
                
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <a href="/SketchVibes/public/home.php" class="btn btn-light btn-lg">
                            <i class="fas fa-images me-2"></i>Explorar Galería
                        </a>
                        <a href="/SketchVibes/public/logout.php" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                        </a>
                    <?php else: ?>
                        <a href="/SketchVibes/public/home.php" class="btn btn-light btn-lg">
                            <i class="fas fa-images me-2"></i>Explorar Galería
                        </a>
                        <a href="/SketchVibes/public/login.php" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </a>
                        <a href="/SketchVibes/public/register.php" class="btn btn-success btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Registrarse
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <i class="fas fa-palette fa-3x text-primary mb-3"></i>
                    <h4 class="mb-3">Arte Diverso</h4>
                    <p class="text-muted">Encuentra dibujos de diferentes categorías: artísticos, técnicos, geométricos y más.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <i class="fas fa-download fa-3x text-primary mb-3"></i>
                    <h4 class="mb-3">Descarga Gratuita</h4>
                    <p class="text-muted">Descarga tus obras favoritas en alta calidad de forma completamente gratuita.</p>
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
            <div class="col-md-4">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h4 class="mb-3">Comunidad Creativa</h4>
                    <p class="text-muted">Únete a nuestra comunidad de artistas y amantes del arte digital.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../src/Views/layouts/main.php';
?>

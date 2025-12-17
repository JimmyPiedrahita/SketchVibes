<?php
require_once __DIR__ . '/../config/config.php';

$title = 'SketchVibes - Galería de Arte Digital';
$bodyClass = 'bg-light';
$showNavbar = false;
$mainClass = '';

ob_start();
?>

<div class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container-fluid px-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 col-xl-6">
                <img src="img/logo.svg" alt="SketchVibes" class="img-fluid mb-4" style="max-width: 200px;">
                <h1 class="display-4 text-primary mb-4">SketchVibes</h1>
                <p class="lead text-dark mb-5">
                    Explora nuestro mundo de creatividad y arte. Descubre dibujos únicos y cautivadores 
                    creados por talentosos artistas. ¡Accede a la galería completa y adquiere tus obras favoritas hoy mismo!
                </p>
                
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <a href="<?= APP_URL ?>/home.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-images me-2"></i>Explorar Galería
                        </a>
                        <a href="<?= APP_URL ?>/logout.php" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                        </a>
                    <?php else: ?>
                        <a href="<?= APP_URL ?>/home.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-images me-2"></i>Explorar Galería
                        </a>
                        <a href="<?= APP_URL ?>/login.php" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </a>
                        <a href="<?= APP_URL ?>/register.php" class="btn btn-success btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Registrarse
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../src/Views/layouts/main.php';
?>

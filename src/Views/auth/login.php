<?php
$title = 'Iniciar Sesión - SketchVibes';
$bodyClass = 'bg-primary min-vh-100 d-flex align-items-center';
$showNavbar = false;

ob_start();
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <a href="/SketchVibes/public/index.php">
                            <img src="img/Logo.png" alt="SketchVibes" class="img-fluid" style="max-width: 120px;">
                        </a>
                        <h2 class="mt-3 text-primary">Iniciar Sesión</h2>
                    </div>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="csrf_token" value="<?= SecurityHelper::generateCSRFToken() ?>">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <p class="mb-2">¿No tienes cuenta? <a href="/SketchVibes/public/register.php" class="text-decoration-none">Regístrate aquí</a></p>
                        <a href="/SketchVibes/public/index.php" class="text-muted">
                            <i class="fas fa-arrow-left me-1"></i>Volver al inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>

<?php
$title = 'Registrarse - SketchVibes';
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
                        <h2 class="mt-3 text-primary">Crear Cuenta</h2>
                    </div>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="csrf_token" value="<?= SecurityHelper::generateCSRFToken() ?>">
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required minlength="6">
                            <div class="form-text">Mínimo 6 caracteres</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <p class="mb-2">¿Ya tienes cuenta? <a href="/SketchVibes/public/login.php" class="text-decoration-none">Inicia sesión aquí</a></p>
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

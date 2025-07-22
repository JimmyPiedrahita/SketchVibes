<?php
$title = 'Iniciar Sesión - SketchVibes';
$bodyClass = 'auth-page';
$showNavbar = false;

ob_start();
?>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card">
                    <div class="text-center mb-4">
                        <a href="/SketchVibes/public/index.php">
                            <img src="/SketchVibes/public/img/Logo.png" alt="SketchVibes" class="auth-logo">
                        </a>
                        <h2 class="mt-3">Iniciar Sesión</h2>
                    </div>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="csrf_token" value="<?= SecurityHelper::generateCSRFToken() ?>">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar Sesión</button>
                    </form>
                    
                    <div class="text-center">
                        <p>¿No tienes cuenta? <a href="/SketchVibes/public/register.php" class="text-decoration-none">Regístrate aquí</a></p>
                        <a href="/SketchVibes/public/index.php" class="text-muted">← Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

$additionalCSS = '
<style>
.auth-page {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.auth-container {
    padding: 2rem 0;
}

.auth-card {
    background: white;
    padding: 3rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.auth-logo {
    max-width: 120px;
    height: auto;
}

.form-control {
    border-radius: 10px;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-weight: 500;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
}
</style>
';

include __DIR__ . '/../src/Views/layouts/main.php';
?>

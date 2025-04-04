<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SketchVibes - Login</title>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-main">
        <a href="index.php" class="logo-seleccionable"><img src="img/Logo.png" alt="Logo de SketchVibes"></a>
        <div class="container-form">
            <h1 class="titulo-form">Iniciar Sesión</h1>
            <?php
            include("conexion.php");
            include("user.php");
            ?>
            <form action="" method="POST" class="formulario">
                <label for="">Correo electrónico</label>
                <input type="email" id="email" required class="campo" name="email">
                <label for="">Contraseña</label>
                <input type="password" id="password" required class="campo" name="password">
                <button type="buttom" name="ingreso" value="ingresar" class="btn btn-action btn-submit">Ingresar</button>
            </form>
            <p>¿No tienes cuenta? <a href="signup.php" class="link">Regístrate aquí</a></p>
        </div>
    </div>
</body>

</html>
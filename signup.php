<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SketchVibes - Signup</title>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-main">
        <a href="index.php" class="logo-seleccionable"><img src="img/Logo.png" alt="Logo de SketchVibes"></a>
        <div class="container-form">
            <h1 class="titulo-form">Registrarse</h1>
            <?php
            include("conexion.php");
            include("user.php");
            ?>
            <form method="POST" class="formulario">
                <label for="">Nombre:</label>
                <input type="text" id="nombre" class="campo" name="nombre" required>
                <label for="">Correo electrónico:</label>
                <input type="email" id="emailSignup" class="campo" name="email" required>
                <label for="">Contraseña:</label>
                <input type="password" id="passwordSignup" class="campo" name="password" required>
                <button type="submit" class="btn btn-action btn-submit" name="registro" value="registrar">Registrarse</button>
            </form>
            <p>¿Ya tienes cuenta? <a href="login.php" class="link">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>

</html>
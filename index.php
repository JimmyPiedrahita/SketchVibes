<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.ico">
    <title>SketchVibes - Web</title>
</head>

<body class="container-index">
    <div class="container-box">
        <div class="container-menu">
            <nav class="menu">
                <a href="index.php"><img src="img/Logo.png" alt="Logo de SketchVibes"></a>
                
                <ul>
                    <li><a href="login.php"><button class="btn btn-index" id="btn-abrir-login">Iniciar Sesión</button></a></li>
                    <li><a href="signup.php"><button class="btn btn-index" id="btn-abrir-signup">Registrarse</button></a></li>
                </ul>
            </nav>
        </div>
        <div class="container-inf">
            <h1>SketchVibes</h1>
            <p>
                "Explora nuestro mundo de creatividad y arte. Descubre dibujos únicos y cautivadores creados por talentosos artistas.
                ¡Accede a la galería completa y adquiere tus obras favoritas hoy mismo!"
            </p>
            <?php
            include("user.php");
            ?>
            <form method="post">
                <button class="btn btn-action" name="explore">Explorar</button>
            </form>
        </div>
    </div>
</body>

</html>
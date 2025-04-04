<?php
session_start();
include("conexion.php");
include("user.php");
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/logo.ico">
    <title>SketchVibes - Explore</title>

</head>

<body class="container-explore">
    <div class="container-inicio">
        <?php
        include 'menu.php';
        ?>
        <div class="container-images">
            <?php
            include("obtener-imagenes.php");
            while ($row = $resultado->fetch_assoc()) {
            ?>
                <div class="elemento" data-filter=<?php echo $row['categoria']; ?>>
                    <div class="grid-item">
                        <img id="<?php echo $row['id_imagen']; ?>" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']) ?>" class="img-home">
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <button class="btn-close" id="btn-cerrar-modal">&times;</button>
                <img id="modal-image" src="" alt="Imagen extendida">
                <div class="btn-container">
                    <?php
                    if ($_SESSION['administrador']) {
                    ?>
                    <a id="modificar-btn" href="#"><button class="btn btn-home">Modificar</button></a>
                    <?php
                    }
                    ?>
                    <a id="download-btn" href="#" download="SketchVibes-imagen-descarga-free.jpg"><button class="btn btn-action">Descargar</button></a>
                    <?php
                    if ($_SESSION['administrador']) {
                    ?>
                    <a id="eliminar-btn" href="#"><button class="btn btn-home">Eliminar</button></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="overlay" class="overlay"></div>
    </div>
</body>
<script src="scripts.js"></script>

</html>
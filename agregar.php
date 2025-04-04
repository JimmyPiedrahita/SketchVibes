<?php
session_start();
include("conexion.php");
include("user.php");
include("obtener-categorias.php");
if (!isset($_SESSION['administrador'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SketchVibes - Agregar imagen</title>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="container-add">
    <div class="container-form form-add">
        <form method="post" action="proceso-guardar.php" enctype="multipart/form-data" class="formulario-add">
            <label>Categoria</label>
            <select name="categoria" required class="selector-categoria">
                <?php
                while ($categoria = $categorias->fetch_assoc()) {
                ?>
                    <option value="<?php echo $categoria['nombre'] ?>"><?php echo $categoria['nombre'] ?></option>
                <?php
                }
                ?>
            </select>
            <input type="file" name="imagen" required accept="image/*" class="selector-imagen">
            <button type="submit" class="btn btn-action" name="guardar-imagen">Guardar</button>
        </form>
        <a href="home.php"><button class="btn btn-index" name="cancelar">Cancelar</button></a>
    </div>
</body>
</html>
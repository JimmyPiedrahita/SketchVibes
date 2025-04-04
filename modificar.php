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
    <title>SketchVibes - Modificar imagen</title>
    <link rel="icon" href="img/logo.ico">
    <link rel="stylesheet" href="css/styles.css">
</head>
<?php
include("conexion.php");
include("obtener-categorias.php");
$id_imagen = $_REQUEST['id_imagen'];
$query = "select * from imagenes where id_imagen = '$id_imagen'";
$resultado = $conexion->query($query);
$row = $resultado->fetch_assoc();
?>
<body class="container-add">
    <div class="container-form form-add">
        <form method="post" action="proceso-modificar.php?id=<?php echo $row['id_imagen'];?>" enctype="multipart/form-data" class="formulario-add">
            <label>Nueva categoria</label>
            <select name="categoria" required class="selector-categoria">
                <?php
                while ($categoria = $categorias->fetch_assoc()) {
                ?>
                    <option value="<?php echo $categoria['nombre'] ?>"><?php echo $categoria['nombre'] ?></option>
                <?php
                }
                ?>
            </select>
            <label>Categoria actual: <?php echo $row['categoria'] ?></label>
            <div class="grid-item" data-filter=<?php echo $row['categoria']; ?>>
                    <img class="img-modificar" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']) ?>">
                </div>
                <br>
            <input type="file" name="imagen" accept="image/*" class="selector-imagen">
            <button type="submit" class="btn btn-action" name="guardar-imagen">Modificar</button>
        </form>
        <a href="home.php"><button class="btn btn-index" name="cancelar">Cancelar</button></a>
    </div>
</body>

</html>
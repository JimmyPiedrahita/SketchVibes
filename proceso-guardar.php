<?php
include("conexion.php");
$categoria_nombre = $_POST['categoria'];

// Obtener el id_categoria basado en el nombre de la categoría
$query_categoria = "SELECT id_categoria FROM categorias WHERE nombre = '$categoria_nombre'";
$resultado_categoria = $conexion->query($query_categoria);
$categoria_data = $resultado_categoria->fetch_assoc();
$id_categoria = $categoria_data['id_categoria'];

$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
$query = "insert into imagenes(id_categoria, imagen) values('$id_categoria', '$imagen')";
 $resultado = $conexion->query($query);

 if($resultado){
    header("location: home.php");
 }

 if(isset($_POST["cancelar"])){
   header("Location: home.php");
 }
?>
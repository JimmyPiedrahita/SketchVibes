<?php
include("conexion.php");
$id = $_REQUEST['id'];
$categoria = $_POST['categoria'];

// Obtener el ID de la categoría basado en el nombre
$query_categoria = "SELECT id_categoria FROM categorias WHERE nombre = '$categoria'";
$resultado_categoria = $conexion->query($query_categoria);
$row_categoria = $resultado_categoria->fetch_assoc();
$id_categoria = $row_categoria['id_categoria'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileError = $_FILES['imagen']['error'];

    if ($fileError === 4) {
      $query = "UPDATE imagenes SET id_categoria='$id_categoria' WHERE id_imagen = '$id'";
    } else {
      $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
      $query = "UPDATE imagenes SET id_categoria='$id_categoria', imagen='$imagen' WHERE id_imagen = '$id'";
    }
}
 $resultado = $conexion->query($query);
 if($resultado){
    header("location: home.php");
 }

 if(isset($_POST["cancelar"])){
   header("Location: home.php");
 }
?>
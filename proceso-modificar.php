<?php
include("conexion.php");
$id = $_REQUEST['id'];
$categoria = $_POST['categoria'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileError = $_FILES['imagen']['error'];

    if ($fileError === 4) {
      $query = "update imagenes set categoria='$categoria' where id_imagen = '$id'";
    } else {
      $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
      $query = "update imagenes set categoria='$categoria', imagen='$imagen' where id_imagen = '$id'";
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
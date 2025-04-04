<?php
include("conexion.php");
$categoria = $_POST['categoria'];
$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
$query = "insert into imagenes(categoria, imagen) values('$categoria', '$imagen')";
 $resultado = $conexion->query($query);

 if($resultado){
    header("location: home.php");
 }

 if(isset($_POST["cancelar"])){
   header("Location: home.php");
 }
?>
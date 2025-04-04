<?php
include("conexion.php");
$id = $_REQUEST['id'];
$query = "delete from imagenes where id_imagen = '$id'";
 $resultado = $conexion->query($query);

 if($resultado){
    header("location: home.php");
 }

 if(isset($_POST["cancelar"])){
   header("Location: home.php");
 }
?>
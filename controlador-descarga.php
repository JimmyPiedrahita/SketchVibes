<?php
session_start();
include("conexion.php");
if (isset($_POST['id_imagen_actual'])) {
    $id_imagen = $_POST['id_imagen_actual'];
    $id_usuario = $_SESSION['id_usuario_actual'];
    $fecha = date('Y-m-d');
    $query = "insert into descargas(id_usuario, id_imagen, fecha) values('$id_usuario', '$id_imagen', '$fecha')";
    $resultado = $conexion->query($query);
}
?>
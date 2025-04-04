<?php
include("conexion.php");
$query = "select * from categorias";
$categorias = $conexion->query($query);
?>
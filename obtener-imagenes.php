<?php
include("conexion.php");
$query = "SELECT i.id_imagen, i.imagen, c.nombre as categoria 
          FROM imagenes i 
          JOIN categorias c ON i.id_categoria = c.id_categoria";
$resultado = $conexion->query($query);
?>
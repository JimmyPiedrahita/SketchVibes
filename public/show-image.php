<?php
require_once __DIR__ . '/../config/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(404);
    die('Imagen no encontrada');
}

$imageController = new ImageController();
$imageController->show($_GET['id']);
?>

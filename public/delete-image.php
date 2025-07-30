<?php
require_once __DIR__ . '/../config/config.php';

// Verificar autenticación y permisos de administrador
SessionHelper::init();
if (!SessionHelper::isLoggedIn()) {
    header('Location: /SketchVibes/public/login.php');
    exit;
}

$imageController = new ImageController();

// Obtener ID de la imagen
$id = $_GET['id'] ?? null;

if (!$id) {
    FlashMessages::add('error', 'ID de imagen no proporcionado');
    header('Location: /SketchVibes/public/home.php');
    exit;
}

// Procesar eliminación
$imageController->delete($id);
?>

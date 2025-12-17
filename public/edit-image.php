<?php
require_once __DIR__ . '/../config/config.php';

// Verificar autenticación y permisos de administrador
SessionHelper::init();
if (!SessionHelper::isLoggedIn()) {
    header('Location: /login.php');
    exit;
}

$imageController = new ImageController();

// Obtener ID de la imagen
$id = $_GET['id'] ?? null;

if (!$id) {
    FlashMessages::add('error', 'ID de imagen no proporcionado');
    header('Location: /home.php');
    exit;
}

// Si es POST, procesar la actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageController->update($id);
} else {
    // Mostrar formulario de edición
    $imageController->showEditForm($id);
}
?>

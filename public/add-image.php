<?php
require_once __DIR__ . '/../config/config.php';

// Verificar autenticación y permisos de administrador
SessionHelper::init();
if (!SessionHelper::isLoggedIn()) {
    header('Location: /login.php');
    exit;
}

$imageController = new ImageController();

// Si es POST, procesar la subida
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageController->store();
} else {
    // Mostrar formulario
    $imageController->showAddForm();
}
?>

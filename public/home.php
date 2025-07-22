<?php
require_once __DIR__ . '/../config/config.php';

// Verificar autenticación
SessionHelper::init();
if (!SessionHelper::isLoggedIn()) {
    header('Location: /SketchVibes/public/login.php');
    exit;
}

$imageController = new ImageController();
$imageController->gallery();
?>

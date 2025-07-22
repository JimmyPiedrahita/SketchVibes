<?php
require_once __DIR__ . '/../config/config.php';

$authController = new AuthController();
$authController->logout();
?>

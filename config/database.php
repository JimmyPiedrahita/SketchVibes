<?php
class Database {
    private $connection;
    public function __construct() {
        // Leemos las credenciales que configuraremos en Apache
        $host = getenv('DB_HOST') ?: 'localhost';
        $db   = getenv('DB_NAME') ?: 'sketchvibes_prod';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';
        
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) { 
            die("Error de conexión: " . $e->getMessage()); 
        }
    }
    public function getConnection() { return $this->connection; }
}
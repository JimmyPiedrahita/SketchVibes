<?php
class Database {
    private $connection;
    public function __construct() {
        // Leemos las credenciales que configuraremos en Apache
        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '3306';
        $db   = getenv('DB_NAME') ?: 'sketchvibes_prod';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';
        
        try {
            // TiDB Cloud requiere conexión segura. 
            // Aseguramos que se incluya el puerto y opciones SSL si es necesario.
            $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];

            // Si estamos conectando a TiDB Cloud, a veces es necesario especificar opciones SSL.
            // Por defecto, PDO intentará negociar SSL.
            if ($port == 4000) {
                $options[PDO::MYSQL_ATTR_SSL_CA] = ''; // A veces necesario para forzar SSL sin certificado específico si el sistema lo tiene
                // O simplemente confiar en que el servidor lo requiera y el cliente lo acepte.
                // Una configuración común para TiDB sin certificado local es:
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
            }

            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) { 
            die("Error de conexión: " . $e->getMessage()); 
        }
    }
    public function getConnection() { return $this->connection; }
}
<?php

class User {
    private $db;
    private $table = 'usuarios';
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    /**
     * Crear nuevo usuario
     */
    public function create($nombre, $email, $password) {
        try {
            // Verificar si el email ya existe
            if ($this->emailExists($email)) {
                return ['success' => false, 'message' => 'El email ya está registrado'];
            }
            
            // Hash de la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Usuario creado correctamente'];
            }
            
            return ['success' => false, 'message' => 'Error al crear usuario'];
            
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error de base de datos: ' . $e->getMessage()];
        }
    }
    
    /**
     * Autenticar usuario
     */
    public function authenticate($email, $password) {
        try {
            // Primero verificar usuarios normales
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($user = $stmt->fetch()) {
                if (password_verify($password, $user['password'])) {
                    return [
                        'success' => true,
                        'user' => $user,
                        'is_admin' => false
                    ];
                }
            }
            
            // Si no es usuario normal, verificar administradores
            $sql = "SELECT * FROM administradores WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($admin = $stmt->fetch()) {
                if (password_verify($password, $admin['password'])) {
                    return [
                        'success' => true,
                        'user' => $admin,
                        'is_admin' => true
                    ];
                }
            }
            
            return ['success' => false, 'message' => 'Credenciales incorrectas'];
            
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error de base de datos'];
        }
    }
    
    /**
     * Verificar si el email existe
     */
    private function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0;
    }
    
    /**
     * Obtener usuario por ID
     */
    public function getById($id) {
        try {
            $sql = "SELECT id, nombre, email FROM usuarios WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }
}

<?php

class Category {
    private $db;
    private $table = 'categorias';
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    /**
     * Obtener todas las categorías
     */
    public function getAll() {
        try {
            $sql = "SELECT * FROM categorias ORDER BY nombre";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    
    /**
     * Obtener categoría por ID
     */
    public function getById($id) {
        try {
            $sql = "SELECT * FROM categorias WHERE id_categoria = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Crear nueva categoría
     */
    public function create($nombre) {
        try {
            $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Categoría creada correctamente'];
            }
            
            return ['success' => false, 'message' => 'Error al crear categoría'];
            
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Duplicate entry
                return ['success' => false, 'message' => 'La categoría ya existe'];
            }
            return ['success' => false, 'message' => 'Error de base de datos'];
        }
    }
}

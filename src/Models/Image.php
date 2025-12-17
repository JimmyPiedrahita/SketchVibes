<?php

class Image {
    private $db;
    private $table = 'imagenes';
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    /**
     * Obtener todas las imágenes
     */
    public function getAll() {
        try {
            $sql = "SELECT i.*, c.nombre as categoria_nombre 
                    FROM imagenes i 
                    LEFT JOIN categorias c ON i.id_categoria = c.id_categoria 
                    ORDER BY i.id_imagen DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    
    /**
     * Obtener imagen por ID
     */
    public function getById($id) {
        try {
            $sql = "SELECT i.*, c.nombre as categoria_nombre 
                    FROM imagenes i 
                    LEFT JOIN categorias c ON i.id_categoria = c.id_categoria 
                    WHERE i.id_imagen = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Crear nueva imagen
     */
    public function create($categoria_id, $imagen_data, $titulo = null, $descripcion = null) {
        try {
            $sql = "INSERT INTO imagenes (id_categoria, imagen, titulo, descripcion) 
                    VALUES (:categoria_id, :imagen, :titulo, :descripcion)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindParam(':categoria_id', $categoria_id);
            $stmt->bindParam(':imagen', $imagen_data);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descripcion', $descripcion);
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Imagen subida correctamente'];
            }
            
            return ['success' => false, 'message' => 'Error al subir imagen'];
            
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error de base de datos: ' . $e->getMessage()];
        }
    }
    
    /**
     * Actualizar imagen
     */
    public function update($id, $categoria_id, $titulo = null, $descripcion = null, $imagen_data = null) {
        try {
            if ($imagen_data) {
                $sql = "UPDATE imagenes SET id_categoria = :categoria_id, titulo = :titulo, 
                        descripcion = :descripcion, imagen = :imagen WHERE id_imagen = :id";
            } else {
                $sql = "UPDATE imagenes SET id_categoria = :categoria_id, titulo = :titulo, 
                        descripcion = :descripcion WHERE id_imagen = :id";
            }
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':categoria_id', $categoria_id);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descripcion', $descripcion);
            
            if ($imagen_data) {
                $stmt->bindParam(':imagen', $imagen_data);
            }
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Imagen actualizada correctamente'];
            }
            
            return ['success' => false, 'message' => 'Error al actualizar imagen'];
            
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error de base de datos'];
        }
    }
    
    /**
     * Eliminar imagen
     */
    public function delete($id) {
        try {
            $sql = "DELETE FROM imagenes WHERE id_imagen = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                return ['success' => true, 'message' => 'Imagen eliminada correctamente'];
            }
            
            return ['success' => false, 'message' => 'Error al eliminar imagen'];
            
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error de base de datos'];
        }
    }
    
    /**
     * Obtener imágenes por categoría
     */
    public function getByCategory($categoria_id) {
        try {
            $sql = "SELECT i.*, c.nombre as categoria_nombre 
                    FROM imagenes i 
                    LEFT JOIN categorias c ON i.id_categoria = c.id_categoria 
                    WHERE i.id_categoria = :categoria_id 
                    ORDER BY i.id_imagen DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':categoria_id', $categoria_id);
            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}

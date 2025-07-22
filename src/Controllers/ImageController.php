<?php

class ImageController {
    private $imageModel;
    private $categoryModel;
    
    public function __construct() {
        $this->imageModel = new Image();
        $this->categoryModel = new Category();
    }
    
    /**
     * Mostrar galería de imágenes
     */
    public function gallery() {
        $images = $this->imageModel->getAll();
        $categories = $this->categoryModel->getAll();
        
        include __DIR__ . '/../Views/gallery/index.php';
    }
    
    /**
     * Mostrar formulario para agregar imagen
     */
    public function showAddForm() {
        $this->requireAdmin();
        $categories = $this->categoryModel->getAll();
        
        include __DIR__ . '/../Views/gallery/add.php';
    }
    
    /**
     * Procesar subida de imagen
     */
    public function store() {
        $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria_id = $_POST['categoria'] ?? '';
            $titulo = $this->sanitizeInput($_POST['titulo'] ?? '');
            $descripcion = $this->sanitizeInput($_POST['descripcion'] ?? '');
            
            if (empty($categoria_id)) {
                $this->setFlashMessage('error', 'La categoría es requerida');
                return $this->showAddForm();
            }
            
            if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
                $this->setFlashMessage('error', 'Error al subir la imagen');
                return $this->showAddForm();
            }
            
            $uploadResult = $this->handleImageUpload($_FILES['imagen']);
            
            if (!$uploadResult['success']) {
                $this->setFlashMessage('error', $uploadResult['message']);
                return $this->showAddForm();
            }
            
            $result = $this->imageModel->create(
                $categoria_id,
                $uploadResult['data'],
                $titulo,
                $descripcion
            );
            
            if ($result['success']) {
                $this->setFlashMessage('success', $result['message']);
                header('Location: /SketchVibes/public/home.php');
                exit;
            } else {
                $this->setFlashMessage('error', $result['message']);
            }
        }
        
        return $this->showAddForm();
    }
    
    /**
     * Mostrar formulario para editar imagen
     */
    public function showEditForm($id) {
        $this->requireAdmin();
        
        $image = $this->imageModel->getById($id);
        if (!$image) {
            $this->setFlashMessage('error', 'Imagen no encontrada');
            header('Location: /SketchVibes/public/home.php');
            exit;
        }
        
        $categories = $this->categoryModel->getAll();
        
        include __DIR__ . '/../Views/gallery/edit.php';
    }
    
    /**
     * Actualizar imagen
     */
    public function update($id) {
        $this->requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoria_id = $_POST['categoria'] ?? '';
            $titulo = $this->sanitizeInput($_POST['titulo'] ?? '');
            $descripcion = $this->sanitizeInput($_POST['descripcion'] ?? '');
            
            $imagen_data = null;
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['imagen']);
                if ($uploadResult['success']) {
                    $imagen_data = $uploadResult['data'];
                } else {
                    $this->setFlashMessage('error', $uploadResult['message']);
                    return $this->showEditForm($id);
                }
            }
            
            $result = $this->imageModel->update($id, $categoria_id, $titulo, $descripcion, $imagen_data);
            
            if ($result['success']) {
                $this->setFlashMessage('success', $result['message']);
                header('Location: /SketchVibes/public/home.php');
                exit;
            } else {
                $this->setFlashMessage('error', $result['message']);
            }
        }
        
        return $this->showEditForm($id);
    }
    
    /**
     * Eliminar imagen
     */
    public function delete($id) {
        $this->requireAdmin();
        
        $result = $this->imageModel->delete($id);
        
        if ($result['success']) {
            $this->setFlashMessage('success', $result['message']);
        } else {
            $this->setFlashMessage('error', $result['message']);
        }
        
        header('Location: /SketchVibes/public/home.php');
        exit;
    }
    
    /**
     * Descargar imagen
     */
    public function download($id) {
        $image = $this->imageModel->getById($id);
        
        if (!$image) {
            http_response_code(404);
            die('Imagen no encontrada');
        }
        
        $filename = 'sketchvibes_' . $id . '.jpg';
        
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($image['imagen']));
        
        echo $image['imagen'];
        exit;
    }
    
    /**
     * Mostrar imagen
     */
    public function show($id) {
        $image = $this->imageModel->getById($id);
        
        if (!$image) {
            http_response_code(404);
            die('Imagen no encontrada');
        }
        
        header('Content-Type: image/jpeg');
        header('Cache-Control: public, max-age=86400'); // Cache por 1 día
        
        echo $image['imagen'];
        exit;
    }
    
    /**
     * Manejar subida de imagen
     */
    private function handleImageUpload($file) {
        // Validar tipo de archivo
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'message' => 'Tipo de archivo no permitido'];
        }
        
        // Validar tamaño
        if ($file['size'] > MAX_FILE_SIZE) {
            return ['success' => false, 'message' => 'El archivo es demasiado grande (máximo 5MB)'];
        }
        
        // Verificar que es una imagen válida
        $imageInfo = getimagesize($file['tmp_name']);
        if (!$imageInfo) {
            return ['success' => false, 'message' => 'El archivo no es una imagen válida'];
        }
        
        // Leer contenido del archivo
        $imageData = file_get_contents($file['tmp_name']);
        
        return ['success' => true, 'data' => $imageData];
    }
    
    /**
     * Verificar autenticación
     */
    private function requireAuth() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /SketchVibes/public/login.php');
            exit;
        }
    }
    
    /**
     * Verificar permisos de administrador
     */
    private function requireAdmin() {
        $this->requireAuth();
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            $this->setFlashMessage('error', 'No tienes permisos para realizar esta acción');
            header('Location: /SketchVibes/public/home.php');
            exit;
        }
    }
    
    /**
     * Sanitizar entrada
     */
    private function sanitizeInput($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Establecer mensaje flash
     */
    private function setFlashMessage($type, $message) {
        session_start();
        $_SESSION['flash_messages'][] = ['type' => $type, 'message' => $message];
    }
}

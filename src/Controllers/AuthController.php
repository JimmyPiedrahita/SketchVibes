<?php

class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    /**
     * Manejar inicio de sesión
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->sanitizeInput($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            
            if (empty($email) || empty($password)) {
                $this->setFlashMessage('error', 'Email y contraseña son requeridos');
                return $this->renderLogin();
            }
            
            $result = $this->userModel->authenticate($email, $password);
            
            if ($result['success']) {
                $this->startSession($result['user'], $result['is_admin']);
                header('Location: /SketchVibes/public/home.php');
                exit;
            } else {
                $this->setFlashMessage('error', $result['message']);
            }
        }
        
        return $this->renderLogin();
    }
    
    /**
     * Manejar registro
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $this->sanitizeInput($_POST['nombre'] ?? '');
            $email = $this->sanitizeInput($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            // Validaciones
            $errors = $this->validateRegistration($nombre, $email, $password, $confirmPassword);
            
            if (empty($errors)) {
                $result = $this->userModel->create($nombre, $email, $password);
                
                if ($result['success']) {
                    $this->setFlashMessage('success', $result['message']);
                    header('Location: /SketchVibes/public/login.php');
                    exit;
                } else {
                    $this->setFlashMessage('error', $result['message']);
                }
            } else {
                foreach ($errors as $error) {
                    $this->setFlashMessage('error', $error);
                }
            }
        }
        
        return $this->renderRegister();
    }
    
    /**
     * Cerrar sesión
     */
    public function logout() {
        session_start();
        session_destroy();
        header('Location: /SketchVibes/public/index.php');
        exit;
    }
    
    /**
     * Verificar si está autenticado
     */
    public function requireAuth() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /SketchVibes/public/login.php');
            exit;
        }
    }
    
    /**
     * Verificar si es administrador
     */
    public function requireAdmin() {
        $this->requireAuth();
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            header('Location: /SketchVibes/public/home.php');
            exit;
        }
    }
    
    /**
     * Iniciar sesión
     */
    private function startSession($user, $isAdmin) {
        session_start();
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'] ?? $user['email'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['is_admin'] = $isAdmin;
    }
    
    /**
     * Validar datos de registro
     */
    private function validateRegistration($nombre, $email, $password, $confirmPassword) {
        $errors = [];
        
        if (empty($nombre)) {
            $errors[] = 'El nombre es requerido';
        }
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email válido es requerido';
        }
        
        if (strlen($password) < 6) {
            $errors[] = 'La contraseña debe tener al menos 6 caracteres';
        }
        
        if ($password !== $confirmPassword) {
            $errors[] = 'Las contraseñas no coinciden';
        }
        
        return $errors;
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
    
    /**
     * Renderizar vista de login
     */
    private function renderLogin() {
        include __DIR__ . '/../Views/auth/login.php';
    }
    
    /**
     * Renderizar vista de registro
     */
    private function renderRegister() {
        include __DIR__ . '/../Views/auth/register.php';
    }
}

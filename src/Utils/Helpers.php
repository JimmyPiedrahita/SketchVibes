<?php

class FlashMessages {
    
    /**
     * Mostrar y limpiar mensajes flash
     */
    public static function display() {
        session_start();
        
        if (isset($_SESSION['flash_messages']) && !empty($_SESSION['flash_messages'])) {
            $messages = $_SESSION['flash_messages'];
            unset($_SESSION['flash_messages']);
            
            foreach ($messages as $message) {
                $alertClass = $message['type'] === 'success' ? 'alert-success' : 'alert-danger';
                echo "<div class='alert {$alertClass} alert-dismissible fade show' role='alert'>";
                echo htmlspecialchars($message['message']);
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert'></button>";
                echo "</div>";
            }
        }
    }
    
    /**
     * Agregar mensaje flash
     */
    public static function add($type, $message) {
        session_start();
        $_SESSION['flash_messages'][] = ['type' => $type, 'message' => $message];
    }
}

class SecurityHelper {
    
    /**
     * Generar token CSRF
     */
    public static function generateCSRFToken() {
        session_start();
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verificar token CSRF
     */
    public static function verifyCSRFToken($token) {
        session_start();
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Sanitizar HTML
     */
    public static function sanitizeHTML($input) {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Validar email
     */
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

class SessionHelper {
    
    /**
     * Inicializar sesión segura
     */
    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Verificar si está logueado
     */
    public static function isLoggedIn() {
        self::init();
        return isset($_SESSION['user_id']);
    }
    
    /**
     * Verificar si es administrador
     */
    public static function isAdmin() {
        self::init();
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
    }
    
    /**
     * Obtener usuario actual
     */
    public static function getCurrentUser() {
        self::init();
        if (self::isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'is_admin' => $_SESSION['is_admin'] ?? false
            ];
        }
        return null;
    }
    
    /**
     * Destruir sesión
     */
    public static function destroy() {
        self::init();
        session_destroy();
    }
}

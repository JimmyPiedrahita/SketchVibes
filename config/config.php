<?php
/**
 * Configuración general de la aplicación
 */

// Cargar variables de entorno desde .env
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

// Configuración de sesión
$lifetime = 31536000;
ini_set('session.gc_maxlifetime', $lifetime);
ini_set('session.cookie_lifetime', $lifetime);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

$env = getenv('APP_ENV') ?: 'local';
ini_set('session.cookie_secure', ($env === 'production' ? 1 : 0));

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de la aplicación
define('APP_NAME', getenv('APP_NAME') ?: 'sketchvibes');
define('APP_URL', getenv('APP_URL') ?: 'http://localhost/sketchvibes');
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Autoloader simple
spl_autoload_register(function ($class) {
    // Primero intentar con la estructura de carpetas
    $paths = [
        __DIR__ . '/../src/Controllers/' . $class . '.php',
        __DIR__ . '/../src/Models/' . $class . '.php',
        __DIR__ . '/../src/Utils/' . $class . '.php',
        __DIR__ . '/../src/' . str_replace('\\', '/', $class) . '.php'
    ];
    
    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Incluir archivos necesarios
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../src/Utils/Helpers.php';

// Incluir controladores principales
require_once __DIR__ . '/../src/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/ImageController.php';

// Incluir modelos principales
require_once __DIR__ . '/../src/Models/User.php';
require_once __DIR__ . '/../src/Models/Image.php';
require_once __DIR__ . '/../src/Models/Category.php';
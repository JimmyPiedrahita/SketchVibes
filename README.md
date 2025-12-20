# 🎨 SketchVibes - Galería de Dibujos

**SketchVibes** es una aplicación web moderna para gestionar y mostrar una galería de dibujos, construida con PHP siguiendo el patrón MVC y las mejores prácticas de desarrollo.

## ✨ Características Principales

- 🔐 **Sistema de autenticación seguro** con contraseñas hasheadas
- 👑 **Roles diferenciados**: administrador y usuario normal
- 📤 **Gestión de imágenes**: subir, editar, eliminar (solo admins)
- 🖼️ **Galería responsive** con filtros por categoría
- ⬬ **Descarga de imágenes** en alta calidad
- 🛡️ **Protección contra vulnerabilidades** (SQL injection, XSS, CSRF)
- 📱 **Diseño responsive** con Bootstrap 5

## 🏗️ Arquitectura

### Estructura MVC
```
SketchVibes/
├── config/              # Configuración
│   ├── config.php       # Configuración general
│   └── database.php     # Conexión a BD
├── src/                 # Código fuente
│   ├── Controllers/     # Controladores
│   ├── Models/          # Modelos de datos
│   ├── Views/           # Vistas
│   └── Utils/           # Utilidades
├── public/              # Archivos públicos
│   ├── img/            # Imágenes estáticas
│   ├── js/             # JavaScript
│   │   └── scripts.js
│   └── *.php           # Puntos de entrada
├── uploads/             # Directorio de subidas
└── basededatos.sql      # Script SQL de la base de datos
```

### Seguridad
- ✅ **PDO con prepared statements** (anti SQL injection)
- ✅ **Contraseñas hasheadas** con `password_hash()`
- ✅ **Protección CSRF** con tokens
- ✅ **Sanitización de datos** de entrada
- ✅ **Validación de archivos** subidos
- ✅ **Sesiones seguras** con configuración mejorada

### Estructura y Código
- ✅ **Patrón MVC** implementado
- ✅ **Autoloader** para clases
- ✅ **Separación de responsabilidades**
- ✅ **Reutilización de código**
- ✅ **Manejo de errores** mejorado
- ✅ **Código documentado**

### Interfaz de Usuario
- ✅ **Bootstrap 5** para diseño responsive
- ✅ **Mensajes flash** para feedback
- ✅ **Modal para vista de imágenes**
- ✅ **Filtros por categoría**
- ✅ **Navegación mejorada**
- ✅ **Iconos Font Awesome**

## 🛠️ Instalación

### Requisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior (o MariaDB)
- Servidor web (Apache/Nginx)

### Pasos de instalación

1. **Clonar o descargar el proyecto**
   ```bash
   git clone https://github.com/usuario/SketchVibes.git
   cd SketchVibes
   ```

2. **Configurar la base de datos**
   - Crear una base de datos en tu servidor MySQL (ej. `sketchvibes_prod`).
   - Importar el archivo `basededatos.sql` en la base de datos creada.

3. **Configurar entorno**
   - El proyecto utiliza un archivo `.env` para la configuración.
   - Asegúrate de que el archivo `.env` exista en la raíz y tenga las credenciales correctas:
     ```ini
     DB_HOST=localhost
     DB_PORT=3306
     DB_NAME=sketchvibes_prod
     DB_USER=root
     DB_PASS=
     ```
   - Alternativamente, puedes editar `config/database.php` directamente.

4. **Acceder a la aplicación**
   - Si usas XAMPP, coloca la carpeta en `htdocs` y navega a:
     `http://localhost/sketchvibes/`

### Credenciales por defecto
- **Admin**: admin@gmail.com / 12345

## 📋 Funcionalidades

### Para todos los usuarios
- Ver galería de imágenes
- Filtrar por categoría
- Descargar imágenes
- Ver detalles en modal

### Para administradores
- Todas las funciones de usuario
- Subir nuevas imágenes
- Editar imágenes existentes
- Eliminar imágenes

## 🔧 Tecnologías Utilizadas

- **Backend**: PHP 7.4+
- **Base de datos**: MySQL
- **Frontend**: HTML5, CSS3, Bootstrap 5
- **JavaScript**: Vanilla JS
- **Iconos**: Font Awesome 6
- **Arquitectura**: MVC Pattern

## 📊 Base de Datos

### Tablas principales
- `usuarios` - Información de usuarios
- `administradores` - Información de admins
- `categorias` - Categorías de imágenes
- `imagenes` - Datos y archivos de imágenes

### Relaciones
- `imagenes.id_categoria` → `categorias.id_categoria`

## 🔒 Seguridad

- Contraseñas hasheadas con `PASSWORD_DEFAULT`
- Prepared statements para consultas SQL
- Validación y sanitización de inputs
- Protección CSRF con tokens
- Validación de tipos de archivo
- Límites de tamaño de archivo
- Sesiones seguras configuradas

# 🎨 SketchVibes - Galería de Dibujos (Versión Mejorada)

**SketchVibes** es una aplicación web moderna para gestionar y mostrar una galería de dibujos, construida con PHP siguiendo el patrón MVC y las mejores prácticas de desarrollo.

## ✨ Características Principales

- 🔐 **Sistema de autenticación seguro** con contraseñas hasheadas
- 👑 **Roles diferenciados**: administrador y usuario normal
- 📤 **Gestión de imágenes**: subir, editar, eliminar (solo admins)
- 🖼️ **Galería responsive** con filtros por categoría
- ⬬ **Descarga de imágenes** en alta calidad
- 🛡️ **Protección contra vulnerabilidades** (SQL injection, XSS, CSRF)
- 📱 **Diseño responsive** con Bootstrap 5

## 🏗️ Arquitectura Mejorada

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
│   ├── css/            # Estilos
│   ├── img/            # Imágenes estáticas
│   ├── *.php           # Puntos de entrada
│   └── scripts.js      # JavaScript
├── uploads/             # Archivos subidos
└── database_updated.sql # Base de datos mejorada
```

## 🚀 Mejoras Implementadas

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
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)

### Pasos de instalación

1. **Clonar o descargar el proyecto**
   ```bash
   git clone https://github.com/usuario/SketchVibes.git
   cd SketchVibes
   ```

2. **Configurar la base de datos**
   - Crear base de datos `bd_sketchvibes`
   - Importar `database_updated.sql`
   ```sql
   CREATE DATABASE bd_sketchvibes;
   USE bd_sketchvibes;
   SOURCE database_updated.sql;
   ```

3. **Configurar credenciales**
   - Editar `config/database.php` si es necesario
   - Verificar permisos de la carpeta `uploads/`

4. **Acceder a la aplicación**
   - Navegar a `http://localhost/SketchVibes/public/`

### Credenciales por defecto
- **Admin**: admin@gmail.com / 12345
- **Usuario**: user@gmail.com / password123

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
- Gestionar categorías

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

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver `LICENSE` para más detalles.

## 👥 Autores

- **Desarrollador Original** - Código base inicial
- **Mejoras y Reestructuración** - GitHub Copilot

## 🐛 Reporte de Bugs

Si encuentras algún bug, por favor:
1. Revisa si ya fue reportado en Issues
2. Crea un nuevo Issue con:
   - Descripción del problema
   - Pasos para reproducir
   - Comportamiento esperado vs actual
   - Screenshots si aplica

## 🚀 Roadmap

### Próximas mejoras planeadas
- [ ] Sistema de usuarios con perfiles
- [ ] Comentarios en imágenes
- [ ] Tags personalizados
- [ ] API REST
- [ ] Panel de administración avanzado
- [ ] Optimización de imágenes automática
- [ ] Sistema de backups
- [ ] Tests unitarios

---

⭐ ¡Si te gusta el proyecto, dale una estrella en GitHub!

-- Nombre de la base de datos: bd_sketchvibes

-- Eliminar tablas existentes si existen (en orden inverso debido a las claves foráneas)
DROP TABLE IF EXISTS imagenes;
DROP TABLE IF EXISTS administradores;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS categorias;

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    descripcion TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE imagenes (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    titulo VARCHAR(255),
    descripcion TEXT,
    imagen LONGBLOB NOT NULL,
    filename VARCHAR(255),
    file_size INT,
    mime_type VARCHAR(100),
    downloads INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE CASCADE
);

-- Insertar categorías por defecto
INSERT INTO categorias(nombre, descripcion) VALUES 
('artistico', 'Dibujos artísticos y creativos'),
('tecnico', 'Dibujos técnicos y arquitectónicos'),
('geometrico', 'Figuras y patrones geométricos'),
('animado', 'Personajes y dibujos animados'),
('topografico', 'Mapas y dibujos topográficos');

-- Insertar administrador por defecto (contraseña hasheada para '12345')
INSERT INTO administradores(nombre, email, password) VALUES 
('Administrador', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Crear usuario de ejemplo (contraseña hasheada para 'password123')
INSERT INTO usuarios(nombre, email, password) VALUES 
('Usuario Demo', 'user@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

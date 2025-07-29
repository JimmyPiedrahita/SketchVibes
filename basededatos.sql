-- Nombre de la base de datos: bd_sketchvibes

-- Eliminar tablas existentes si existen (en orden inverso debido a las claves foráneas)
DROP TABLE IF EXISTS imagenes;
DROP TABLE IF EXISTS administradores;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS categorias;

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE imagenes (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT,
    imagen LONGBLOB,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

INSERT INTO categorias(nombre) VALUES ('artistico');
INSERT INTO categorias(nombre) VALUES ('tecnico');
INSERT INTO categorias(nombre) VALUES ('geometrico');
INSERT INTO categorias(nombre) VALUES ('animado');
INSERT INTO categorias(nombre) VALUES ('topografico');
-- Password admin: 12345
INSERT INTO administradores(email, password) VALUES ('admin@gmail.com', '$2y$10$HNL5H/8SMwdhJeuiqB3dvuc/epagOP19ITnyFLMJorx9WpWraV7FC');

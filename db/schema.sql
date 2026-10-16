-- Script de creación de Base de Datos y Tabla Personas
-- Base de Datos
CREATE DATABASE IF NOT EXISTS arq_2026;
USE arq_2026;

-- Tabla Personas
CREATE TABLE IF NOT EXISTS personas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    edad INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Datos de ejemplo (opcional)
INSERT INTO personas (nombre, email, edad) VALUES
('Juan García', 'juan@example.com', 28),
('María López', 'maria@example.com', 25),
('Carlos Pérez', 'carlos@example.com', 32),
('Carlos Paez', 'carlospaez@example.com', 58);

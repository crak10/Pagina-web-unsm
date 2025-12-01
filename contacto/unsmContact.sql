-- =====================================================
-- BASE DE DATOS PARA FORMULARIO DE CONTACTO - UNSM
-- =====================================================

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS unsm_contacto 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_spanish_ci;

-- Usar la base de datos
USE unsm_contacto;

-- Crear la tabla de mensajes de contacto
CREATE TABLE IF NOT EXISTS mensajes_contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    dni VARCHAR(20) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    oficina VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'leido', 'respondido') DEFAULT 'pendiente',
    ip_address VARCHAR(45),
    user_agent TEXT,
    INDEX idx_fecha (fecha_envio),
    INDEX idx_estado (estado),
    INDEX idx_oficina (oficina)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Crear tabla para log de errores (opcional pero recomendado)
CREATE TABLE IF NOT EXISTS log_errores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_error VARCHAR(100),
    mensaje_error TEXT,
    archivo VARCHAR(255),
    linea INT,
    fecha_error TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- =====================================================
-- CONSULTAS ÚTILES PARA ADMINISTRACIÓN
-- =====================================================

-- Ver todos los mensajes
-- SELECT * FROM mensajes_contacto ORDER BY fecha_envio DESC;

-- Ver mensajes pendientes
-- SELECT * FROM mensajes_contacto WHERE estado = 'pendiente' ORDER BY fecha_envio DESC;

-- Contar mensajes por oficina
-- SELECT oficina, COUNT(*) as total FROM mensajes_contacto GROUP BY oficina;

-- Buscar mensajes por DNI
-- SELECT * FROM mensajes_contacto WHERE dni = '12345678' ORDER BY fecha_envio DESC;

-- Cambiar estado de un mensaje
-- UPDATE mensajes_contacto SET estado = 'leido' WHERE id = 1;

-- =====================================================
-- INFORMACIÓN DE INSTALACIÓN
-- =====================================================
-- 1. Abre phpMyAdmin
-- 2. Haz clic en "Importar" en el menú superior
-- 3. Selecciona este archivo database_contacto.sql
-- 4. Haz clic en "Continuar"
-- 5. La base de datos estará lista para usar
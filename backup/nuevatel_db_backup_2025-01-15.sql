# NuevaTel — Database Backup
# ⚠️ VULN #5: Backup de BD expuesto públicamente en /backup/
# Fecha: 2025-01-15 03:00:01 (cron job automático)
# Servidor: nuevatel-server-01 / MySQL 5.7

-- NuevaTel Database Dump
-- Generado por: mysqldump 5.7.44

CREATE DATABASE IF NOT EXISTS `nuevatel_db`;
USE `nuevatel_db`;

-- ⚠️ Tabla de usuarios con hashes MD5 expuestos
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL COMMENT 'MD5 sin salt',
  `email` varchar(100) DEFAULT NULL,
  `rol` enum('admin','soporte','tecnico','cliente') NOT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `creado` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ⚠️ DATOS SENSIBLES: Credenciales de todos los usuarios
INSERT INTO `usuarios` VALUES
(1, 'admin',     '5f4dcc3b5aa765d61d8327deb882cf99', 'admin@nuevatel.com.bo',     'admin',    NULL,        1, '2024-01-01 00:00:00'),
(2, 'soporte1',  '827ccb0eea8a706c4c34a16891f84e7b', 'soporte@nuevatel.com.bo',   'soporte',  NULL,        1, '2024-01-10 09:00:00'),
(3, 'tecnico',   'e10adc3949ba59abbe56e057f20f883e', 'tecnico@nuevatel.com.bo',   'tecnico',  NULL,        1, '2024-01-10 09:00:00'),
(4, 'mlopez',    '96e79218965eb72c92a549dd5a330112', 'mlopez@gmail.com',          'cliente',  '8712345',   1, '2024-01-15 10:22:00'),
(5, 'cquispe',   '827ccb0eea8a706c4c34a16891f84e7b', 'cquispe@gmail.com',        'cliente',  '5436789',   1, '2024-02-03 14:55:00');

-- Contraseñas en texto plano (para referencia interna — NUNCA HACER ESTO):
-- admin    → password
-- soporte1 → 12345
-- tecnico  → 123456
-- mlopez   → iloveyou
-- cquispe  → 12345

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `ci` varchar(20) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` text,
  `plan` varchar(50) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `clientes` VALUES
(1, 'María López',    '8712345', '70111222', 'mlopez@gmail.com',  'Av. América 456, Cbba', 'Hogar Plus', '2024-01-15'),
(2, 'Carlos Quispe',  '5436789', '70333444', 'cquispe@gmail.com', 'Calle Sucre 789, Cbba',  'Fibra Max',  '2024-02-03'),
(3, 'Ana Flores',     '7891234', '70555666', 'aflores@hotmail.com','Av. Blanco 12, Cbba',  'Básico',     '2023-11-20');

-- ⚠️ Configuración del servidor expuesta
CREATE TABLE `config_sistema` (
  `clave` varchar(100) NOT NULL,
  `valor` text,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB;

INSERT INTO `config_sistema` VALUES
('smtp_host',     'mail.nuevatel.com.bo'),
('smtp_user',     'no-reply@nuevatel.com.bo'),
('smtp_password', 'NuevaTel@Mail2024'),
('db_backup_key', 'bk_nt_xK9mP2vL8qR5'),
('api_secret',    'nt_live_sk_8f2a9c1d4e7b3f6a2c8d5e9f1a4b7c2d');

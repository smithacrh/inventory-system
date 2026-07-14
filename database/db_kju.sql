-- Database: db_kju
-- Created: 2026-07-14
-- Description: Inventory Management System Database

CREATE DATABASE IF NOT EXISTS db_kju;
USE db_kju;

-- Table: users
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `level` int(11) NOT NULL COMMENT '1=Admin, 2=Operator Assembly, 3=Operator Cutting, 4=Driver',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: consumers
CREATE TABLE `consumers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: categories
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL UNIQUE,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: items
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(50) NOT NULL COMMENT 'pcs, meter, kg, liter, dll',
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_category` (`category_id`),
  CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: productions
CREATE TABLE `productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `production_date` datetime NOT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_item` (`item_id`),
  KEY `fk_created_by` (`created_by`),
  KEY `idx_production_date` (`production_date`),
  CONSTRAINT `fk_production_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_production_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: cuttings
CREATE TABLE `cuttings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cutting_date` datetime NOT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_item` (`item_id`),
  KEY `fk_created_by` (`created_by`),
  KEY `idx_cutting_date` (`cutting_date`),
  CONSTRAINT `fk_cutting_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cutting_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: deliveries
CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `delivery_date` datetime NOT NULL,
  `delivery_type` varchar(50) NOT NULL COMMENT 'Masuk/Keluar',
  `notes` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_consumer` (`consumer_id`),
  KEY `fk_item` (`item_id`),
  KEY `fk_created_by` (`created_by`),
  KEY `idx_delivery_date` (`delivery_date`),
  CONSTRAINT `fk_delivery_consumer` FOREIGN KEY (`consumer_id`) REFERENCES `consumers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_delivery_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_delivery_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Indexes untuk optimasi query
CREATE INDEX idx_item_stock ON items(stock);
CREATE INDEX idx_item_category ON items(category_id);
CREATE INDEX idx_production_item ON productions(item_id);
CREATE INDEX idx_cutting_item ON cuttings(item_id);
CREATE INDEX idx_delivery_item ON deliveries(item_id);
CREATE INDEX idx_delivery_consumer ON deliveries(consumer_id);

-- Insert Default Admin User
INSERT INTO `users` (`username`, `password`, `name`, `level`, `created_at`) VALUES 
('admin', '$2y$10$N9qo8uLOickgx2ZMRZoHyeIjZAgcg7b3XeKeUxWdeS86E36ZyYD4m', 'Administrator', 1, NOW());
-- Password: password123 (hashed with bcrypt)

-- Insert Sample Data
INSERT INTO `categories` (`category_name`, `description`, `created_at`) VALUES 
('Elektronik', 'Produk Elektronik', NOW()),
('Tekstil', 'Bahan Tekstil', NOW()),
('Logam', 'Produk Logam', NOW()),
('Plastik', 'Produk Plastik', NOW()),
('Kaca', 'Produk Kaca', NOW());

INSERT INTO `consumers` (`name`, `phone`, `email`, `address`, `created_at`) VALUES 
('PT. Maju Jaya', '0821-1234-5678', 'info@majujaya.com', 'Jl. Sudirman No. 123, Jakarta', NOW()),
('CV. Bersama Makmur', '0822-9876-5432', 'cv@bersamamakmur.com', 'Jl. Gatot Subroto No. 456, Bandung', NOW()),
('Toko Elektronik Sejahtera', '0823-5555-6666', 'toko@sejahtera.com', 'Jl. Ahmad Yani No. 789, Surabaya', NOW()),
('Distributor Umum', '0824-1111-2222', 'distributor@umum.com', 'Jl. Ratulangi No. 321, Medan', NOW());

INSERT INTO `items` (`item_name`, `category_id`, `stock`, `unit`, `price`, `created_at`) VALUES 
('Kabel USB 1 Meter', 1, 150, 'pcs', 25000.00, NOW()),
('Kain Katun Premium', 2, 500, 'meter', 75000.00, NOW()),
('Plat Baja 5mm', 3, 100, 'lembar', 500000.00, NOW()),
('Kantong Plastik Besar', 4, 2000, 'pack', 50000.00, NOW()),
('Botol Kaca Bening 500ml', 5, 800, 'pcs', 15000.00, NOW());

-- Create View for Dashboard
CREATE VIEW v_dashboard_summary AS
SELECT 
  (SELECT COUNT(*) FROM consumers) as total_consumers,
  (SELECT COUNT(*) FROM items) as total_items,
  (SELECT COUNT(*) FROM productions) as total_productions,
  (SELECT COUNT(*) FROM deliveries) as total_deliveries,
  (SELECT SUM(stock * price) FROM items) as total_inventory_value;

-- Create View for Low Stock Alert
CREATE VIEW v_low_stock_alert AS
SELECT 
  i.id,
  i.item_name,
  c.category_name,
  i.stock,
  i.unit,
  i.price
FROM items i
LEFT JOIN categories c ON i.category_id = c.id
WHERE i.stock < 10
ORDER BY i.stock ASC;
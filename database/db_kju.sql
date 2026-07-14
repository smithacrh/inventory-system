-- Database: db_kju
-- Version: 1.0

CREATE DATABASE IF NOT EXISTS `db_kju`;
USE `db_kju`;

-- Table: users
CREATE TABLE `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(100) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `level` INT NOT NULL COMMENT '1=Admin, 2=Operator Assembly, 3=Operator Cutting, 4=Driver',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: consumers (Konsumen)
CREATE TABLE `consumers` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `address` LONGTEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: item_categories (Kategori Barang)
CREATE TABLE `item_categories` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: items (Barang)
CREATE TABLE `items` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `category_id` INT NOT NULL,
  `stock` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `item_categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: stock_additions (Penambahan Stok)
CREATE TABLE `stock_additions` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `item_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `created_by` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: production (Produksi Barang)
CREATE TABLE `production` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `item_id` INT NOT NULL,
  `quantity_produced` INT NOT NULL,
  `waste_quantity` INT NOT NULL DEFAULT 0,
  `created_by` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: cutting_production (Produksi Cutting)
CREATE TABLE `cutting_production` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `item_id` INT NOT NULL,
  `quantity_produced` INT NOT NULL,
  `waste_quantity` INT NOT NULL DEFAULT 0,
  `created_by` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: production_waste (Sampah Produksi)
CREATE TABLE `production_waste` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `production_id` INT,
  `cutting_production_id` INT,
  `quantity` INT NOT NULL,
  `type` VARCHAR(50) NOT NULL COMMENT 'production atau cutting',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`production_id`) REFERENCES `production`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`cutting_production_id`) REFERENCES `cutting_production`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: delivery_letters (Surat Jalan)
CREATE TABLE `delivery_letters` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `letter_number` VARCHAR(100) NOT NULL UNIQUE,
  `letter_date` DATE NOT NULL,
  `vehicle_number` VARCHAR(50) NOT NULL,
  `type` VARCHAR(20) NOT NULL COMMENT 'in atau out',
  `created_by` INT NOT NULL,
  `approved_by` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`approved_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: delivery_letter_items (Detail Surat Jalan)
CREATE TABLE `delivery_letter_items` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `delivery_letter_id` INT NOT NULL,
  `item_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`delivery_letter_id`) REFERENCES `delivery_letters`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Index
CREATE INDEX `idx_users_username` ON `users`(`username`);
CREATE INDEX `idx_items_category` ON `items`(`category_id`);
CREATE INDEX `idx_production_date` ON `production`(`created_at`);
CREATE INDEX `idx_cutting_date` ON `cutting_production`(`created_at`);
CREATE INDEX `idx_delivery_date` ON `delivery_letters`(`letter_date`);
CREATE INDEX `idx_stock_additions_date` ON `stock_additions`(`created_at`);

-- Default Users
INSERT INTO `users` (`username`, `password`, `level`) VALUES
('admin', '$2y$10$YIjlrPNaYeOZnL4S7H7xHOzJjMFJ7T.Hhd.yE7lHdmD8V8B8vQODa', 1),
('operator_assembly', '$2y$10$YIjlrPNaYeOZnL4S7H7xHOzJjMFJ7T.Hhd.yE7lHdmD8V8B8vQODa', 2),
('operator_cutting', '$2y$10$YIjlrPNaYeOZnL4S7H7xHOzJjMFJ7T.Hhd.yE7lHdmD8V8B8vQODa', 3),
('driver', '$2y$10$YIjlrPNaYeOZnL4S7H7xHOzJjMFJ7T.Hhd.yE7lHdmD8V8B8vQODa', 4);

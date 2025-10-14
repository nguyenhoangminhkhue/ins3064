-- SQL file for Laptop Shop Management System
-- Database: LaptopShop
-- Table: Laptops

-- Create database
CREATE DATABASE IF NOT EXISTS `LaptopShop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `LaptopShop`;

-- Create laptops for user data
CREATE TABLE IF NOT EXISTS `Laptops` (
  `LaptopID` INT(11) NOT NULL AUTO_INCREMENT,
    Brand VARCHAR(50) NOT NULL,
    Model VARCHAR(100) NOT NULL,
    Processor VARCHAR(100),
    RAM VARCHAR(20),
    Storage VARCHAR(50),
    Price DECIMAL(10,2),
    Quantity INT,
  PRIMARY KEY (`LaptopID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data (optional)
INSERT INTO Laptops (Brand, Model, Processor, RAM, Storage, Price, Quantity) VALUES
('Dell', 'Inspiron 15', 'Intel i5-1135G7', '8GB', '512GB SSD', 750.00, 10),
('HP', 'Pavilion x360', 'Intel i7-1165G7', '16GB', '1TB SSD', 1200.00, 5),
('Apple', 'MacBook Air M1', 'Apple M1', '8GB', '256GB SSD', 999.00, 8),
('Lenovo', 'ThinkPad X1 Carbon', 'Intel i7-1185G7', '16GB', '512GB SSD', 1400.00, 4),
('Asus', 'ROG Zephyrus G14', 'AMD Ryzen 9 5900HS', '16GB', '1TB SSD', 1500.00, 6);
('Lenovo', 'ThinkPad X1 Carbon', 'Intel Core i7-1260P', '16GB', '1TB SSD', 1800.00, 5, 2023);
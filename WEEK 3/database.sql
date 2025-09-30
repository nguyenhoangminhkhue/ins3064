-- SQL file for PHP User Management System
-- Database: LoginReg
-- Table: Laptops

-- Create database
CREATE DATABASE IF NOT EXISTS `LoginReg` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `LoginReg`;

-- Create table1 for user data
CREATE TABLE IF NOT EXISTS `Laptops` (
  LaptopID INT PRIMARY KEY AUTO_INCREMENT,
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
INSERT INTO `Laptops` (`LaptopID`, `Brand`, `Model`, `Processor`,`RAM`,`Storage`,`Price`,`Quantity` ) VALUES
('Dell', 'XPS 13', 'Intel Core i7-1250U', '16GB', '512GB SSD', 1500.00, 10, 2023),
('Apple', 'MacBook Air M2', 'Apple M2', '8GB', '256GB SSD', 1200.00, 15, 2022),
('HP', 'Pavilion 15', 'AMD Ryzen 5 5600U', '16GB', '1TB SSD', 1000.00, 8, 2023),
('Asus', 'ZenBook 14', 'Intel Core i5-1240P', '8GB', '512GB SSD', 900.00, 12, 2022),
('Lenovo', 'ThinkPad X1 Carbon', 'Intel Core i7-1260P', '16GB', '1TB SSD', 1800.00, 5, 2023);
CREATE DATABASE IF NOT EXISTS `LoginReg`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `LoginReg`;

CREATE TABLE IF NOT EXISTS `userReg` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentid` VARCHAR(50) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `dob` DATE NOT NULL,
  `country` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_studentid` (`studentid`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

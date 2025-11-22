CREATE TABLE `table1` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`AName` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`Species` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`Area` VARCHAR(150) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`Date` DATE NOT NULL,
	`photo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`des` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
AUTO_INCREMENT=13
;

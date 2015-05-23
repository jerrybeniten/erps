ALTER TABLE `erps`.`users` 
ADD COLUMN `user_type` TINYINT(1) NOT NULL DEFAULT 0 AFTER `is_active`,
ADD COLUMN `country_name` VARCHAR(3) NOT NULL AFTER `user_type`;
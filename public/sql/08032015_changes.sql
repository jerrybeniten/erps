ALTER TABLE `erps`.`job_analysis` 
ADD COLUMN `hash` VARCHAR(255) NOT NULL AFTER `id`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`, `hash`);
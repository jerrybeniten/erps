CREATE TABLE companies(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(100) NOT NULL,
	street_number VARCHAR(50) NOT NULL,
    street VARCHAR(255) NOT NULL,
    city_id INT NOT NULL,
    state_id INT NOT NULL,
    postcode VARCHAR(255) NOT NULL,
    country_id INT NOT NULL,
    mobile VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    company_status_id INT NOT NULL,
    created_at DATE NOT NULL DEFAULT '0000-00-00',
    updated_at DATE NOT NULL DEFAULT '0000-00-00'
);

ALTER TABLE `erps`.`companies` 
CHANGE COLUMN `city_id` `city` VARCHAR(100) NOT NULL ;

CREATE TABLE states(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    state_name VARCHAR(50) NOT NULL,
    state_code VARCHAR(50) NOT NULL
);

INSERT INTO `erps`.`states` (`state_name`, `state_code`) VALUES ('New South Wales', 'NSW');
INSERT INTO `erps`.`states` (`state_name`, `state_code`) VALUES ('Queensland', 'QLD');
INSERT INTO `erps`.`states` (`state_name`, `state_code`) VALUES ('South Australia', 'SA');
INSERT INTO `erps`.`states` (`state_name`, `state_code`) VALUES ('Tasmania', 'TAS');
INSERT INTO `erps`.`states` (`state_name`, `state_code`) VALUES ('Victoria', 'VIC');
INSERT INTO `erps`.`states` (`state_name`, `state_code`) VALUES ('Western Australia', 'WA');

ALTER TABLE `erps`.`companies` 
DROP COLUMN `company_status_id`;
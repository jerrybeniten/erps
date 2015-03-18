CREATE TABLE countries(
	geoname_id INT NOT NULL PRIMARY KEY,
    locale_code VARCHAR(2) NOT NULL,
    continent_code VARCHAR(2) NOT NULL,
    continent_name VARCHAR(20) NOT NULL,
    country_iso_code VARCHAR(20) NOT NULL,
    country_name VARCHAR(100) NOT NULL
);
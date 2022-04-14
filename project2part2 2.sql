-- Project2

DROP DATABASE IF EXISTS euro_restuarant;
CREATE DATABASE euro_restuarant;
USE euro_restuarant;

DROP TABLE IF EXISTS mega_table;
CREATE TABLE mega_table (
	restaurant_link VARCHAR(100),
    restaurant_name VARCHAR(500),
    original_location VARCHAR(500),
    country VARCHAR(20),
    region VARCHAR(45),
    province VARCHAR(60),
    city VARCHAR(60),
    address VARCHAR(500),
    latitude VARCHAR(15),
    longitude VARCHAR(15),
    claimed VARCHAR(10),
    awards VARCHAR(500),
    popularity_detailed VARCHAR(80),
    popularity_generic VARCHAR(80),
    top_tags VARCHAR(100),
    price_level VARCHAR(20),
    price_range VARCHAR(40),
    meals VARCHAR(100),
    cuisines VARCHAR(500),
    special_diets VARCHAR(80),
    features VARCHAR(800),
    vegetarian_friendly VARCHAR(1),
    vegan_options VARCHAR(1),
    gluten_free VARCHAR(1),
    original_open_hours VARCHAR(300),
    open_days_per_week VARCHAR(3),
    open_hours_per_week VARCHAR(20),
    working_shifts_per_week VARCHAR(20),
    avg_rating VARCHAR(3),
    total_reviews_count VARCHAR(10),
    default_language VARCHAR(20),
    reviews_count_in_default_language VARCHAR(10),
    excellent VARCHAR(10),
    very_good VARCHAR(10),
    average VARCHAR(10),
    poor VARCHAR(10),
    terrible VARCHAR(10),
    food VARCHAR(5),
    service VARCHAR(5),
    value_rating VARCHAR(5),
    atmosphere VARCHAR(5),
    keywords VARCHAR(300)
);

-- Load data into megatable
LOAD DATA INFILE '/Users/stephanielin/Desktop/CS3265/project2/tripadvisor_european_restaurants.csv' INTO TABLE euro_restuarant.mega_table
    CHARACTER SET latin1
    FIELDS Terminated BY ',' 
    OPTIONALLY ENCLOSED BY '"' 
    LINES TERMINATED BY '\r\n'
    IGNORE 1 ROWS;

-- Dependency Test

-- To test whether there are restuarants with identical names. Turn out that there are many repeated names.
SELECT restaurant_name, count(*)
FROM mega_table
GROUP BY restaurant_name
HAVING count(*) > 1;

SELECT restaurant_name
FROM mega_table
GROUP BY restaurant_name
HAVING COUNT(DISTINCT restaurant_link) > 1;

-- To test whether there are restuarants with identical link. Turn out that none of them have indentical link. So we choose restaurant_link as primary key for later table.
SELECT restaurant_link, count(*)
FROM mega_table
GROUP BY restaurant_link
HAVING count(*) > 1;

SELECT restaurant_link
FROM mega_table
GROUP BY restaurant_link
HAVING COUNT(DISTINCT restaurant_name) > 1;

-- address -> latitude, longtitude. FAIL
SELECT address  
FROM mega_table 
GROUP BY address
HAVING COUNT(DISTINCT latitude) > 1 OR COUNT(DISTINCT longitude)>1;

-- price_range -> price_level. FAIL
SELECT price_range, count(price_level)
FROM mega_table
WHERE price_level != ''
GROUP BY price_range
HAVING COUNT(DISTINCT price_level) > 1;

-- vegan_options -> vegetarian_friendly. FAIL
SELECT vegan_options
FROM mega_table
GROUP BY vegan_options
HAVING COUNT(DISTINCT vegetarian_friendly) > 1;

-- original_location -> country, region, province, city. SUCCEED
## SELECT original_location
## FROM mega_table
## GROUP BY original_location
## HAVING COUNT(DISTINCT country) > 1 OR COUNT(DISTINCT region) > 1 OR COUNT(DISTINCT province) > 1 OR COUNT(DISTINCT city) > 1;

-- Decomposition
DROP TABLE IF EXISTS basic_info;
CREATE TABLE IF NOT EXISTS basic_info (
	restaurant_link VARCHAR(25) NOT NULL,
    restaurant_name VARCHAR(200),
    claimed VARCHAR(10),
    PRIMARY KEY (restaurant_link)
);

DROP TABLE IF EXISTS demograhic;
CREATE TABLE IF NOT EXISTS demograhic (
	restaurant_link VARCHAR(25) NOT NULL,
    country VARCHAR(20),
    region VARCHAR(45),
    province VARCHAR(60),
    city VARCHAR(60),
    address VARCHAR(500),
    latitude VARCHAR(15),
    longitude VARCHAR(15),
    PRIMARY KEY (restaurant_link),
	CONSTRAINT fk_link_demo FOREIGN KEY (restaurant_link)
		REFERENCES basic_info(restaurant_link)
);

DROP TABLE IF EXISTS professional_evaluation;
CREATE TABLE IF NOT EXISTS professional_evaluation (
	restaurant_link VARCHAR(25) NOT NULL,
	awards VARCHAR(500),
	popularity_detailed VARCHAR(80),
    popularity_generic VARCHAR(80),
    PRIMARY KEY (restaurant_link),
	CONSTRAINT fk_link_prof FOREIGN KEY (restaurant_link)
		REFERENCES basic_info(restaurant_link)
);

DROP TABLE IF EXISTS res_features;
CREATE TABLE IF NOT EXISTS res_features (
	restaurant_link VARCHAR(25) NOT NULL,
	top_tags VARCHAR(100),
	features VARCHAR(600),
    keywords VARCHAR(300),
    PRIMARY KEY (restaurant_link),
	CONSTRAINT fk_link_feat FOREIGN KEY (restaurant_link)
		REFERENCES basic_info(restaurant_link)
);

DROP TABLE IF EXISTS meals;
CREATE TABLE IF NOT EXISTS meals (
	restaurant_link VARCHAR(25) NOT NULL,
	meals VARCHAR(100),
    cuisines VARCHAR(200),
    special_diets VARCHAR(80),
    PRIMARY KEY (restaurant_link),
	CONSTRAINT fk_link_meals FOREIGN KEY (restaurant_link)
		REFERENCES basic_info(restaurant_link)
);

DROP TABLE IF EXISTS price;
CREATE TABLE IF NOT EXISTS price (
	restaurant_link VARCHAR(25) NOT NULL,
	price_level VARCHAR(20),
    price_range VARCHAR(40),
    PRIMARY KEY (restaurant_link),
	CONSTRAINT fk_link_price FOREIGN KEY (restaurant_link)
		REFERENCES basic_info(restaurant_link)
);

DROP TABLE IF EXISTS special_option;
CREATE TABLE IF NOT EXISTS special_option (
	restaurant_link VARCHAR(25) NOT NULL,
    vegetarian_friendly VARCHAR(1),
    vegan_options VARCHAR(1),
    gluten_free VARCHAR(1),
    PRIMARY KEY (restaurant_link),
	CONSTRAINT fk_link_option FOREIGN KEY (restaurant_link)
		REFERENCES basic_info(restaurant_link)
);

DROP TABLE IF EXISTS hours;
CREATE TABLE IF NOT EXISTS hours (
	restaurant_link VARCHAR(25) NOT NULL,
    original_open_hours VARCHAR(300),
    open_days_per_week TINYINT UNSIGNED,
    open_hours_per_week DECIMAL(5,2),
    working_shifts_per_week DECIMAL(4,2),
    PRIMARY KEY (restaurant_link),
	CONSTRAINT fk_link_hours FOREIGN KEY (restaurant_link)
		REFERENCES basic_info(restaurant_link)
);

DROP TABLE IF EXISTS customer_rating;
CREATE TABLE IF NOT EXISTS customer_rating (
	restaurant_link VARCHAR(25) NOT NULL,
	avg_rating DECIMAL(2,1),
    total_reviews_count INT UNSIGNED,
    default_language VARCHAR(20),
    reviews_count_in_default_language INT UNSIGNED,
    excellent INT UNSIGNED,
    very_good INT UNSIGNED,
    average INT UNSIGNED,
    poor INT UNSIGNED,
    terrible INT UNSIGNED,
    food DECIMAL(2,1),
    service DECIMAL(2,1),
    value_rating DECIMAL(2,1),
    atmosphere DECIMAL(2,1),
    PRIMARY KEY (restaurant_link),
	CONSTRAINT fk_link_cust FOREIGN KEY (restaurant_link)
		REFERENCES basic_info(restaurant_link)
);

-- DATA CLEANING 

SET SQL_SAFE_UPDATES = 0;

UPDATE mega_table
SET open_days_per_week = NULL
WHERE open_days_per_week = '';

UPDATE mega_table
SET open_hours_per_week = NULL
WHERE open_hours_per_week = '';

UPDATE mega_table
SET working_shifts_per_week = NULL
WHERE working_shifts_per_week = '';

UPDATE mega_table
SET avg_rating = NULL
WHERE avg_rating = '';

UPDATE mega_table
SET total_reviews_count = NULL
WHERE total_reviews_count = '';

UPDATE mega_table
SET reviews_count_in_default_language = NULL
WHERE reviews_count_in_default_language = '';

UPDATE mega_table
SET excellent = NULL
WHERE excellent = '';

UPDATE mega_table
SET very_good = NULL
WHERE very_good = '';

UPDATE mega_table
SET average = NULL
WHERE average = '';

UPDATE mega_table
SET poor = NULL
WHERE poor = '';

UPDATE mega_table
SET terrible = NULL
WHERE terrible = '';

UPDATE mega_table
SET food = NULL
WHERE food = '';

UPDATE mega_table
SET service = NULL
WHERE service = '';

UPDATE mega_table
SET value_rating = NULL
WHERE value_rating = '';

UPDATE mega_table
SET atmosphere = NULL
WHERE atmosphere = '';

-- TRIGGERS

-- transform empty string of original_open_hours into 'Not Available' to better inform users
DROP TRIGGER IF EXISTS hours_before_insert;

DELIMITER //

CREATE TRIGGER hours_before_insert
BEFORE INSERT
ON hours
FOR EACH ROW
BEGIN

	IF NEW.original_open_hours = '' THEN
		SET NEW.original_open_hours = 'Not Available';
	END IF;

END //

-- Transform price_level and price_range into correct format

DROP TRIGGER IF EXISTS price_before_insert;

DELIMITER //

CREATE TRIGGER price_before_insert
BEFORE INSERT
ON price
FOR EACH ROW
BEGIN

	IF NEW.price_level <> '' THEN
        SET NEW.price_level = REPLACE(NEW.price_level, 'â‚¬', '€');
	END IF;
    
	IF NEW.price_range <> '' THEN
        SET NEW.price_range = REPLACE(NEW.price_range, 'â‚¬', '€');
	END IF;

END //

-- Insert data into decomposed tables

INSERT INTO basic_info
	SELECT restaurant_link, 
		restaurant_name, 
		claimed
	FROM mega_table;
    
INSERT INTO demograhic
	SELECT restaurant_link, 
    country, 
    region, 
    province, 
    city, 
    address, 
    latitude, 
    longitude
	FROM mega_table;
    
INSERT INTO professional_evaluation
	SELECT restaurant_link, 
		awards, 
        popularity_detailed, 
        popularity_generic
	FROM mega_table;

INSERT INTO res_features
	SELECT restaurant_link, 
		top_tags, 
        features, 
        keywords
	FROM mega_table;
    
INSERT INTO meals
	SELECT restaurant_link, 
		meals, 
		cuisines, 
        special_diets
	FROM mega_table;

INSERT INTO price
	SELECT restaurant_link, 
		price_level, 
        price_range
	FROM mega_table;
    
INSERT INTO special_option
	SELECT restaurant_link, 
		vegetarian_friendly, 
        vegan_options, 
        gluten_free
	FROM mega_table;

INSERT INTO hours
	SELECT restaurant_link, 
		original_open_hours, 
        open_days_per_week, 
        open_hours_per_week, 
        working_shifts_per_week
	FROM mega_table;
    
INSERT INTO customer_rating
	SELECT restaurant_link, 
		avg_rating, 
        total_reviews_count, 
        default_language, 
        reviews_count_in_default_language, 
        excellent, 
        very_good, 
        average, 
        poor, 
        terrible, 
        food, 
        service, 
        value_rating, 
        atmosphere
	FROM mega_table;
    
-- VIEWS

-- show restuarants that have rating of 5
DROP VIEW IF EXISTS res_avg_rating_5;
CREATE VIEW res_avg_rating_5 AS
SELECT restaurant_name, country, address, popularity_detailed, popularity_generic
FROM basic_info
	JOIN customer_rating ON basic_info.restaurant_link = customer_rating.restaurant_link
    JOIN professional_evaluation ON basic_info.restaurant_link = professional_evaluation.restaurant_link
    JOIN demograhic ON basic_info.restaurant_link = demograhic.restaurant_link
WHERE avg_rating = 5.0;

-- Test
SELECT * FROM res_avg_rating_5;

-- show restuarants that are both vegetarian friendly and provide vegan options
DROP VIEW IF EXISTS res_veg_friendly;
CREATE VIEW res_veg_friendly AS
SELECT restaurant_name, country, address, original_open_hours, features, keywords
FROM basic_info
	JOIN res_features ON basic_info.restaurant_link = res_features.restaurant_link
    JOIN special_option ON basic_info.restaurant_link = special_option.restaurant_link
    JOIN demograhic ON basic_info.restaurant_link = demograhic.restaurant_link
    JOIN hours ON basic_info.restaurant_link = hours.restaurant_link
WHERE vegetarian_friendly = 'Y' AND vegan_options = 'Y';

-- TEST
SELECT * FROM res_veg_friendly;

-- STORED PROCEDURES

-- Allow users to search vegetarian friendly restaurants that have vegan options by country
DROP PROCEDURE IF EXISTS search_res_by_country;

DELIMITER //

CREATE PROCEDURE search_res_by_country(IN country_name VARCHAR(100))

BEGIN

	IF country_name IN (SELECT country FROM demograhic) THEN
		SELECT restaurant_name, address, original_open_hours, features, keywords
		FROM res_veg_friendly
		WHERE country = country_name;
	END IF;

END //

-- TEST 
CALL search_res_by_country('Italy');

-- TEST 
CALL search_res_by_country('Stephanie');

-- Allow users to search restaurants' general information
DROP PROCEDURE IF EXISTS search_geninfo;

DELIMITER //

CREATE PROCEDURE search_geninfo (IN res_name VARCHAR(300))

BEGIN

	IF res_name IN (SELECT restaurant_name FROM basic_info) THEN
		SELECT restaurant_name, address, original_open_hours, price_level, avg_rating, top_tags
		FROM basic_info
			JOIN demograhic ON basic_info.restaurant_link = demograhic.restaurant_link
			JOIN hours ON basic_info.restaurant_link = hours.restaurant_link
            JOIN price ON basic_info.restaurant_link = price.restaurant_link
            JOIN res_features ON basic_info.restaurant_link = res_features.restaurant_link
            JOIN customer_rating ON basic_info.restaurant_link = customer_rating.restaurant_link
		WHERE restaurant_name = res_name;
	END IF;

END //

-- TEST1 Successfully find
CALL search_geninfo('Le 147');

-- TEST2 CANNOT FIND
CALL search_geninfo('XiaoyingLin');

-- Allow users to search restaurants that have rating of 5 by country
DROP PROCEDURE IF EXISTS search_res_rating_5;

DELIMITER //

CREATE PROCEDURE search_res_rating_5(IN country_name VARCHAR(100))

BEGIN

	IF country_name IN (SELECT country FROM demograhic) THEN
		SELECT restaurant_name, address, popularity_detailed, popularity_generic
		FROM res_avg_rating_5
		WHERE country = country_name;
	END IF;

END //

-- TEST
CALL search_res_rating_5('Italy');

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






<?php

if (isset($_POST['field_submit'])) {

    require_once("p2conn.php");

    $var_restaurant_link = $_POST['field_restaurant_link'];
    $var_restaurant_name = $_POST['field_restaurant_name'];
    $var_original_location = $_POST['field_original_location'];
    $var_country = $_POST['field_country'];
    $var_region = $_POST['field_region'];
    $var_province = $_POST['field_province'];
    $var_city = $_POST['field_city'];
    $var_address = $_POST['field_address'];
    $var_latitude = $_POST['field_latitude'];
    $var_longitude = $_POST['field_longitude'];
    $var_claimed = $_POST['field_claimed'];
    $var_popularity_detailed = $_POST['field_popularity_detailed'];
    $var_popularity_generic = $_POST['field_popularity_generic'];
    $var_top_tags = $_POST['field_top_tags'];
    $var_price_level = $_POST['field_price_level'];
    $var_price_range = $_POST['field_price_range'];
    $var_meals = $_POST['field_meals'];
    $var_cuisines = $_POST['field_cuisines'];
    $var_special_diets = $_POST['field_special_diets'];
    $var_features = $_POST['field_features'];
    $var_vegetarian_friendly = $_POST['field_vegetarian_friendly'];
    $var_vegan_options = $_POST['field_vegan_options'];
    $var_gluten_free = $_POST['field_gluten_free'];
    $var_original_open_hours = $_POST['field_original_open_hours'];
    $var_open_days_per_week = $_POST['field_open_days_per_week'];
    $var_open_hours_per_week = $_POST['field_open_hours_per_week'];
    $var_working_shifts_per_week = $_POST['field_working_shifts_per_week'];
    $var_avg_rating = $_POST['field_avg_rating'];
    $var_total_reviews_count = $_POST['field_total_reviews_count'];
    $var_default_language = $_POST['field_default_language'];
    $var_reviews_count_in_default_language = $_POST['field_reviews_count_in_default_language'];
    $var_excellent = $_POST['field_excellent'];
    $var_very_good = $_POST['field_very_good'];
    $var_c = $_POST['field_c'];
    $var_poor = $_POST['field_poor'];
    $var_terrible = $_POST['field_terrible'];
    $var_food = $_POST['field_food'];
    $var_service = $_POST['field_service'];
    $var_value_rating = $_POST['field_value_rating'];
    $var_atmosphere = $_POST['field_atmosphere'];
    $var_keywords = $_POST['field_keywords'];



//double check
    $query = "INSERT INTO Movie (restaurant_link, restaurant_name, original_location, country, region, province,
    city, address, latitude, longitude, claimed, awards, popularity_detailed, popularity_generic,
    top_tags, price_level, price_range, meals, cuisines, special_diets, features, vegetarian_friendly,
    vegan_options, gluten_free, original_open_hours, open_days_per_week, open_hours_per_week, working_shifts_per_week,
    avg_rating, total_reviews_count, default_language, reviews_count_in_default_language, excellent, very_good,
    c, poor, terrible, food, service, value_rating, atmosphere, keywords) "
            . "VALUES (:restaurant_link, :restaurant_name, :original_location, :country, :region, :province,
            :city, :address, :latitude, :longitude,
            :claimed, :awards, :popularity_detailed, :popularity_generic,
            :top_tags, :price_level, :price_range, :meals,
            :cuisines, :special_diets, :features, :vegetarian_friendly,
            :vegan_options, :gluten_free, :original_open_hours, :open_days_per_week,
            :open_hours_per_week, :working_shifts_per_week, :avg_rating, :total_reviews_count,
            :default_language, :reviews_count_in_default_language, :excellent, :very_good,
            :c, :poor, :terrible, :food,
            :service, :value_rating, :atmosphere, :keywords)";

    try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':restaurant_link', $var_restaurant_link, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':restaurant_name', $var_restaurant_name, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':original_location', $var_original_location, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':country', $var_country, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':region', $var_region, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':province', $var_province, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':city', $var_city, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':address', $var_address, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':latitude', $var_latitude, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':longitude', $var_longitude, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':claimed', $var_claimed, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':awards', $var_awards, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':popularity_detailed', $var_popularity_detailed, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':popularity_generic', $var_popularity_generic, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':top_tags', $var_top_tags, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':price_level', $var_top_tags, PDO::PARAM_STR);

      $prepared_stmt->bindValue(':price_range', $var_latitude, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':meals', $var_longitude, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':cuisines', $var_claimed, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':special_diets', $var_awards, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':features', $var_popularity_detailed, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':vegetarian_friendly', $var_popularity_generic, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':vegan_options', $var_top_tags, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':gluten_free', $var_top_tags, PDO::PARAM_STR);

      $prepared_stmt->bindValue(':original_open_hours', $var_original_open_hours, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':open_days_per_week', $var_open_days_per_week, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':default_language', $var_default_language, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':reviews_count_in_default_language', $var_reviews_count_in_default_language, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':excellent', $var_excellent, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':very_good', $var_very_good, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':c', $var_c, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':poor', $var_poor, PDO::PARAM_STR);

      $prepared_stmt->bindValue(':terrible', $var_terrible, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':food ', $var_food, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':service', $var_service, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':value_rating', $var_open_hours_per_week, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':keywords', $var_avg_rating, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':atmosphere', $var_atmosphere, PDO::PARAM_STR);
      $result = $prepared_stmt->execute();

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
}

?>

<html>
  <head>
    <!-- THe following is the stylesheet file. The CSS file decides look and feel -->
    <link rel="stylesheet" type="text/css" href="project.css" />
  </head> 

  <body>
    <div id="navbar">
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="getRestaurant.php">Search Movie</a></li>
        <li><a href="insertRestaurant.php">Insert Movie</a></li>
        <li><a href="deleteRestaurant.php">Delete Movie</a></li>
        <li><a href="getByVegFriendly.php">Delete Restaurant</a></li>
        <li><a href="getByRating5.php">Delete Restaurant</a></li>
        <li><a href="getByGenInfo.php">Delete Restaurant</a></li>
      </ul>
    </div>

<h1> Insert Movie </h1>

    <form method="post">
    	<label for="restaurant_link">Restaurant</label>
    	<input type="text" name="f_mID" id="id_mID"> 

    	<label for="restaurant_name">title</label>
    	<input type="text" name="restaurant_name" id="id_restaurant_name">

      <input type="submit" name="field_submit" value="Submit">
    </form>
    <?php
      if (isset($_POST['f_submit'])) {
        if ($result) { 
    ?>
          Restaurant data was inserted successfully.
    <?php 
        } else { 
    ?>
          <h3> Sorry, there was an error. Movie data was not inserted. </h3>
    <?php 
        }
      } 
    ?>


    
  </body>
</html>
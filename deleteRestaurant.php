<?php
// If the all the variables are set when the Submit button is clicked...
if (isset($_POST['field_submit'])) {
    // It will refer to conn.php file and will open a connection.
    require_once("p2conn.php");
    // Will get the value typed in the form text field and save into variable
    $var_title = $_POST['field_title'];
    // Save the query into variable called $query. NOte that :title is a place holder
    $query = "CALL deleteRestaurant(:title)";
    
    try
    {
      $prepared_stmt = $dbo->prepare($query);

      //bind the value saved in the variable $var_restaurant_name to the place holder :title after
      //verifying (using PDO::PARAM_STR) that the user has typed a valid string.
      $prepared_stmt->bindValue(':restaurant_name', $var_restaurant_name, PDO::PARAM_STR);

      //Execute the query and save the result in variable named $result
      $result = $prepared_stmt->execute();

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
}

?>

<html>
  <!-- Any thing inside the HEAD tags are not visible on page.-->
  <head>
    <!-- THe following is the stylesheet file. The CSS file decides look and feel -->
    <link rel="stylesheet" type="text/css" href="project.css" />
  </head> 

  <!-- Everything inside the BODY tags are visible on page.-->
  <body>
     <!-- See the project.css file to see how is navbar stylized.-->
    <div id="navbar">
      <!-- See the project.css file to note how ul (unordered list) is stylized.-->
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
    <!-- See the project.css file to note h1 (Heading 1) is stylized.-->
    <h1> Delete a Movie </h1>
    <!-- This is the start of the form. This form has one text field and one button.
      See the project.css file to note how form is stylized.-->
    <form method="post">

      <label for="restaurant_link">Restaurant</label>
      <!-- The input type is a text field. Note the name and id. The name attribute
        is referred above on line 7. $var_director = $_POST['field_director']; id attribute is referred in label tag above on line 52-->
      <input type="text" name="field_restaurant_name" id = "id_restaurant_name">
      <!-- The input type is a submit button. Note the name and value. The value attribute decides what will be dispalyed on Button. In this case the button shows Submit.
      The name attribute is referred  on line 3 and line 61. -->
      <input type="submit" name="field_submit" value="Submit">
    </form>

    <?php
      if (isset($_POST['field_submit'])) {
        if ($result) { 
    ?>
          Restaurant was deleted successfully.
    <?php 
        } else { 
    ?>
          <h3> Sorry, there was an error. Restaurant data was not deleted. </h3>
    <?php 
        }
      } 
    ?>

    
  </body>
</html>



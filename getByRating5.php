
<?php

//Allow users to search restaurants that have rating of 5 by country
if (isset($_POST['field_submit'])) {

    require_once("p2conn.php");

    $var_country_name = $_POST['field_country_name'];

    $query = "CALL search_res_rating_5(:country_name)";

 try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':country_name', $var_country_name, PDO::PARAM_STR);
      $prepared_stmt->execute();
      $result = $prepared_stmt->fetchAll();

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
}
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="project.css" />

  </head>

  <body>
    <div id="navbar">
      <ul>
		        <li><a href="index.html">Home</a></li>
		        <li><a href="getRestaurant.php">Search Restaurant</a></li>
		        <li><a href="insertRestaurant.php">Insert Restaurant</a></li>
		        <li><a href="deleteRestaurant.php">Delete Restaurant</a></li>
				<li><a href="getByVegFriendly.php">Search By Vegetarian Friendly</a></li>
				<li><a href="getByRating5.php">Search By Top Rating</a></li>
				<li><a href="getByGenInfo.php">Search by General Info</a></li>
      </ul>
    </div>

    <h1> Get the top 100 popular restaurants with a rating of 5 in different European cities.</h1>

    <form method="post">

      <label for="id_country_name">Country Name</label>
      <input type="text" name="field_country_name" id ="id_country_name">

      <input type="submit" name="field_submit" value="Search">
      <r> Enter a country name. </r>
    </form>
    <?php
      if (isset($_POST['field_submit'])) {
        if ($result && $prepared_stmt->rowCount() > 0) { ?>

              <h2>Results</h2>

              <table>
                <thead>
                  <tr>
                    <th>restaurant name</th>
                    <th>address</th>
                    <th>popularity detailed</th>
                    <th>popularity generic</th>

                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($result as $row) { ?>

                    <tr>
                      <td><?php echo $row["restaurant_name"]; ?></td>
                      <td><?php echo $row["popularity_detailed"]; ?></td>
                      <td><?php echo $row["address"]; ?></td>
                      <td><?php echo $row["popularity_generic"]; ?></td>

                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#specTable').DataTable();
            });
            </script>

        <?php } else { ?>
          Sorry No results found for <?php echo $_POST['field_country_name']; ?>.
        <?php }
    } ?>


    <img id='i2' src= "BarPic.jpeg" />
  </body>
</html>







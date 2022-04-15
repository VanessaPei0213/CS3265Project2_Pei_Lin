
<?php

//Allow users to search restaurants' general information
if (isset($_POST['submit'])) {

    require_once("p2conn.php");

    $res_veg_friendly = $_POST['res_name'];

    $query = "CALL search_geninfo(:res_name)"; //todo: change this later

 try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':res_name', $res_veg_friendly, PDO::PARAM_STR);
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
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>

  </head>

  <body>
    <div id="navbar">
      <ul>
		        <li><a href="index.html">Home</a></li>
		        <li><a href="getRestaurant.php">Search Restaurant</a></li>
		        <li><a href="insertRestaurant.php">Insert Restaurant</a></li>
		        <li><a href="deleteRestaurant.php">Delete Restaurant</a></li>
				<li><a href="getByVegFriendly.php">Delete Restaurant</a></li>
				<li><a href="getByRating5.php">Delete Restaurant</a></li>
				<li><a href="getByGenInfo.php">Delete Restaurant</a></li>
      </ul>
    </div>

    <h1> Search Restaurants that are both vegetarian friendly and provide vegan options</h1>

    <form method="post">

      <label for="res_veg_friendly">specialty</label>
      <input type="text" name="res_veg_friendly">

      <input type="submit" name="submit" value="Search">
      <r> Enter a specialty. </r>
    </form>
    <?php
      if (isset($_POST['submit'])) {
        if ($result && $prepared_stmt->rowCount() > 0) { ?>

              <h2>Results</h2>

              <table id="specTable">
                <thead>
                  <tr>
                    <th>restaurant_name</th>
                    <th>address</th>
                    <th>original_open_hours</th>
                    <th>price_level</th>
                    <th>avg_rating</th>
                    <th>top_tags</th>

                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($result as $row) { ?>

                    <tr>
                      <td><?php echo $row["restaurant name"]; ?></td>
                      <td><?php echo $row["address"]; ?></td>
                      <td><?php echo $row["original open hours"]; ?></td>
                      <td><?php echo $row["price level"]; ?></td>
                      <td><?php echo $row["average rating"]; ?></td>
                      <td><?php echo $row["top tags"]; ?></td>

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
          Sorry No results found for <?php echo $_POST['res_name']; ?>.
        <?php }
    } ?>


    <img id='i2' src= "img2.png" />
  </body>
</html>







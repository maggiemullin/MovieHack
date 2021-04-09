<?php
    require('header.php');

    //connect to the database
    require('connect.php');
    include_once('config.php');
    // Validate the recaptcha
  if(!empty($_POST['recaptcha_response'])) {
    $secret = SECRETKEY;
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$_POST['recaptcha_response']}");

      $response_data = json_decode($verify_response);
      if(!$response_data->success) {
        $errors[] = "Google reCaptcha failed: " . ($response_data->{'error-code'})[0];
        
      }
  }

    //set up SQL statement
    $sql = "SELECT * FROM movies;";

    //prepare
    $statement = $db->prepare($sql);

    //execute
    $statement->execute();

    //use fetchAll to store results

    $films = $statement->fetchAll();

    //creating the top of the table
    echo "<table class='table table-hover table-striped'><tbody>";

    foreach($films as $film) {
        echo "<tr><td>" . $film['network'] . "</td><td>" . $film['movie_title'] . $film['genre'] . "</td><td>" . $film['first_name'] . "</td><td>" . $film['last_name'] . "</td><td>" . $film['email'] . "</td><td>". $film['review'] . "</td>
        <td><a href='delete.php?id=". $film['user_id'] . "'> Delete Review </a>
        </td>
        <td><a href='index.php?id=". $film['user_id'] . "'> Edit Review </a></td>
        </tr>";
    }

    echo "</tbody></table>";


    $sql = "SELECT movie_title FROM movies;";
    $statement = $db->prepare($sql);
    $statement->execute();
    $search_results = $statement->fetchAll();
    echo "<ul>";
    foreach($search_results as $results) {
        echo "<li>" .$result['movie_title']. "</li>";
        echo "</ul>";
    }
    //close the DB connection
    $statement->closeCursor();
    ?>

    <div class="container">
    <h2> Search For Your Movie Titles: </h2>
            <form action="search_results.php" method="get">
                <div class="row">
                    <div class="col">
                        <input type ="text" name="network" placeholder="network" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" name="search" placeholder="I'm searching for..." class="form-control">
                    </div>
                    <input type="submit" name="submit" value="Search" class="btn btn-primary">
                </div>
            </form>
        </div>

    <?php require('footer.php'); ?>
    
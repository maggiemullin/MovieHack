<?php
    require('header.php');

    //connect to the database
    require('connect.php');

    //set up SQL statement
    $sql = "SELECT * FROM movies;";

    //prepare
    $statement = $db->prepare($sql);

    //execute
    $statement->execute();

    //use fetchAll to store results

    $form_values = $statement->fetchAll();

    //creating the top of the table
    echo "<table class='table table-hover table-striped'><tbody>";

    foreach($form_values as $form_value) {
        echo "<tr><td>" . $form_value['network'] . "</td><td>" . $form_value['movie_title'] . $form_value['genre'] . "</td><td>" . $form_value['first_name'] . "</td><td>" . $form_value['last_name'] . "</td><td>" . $form_value['email'] . "</td><td>". $form_value['review'] . "</td>" . "
        <td><a href='delete.php?id=". $form_value['user_id'] . "'> Delete Review </a>
        </td>
        <td><a href='index.php?id=". $form_value['user_id'] . "'> Edit Review </a></td>
        </tr>";
    }

    echo "</tbody></table>";
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
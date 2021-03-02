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

    $films = $statement->fetchAll();

    //creating the top of the table
    echo "<table class='table table-hover table-striped'><tbody>";

    foreach($films as $film) {
        echo "<tr><td>" . $film['network'] . "</td><td>" . $film['movie_title'] . $film['genre'] . "</td><td>" . $film['first_name'] . "</td><td>" . $film['last_name'] . "</td><td>" . $film['email'] . "</td><td>". $film['review'] . "</td><td>" . $record['location'] . "</td><td>" . $record['email'] .  "</td>
        <td><a href='delete.php?id=". $film['user_id'] . "'> Delete Review </a>
        </td>
        <td><a href='index.php?id=". $film['user_id'] . "'> Edit Review </a></td>
        </tr>";
    }

    echo "</tbody></table>";

    //close the DB connection
    $statement->closeCursor();
    require('footer.php');
    ?>
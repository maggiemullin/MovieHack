<?php
    ob_start();
     require('header.php');

    //create variables to store form data

    $network = filter_input(INPUT_POST, 'network');
    $movie_title = filter_input(INPUT_POST, 'movietitle');
    $genre = filter_input(INPUT_POST, 'genre');
    $first_name = filter_input(INPUT_POST, 'fname');
    $last_name = filter_input(INPUT_POST, 'lname');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $review = filter_input(INPUT_POST, 'review');
    $id = null;
    $id = filter_input(INPUT_POST, 'user_id');


    //set up a flag variable
    $ok = true;

    //validation for email address

    if($email === false) {
        echo "<p> Please include a properly formatted email!</p>";
        $ok = false;
    }

    if($ok === true) {
        try {
            //connect to the database
            require('connect.php');
            //set up our SQL query

            //if we have an id, we are editing
            if(!empty($id)) {
                $sql = "UPDATE movies SET network = :network, movie_title = :movietitle, genre = :genre, first_name = :firstname, last_name = :lastname, email = :email, review = :review WHERE user_id = :user_id;";
            }
            //if not, adding a new record
            else {
                $sql = "INSERT INTO movies (network, movie_title, genre, first_name, last_name, email, review) VALUES (:network, :movietitle, :genre, :firstname, :lastname, :email, :review);";

            }
            //call the prepare method of the PDO object
            $statement = $db->prepare($sql);
            //bind parameters

            $statement->bindParam(':network', $network);
            $statement->bindParam(':movietitle', $movie_title);
            $statement->bindParam(':genre', $genre);
            $statement->bindParam(':firstname', $first_name);
            $statement->bindParam(':lastname', $last_name);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':review', $review);

            if(!empty($id)) {
                $statement->bindParam(':user_id', $id );
            }
            //execute the query
            $statement->execute();
            //close the db connection
            $statement->closeCursor();
            header('location:view.php');
        }
        catch(PDOException $e) {
            echo "<p> something broke </p>";
            $error_message = $e->getMessage();
            echo $error_message;
        }
    }
    ob_flush();
    require('footer.php'); ?>

<?php
    
     require('header.php');

    include_once('config.php');

    /** Validation */

    session_start();
    function error_handler ($errors) {
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            

            header("Location: view.php");
            exit();
        }
    }

    $errors = [];

    //Validate the recaptcha 
    if(!empty($_POST['recaptcha_response'])) {
        $secret = SECRETKEY;
        $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$_POST['recaptcha_response']}");
    
          $response_data = json_decode($verify_response);
          if(!$response_data->success) {
            $errors[] = "Google reCaptcha failed: " . ($response_data->{'error-code'})[0];
            error_handler($errors);
          }
      }



    //create variables to store form data

    $network = filter_input(INPUT_POST, 'network');
    $movie_title = filter_input(INPUT_POST, 'movie_title');
    $genre = filter_input(INPUT_POST, 'genre');
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $review = filter_input(INPUT_POST, 'review');
    $id = null;
    $id = filter_input(INPUT_POST, 'user_id');

     error_handler($errors);
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
            $conn = dbo();
            //set up our SQL query

            //if we have an id, we are editing
            if(!empty($id)) {
                $sql = "UPDATE movies SET network = :network, movie_title = :movie_title, genre = :genre, first_name = :first_name, last_name = :last_name, email = :email, review = :review WHERE user_id = :user_id;";
            }
            //if not, adding a new record
            else {
                $sql = "INSERT INTO movies (network, movie_title, genre, first_name, last_name, email, review) VALUES (:network, :movie_title, :genre, :first_name, :last_name, :email, :review);";

            }
            //call the prepare method of the PDO object
            $stmt = $conn->prepare($sql);
            //bind parameters

            $stmt->bindParam(':network', $network);
            $stmt->bindParam(':movie_title', $movie_title);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':review', $review);

            if(!empty($id)) {
                $statement->bindParam(':user_id', $id );
            }
            //execute the query
            $statement->execute();
            $_SESSION['successes'][] = "Your review has been added";
            //close the db connection
            exit();
            header('location:view.php');
        }
        catch(PDOException $error) {
            $errors[] = $error->getMessage();
            error_handler($errors);
        }
    }
  
    require('footer.php'); ?>

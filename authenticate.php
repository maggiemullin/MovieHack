<?php

  // Connect to the database
  require('connect.php');
  $conn = dbo();
  
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $email = strtolower($email);
  $password = filter_input(INPUT_POST, 'password');
  // Create our SQL with an email placeholder
  $sql = "SELECT * FROM users WHERE email = :email";
  // Prepare the SQL
  $statement = $conn->prepare($sql);
  // Bind the value to the placeholder (incidently this will also sanitize the value)
  $statement->bindParam('email', $email, PDO::PARAM_STR);
  // Execute
  $statement->execute();
 
  // Check if we have a user and their password is correct
  $user = $statement->fetch(PDO::FETCH_ASSOC);
  
  $authorized = false;

  if($user) { 
    $authorized = password_verify($password, $user['password']);
  }

  session_start();
  if(!$authorized) {
    // Add a session variable to keep track of the user
    $_SESSION['errors'][] = "You email/password could not be verified";
    $_SESSION['form_values'] = $_POST;
    

    // Redirect back to the form
    header("Location: login.php");
    exit;
  }

  unset($user['password']);
  $_SESSION['user'] = $user;
  $_SESSION['successes'][] = "You have been logged in.";
  header("location: profile.php");
  exit;  

  
  
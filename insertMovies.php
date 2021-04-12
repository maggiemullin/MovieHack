<?php

  session_start();

  if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
  }

  $network = filter_input(INPUT_POST, 'network', FILTER_SANITIZE_STRING);
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
  $review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_STRING);

  if (empty($network)) {
    $_SESSION["errors"][] = "You must have a network";
    header("Location: newMovie.php");
    exit();
  }
  if (empty($title)) {
    $_SESSION["errors"][] = "You must have a title";
    header("Location: newMovie.php");
    exit();
  }
  if (empty($genre)) {
    $_SESSION["errors"][] = "You must have a genre";
    header("Location: newMovie.php");
    exit();
  }
  if (empty($review)) {
    $_SESSION["errors"][] = "You must have a review";
    header("Location: newMovie.php");
    exit();
  }

  require("connect.php");
  $sql = "INSERT INTO movies (
    network,
    userID,
    title,
    genre,
    review
  ) VALUES (
    :network,
    {$_SESSION['user']['id']},
    :title,
    :genre,
    :review
    
  )";

  $stmt = dbo()->prepare($sql);
  $stmt->bindParam(':network', $network, PDO::PARAM_STR);
  $stmt->bindParam(':title', $title, PDO::PARAM_STR);
  $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
  $stmt->bindParam(':review', $review, PDO::PARAM_STR);
  $stmt->execute();

  header("Location: movies.php");
  exit();
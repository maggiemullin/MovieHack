<?php

    require_once('header.php');
  // If they're not logged in, redirect them
  if (session_status() === PHP_SESSION_NONE) session_start();
  if (!isset($_SESSION['user'])) {
    $_SESSION["errors"][] = "You're not logged in.";
    header("Location: login.php");
    exit();
  }

  // Assign the user
  $user = $_SESSION['user'];

  if(!empty($_GET['userID']) && (is_numeric($_GET['userID']))) {
    //grab id and store in a variable
    $id = filter_input(INPUT_GET, 'userID');
    //connect to db
    require('connect.php');
    //set up query
    $sql = "SELECT * FROM movies WHERE userID = :userID;";
    //prepare
    $statement = $db->prepare($sql);
    //bind
    $statement->bindParam(':userID', $id);
    //execute
    $statement->execute();
    //use fetchAll method to store
    $films = $statement->fetchAll();
    foreach($movies as $movie) :
        $network = $movie['network'];
        $title = $movie['title'];
        $genre = $movie['genre'];
        $review= $movie['review'];

     endforeach;
     $statement->closeCursor();
    }
  
?>

  <main>
    <?php include_once('notification.php') ?>

    <div class="container">
      <header class="my-2">
          <div class="col">
            <h1 class="text-center"><?= "{$user['first_name']} {$user['last_name']}" ?></h1>
            <p class="text-center">Create a New Review</p>
           
          </div>
        
      </header>

      <form action="insertMovies.php" method="post">
        <div class="form-group">
          <label>Network:</label>
          <input type="text" name="network" class="form-control">
        </div>
        <div class="form-group">
          <label>Title:</label>
          <input type="text" name="title" class="form-control" require>
        </div>
        <div class="form-group">
          <label>Genre:</label>
          <input type="text" name="genre" class="form-control" require>
        </div>
        <div class="form-group">
          <label>review:</label>
          <input type="text" name="review" class="form-control">
        </div>
        
        <button class="btn btn-primary">Create</button>
      </form>

      <a class="btn mt-2" href="logout.php">Logout</a>
    </div>

</main>

  <?php require_once('footer.php'); ?>
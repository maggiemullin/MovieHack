<?php require_once('header.php'); 
       // If they're not logged in, redirect them
  if (session_status() === PHP_SESSION_NONE) session_start();
  if (!isset($_SESSION['user'])) {
    $_SESSION["errors"][] = "You're not logged in.";
    header("Location: login.php");
    exit();
  }

  // Assign the user
  $user = $_SESSION['user'];
  require("connect.php");
  $sql = "SELECT * FROM movies WHERE userID = :userID";
  $stmt = dbo()->prepare($sql);
  $stmt->bindParam(':userID', $user['id'], PDO::PARAM_INT);
  $stmt->execute();
  $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

 
  
?>
<main>
    <?php include_once('notification.php') ?>

    <div class="container">
      <header class=" my-5">
          <div class="row">
          <div class="col-12">
           
            <h1 class="text-center"><?= "{$user['first_name']} {$user['last_name']}" ?></h1>
            <p class="text-center">Here are your reviews!</p>
            </div>
          </div>
        </div>
      </header>
      <div class="row">
      <div class="col-12">
     
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Network</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Review</th>
            <th>Action</th>
          </tr>
        </thead>
          </div>
        <tbody>
          <?php foreach($movies as $movie): ?>
            <tr>
              <td><?= $movie['network'] ?></td>
              <td><?= $movie['title'] ?></td>
              <td><?= $movie['genre'] ?></td>
              <td><?= $movie['review'] ?></td>
              <td><a href='delete.php?id=". $movie['userID'] . "'> Delete Review </a></td>
              <td><a href='newMovie.php?id=". $movie['userID'] . "'> Edit Review </a></td>
              
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      </div>
      <a class="btn mr-2" href="logout.php">Logout</a>
      <a class="btn " href="newMovie.php">New Movie</a>
    </div>
</main>
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
    

 <?php require_once('footer.php'); ?>
<?php
   
   if (session_status() === PHP_SESSION_NONE) session_start();
  if (isset($_SESSION['user'])) {
    header("Location: profile.php");
    exit();
  }
  
  // Before we render the form let's check for form values
 
  $form_values = $_SESSION['form_values'] ?? null;

  // Clear the form values
  unset($_SESSION['form_values']);

  // Clear the form values
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">

    <title>Login</title>
  </head>

  <main>
  <?php include_once('notification.php') ?>

    <div class="container">
      <header class="my-2 text-center">
        <h1>Login</h1>
        
      </header>
     
      
      <section class="mb-5">
        <form action="./authenticate.php" method="post">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" placeholder="user@gc.com" required value="<?= $form_value['email'] ?? null ?>">
              </div>
            </div>
            
            <div class="col">
              <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" required>
              </div>
            </div>
          </div>

          <button class="btn" type="submit">Login</button>
          <a class="btn" href="register.php">Register</a>
        </form>
      </section>
    </div>
  </main>

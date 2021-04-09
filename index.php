<?php require('header.php');
    session_start();
    $form_values = $_SESSION['form_values'] ?? null;

    unset($_SESSION['form_values']);
    
  //initialize variables

        $id = null;
        $network = null;
        $movie_title = null;
        $genre = null;
        $first_name = null;
        $last_name = null;
        $email = null;
        $review = null;


        //check if user is editing

        if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
            //grab id and store in a variable
            $id = filter_input(INPUT_GET, 'id');
            //connect to db
            require('connect.php');
            //set up query
            $sql = "SELECT * FROM movies WHERE user_id = :user_id;";
            //prepare
            $statement = $db->prepare($sql);
            //bind
            $statement->bindParam(':user_id', $id);
            //execute
            $statement->execute();
            //use fetchAll method to store
            $form_values = $statement->fetchAll();
            foreach($form_values as $film) :
                $network = $film['network'];
                $movie_title = $film['movie_title'];
                $genre = $film['genre'];
                $first_name = $film['first_name'];
                $last_name = $film['last_name'];
                $email = $film['email'];
                $review= $film['review'];

             endforeach;
             $statement->closeCursor();
            }
        ?>

            <main>
             <div class="container">
                <form action="process.php" method="post" novalidate>

                    <input type="hidden" name="user_id" value="<?= $form_values['id'] ?? null ?>">
                    <div class="row">
                    <div class="form-group col-4">
                         <input type="text" name="network" placeholder="Network" class="form-control" require value="<?= $form_values['network'] ?? null ?>">
                     </div>

                     <div class="form-group col-4">
                          <input type="text" name="movie_title" placeholder="Movie Title" class="form-control" require value="<?= $form_values['movie_title'] ?? null ?>">
                    </div>
            
                    <div class="form-group col-4">
                           <input type="text" name="genre" placeholder="Genre" class="form-control" require value="<?= $form_values['genre'] ?? null ?>">
                    </div>
                    </div><!-- end of row -->

                    <div class="row">
                    <div class="form-group col-4">
                        <input type="text" name="first_name" placeholder="First Name" class="form-control" require value="<?= $form_values['first_name'] ?? null ?>">
                    </div>
                   

                    <div class="form-group col-4">
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control" require value="<?= $form_values['last_name'] ?? null ?>">
                    </div>

                    <div class="form-group col-4">
                        <input type="email" name="email" placeholder="Email" class="form-control" require value="<?= $form_values['email'] ?? null ?>">
                    </div>
                    </div><!-- end of row -->

                    <div class="form-group">
                        <input type="text" name="review" placeholder="The Lowdown on the Movie" require class="form-control" value="<?= $form_values['review'] ?? null ?>">
                    </div>

                    <!-- Add the recaptcha field -->
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                    <button type="submit" value="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
                </div>

                   <!-- Add the recaptcha scripts -->
                <?php include_once('config.php'); ?>
                 <script src="https://www.google.com/recaptcha/api.js?render=<?=SITEKEY ?>"></script> 
                 <script>
                     grecaptcha.ready(() => {
                     grecaptcha.execute("<?=SITEKEY ?>", { action: "register" })
                    .then(token => document.querySelector("#recaptchaResponse").value = token)
                    .catch(error => console.error(error));
                     });
                 </script>

            </main>
        <?php require('footer.php'); ?>
<?php require('header.php');

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
            $films = $statement->fetchAll();
            foreach($films as $film) :
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
             <div class="col">
                <form action="process.php" method="post">

                    <input type="hidden" name="user_id" value="<?php echo $id; ?>">

                    <div class="form-group">
                         <input type="text" name="network" placeholder="Network" class="form-control" value="<?php echo $network; ?>">
                     </div>

                     <div class="form-group">
                          <input type="text" name="movie_title" placeholder="Movie Title" class="form-control" value="<?php echo $movie_title; ?>">
                    </div>

                    <div class="form-group">
                           <input type="text" name="genre" placeholder="Genre" class="form-control" value="<?php echo $genre; ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" name="first_name" placeholder="First Name" class="form-control" value="<?php echo $first_name; ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="<?php echo $last_name; ?>">
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" name="review" placeholder="The Lowdown on the Movie" class="form-control" value="<?php echo $review; ?>">
                    </div>

                    <button type="submit" value="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
                </div>
            </main>
        <?php require('footer.php'); ?>
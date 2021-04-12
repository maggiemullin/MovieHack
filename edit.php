<?   
    if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
        //grab id and store in a variable
        $id = filter_input(INPUT_GET, 'id');
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
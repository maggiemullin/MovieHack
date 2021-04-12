<?php

try {
    $userID = filter_input(INPUT_GET, 'id');
    //connect to db
    require('connect.php');
    $conn = dbo();
    //set up query
    $sql = "DELETE FROM movies WHERE id = :id;";
    //prepare
    $statement = $conn->prepare($sql);
    //bind
    $statement->bindParam(':id', $id);
    //execute
    $statement->execute();
    //close DB connection
    $statement->closeCursor();
    header('location:movies.php');
}
catch(PDOException $e) {
    header('location:error.php');
}

?>

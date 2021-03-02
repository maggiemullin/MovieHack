<?php
try{

    $dsn = 'mysql:host=localhost;dbname=movie_hack';
    $username = 'root';
    $password = 'root'; //mamp users

    $db = new PDO($dsn, $username, $password);
    //echo "<p> Successfully connected </p>";
}
catch(PDOException $e){
    echo "<p> This did not work </p>";
    $error_message = $e->getMessage();
    echo $error_message;

}


?>
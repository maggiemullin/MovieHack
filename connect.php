<?php
try{

    $dsn = 'mysql:host=localhost;dbname=movie_hack';//'mysql:host=172.31.22.43;dbname=Mullin100104425';
    $username = 'root'; //'Mullin100104425';
    $password = 'root';  //'UQabtxmMN5'; //mamp users

    $db = new PDO($dsn, $username, $password);
    //echo "<p> Successfully connected </p>";
}
catch(PDOException $e){
    echo "<p> This did not work </p>";
    $error_message = $e->getMessage();
    echo $error_message;

}


?>
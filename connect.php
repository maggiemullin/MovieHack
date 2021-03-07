<?php
try{
   //LIVE
  /* $dsn = 'mysql:host=172.31.22.43;dbname=Mullin100104425';
    $username = 'Mullin100104425';
    $password = 'UQabtxmMN5'; //mamp users
    */

    //LOCAL
     $dsn = 'mysql:host=localhost;dbname=COMP1006';
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
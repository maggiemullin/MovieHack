<?php

function dbo () {
try{

    $dsn ='mysql:host=172.31.22.43;dbname=Mullin100104425'; //
    $username = 'Mullin100104425'; //'root';
    $password ='UQabtxmMN5'; //'root';

    $db = new PDO($dsn, $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
    //echo "<p> Successfully connected </p>";
}
catch(PDOException $error){
    var_dump("Issue connection : {$error->getMessage()}");

}
}

?>
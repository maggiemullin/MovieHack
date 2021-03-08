<?php
try{

   $dsn = 'mysql:host=172.31.22.43;dbname=Mullin100104425';
    $username = 'Mullin100104425';
    $password = 'UQabtxmMN5';
}
catch(PDOException $e){
    echo "<p> This did not work </p>";
    $error_message = $e->getMessage();
    echo $error_message;

}


?>
<?php

try{

$db = 'mysql:host=localhost;dbname=contact';

$username = 'root';
$password = 'root'; 

$db = new PDO($dsn,$username,$password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
    $error_ms = $e->getMessage();
    echo 'Error' . $error_ms .'sorry for that!'; 
}

?>
<?php
function dbo () {
try{

$dsn = 'mysql:host=172.31.22.43;dbname=Illia200453638';

$username = 'Illia200453638';
$password = '9JGPrwrjLp'; 

$db = new PDO($dsn,$username,$password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

return $db;

}
catch(PDOException $error){
    $error_ms = $error->getMessage();
    echo 'Error' . $error_ms .'sorry for that!'; 
}
}
?>
<?php
ob_start();
$user_id = filter_input(INPUT_GET,'id');

try{

require('connect.php'); 

$sql = "DELETE FROM contact_info WHERE user_id = :user_id"; 
$conn = dbo();
$statement = $conn->prepare($sql); 
$statement->bindParam(':user_id', $user_id);
$statement->execute(); 

 
$statement->closeCursor();

header('location:view.php');
}
catch(PDOException $error){
    echo '<p>Error</p>';
}

ob_flush();
?>
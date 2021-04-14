<?php 

session_start();

require_once("connect.php");
dbo()->query("DELETE FROM users WHERE id = {$_SESSION['user']['id']}");

unset($_SESSION['user']);
$_SESSION['successes'][] = "You have deleted yourself successfully.";

header("Location: index.php");
exit();

<?php
  // If they're not logged in, redirect them
  session_start();
  if (!$_SESSION['user']) {
      $_SESSION['errors'][] = "You must log in.";
      header("Location: ./login.php");
      exit();
  }
  // Logging out means just destroying the session variable 'user'
  unset($_SESSION['user']);
  
  // Then redirect with a success message
  $_SESSION['successes'][] = "You are successfully logged out!";
  header("Location: ./order.php");
  exit();
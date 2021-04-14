<?php
  // If they're not logged in, redirect them
  session_start();
  if (!$_SESSION['user']) {
    $_SESSION['errors'][] = "You must log in.";
    header("Location: login.php");
    exit();
  }
  // Assign the user
  $user = $_SESSION['user'];
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <title>Profile</title>
  </head>

  

  <body>
  <?php require('headerForUser.php');
  $id = null;
  $firstname = null;
  $lastname = null;
  $email = null;
  $seat = null;
  $date = null;

  if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
    $id = filter_input(INPUT_GET, 'id'); 
 
    require('connect.php'); 
   
    $sql = "SELECT * FROM contact_info WHERE user_id = :user_id;";
    
    $conn = dbo();
    $statement = $conn->prepare($sql);
    
    $statement->bindParam(':user_id', $id); 
   
    $statement->execute(); 

    $info = $statement->fetchAll(); 

    foreach($info as $record) :
     $id = $record['user_id']; 
     $firstname = $record['first_name']; 
     $lastname = $record['last_name']; 
     $email = $record['email']; 
     $seat = $record['seat'];
     $date = $record['date'];

    endforeach; 

    $statement->closeCursor(); 

    }
  
  ?>
  
    <?php include_once('notification.php')?>
    <form action="process.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $id ?>">
            <div class="form-group">
                <label for="fname"> First Name </label>
                <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $firstname ?>">
            </div> 
            <div class="form-group">
                <label for="lname"> Last Name </label>
             <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $lastname ?>"> 
            </div>           
            <div class="form-group">
             <label for="email"> Your Email </label>
             <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?>"> 
            </div>
            <div class="form-group">
                <label for="seat"> Number of table(0-10) </label>
                <input type="number" name="seat" id="seat" class="form-control" value="<?php echo $seat ?>">
            </div> 
            <div>
                <label for="date">Date and time: </label>
                <input type="datetime-local" id="date" name="date"  class="form-control" value="<?php echo $date ?>">
            </div>           
            <input type="submit" value="submit" name="submit" >
            <?php require('footer.php'); ?>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <?php include_once('config.php') ?>
          <script src="https://www.google.com/recaptcha/api.js?render=<?= SITEKEY ?>"></script>
          <script>
            grecaptcha.ready(() => {
              grecaptcha.execute("<?= SITEKEY ?>", { action: "register" })
              .then(token => document.querySelector("#recaptchaResponse").value = token)
              .catch(error => console.error(error));
            });
          </script>
  </body>
</html>
<?php require('header.php'); 

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
  
    $statement = $db->prepare($sql);
    
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
    <main>
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
        </form>
    </main>


<?php require('footer.php'); ?>
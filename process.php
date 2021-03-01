<?php 
        ob_start(); 
        require('header.php');

        $first_name = filter_input(INPUT_POST, 'fname');
        $last_name = filter_input(INPUT_POST, 'lname');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $seat = filter_input(INPUT_POST, 'seat');
        $date = filter_input(INPUT_POST, 'date');
        $id = null;
        $id = filter_input(INPUT_POST, 'user_id'); 
      
        $value = true; 

        if($email === false) {
            echo "<p> Please write your real email </p>";
            $value = false;  
        }
        if($seat > 10 || $seat <0) {
            echo "<p> Please select the number of table between 0-10 </p>";
            $value = false;  
        }

        if($value === true) {
            try {
               
                require('connect.php');  

                if(!empty($id)) {
                  $sql = "UPDATE contact_info SET first_name = :firstname, last_name = :lastname,  email = :email, seat = :seat, date = :date WHERE user_id = :user_id;"; 

                }
                else {
                    $sql = "INSERT into contact_info (first_name, last_name, email, seat, date) VALUES (:firstname, :lastname,  :email, :seat, :date);";
                }
                
                echo "$sql";

                $statement = $db->prepare($sql);

                $statement->bindParam(':firstname', $first_name);
                $statement->bindParam(':lastname', $last_name);
                $statement->bindParam(':email', $email);
                $statement->bindParam(':seat', $seat);
                $statement->bindParam(':date', $date);


                if(!empty($id)) {
                    $statement->bindParam(':user_id', $id); 
                }               

  
                $statement->execute(); 

                $statement->closeCursor(); 
                header('location:view.php');

            
            }
            catch(PDOException $e) {
             header('location:error.php');  
             echo $e->getMessage();
            }
        }
        require('footer.php'); 
        ob_flush(); 
        ?>
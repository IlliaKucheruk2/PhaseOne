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

        require('connect.php');  

        // check seat availability
        $sql = "SELECT COUNT(*) from contact_info WHERE seat = :seat"; 
        $statement = $db->prepare($sql);
        $statement->execute(array('seat' => $seat));
        $number_of_tables = $statement->fetchColumn(); 

         // check if email is repeat 
         $sql = "SELECT COUNT(*) from contact_info WHERE email = :email"; 
         $statement = $db->prepare($sql);
         $statement->execute(array('email' => $email));
         $number_of_email = $statement->fetchColumn(); 

        // check if date is repeat 
        $sql = "SELECT COUNT(*) from contact_info WHERE date = :date"; 
        $statement = $db->prepare($sql);
        $statement->execute(array('date' => $date));
        $number_of_date = $statement->fetchColumn(); 

        if ($number_of_tables > 0 ) {
                echo "<p>This seat is unavailable. Please select another one.</p>";
            $value = false;  
        }
        else if ($number_of_email  > 0) {
            echo "<p>This email was recorded before. Please write another one.</p>";
            $value = false;  
        }
        else if ($number_of_date  > 0) {
            echo "<p>This date  was recorded before. Please write another one.</p>";
            $value = false;  
        }
    
    
        
        if($value === true) {
            try {
               

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
<?php 
    session_start(); 
    require('header.php');
    echo "<div class='container'>";


    $submit = filter_input(INPUT_GET, 'submit'); 
    $search_table = filter_input(INPUT_GET, 'search'); 

    require('connect.php');

    $query = "SELECT * FROM contact_info WHERE seat LIKE :search_table;"; 
    $statement = $db->prepare($query);  
    $statement->bindValue(':search_table', '%'.$search_table.'%');

    $statement->execute(); 

    $info = $statement->fetchAll();
//---------------------------------------------------------------------------------
    $query1 = "SELECT seat FROM contact_info WHERE seat LIKE :search_table;"; 
    $statement1 = $db->prepare($query1);  
    $statement1->bindValue(':search_table', '%'.$search_table.'%');

    $statement1->execute(); 

    $info1 = $statement->fetchAll();


  
    
?>

    <table class='table table-striped'><tbody>

<?php 
    if($statement1->rowCount() >=1){
        echo "<h1> The infomation about the table number " . $search_table . " are avaiable</h1>"; 
        foreach($info as $results) {
            echo"<tr><td>". $results['first_name']. 
            "</td><td>" . $results['last_name'] . "</td>
            <td>" . $results['email']. "</td>
            <td>" . $results['seat']."</td>
            <td>" . $results['date']."</td>
            <td><a href='index.php?id=" . $results['user_id']. "'>Edit order </a></td>
            <td><a href='delete.php?id=" .$results['user_id']. "'> Delete order </a></td></tr>";
                
        }
 
    }

    else {
        
        echo "<h1> No results found!</h1>"; 
    }
    
    echo "</tbody></table>"; 

    $statement->closeCursor(); 
?>
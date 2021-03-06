<?php require('header.php'); ?>

<h2> Search For Your Detail Of The Order: </h2> 
        <form action="search.php" method="get">
            <div class="row">
                <div class="col">
                    <input type="text" name="search" placeholder="My table is: " class="form-control">
                </div>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </div>
        </form>
<?php

require('connect.php'); 

$sql = "SELECT * FROM contact_info"; 

$statement = $db->prepare($sql); 
$statement->execute(); 
$info = $statement->fetchAll(); 

?>
<p style="text-align:center; font-size: 18px;" >Your Order</p> 
<table class='table table-striped'><tbody>



<?php
foreach($info as $record) {
    echo"<tr><td>". $record['first_name']. 
    "</td><td>" . $record['last_name'] . "</td>
    <td>" . $record['email']. "</td>
    <td>" . $record['seat']."</td>
    <td>" . $record['date']."</td>
    <td><a href='index.php?id=" . $record['user_id']. "'>Edit order </a></td>
    <td><a href='delete.php?id=" .$record['user_id']. "'> Delete order </a></td></tr>";
}

echo "</tbody></table>"; 

$statement->closeCursor(); 

?>

<?php require('footer.php'); ?>
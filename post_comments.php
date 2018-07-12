<?php
$host="localhost";
$username="root";
$password="";
$databasename="testdb";
$link = new PDO("mysql:host=localhost;dbname=testdb", "root", "");
 if (!$link) {
    die('Not connected : ' . mysql_error());
 }     
if(isset($_POST['user_comm']) && isset($_POST['user_name']) )
{
  $statement = $link->prepare("INSERT INTO comments(name, comment, post_time)VALUES(:name,:comment, CURRENT_TIMESTAMP)");
  $statement->bindParam(':name',$_POST['user_name']);
  $statement->bindParam(':comment',$_POST['user_comm']);
  $statement->execute();  
}
// Step 5: Free used resources
//$statement->closeCursor();
//$link = null;
 ?>
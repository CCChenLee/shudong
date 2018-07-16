<?php
  include('lqsym.php');
  $link = @new PDO($host,$username,$password);
  if (!$link) {
    die('Not connected : ' . mysql_error());
  }     
  if(isset($_POST['user_comm']) && isset($_POST['user_name']) ) {

    $_POST['user_name'] = htmlspecialchars($_POST['user_name']);
    $_POST['user_comm'] = htmlspecialchars($_POST['user_comm']);

    $statement = $link->prepare("INSERT INTO comments(name, comment, post_time)VALUES(:name,:comment, CURRENT_TIMESTAMP)");
    $statement->bindParam(':name',$_POST['user_name']);
    $statement->bindParam(':comment',$_POST['user_comm']);
    $statement->execute();
  exit;
  }
?>
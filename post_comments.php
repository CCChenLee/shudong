<?php
$host='mysql:host=localhost;dbname=testdb';
$username='root';
$password='123456';
$databasename='testdb';
$link = new PDO($host,$username,$password);
 if (!$link) {
    die('Not connected : ' . mysql_error());
 }     
if(isset($_POST['user_comm']) && isset($_POST['user_name']) )
{
  $statement = $link->prepare("INSERT INTO comments(name, comment, post_time)VALUES(:name,:comment, CURRENT_TIMESTAMP)");
  $statement->bindParam(':name',$_POST['user_name']);
  $statement->bindParam(':comment',$_POST['user_comm']);
  $statement->execute();  
if($row = $qresult->fetch(PDO::FETCH_ASSOC))
{
	$name=$row['name'];
      $comment=$row['comment'];
      $time=$row['post_time'];
      ?>
                <div class="comment_div">
                    <p class="name">大富大贵之人：
                        <?php echo $name;?>
                    </p>
                    <p class="comment">留言板：
                        <?php echo $comment;?>
                    </p>
                    <p class="time">发表时间：
                        <?php echo $time;?>
                    </p>
                </div>
    <?php
	}
exit;
}
// Step 5: Free used resources
//$statement->closeCursor();
//$link = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../test/css/comment_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function post() {
            var comment = document.forms["myForm"]["fcomment"].value
            var name = document.forms["myForm"]["fname"].value
            if (comment && name) {
                $.ajax({
                    url: 'post_comments.php',
                    type: 'post',
                    //  dataType:'json',
                    data: {
                        user_comm: comment,
                        user_name: name
                    },
                    success: function(response) {
                        document.getElementById("all_comments").innerHTML = response + document.getElementById("all_comments").innerHTML;
                        document.getElementById("comment").value = "";
                        document.getElementById("username").value = "";
                    }
                });
            }
        }
    </script>
    <!--
<script>
function post()
    {
  var comment = document.getElementById("comment").value;
  var name = document.getElementById("username").value;
  if(comment && name)
  {
   alert("Name must be filled out");
    };
  }
</script>
-->
</head>
<body>
    <div class="col-md-12 colcol">
        <h1>Instant Comment System Using Ajax,PHP and MySQL</h1>
        <form name="myForm" method="post" action="" onsubmit="return post()">
            <textarea id="comment" name="fcomment" placeholder="Write Your Comment Here....."></textarea>
            <br>
            <input type="text" id="username" name="fname" placeholder="Your Name">
            <br>
            <input id="submit" type="submit" value="Post Comment">
        </form>
        <div id="all_comments">
            <?php
    $host="localhost";
    $username="root";
    $password="";
    $databasename="testdb";

//   $connect=mysql_connect($host,$username,$password);
//    if (!$connect) {
//    die('Not connected : ' . mysql_error());
//}
//    $db=mysql_select_db("testdb");
//    if (!$db) {
//    die ('Can\'t use testdb : ' . mysql_error());
//}     
//    $comm = mysql_query('SELECT name FROM `comments`');
      
$dbo = new PDO("mysql:host=localhost;dbname=testdb", "root", "");
// Construct a query
$query = "SELECT * FROM comments";
// Send the query
$qresult = $dbo->query($query);
while($row = $qresult->fetch(PDO::FETCH_ASSOC)) {
    //$result[] = $row;
      $name=$row['name'];
      $comment=$row['comment'];
      $time=$row['post_time'];
      ?>
                <div class="comment_div">
                    <p class="name">Posted By:
                        <?php echo $name;?>
                    </p>
                    <p class="comment">
                        <?php echo $comment;?>
                    </p>
                    <p class="time">
                        <?php echo $time;?>
                    </p>
                </div>
                <?php
}
// Free used resources
$qresult->closeCursor();
$dbo = null;
 ?>
        </div>
    </div>
</body>
</html>
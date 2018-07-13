<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="img/x-icon" href="favicon.ico" />
    <title>树洞</title>
    <link rel="stylesheet" type="text/css" href="comment_style.css">
    <script src="jquery-3.2.1.min.js"></script>
    
    <style type="text/css">
        .clo{
            /*text-align:left;*/
            padding-left:50px;
            margin-top:50px;
            float:left;
        }
        #clock{border:0px solid #ccc}
    </style>
    
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
        <h1 style="color:pink;">树洞&致青春：</h1>
    <table>
        <td style="padding-left:120px">
        <div class=".clo">
            <canvas id="clock" width=200px height=200px></canvas>
            <h6>本站仅供学习交流娱乐，严禁用于商业用途。</h6>
        </div>
        <script type="text/javascript" src="clock.js"></script>
        </td>
        <td style="padding-left:180px">
        <form name="myForm" method="post" action="" onsubmit="return post()">
            <textarea id="comment" name="fcomment" placeholder="我想匿名对你说..."></textarea>
            <br>
            <input type="text" id="username" name="fname" placeholder="我是何方神圣？">
            <br>
            <input id="submit" type="submit" value="匿名发送">
        </form>
        </td>
    </table>

        <div id="all_comments">
            <?php
        $host='mysql:host=localhost;dbname=testdb';
        $username='root';
        $password='123456';
        $databasename='testdb';

        //   $connect=mysql_connect($host,$username,$password);
        //    if (!$connect) {
        //    die('Not connected : ' . mysql_error());
        //}
        //    $db=mysql_select_db("testdb");
        //    if (!$db) {
        //    die ('Can\'t use testdb : ' . mysql_error());
        //}     
        //    $comm = mysql_query('SELECT name FROM `comments`');
        try{
        $dbo = new PDO($host,$username,$password);
        } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        }    
        // Construct a query
        $query = "SELECT * FROM comments order by post_time desc";
        // Send the query
        $qresult = $dbo->query($query);
        // var_dump($qresult);
        while($row = $qresult->fetch(PDO::FETCH_ASSOC)) {
        //$result[] = $row;
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
        // Free used resources
        // $qresult->closeCursor();
        // $dbo = null;
        ?>
        </div>
    </div>
</body>
</html>
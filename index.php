<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <link rel="icon" type="img/x-icon" href="img/favicon.ico" />
    <title>树洞</title>
    <link rel="stylesheet" type="text/css" href="code/comment_style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
                    url: './code/post_comments.php',
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
</head>

<body>
    <div class ="col-md-12 colcol">
        <h1 style="color:pink;">树洞&致青春：</h1>
    <table>
        <td style="padding-left:120px">
            <div class=".clo">
                <canvas id="clock" width=200px height=200px></canvas>
                <h6>本站仅供学习交流娱乐，严禁用于商业用途。</h6>
            </div>
        <script type="text/javascript" src="code/clock.js"></script>
        </td>

        <td style="padding-left:180px">
            <form name="myForm" method="post" action="" onsubmit="return post()">
                <textarea id="comment" name="fcomment" placeholder="我想匿名对你说..."></textarea>
                <br>
                <input type="text" id="username" name="fname" placeholder="您贵姓？">
                <br>
                <input id="submit" type="submit" value="匿名发送">
                <br>
                <a href="#end" style="color: black">直达底部</a>
            </form>
        </td>
    </table>

    <div id="all_comments">
        <?php
            // Please forget
            include('./code/lqsym.php');
            $dbo = @new PDO($host,$username,$password);
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
            <p class="name">匿名访客：
                <?php echo htmlspecialchars($name,ENT_NOQUOTES,"UTF-8");?>
            </p>
            <p class="comment">留言内容：
                <?php echo htmlspecialchars($comment,ENT_NOQUOTES,"UTF-8");?>
            </p>
            <p class="time">发送时间：
                <?php echo $time;?>
            </p>
        </div>
        <?php
            }
        ?>
        </div>
        <a name="end"></a>
        <a href="#" style="color: black">回到顶部</a>
    </div>
    <script type="text/javascript" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>
</body>
</html>

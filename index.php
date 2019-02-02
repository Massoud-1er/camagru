<?php
session_start();

print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Our shop</title>
    <link rel = "stylesheet"
    type = "text/css"
    href = "style.css" />
</head>
<body>
    <div id="top_bar">
    <?php include ('top_bar.php');?>
</div>
<div id="full_body">
    <div id="middle-col">
            <?php include ('comments/like.html');?>
            <?php include ('comments/write_comment.html');?>
                                </div>
    <div id="right-col">
        <?php include('get_mini.php');?>
    </div> 
</div>         
    <?php include('footer.php'); ?>
    </body>
</html>

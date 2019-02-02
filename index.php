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
        <!-- <div id="left-col">
            <a href="#">Categorie 1</a>
            <a href="#">Categorie 2</a>
            <a href="#">Categorie 3</a>
            <a href="#">Categorie 4</a>
            <a href="#">Categorie 5</a>
    </div> -->
    <div id="right-col">
        <!-- montage passé -->
        <div class="montageDiv"><img class="montage" src="uploads/leonard.jpg"></div>
    </div> 
</div>         
    <div id="footer"></div>
    


    </body>
</html>

<?php
session_start();

print_r($_SESSION);
print_r($_POST);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
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
        <?php if (!$_POST['change']) : ?>
        <?php include ('account.html');?>
        <?php endif;?>
        <?php if (in_array($_POST['change'], $allowed)) : ?>
        <?php include("change/change_".$_POST['change'].".html");?>
        <?php endif;?>
            <!-- <?php include ('change_mail.html');?> -->
                                </div>
        <!-- <div id="left-col">
            <a href="#">Categorie 1</a>
            <a href="#">Categorie 2</a>
            <a href="#">Categorie 3</a>
            <a href="#">Categorie 4</a>
            <a href="#">Categorie 5</a>
    </div> -->
                                </div>         
    <div id="right-col">
    </div> 
    <div id="footer"></div>
    


    </body>
</html>

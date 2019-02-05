<?php
session_start();

$allowed = array("mail", "password", "photos", "forgot", "notif");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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
            <div><a href="my_pics.php">Voir mes photos</a></div>
                                </div>
        <!-- <div id="left-col">
            <a href="#">Categorie 1</a>
            <a href="#">Categorie 2</a>
            <a href="#">Categorie 3</a>
            <a href="#">Categorie 4</a>
            <a href="#">Categorie 5</a>
    </div> -->
    <div id="right-col">
    </div> 
                                </div>         
    <div id="footer"></div>
    


    </body>
</html>

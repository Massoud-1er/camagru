<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <button id="deco">se déconnecter</button>
    <div id="top_bar">
    <?php include ('top_bar.php');?>
</div>

    <br/>
    <?php include('pagination.php'); ?>
</body>
</html>
<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="top_bar">
    <?php include ('top_bar.php');?>
</div>
    <br/>
    <?php include('pagination.php'); ?>
</body>
</html>
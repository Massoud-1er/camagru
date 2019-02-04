<?php
session_start();

include('config/connection.php');
include('all_my_pics.php');
$allowed = array("mail", "password", "photos", "forgot", "notif");

try {
    $query = $pdo->prepare("SELECT
*
FROM
photos
WHERE login = ?");
    $query->execute([$_SESSION['login']]);
    $total = $query->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mes photos</title>
    <link rel = "stylesheet"
    type = "text/css"
    href = "style.css" />
</head>
<body>
    <div id="top_bar">
    <?php include('top_bar.php');?>
</div>
    <div id="full_body">
        
        <div id="middle-col">
        <?php all_my_pics($total); ?>
        </div>
            <div id="right-col">
                </div> 
            </div>         
            <?php include('footer.php'); ?>
    </body>
</html>

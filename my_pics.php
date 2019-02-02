<?php
session_start();

include('config/connection.php');
include('all_my_pics.php');
print_r($_SESSION);
$allowed = array("mail", "password", "photos", "forgot", "notif");

print_r($_POST);

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
print_r($total);
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
    <?php include ('top_bar.php');?>
</div>
    <div id="full_body">
        
        <div id="middle-col">
        <?php all_my_pics($total); ?>
        </div>

                                <div id="right-col">
                                    </div> 
                                </div>         
    <div id="footer"></div>
    


    </body>
</html>

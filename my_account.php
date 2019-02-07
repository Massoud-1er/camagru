<?php
session_start();

$allowed = array("mail", "password", "photos", "forgot", "notif", "login");

function my_last_pics()
{
    include('config/connection.php');
    try {
        $query = $pdo->prepare("SELECT * FROM `photos` WHERE `login` = ? ORDER BY id DESC limit 3");
        $query->execute([$_SESSION['login']]);
        $total = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($query->rowCount() > 0) {
        foreach ($total as $k => $val) {
            echo '<div style="display:inline-block;margin-top:2vh;margin-left:12.5vw;"><a href="my_pics.php"><img class ="montage" src="'.($val['photo']).'"></a></div>';
        }
    }
}

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
        <?php if ($_SESSION['mail_sent']) : ?>
            <div style="margin-top:10vh;"><h1 style="color:black;">L'utilisateur a bien été crée. Vous allez recevoir un email de confirmation à l'adresse indiquee</h1></div>
        <?php unset($_SESSION['mail_sent']); ?>
        <?php endif; ?>
        <?php if ($_SESSION['login']) : ?>
        <?php if (!$_POST['change']) : ?>
        <?php include ('account.html');?>
        <?php endif;?>
        <?php if (in_array($_POST['change'], $allowed)) : ?>
        <?php include("change/change_".$_POST['change'].".html");?>
        <?php endif;?>
        <?php if (!$_POST['change']) : ?>
            <div style="text-align:center;"><a  href="my_pics.php">Voir mes photos</a></div>
        <?php my_last_pics(); ?>
        <?php endif;?>
<?php endif;?>
        </div>
    <div id="right-col">
    </div> 
                                </div>         
    <div id="footer"></div>
    


    </body>
</html>

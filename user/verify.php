<?php
session_start();

print_r($_SESSION);
print_r($_POST);

function verify_hash()
{
    include('../config/connection.php');
    if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
        $mail = $_GET['email'];
        $hash = $_GET['hash'];
        try {
            // Prepare and query SQL for check
            $query = $pdo->prepare("SELECT * FROM users WHERE mail='$mail' AND hash='$hash' AND verified='N'");
            $query->execute();
            $check = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($check) {
            // valid url and user not verified
            $query = $pdo->prepare("UPDATE users
            SET verified='Y'
            WHERE mail='$mail'");
            try {
                // apply SQL line on database
                $query->execute();
                echo("Votre compte a bien ete active, vous pouvez maintenant vous connecter\n");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } elseif (!$check) {
            echo("URL invalide ou le code a deja ete active\n");
        }
    }
}
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
    <?php include ('../top_bar.php');?>
</div>
    <div id="full_body">
        
        <div id="middle-col">
        <?php verify_hash(); ?>
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
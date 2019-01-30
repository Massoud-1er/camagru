<?php

function add_com()
{
    session_start();
    include('../config/connection.php');
    // create var of user, oldpw and newpw
    list($login, $com, $idphoto) = array($_SESSION['login'], $_POST["com"], $idphoto);
    $query = $pdo->prepare("INSERT INTO `comments` (`id_photo`, `comments`, `login`) VALUES ('$idphoto', '$com', '$login')"); 
    try {
        // Prepare and query SQL for check
        //second check for passwd
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}
add_com();
?>
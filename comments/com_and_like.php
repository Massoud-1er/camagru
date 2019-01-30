<?php

function add_com($idphoto)
{
    session_start();
    include('../config/connection.php');
    list($login, $com) = array($_SESSION['login'], $_POST["com"]);
    // Prepare and query SQL for check
    $query = $pdo->prepare("INSERT INTO `comments` (`id_photo`, `comments`, `login`) VALUES ('$idphoto', '$com', '$login')"); 
    try {
        //insert com in commencts table
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

function add_like($idphoto)
{
    session_start();
    include('../config/connection.php');
    $query = $pdo->prepare("UPDATE `photos` SET like = like + 1"); 
    try {
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

?>
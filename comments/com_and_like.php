<?php

// header('Location: '.$_SERVER['HOME'].'/galerie.php');
// die;
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
    $login = $_SESSION['login'];
    $query = $pdo->prepare("SELECT `like` FROM `likes` WHERE `id_photo` = ?");
    try {
        $query->execute([$idphoto]);
        $row = $query->fetchAll();
        echo '<div>'.$row.'</div>';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if (!$row) {
        $query = $pdo->prepare("INSERT INTO `likes` (`id_photo`, `login`, `like`) VALUES ('$idphoto', '$login', 1)");
        try {
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $query = $pdo->prepare("UPDATE `photos` SET `like` = `like` + 1");
        try {
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        echo '<p> Vous avez deja aimé cette photo</p>';
    }
    $pdo = null;
}
if ($_POST["submit"] == "Ajouter un commmentaire" && $_POST['id'] && $_POST['com']) {
    add_com($_POST['id']);
} elseif ($_POST["submit"] == "like" && $_POST['id']) {
    add_like($_POST['id']);
}

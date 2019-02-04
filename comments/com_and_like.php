<?php

header('Location: '.$_SERVER['HOME'].'/galerie.php');
// die;
function add_com($idphoto, $photo_login)
{
    session_start();
    include('../mail_com.php');
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
    try {
        $query = $pdo->prepare("SELECT mail FROM users WHERE login=?");
        $query->execute([$photo_login]);
        $check = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($check){
        mail_com($check[0]['mail']);
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
if ($_POST["submit"] == "Ajouter un commmentaire" && $_POST['id'] && $_POST['com'] && $_POST['login']) {
    add_com($_POST['id'], $_POST['login']);
} elseif ($_POST["submit"] == "like" && $_POST['id']) {
    add_like($_POST['id']);
}

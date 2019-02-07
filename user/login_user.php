<?php
session_start();
header("Location: ../index.php");
include('../config/connection.php');
function find_id()
{
    include('../config/connection.php');
    $query = $pdo->prepare("SELECT MAX(id) FROM photos");
    try {
        $query->execute();
        $result = $query->fetchAll();
    } catch (PDOexception $e) {
        echo $e->getMessage();
    }
    $result = $result[0]['MAX(id)'] + 1;
    $pdo = null;
    return $result;
}

    if ($_POST['submit'] == "Se connecter" && $_POST["login"] && $_POST["password"]) {
        list($login, $password) = array($_POST["login"], $_POST["password"]);
        try {
            $query = $pdo->prepare("SELECT * FROM users WHERE login = '$login'");
            $query->execute();
            $check = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        try {
            $query = $pdo->prepare("SELECT * FROM users WHERE login = '$login' AND password = PASSWORD('$password')");
            $query->execute();
            $check2 = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        try {
            $query = $pdo->prepare("SELECT * FROM users WHERE login = '$login' AND password = PASSWORD('$password') AND verified = 'Y'");
            $query->execute();
            $check3 = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($check && $check2 && $check3) {
            $_SESSION['login'] = $login;
            $_SESSION["password"] = $password;
            $_SESSION['logged_on_user'] = 1;
            if (file_exists("../uploads/photo.png"))
                 unlink("../uploads/photo.png");
            if (file_exists("../uploads/".find_id().".png"))
                 unlink("../uploads/".find_id().".png");
            echo "User session connected\n";
            $query = $pdo->prepare("SELECT * FROM users WHERE login = ? AND verified = ?");
            $query->execute([$login, 'Y']);
            $check = $query->fetchAll();
            if ($check) {
                $_SESSION['verified'] = 1;
                echo("User is verified\n");
            } else {
                $_SESSION['verified'] = 0;
                
            }
        }
        elseif (!$check)
        $_SESSION['wronglogin'] = 1;
        elseif (!$check2)
            $_SESSION['wrongpw'] = 1;
        elseif (!$check3)
            $_SESSION['plslogin'] = 1; 
    }
    $pdo = null;
?>
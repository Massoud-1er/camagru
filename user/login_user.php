<?php
//connection to SQL through PDO
include('../config/connection.php');
    if ($_POST['submit'] == "Se connecter" && $_POST["login"] && $_POST["password"]) {
        list($login, $password) = array($_POST["login"], $_POST["password"]);
        try {
            // Prepare and query SQL for check
            $query = $pdo->prepare("SELECT * FROM users WHERE login='$login' AND password=PASSWORD('$password')");
            $query->execute();
            $check = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($check) {
            session_start();
            //CREATE a session
            $_SESSION['login'] = $login;
            $_SESSION["password"] = $password;
            $_SESSION['logged_on_user'] = 1;
            echo "User session connected\n";
            $query = $pdo->prepare("SELECT * FROM users WHERE login='$login' AND verified='Y'");
            $query->execute();
            $check = $query->fetchAll();
            if ($check) {
                $_SESSION['verified'] = 1;
                echo("User is verified\n");
            } else {
                $_SESSION['verified'] = 0;
                echo("User is not verified\n");
            }
            print_r($_SESSION);   
        }
    }
    $pdo = null;

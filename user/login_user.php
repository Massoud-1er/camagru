<?php
//connection to SQL through PDO
include('../config/connection.php');
session_start();
header("Location: ../index.php");
    if ($_POST['submit'] == "Se connecter" && $_POST["login"] && $_POST["password"]) {
        list($login, $password) = array($_POST["login"], $_POST["password"]);
        try {
            print_r($_POST); 
            // Prepare and query SQL for check
            $query = $pdo->prepare("SELECT * FROM users WHERE login = '$login' AND password = PASSWORD('$password')");
            $query->execute();
            $check = $query->fetchAll();
            print_r($check);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($check) {
            
            //CREATE a session
            $_SESSION['login'] = $login;
            $_SESSION["password"] = $password;
            $_SESSION['logged_on_user'] = 1;
            echo "User session connected\n";
            $query = $pdo->prepare("SELECT * FROM users WHERE login = ? AND verified = ?");
            $query->execute([$login, 'Y']);
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
?>
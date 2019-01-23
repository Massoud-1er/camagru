<?php
include('../config/database.php');

    //connection to SQL through PDO
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $DB_USER, $DB_PASSWORD, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
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

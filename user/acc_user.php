<?php

//connection to SQL through PDO
include('../config/connection.php');
    // check if Post is correct
    if ($_POST["submit"] == "Modifier son mot de passe" && $_POST["login"] && $_POST["newpw"] && $_POST["oldpw"]) {
        // create var of user, oldpw and newpw
        list($login, $oldpw, $newpw) = array($_POST["login"], $_POST["oldpw"], $_POST["newpw"]);
        try {
            // Prepare and query SQL for check
            //first check for login
            $query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
            $query->execute();
            $check = $query->fetchAll();
            //second check for passwd
            $query = $pdo->prepare("SELECT * FROM users WHERE login='$login' AND password=PASSWORD('$oldpw')");
            $query->execute();
            $check2 = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($check && $check2) {
            // Change passwd in SQL
            $query = $pdo->prepare("UPDATE users
                SET password=PASSWORD('$newpw')
                WHERE login='$login'");
            try {
                $query->execute();
                // header("Location: ../index.php");
                echo("Le mot de passe a bien ete change\n");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } elseif (!$check) {
            echo("Cet utilisateur n'existe pas\n");
        } elseif (!$check2) {
            echo("Le mot de passe ne correspond pas a cet utilisateur\n");
        }
    }
    $pdo = null;

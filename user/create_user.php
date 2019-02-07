<?php
    session_start();
    if ($_SESSION['mail_sent'])
        header('Location: ../my_account.php');
    header('Location: ../create.php');
    include('../config/connection.php');
    include('valid_passwd.php');
    include('valid_mail.php');
    include('verify_user.php');
    if ($_POST["submit"] == "Creer un compte" && $_POST["login"] && $_POST["password"] && $_POST["email"]) {
        if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['email'])){
            unset($_SESSION['crea']);
            header('Location: ../create.php');
        }
        list($login, $password, $mail, $hash) = array($_POST["login"], $_POST["password"], $_POST["email"], md5(rand(0,1000)));
        if (!is_valid_password($_POST['password'])){
            $_SESSION['crea'] = 1;
            exit();
        }
        if (!valid_mail($_POST['email'])){
            $_SESSION['crea'] = 2;
            exit();
        }
        try {
            $query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
            $query->execute();
            $check = $query->fetchAll();
            $query = $pdo->prepare("SELECT * FROM users WHERE mail='$mail'");
            $query->execute();
            $check2 = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($check == null && $check2 == null) {
            $query = $pdo->prepare("INSERT INTO users (login, password, mail, hash)
								VALUES ('$login', PASSWORD('$password'), '$mail', '$hash')");
            try {
                $query->execute();
                verify_user($mail, $hash);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            $_SESSION['mail_sent'] = 1;
            if (isset($_SESSION['crea']))
            unset($_SESSION['crea']);
            header('Location: ../my_account.php');
        } elseif ($check != null) {
            $_SESSION['crea'] = 3;
            exit();
        } elseif ($check2 != null) {
            $_SESSION['crea'] = 4;
            exit();
        }
    }
    $pdo = null;
?>
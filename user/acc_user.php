<?php
header("Location: ../index.php");
function change_pw()
{
    include('../config/connection.php');
    list($login, $oldpw, $newpw) = array($_POST["login"], $_POST["oldpw"], $_POST["newpw"]);
    try {
        if (!is_valid_password($newpw)){
            echo "Le mot de passe doit contenir 2 caracteres speciaux et/ou majuscules et avoir 8 caracteres";
            exit();
        }
        $query = $pdo->prepare("SELECT * FROM users WHERE login= ?");
        $query->execute([$login]);
        $check = $query->fetchAll();
        $query = $pdo->prepare("SELECT * FROM users WHERE login='$login' AND password=PASSWORD('$oldpw')");
        $query->execute();
        $check2 = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($check && $check2) {
        $query = $pdo->prepare("UPDATE users
                SET password=PASSWORD('$newpw')
                WHERE login='$login'");
        try {
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } elseif (!$check) {
        echo("Cet utilisateur n'existe pas\n");
    } elseif (!$check2) {
        echo("Le mot de passe ne correspond pas a cet utilisateur\n");
    }
    $pdo = null;
}

function change_login()
{
    include('../config/connection.php');
    list($login, $passwd, $newlogin) = array($_POST["login"], $_POST["passwd"], $_POST["newlogin"]);
    try {
        $query = $pdo->prepare("SELECT * FROM users WHERE login= ?");
        $query->execute([$login]);
        $check = $query->fetchAll();
        $query = $pdo->prepare("SELECT * FROM users WHERE login=? AND password=PASSWORD('$passwd')");
        $query->execute([$login]);
        $check2 = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($check && $check2) {
        $query = $pdo->prepare("UPDATE `users`
                SET login='$newlogin'
                WHERE login='$login'");
        try {
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $query = $pdo->prepare("UPDATE `comments`
                SET login='$newlogin'
                WHERE login='$login'");
        try {
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $query = $pdo->prepare("UPDATE `likes`
        SET login='$newlogin'
        WHERE login='$login'");
        try {
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $query = $pdo->prepare("UPDATE `photos`
SET login='$newlogin'
WHERE login='$login'");
        try {
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } elseif (!$check) {
        echo("Cet utilisateur n'existe pas\n");
    } elseif (!$check2) {
        echo("Le mot de passe ne correspond pas a cet utilisateur\n");
    }
    $pdo = null;
}

function change_mail()
{
    include('../config/connection.php');
    list($login, $oldmail, $newmail) = array($_POST["login"], $_POST["oldmail"], $_POST["newmail"]);
    try {
        $query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
        $query->execute();
        $check = $query->fetchAll();
        $query = $pdo->prepare("SELECT * FROM users WHERE login='$login' AND mail='$oldmail'");
        $query->execute();
        $check2 = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($check && $check2) {
        $query = $pdo->prepare("UPDATE users
                SET mail='$newmail'
                WHERE login='$login'");
        try {
            $query->execute();
            echo("L'adresse e-mail a bien ete modifie\n");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } elseif (!$check) {
        echo("Cet utilisateur n'existe pas\n");
    } elseif (!$check2) {
        echo("L'adresse e-mail ne correspond pas a cet utilisateur'\n");
    }
    $pdo = null;
}
    
function change_notif()
{
    include('../config/connection.php');
    list($login, $mail) = array($_POST["login"], $_POST["mail"]);
    try {
        $query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
        $query->execute();
        $check = $query->fetchAll();
        $query = $pdo->prepare("SELECT * FROM users WHERE login='$login' AND mail='$mail'");
        $query->execute();
        $check2 = $query->fetchAll();
        $query = $pdo->prepare("SELECT * FROM users WHERE login='$login' AND notif='Y'");
        $query->execute();
        $check3 = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($check && $check2 && $check3) {
        $query = $pdo->prepare("UPDATE users
                SET notif='N'
                WHERE login='$login'");
        try {
            $query->execute();
            echo("Vous ne recevrez plus de notifications par mail\n");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } elseif (!$check) {
        echo("Cet utilisateur n'existe pas.\n");
    } elseif (!$check2) {
        echo("Le mot de passe ne correspond pas a cet utilisateur.\n");
    } elseif (!$check3) {
        echo("Les notifications sont deja desactivees.\n");
    }
    $pdo = null;
}

function reset_passwd()
{
    include('../config/connection.php');
    include('mail_reset.php');
    list($login, $mail) = array($_POST["login"], $_POST["mail"]);
    try {
        $query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
        $query->execute();
        $check = $query->fetchAll();
        $query = $pdo->prepare("SELECT * FROM users WHERE login='$login' AND mail='$mail'");
        $query->execute();
        $check2 = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($check && $check2) {
        // prepare token
        date_default_timezone_set(UTC);
        $expFormat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d")+1,
            date("Y")
            );
        $expDate = date("Y-m-d H:i:s", $expFormat);
        $key = md5(2418*2+$email);
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $key = $key . $addKey;
        $query = $pdo->prepare("INSERT INTO `password_reset` (`mail`, `key`, `expDate`)
        VALUES ('$mail', '$key', '$expDate');");
        try {
            $query->execute();
            mail_reset($key, $mail);
            // header("Location: ../index.php");

            echo("Un email pour reinitialiser votre mot de passe vous a bien ete envoye\n");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } elseif (!$check) {
        echo("Cet utilisateur n'existe pas.\n");
    } elseif (!$check2) {
        echo("L'adresse e-mail ne correspond pas.\n");
    }
    $pdo = null;
}

if ($_POST["submit"] == "Modifier son mot de passe" && $_POST["login"] && $_POST["newpw"] && $_POST["oldpw"]) {
    change_pw();
} elseif ($_POST["submit"] == "Modifier son login" && $_POST["login"] && $_POST["newlogin"] && $_POST["passwd"]) {
    change_login();
} elseif ($_POST["submit"] == "Modifier son adresse e-mail" && $_POST["login"] && $_POST["oldmail"] && $_POST["newmail"]) {
    change_mail();
} elseif ($_POST["submit"] == "Desactiver les notifcations" && $_POST["login"] && $_POST["mail"]) {
    change_notif();
} elseif ($_POST["submit"] == "Reinitialiser votre mot de passe" && $_POST["login"] && $_POST["mail"]) {
    reset_passwd();
}

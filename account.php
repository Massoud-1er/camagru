<?php
    session_start();
    switch ($_SESSION['pb']) {
        case 1:
            echo "<div style=\"text-align:center;\"><h2>Cet utilisateur n'existe pas</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 2:
            echo "<div style=\"text-align:center;\"><h2>Le mot de passe ne correspond pas a cet utilisateur</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 3:
            echo "<div style=\"text-align:center;\"><h2>Cet utilisateur n'existe pas</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 4:
            echo "<div style=\"text-align:center;\"><h2>Le mot de passe ne correspond pas a cet utilisateur</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 5:
            echo "<div style=\"text-align:center;\"><h2>Cet utilisateur n'existe pas</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 6:
            echo "<div style=\"text-align:center;\"><h2>L'adresse e-mail ne correspond pas a cet utilisateur</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 7:
            echo "<div style=\"text-align:center;\"><h2>Cet utilisateur n'existe pas.</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 8:
            echo "<div style=\"text-align:center;\"><h2>Le mot de passe ne correspond pas a cet utilisateur.</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 9:
            echo "<div style=\"text-align:center;\"><h2>Les notifications sont deja desactivees.</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 10:
            echo "<div style=\"text-align:center;\"><h2>Cet utilisateur n'existe pas.</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 11:
            echo "<div style=\"text-align:center;\"><h2>L'adresse e-mail ne correspond pas.</h2></div>";
            unset($_SESSION['pb']);
            break;
        case 12:
            echo "<div style=\"text-align:center;\"><h2>le mot de passe n'est pas valide</h2></div>";
            unset($_SESSION['pb']);
            break;
    };
    switch($_SESSION['good']){
        case 1:
            echo "<div style=\"text-align:center;\"><h2>votre mot de passe a bien ete change</h2></div>";
            unset($_SESSION['good']);
            break;
        case 2:
            echo "<div style=\"text-align:center;\"><h2>votre login a bien ete change</h2></div>";
            unset($_SESSION['good']);
            break;
        case 3:
            echo "<div style=\"text-align:center;\"><h2>L'adresse e-mail a bien ete modifie</h2></div>";
            unset($_SESSION['good']);
            break;
        case 4:
            echo "<div style=\"text-align:center;\"><h2>Vous ne recevrez plus de notifications par mail</h2></div>";
            unset($_SESSION['good']);
            break;

    };
    ?>
    <div class="form">
    <form id="login-form" action="my_account.php" method="POST">
        <button class="change" type="submit" name="change" value="mail">Changer mon adresse e-mail</button><br>
        <button class="change" type="submit" name="change" value="login">Changer mon login</button><br>
        <button class="change" type="submit" name="change" value="password">Changer mon mot de passe</button><br>
        <button class="change" type="submit" name="change" value="notif">Desactiver les notifcations </button>
    </form>
    <br><p class="message">Pas encore de compte ? <a href="create.php">Creer un compte</a></p>
</div>
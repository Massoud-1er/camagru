<?php
if ($_SESSION['plslogin']) {
    echo'<div><p style="text-align:center;margin-top:10vh;">Valide ton compte avant de te connecter ! </p></div>';
    unset($_SESSION['plslogin']);
}
if ($_SESSION['wrongpw']) {
    echo'<div><p style="text-align:center;margin-top:10vh;">Le mot de passe est incorrecte ! </p></div>';
    unset($_SESSION['wrongpw']);
}
if ($_SESSION['wronglogin']) {
    echo'<div><p style="text-align:center;margin-top:10vh;">Cet utilisateur n\'existe pas ! </p></div>';
    unset($_SESSION['wronglogin']);
}
?>
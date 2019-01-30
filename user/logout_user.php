<?php

function logout(){
    session_start();
    if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['logged_on_user'])){
        $_SESSION = array();
    }
	header('location: ../index.php');
	echo "Vous vous êtes deconnecté\n";
}
logout();
?>
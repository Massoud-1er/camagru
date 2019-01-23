<?php

function logout(){
    session_start();
    if (isset($_SESSION['login']) && isset($_SESSION['password'])){
        unset($_SESSION);
    }
	header('location: ../index.php');
	echo "Vous vous êtes deconnecté\n";
}
logout();
?>
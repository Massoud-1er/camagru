<?php

function mail_reset($key, $email)
{
    $to = $email;
    $subject = "Reinitialiser votre mot de passe";

    $message='T\'as encore oublie ton mot de passe ? T\'inquiete, il te suffit de suivre ce lien pour reinitialiser ton mot de passe :
    

localhost:8100/user/reset_passwd.php?
key='.$key.'&email='.$email.'&action=reset

Ce mail va expirer apres un jour pour des raisons de securite alors depeche toi !';

$headers = 'From:noreply@camagru.com' . "\r\n"; 
mail($to, $subject, $message, $headers); 
}
?>
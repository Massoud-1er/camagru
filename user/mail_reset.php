<?php

function mail_reset($key, $email)
{
    $to = $email;
    $subject = "Reinitialiser votre mot de passe";

    $message='Dear user,
    Please click on the following link to reset your password.

localhost:8100/user/reset_passwd.php?
key='.$key.'&email='.$email.'&action=reset

Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.
If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.
Thanks';

    $headers = 'From:noreply@camagru.com' . "\r\n"; 
mail($to, $subject, $message, $headers); 
}
?>
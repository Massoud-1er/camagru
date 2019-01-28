<?php
function verify_user($email, $hash)
{
$to      = $email;
$subject = 'Signup | Verification';
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
Please click this link to activate your account:
localhost:8100/user/verify.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
}
?>

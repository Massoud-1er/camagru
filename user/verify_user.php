<?php
function verify_user($email, $hash)
{
$to      = $email;
$subject = 'Verification';
$message = '
Bienvenue sur Camagru ! Ton compte a bien ete cree. Il te reste juste a l\'activer.
Copie ce lien pour valider ton compte.
localhost:8100/user/verify.php?email='.$email.'&hash='.$hash.'
';
$headers = 'From:noreply@camagru.com' . "\r\n";
mail($to, $subject, $message, $headers); 
}
?>

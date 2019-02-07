<?php
function mail_com($email)
{
$to      = $email;
$subject = 'Une de vos images a été commenté';
$message = '
Une de vos images a été commenté sur Camagru. Rendez vous sur votre page utilisateur pour profiter pleinement de cette attention. 
localhost:8100/my_pics.php';
$headers = 'From:noreply@camagru.com' . "\r\n";
mail($to, $subject, $message, $headers);
}
?>

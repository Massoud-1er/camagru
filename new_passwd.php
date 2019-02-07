<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Reinitialiser le mot de passe</title>
    <link rel="stylesheet" type="text/css" href="../form.css" />
</head>
<body>
        <div id="top_bar">
                <?php include ('top_bar.php');?>
            </div>
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="../user/acc_user.php" method="POST">
                <p>Nom d'utilisateur : </p><input type="text" name="login" />
                <p>Adresse e-mail : </p><input type="text" name="mail" />
                <input id="login" type="submit" name="submit" value="Reinitialiser votre mot de passe">
            </form>
        </div>
    </div>
</body>

</html>
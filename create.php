<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Creer un compte</title>
        <link rel = "stylesheet"
        type = "text/css"
        href = "form.css" />
	</head>
	<body>
		<div class="login-page">
			
			<div class="form">
				<form class="login-form" action="user/create_user.php" method="POST">
					<p>Nom d'utilisateur : </p><input type="text" name="login"/>
                    <p>Mot de passe : </p><input type="password" name="password"/>
                    <p>Adresse e-mail : </p><input type="text" name="email"/>
					<input id = "login" type="submit" name="submit" value ="Creer un compte">
				</form>
				<?php 
			    switch($_SESSION['crea']) {
					case 1:
						echo "<div><h1>Le mot de passe doit contenir 2 caracteres speciaux et/ou majuscules et avoir 8 caracteres</div>";
					case 2:
						echo "<div><h1>L'addresse email est non-valide</div></h1>";
					case 3:
						echo "<div><h1>Ce nom d'utilisateur est deja utilise</h1></div>";
					case 4:
						echo "<div><h1>Cette adresse e-mail est deja utilisee</h1></div>";
				};?>
			</div>
		</div>
	</body>
</html>

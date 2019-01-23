<?php

include ('../config/database.php');

	//connection to SQL through PDO
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
	// check Post correct
	if ($_POST["submit"] == "Creer un compte" && $_POST["login"] && $_POST["password"] && $_POST["email"]){
		// create var of user and pass and mail
		list($login, $password, $mail) = array($_POST["login"], $_POST["password"], $_POST["email"]);
		
        try {
           // Prepare and query SQL for check
            $query = $pdo->prepare("SELECT * FROM users WHERE login='$login'");
            $query->execute();
            $check = $query->fetchAll();
            $query = $pdo->prepare("SELECT * FROM users WHERE mail='$mail'");
            $query->execute();
            $check2 = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
         // check if user exist
		if ($check == null && $check2 == null){
				// create user on SQL line
				$query = $pdo->prepare("INSERT INTO users (login, password, mail)
								VALUES ('$login', PASSWORD('$password'), '$mail')");
                try {
                    // apply SQL line on database
                    $query->execute();
                    echo ("L'utilisateur a bien été crée\n");
                 } catch (PDOException $e) {
                     echo $e->getMessage();
                 }
			}
			else if ($check != null){
				echo ("Ce nom d'utilisateur est deja utilise\n");
            }
            else if ($check2 != null){
				echo ("Cette adresse e-mail est deja utilisee\n");
            }
        }
        $pdo = null;

?>
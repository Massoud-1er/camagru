<?php
include('../config/connection.php');

date_default_timezone_set(UTC);

if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
&& ($_GET["action"]=="reset") && !isset($_POST["action"])) {
    $key = $_GET["key"];
    $mail = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");
    try {
        // Prepare and query SQL for check
        $query = $pdo->prepare("SELECT * FROM `password_reset` WHERE `key`= ? AND `mail`= ?");
        $query->execute([$key, $mail]);
        $check = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if ($check == null) {
        $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>';
    } else {
        $expDate = $check[0]['expDate'];
        if ($expDate >= $curDate) {
            ?>
  <br />
  <form method="post" action="" name="update">
  <input type="hidden" name="action" value="update" />
  <br /><br />
  <label><strong>Veuillez entrer un nouveau mot de passe:</strong></label><br />
  <input type="password" name="pass1" maxlength="15" required />
  <br /><br />
  <label><strong>Veuillez re-entrer votre nouveau mot de passe:</strong></label><br />
  <input type="password" name="pass2" maxlength="15" required/>
  <br /><br />
  <input type="hidden" name="email" value="<?php echo $mail; ?>"/>
  <input type="submit" value="Reset Password" />
  </form>
<?php
        } else {
            $error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
is valid only 24 hours (1 days after request).<br /><br /></p>";
        }
    }

    if ($error!="") {
        echo "<div class='error'>".$error."</div><br />";
    }
} // isset email key validate end
 
 
if (isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")) {
    $error="";
    $pass1 = strip_tags($_POST["pass1"]);
    $pass2 = strip_tags($_POST["pass2"]);
    $mail = $_POST["email"];
    $curDate = date("Y-m-d H:i:s");

    if ($pass1!=$pass2) {
        $error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
    }
  
    if ($error!="") {
        echo "<div class='error'>".$error."</div><br />";
    } else {
        $query = $pdo->prepare("UPDATE users
SET password=PASSWORD('$pass1')
WHERE mail= ?");
        $query2 = $pdo->prepare("DELETE FROM `password_reset` WHERE `mail`= ?");
        try {
            // apply SQL line on database
            $query->execute([$mail]);
            echo("Le mot de passe a bien ete change\n");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        try {
            // apply SQL line on database
            $query2->execute([$mail]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="localhost:8100/login.html">
Click here</a> to Login.</p></div><br />';
    }
}
?>
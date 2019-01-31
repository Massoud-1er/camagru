<?php

function put_img_to_gal()
{
    include('del_photo.php');
    include('config/connection.php');

    $query = $pdo->prepare("SELECT * FROM photos ORDER BY date DESC");
    try {
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $key=>$value)  
        {
            echo '  
                <tr>  
                    <td>  
                        <img src="data:image/jpeg;base64,'.base64_encode($value['photo']).'" class="img_gal" />
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
                        </form>
                    </td>
                </tr>
            ';
        }
    } catch (PDOexception $e) {
        echo $e->getMessage();
    }
    if ((isset($_POST["email"]) && isset($_POST["action"]) &&
    ($_POST["action"]=="update"))){
        delete();
    }
}
put_img_to_gal();
?>
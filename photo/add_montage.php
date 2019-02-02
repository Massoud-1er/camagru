<?php
function save_img()
{
    include('config/connection.php');
    session_start();
    if(isset($_POST["submit"]))  
    {
        date_default_timezone_set(UTC);
        $date = date('Y-m-d', time());
        $login = $_SESSION['login'];
        $file = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));  
        $query = $pdo->prepare("INSERT INTO `photos` (`photo`, `login`, `date`) VALUES ('$file', '$login', '$date')");  
        try {
            $query->execute();
            echo "la photo a bien été mise dans la db";
        } catch (PDOexception $e) {
            echo "la photo n'a pas été mise dans ls db";
        }
    }
    else
        echo "oups";
}
save_img();

?>
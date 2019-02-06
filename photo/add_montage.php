<?php

function del_montage($idphoto)
{
    header('Location: ../my_pics.php');
    include('config/connection.php');
    $query = $pdo->prepare("DELETE FROM photos WHERE id =?");
    try {
        $query->execute([$idphoto]);
        $result = $query->fetchAll();
    } catch (PDOexception $e) {
        echo $e->getMessage();
    }    
    $pdo = null;
}

function find_id()
{
    include('config/connection.php');
    $query = $pdo->prepare("SELECT MAX(id) FROM photos");
    try {
        $query->execute();
        $result = $query->fetchAll();
    } catch (PDOexception $e) {
        echo $e->getMessage();
    }
    $result = $result[0]['MAX(id)'] + 1;
    $pdo = null;
    return $result;
}

function save_img()
{
    include('config/connection.php');
    include_once('webcam.php');
    if (isset($_POST["save"]))
    {
        date_default_timezone_set(UTC);
        $date = date('Y-m-d', time());
        $login = $_SESSION['login'];
        $file = "uploads/".find_id().".png";
        if (!file_exists($file))
            rename("uploads/photo.png", $file);
        if (file_exists($file)) {
            $query = $pdo->prepare("INSERT INTO `photos` (`photo`, `login`, `date`, `like`) VALUES ('$file', '$login', '$date', 0)");
            try {
                $query->execute();
            } catch (PDOexception $e) {
                echo $e->getMessage();
            }
        if (file_exists("uploads/photo.png"))
            unlink("uploads/photo.png");
        }
    }
}

if ($_POST['submit'] && $_POST['submit'] == "del"){
    del_montage($_POST['id']);
}
?>
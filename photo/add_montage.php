<?php

function find_id()
{
    include('config/connection.php');
    $query = $pdo->prepare("SELECT MAX(id) FROM photos");
    try {
        $query->execute();
        $result = $query->fetchAll();
    } catch (PDOexception $e) {}
    $result = $result[0]['MAX(id)'] + 1;
    $pdo = null;
    return $result;
}

function save_img()
{
    include('config/connection.php');
    if (isset($_POST["save"]))
    {
        date_default_timezone_set(UTC);
        $date = date('Y-m-d', time());
        $login = $_SESSION['login'];
        $file = "uploads/".find_id().".png";
        $query = $pdo->prepare("INSERT INTO `photos` (`photo`, `login`, `date`, `like`) VALUES ('$file', '$login', '$date', 1)");
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
?>
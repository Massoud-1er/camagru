<?php
function get_likes($idphoto)
{
    include($_SERVER['HOME'].'config/connection.php');
    try {
        $query = $pdo->prepare("SELECT `like` FROM `photos` WHERE id = ?");
        $query->execute([$idphoto]);
        $total = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
    return ($total[0]['like'] ? $total[0]['like'] : 0);
}
?>

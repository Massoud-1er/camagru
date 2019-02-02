<?php
function get_likes($idphoto)
{
    include('../config/connection.php');
    try {
        $query = $pdo->prepare("SELECT `like` FROM `likes` WHERE id = ?");
        $query->execute([$idphoto]);
        $total = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return ($total['like']);
}
?>

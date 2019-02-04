<?php
include('config/connection.php');
try {
    $query = $pdo->prepare("SELECT * FROM `comments` WHERE id_photo = ?");
    $query->execute([$_GET['id']]);
    $total = $query->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($query->rowCount() > 0) {
    foreach ($total as $k => $val) {
        echo ''.$val['login'].' a commenté :';
        echo '<div class="one_com">'.($val['comments']).'</div>';
    }
}
?>
<?php

include('config/connection.php');
try {
    $query = $pdo->prepare("SELECT * FROM `photos` ORDER BY date DESC limit 5");
    $query->execute();
    $total = $query->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}


if ($query->rowCount() > 0) {
    foreach ($total as $k => $val) {
        echo '<div class="montageDiv"><a href="view_com.php?id='.$val['id'].'"><img class ="montage" src="'.($val['photo']).'"></a></div>';
    }
}
?>
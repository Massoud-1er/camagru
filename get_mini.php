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
        echo '<div class="montageDiv"><img class ="montage" src="data:image/jpeg;base64,'.base64_encode($val['photo']).'"></div>';
    }
}
        print_r($total);
?>
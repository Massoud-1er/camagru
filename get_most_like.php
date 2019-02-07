<?php
function get_most_like(){
    include('config/connection.php');
    try {
        $query = $pdo->prepare("SELECT * FROM `photos` ORDER BY `like` DESC LIMIT 1");
        $query->execute();
        $total = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($total) {
            echo '<p style="margin-left:15vw;margin-top:2vh;padding-bottom:1vh;"> La photo avec le plus de succes en ce moment :';
            echo '<div id="main_pic"><a href="view_com.php?id='.$total[0]['id'].'"><img id="most_pic" src="'.($total[0]['photo']).'"></a></div>';
        }
    }
?>
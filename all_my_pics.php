<?php
function all_my_pics($rows)
{
    include($_SERVER['HOME'].'comments/get_likes.php');
    foreach ($rows as $k => $val) {
        echo '<div class="col"><img class ="my_pics" src="'.($val['photo']).'"></br>';
        echo 'Nombre de personnes aimant cette photo :'.get_likes($val['id']);
        echo '<a href="view_com.php?id='.$val['id'].'">Voir les commentaires.</a>';
        echo '</div>';
    }
}
?>
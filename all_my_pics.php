<?php
function all_my_pics($rows)
{
    include($_SERVER['HOME'].'comments/get_likes.php');
    foreach ($rows as $k => $val) {
        echo '<div class="col">';
        echo '<img class ="my_pics" src="'.($val['photo']).'">';
        echo 'Nombre de personnes aimant cette photo : '.get_likes($val['id']);
        echo '<div><br><a href="view_com.php?id='.$val['id'].'">Voir les commentaires.</a>';
        echo '<form id="del_form" onsubmit="return confirm(\'Are you sure?\');" action="photo/add_montage.php" method="POST">
        <input id ="delete" type="image" src="../pics/del.svg" alt="submit"></a>
        <input type="hidden" name="id" value="'.$val['id'].'">
        <input type="hidden" name="submit" value="del">
        </form></div>';
        echo '</div>';
    }
}
?>
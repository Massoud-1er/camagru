<?php
function all_my_pics($rows)
{
    include($_SERVER['HOME'].'comments/get_likes.php');

    foreach ($rows as $k => $val) {
        echo '<div class="my_pics"><img class ="montage" src="'.($val['photo']).'"></div>';
        include($_SERVER['HOME'].'comments/write_comment.html');
        include($_SERVER['HOME'].'comments/like.html');
        echo 'Nombre de personnes aimant cette photo :'.get_likes($val['id']);
    }
}
?>
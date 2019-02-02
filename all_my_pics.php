<?php
function all_my_pics($rows)
{
    include('comments/get_likes.php');
    foreach ($rows as $k => $val) {
        echo '<p><img src="data:image/jpeg;base64,'.base64_encode($val['photo']).'" class="img_gal" /></p>';
        include('comments/write_comment.html');
        include('comments/like.php');
        echo 'Nombre de personnes aimant cette photo :'.get_likes($val['id']);
    }
}
?>
<?php
if (isset($_POST['data_img']) && isset($_POST['getimg']) && $_POST['getimg'] == "getimg"){
    $img = $_POST['data_img'];
    $img = str_replace('data:image/png;base64,', '', $img);
    base64_decode($img);
    imagepng($img, "uploads/test.png");
}
?>
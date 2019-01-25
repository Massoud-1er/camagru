#!/usr/bin/php
<?php

    $image = imagecreatefromjpeg ('leonard.jpg');
    $filter = imagecreatefrompng('https://raw.githubusercontent.com/wickedpool/Camagru-42/master/images/trash.png');

    imagealphablending($filter, false);
    imagesavealpha($filter, true);
    
    imagejpeg($filter, 'filter.png');

    $x = imagesx($filter);
    $y = imagesy($filter);
    




    // $newImg = imagecreatetruecolor($x, $y);

    //  imagealphablending($newImg, false);
    //  imagesavealpha($newImg,true);
    //  $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
    //  imagefilledrectangle($newImg, 0, 0, $x, $y, $transparent);

    // imagecopyresampled($newImg, $filter, 0, 0, 0, 0, $x, $y, $x, $y);






    imagecopymerge($image, $filter, 0, 0, 0, 0, $x, $y, 100);
    imagejpeg($image, 'v.png');
    imagedestroy($image);
?>
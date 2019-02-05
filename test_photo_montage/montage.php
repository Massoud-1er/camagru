<?php

function imageCreateFromAny($filepath) { 
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize() 
    $allowedTypes = array( 
        1,  // [] gif 
        2,  // [] jpg 
        3,  // [] png 
    ); 
    if (!in_array($type, $allowedTypes)) { 
        return false; 
    } 
    switch ($type) { 
        case 1 : 
            $im = imageCreateFromGif($filepath); 
        break; 
        case 2 : 
            $im = imageCreateFromJpeg($filepath); 
        break; 
        case 3 : 
            $im = imageCreateFromPng($filepath); 
        break; 
    }    
    return $im;  
}

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
    if(!isset($pct)){ 
        return false; 
    } 
    $pct /= 100; 
    $w = imagesx( $src_im ); 
    $h = imagesy( $src_im ); 
    imagealphablending( $src_im, false );
    $minalpha = 127; 
    for( $x = 0; $x < $w; $x++ ) 
    for( $y = 0; $y < $h; $y++ ){ 
        $alpha = ( imagecolorat( $src_im, $x, $y ) >> 24 ) & 0xFF; 
        if( $alpha < $minalpha ){ 
            $minalpha = $alpha; 
        } 
    }
    for( $x = 0; $x < $w; $x++ ){ 
        for( $y = 0; $y < $h; $y++){ 
            $colorxy = imagecolorat( $src_im, $x, $y ); 
            $alpha = ( $colorxy >> 24 ) & 0xFF; 
            if( $minalpha !== 127 )
            $alpha = 127 + 127 * $pct * ( $alpha - 127 ) / ( 127 - $minalpha ); 
            else
            $alpha += 127 * $pct; 
            $alphacolorxy = imagecolorallocatealpha( $src_im, ( $colorxy >> 16 ) & 0xFF, ( $colorxy >> 8 ) & 0xFF, $colorxy & 0xFF, $alpha ); 
            if(!imagesetpixel( $src_im, $x, $y, $alphacolorxy))
            return false; 
        } 
    } 
    imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h); 
}

function edit($filt)
{
    include_once('photo/add_montage.php');

    $file = "uploads/".find_id().".png";
    $im = imageCreateFromAny("uploads/photo.png");
    $image = imagescale($im, 500, 375);

    $filter = imagecreatefrompng($filt);
    imagecopymerge_alpha($image, $filter, 100, 100, 0, 0, imagesx($filter), imagesy($filter), 100); 
    imagesavealpha($image, true);

    imagepng($image, $file);
    echo "<div><img id = \"up_img\" src=\"$file\"></div>";
    echo "<form action=\"\" method=\"post\">
    <input type=\"submit\" name=\"save\" id=\"save\" value=\"save\"></form>";
}
?>
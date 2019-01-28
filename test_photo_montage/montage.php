#!/usr/bin/php

<?php

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

function resizeImage($img)
{

}

$im = imagecreatefrompng("face.png");
$image = imagescale($im, 500, 375);

$filter = imagecreatefrompng("smiley.png");
imagecopymerge_alpha($image, $filter, 100, 100, 0, 0, imagesx($filter), imagesy($filter), 100); 
imagesavealpha($image, true); 
imagepng($image, 'toto.png');

?>
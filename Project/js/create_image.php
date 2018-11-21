<?php
    session_start();    	
    $md5_hash = md5(rand(0,9999)); 
    $security_code = substr($md5_hash, 25, 5); 
    $enc=md5($security_code);
    $_SESSION['count'] = $enc;
    $secure = $_SESSION['count'];
    //     echo "--------------------------$secure<br>";
    $width = 150;
    $height = 50;    
 
    $dir = 'fonts/';

$image = imagecreatetruecolor(170, 60);
$black = imagecolorallocate($image, 0, 0, 0);
$color = imagecolorallocate($image, 255, 100, 100); // red
$white = imagecolorallocate($image, 255, 255, 255);

imagefilledrectangle($image,0,0,399,99,$white);

for( $i=0; $i<($width*$height)/800; $i++ ) {
    imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
}

imageline($image, 0, $height/2, $width, $height/2, $grey); 
imageline($image, $width/2, 0, $width/2, $height, $grey); 


imagettftext ($image, 35, 0, 10, 40, $color, $dir."arial.ttf", $security_code);

header("Content-type: image/png");
imagepng($image);
    ImageDestroy($image);
    ImageDestroy($image);
    ?>
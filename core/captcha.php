<?php 
    session_start();
    $rand_str = md5(rand());
    // echo $rand_str;
    $str = substr($rand_str, 0, 6);
    // echo $str;
    $_SESSION['captcha'] = $str;
    $newImage = imagecreate(100, 30);
    imagecolorallocate($newImage, 220, 220, 225);
    $col = imagecolorallocate($newImage, 0, 0, 0);
    imagestring($newImage, 29, 10, 2, $str, $col);
    header('content:image/jpeg');
    imagejpeg($newImage);

?>
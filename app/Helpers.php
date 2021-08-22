<?php
if (!function_exists('makeAvatar')) {
    function makeAvatar($fontPath, $dest, $char)
    {
        $path = $dest;
        // $image = imagecreate(200, 200);
        $image = imagecreate(200, 200);

        $red = rand(0, 255);
        $greed = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $greed, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);
        imagettftext($image, 100, 0, 50, 150, $textcolor, $fontPath, $char);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }
}

// app\Http\helpers.php
function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

?>

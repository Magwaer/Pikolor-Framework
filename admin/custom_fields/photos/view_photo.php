<?php
session_write_close();

$w = $_GET['w'];
$h = $_GET['h'];

$sourceImage = "../../.." . $_GET['img'];

if (file_exists($sourceImage)){

    $imageSize = getimagesize($sourceImage);
		
	$map = $w . "_" . $h;
	$name = md5($sourceImage);
	$size = filesize($sourceImage);
	$dir = dirname($sourceImage) . "/cache/" . $w . "_" . $h . "/";
	$adr = $dir . $name . "_" . $size ;
	if (!is_dir($dir))
	{
		mkdir($dir, 0777, true);
	}
	if (file_exists($adr))
	{
		header('Content-Type: ' . $imageSize[2]);
		header('Content-Length: ' . filesize($adr));
		readfile($adr);
		exit;
	}
	else
	{
		copy($sourceImage , $adr);
	}
	
    $wi = $imageSize[0];
    $hi = $imageSize[1];

    $newWidth = $w+4;
    $newHeight = $h+4;

    if ($wi > $newWidth || $hi > $newHeight) {
        if ($wi < $hi)
            $newWidth = ceil(($newHeight / $hi) * $wi);
        elseif ($wi >= $hi)
            $newHeight = ceil(($newWidth / $wi) * $hi);
    }
    else {
        $newWidth = $wi;
        $newHeight = $hi;
    }


    switch (image_type_to_mime_type($imageSize[2])) {
        case "image/jpeg":
            $image = imagecreatefromjpeg($sourceImage);
            break;
		case "image/gif":
            $image = imagecreatefromgif($sourceImage);
            break;
		case "image/png":
            $image = imagecreatefrompng($sourceImage);
            break;
        default:
            $t = image_type_to_mime_type($imageSize[2]);
            echo "The file type {$t} is not supported, please use jpeg";
            break;
    }
    $thumb = imagecreatetruecolor($w, $h);

	$black = imagecolorallocate($thumb, 0, 0, 0);
	// Make the background transparent
	imagecolortransparent($thumb, $black);

    imagealphablending($thumb, false);
    // Create a new transparent color for image
    $color = imagecolorallocatealpha($thumb, 255, 255,255, 127);
    // Completely fill the background of the new image with allocated color.
    imagefill($thumb, 0, 0, $color);
    // Restore transparency blending
    imagesavealpha($thumb, true);


    $x = floor( ($newWidth - $w )/ 2) * -1 ;
    $y = floor( ($newHeight - $h)/ 2) * -1 ;
    imagecopyresampled($thumb, $image, $x, $y, 0, 0, $newWidth, $newHeight, $imageSize[0], $imageSize[1]);

    Header ('Content-type: image/jpeg');
	imagepng($thumb, $adr);
    imagepng($thumb);
    imagedestroy($image);
    imagedestroy($thumb);
}

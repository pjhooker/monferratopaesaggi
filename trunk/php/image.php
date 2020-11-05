<?php
/*
$myimage = $_GET['myimage'];
$imgh = $_GET['h'];
$imgw = $_GET['w'];
//$x=0;
//$y=0;
// Max vert or horiz resolution
$maxsize=$imgw;

// create new Imagick object
$image = new Imagick($myimage);


// Resizes to whichever is larger, width or height
if($image->getImageHeight() <= $image->getImageWidth())
{
// Resize image using the lanczos resampling algorithm based on width
$image->resizeImage(0,$maxsize,Imagick::FILTER_LANCZOS,1);
}
else
{
// Resize image using the lanczos resampling algorithm based on height
$image->resizeImage($maxsize,0,Imagick::FILTER_LANCZOS,1);
}

$geo=$image->getImageGeometry();

$sizex=$geo['width'];
$sizey=$geo['height']; 

$y = $sizey/2;
$x=$sizex/2;

$image->cropImage(960, 640, 0, 0);
*/

// define widescreen dimensions
$myimage = $_GET['myimage'];
$height = $_GET['h'];
$width = $_GET['w'];

// load an image
$i = new Imagick($myimage);
// get the current image dimensions
$geo = $i->getImageGeometry();

// crop the image
if(($geo['width']/$width) < ($geo['height']/$height))
{
    $i->cropImage($geo['width'], floor($height*$geo['width']/$width), 0, (($geo['height']-($height*$geo['width']/$width))/2));
}
else
{
    $i->cropImage(ceil($width*$geo['height']/$height), $geo['height'], (($geo['width']-($width*$geo['height']/$height))/2), 0);
}
// thumbnail the image
$i->ThumbnailImage($width,$height,true);
/*
// Set to use jpeg compression
$image->setImageCompression(Imagick::COMPRESSION_JPEG);
// Set compression level (1 lowest quality, 100 highest quality)
$image->setImageCompressionQuality(75);
*/

// save or show or whatever the image
$i->setImageFormat("png");

header('Content-type: image/jpeg;');
//echo $image;
echo $i;
?>
<?php
header('Content-Type:image/jpeg');
include('../plugin/resize/resizeimg.php');

if(is_file($_GET['pic'].'.jpg')){
  $path = $_GET['pic'].'.jpg';
}else{
  $path = 'nopic.jpg';
}
$image = new SimpleImage();
$image->load($path);
if(!empty($_GET['w'])){
	$width = $_GET['w'];
  $image->resizeToWidth($width);
}
$image->output();
?>
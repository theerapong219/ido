<?php

/* ==================================================
 *  Author : Tirapant Tongpann
 *  Created Date : 11/09/2554 01:30
 *  Module : 
 *  Description : 
 *  Involve People : -
 *  Last Updated : 11/09/2554 01:30
  ================================================== */
header("Content-type: text/html; charset=utf-8");
session_start();

$mod = $_GET['mod'];

require_once "../service/service.php";
require_once "../main/main.class.php";
require_once "module/$mod/$mod.class.php";
$obj = new SubClass();

$path = "../img/";
$img = $_FILES['file']['tmp_name'];
$type = CheckType($_FILES['file']['name']);
$name = str_replace(".$type", '', $_FILES['file']['name']);
$name = CreateFileName($name);
if(is_file($path.$name.'.'.$type)){
  $name = $name.'_'.RandomNumber(3);
}
$name = strtolower($name);
$filecopy = $path.$name.'.jpg';

if (($img_info = getimagesize($img)) === FALSE)$result['success'] = 'FAIL';

$width = $img_info[0];
$height = $img_info[1];
$widthOrg = $width;
$heightOrg = $height;
if(($width > 1024) || ($height > 1024)){
  $size = ResizePicture($width, $height, 1024, 1024);
  $width = $size['width'];
  $height = $size['height'];
}

switch ($img_info[2]) {
  case IMAGETYPE_GIF  : $src = imagecreatefromgif($img);  break;
  case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
  case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
  default : $result['success'] = 'NOTYPE';
}

$tmp = imagecreatetruecolor($width, $height);
imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $widthOrg, $heightOrg);
imagejpeg($tmp, $filecopy);

$result['result'] = array(
  'id' => $name,
  'url' => URL.'/img/?pic='.$name,
  'thumb' => URL.'/img/?pic='.$name.'&w=50'
);

echo json_encode($result);
?>
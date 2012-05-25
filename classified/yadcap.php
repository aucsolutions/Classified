<?php
	
	session_start();
	
	
	$md5 = md5(rand(1000,9999));
	$pass = substr($md5, 10, 5);
	$width = 110;
	$height = 50;
	if ( intval ( $_GET["posting"] ) == 1 )
		$_SESSION["posting"]["capCode"] = strtolower ( $pass ) ;
	else
		$_SESSION["capCode"] = strtolower ( $pass ) ;
	$image = imagecreate($width, $height);
	$white = imagecolorallocate($image, 255, 255, 255);
	$black = imagecolorallocate($image, 60, 60, 60);
	$grey = imagecolorallocate($image, 170, 170, 170);
	imagefill($image, 0, 0, $white);
	imagestring($image, 5, 33, 18, strtoupper ( $pass ), $black);

	//imageline($image, 0, $height/2, $width, $height/2, $grey);
	//imageline($image, $width/2, 0, $width/2, $height, $grey);
	header("Content-Type: image/jpeg");
	imagejpeg($image);
	imagedestroy($image);
	
	
	
?>
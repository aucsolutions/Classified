<?php
	
	session_start ( ) ;
	header ( "content-type:image/jpg" ) ;
	
	if ( $_GET["path"] != "" )
	{
		$imageName = $_GET["path"] ;
		if ( file_exists ( $imageName ) )
		{
			$image = imagecreatefromjpeg ( $imageName ) ;
			
			if ( intval ( $_GET["full"] ) == 0 )
			{
				list ( $width, $height ) = getimagesize ( $imageName ) ;
				
				$diffWidth = 1 ;
				$diffHeight = 1 ;
				if ( $width > $height )
				{
					if ( $width > 100 )
					{
						$diffWidth = 1 - ( ( $width-100 ) / $width ) ;
						$diffHeight = $diffWidth ;
					}
				}
				else
				{
					if ( $height > 100 )
					{
						$diffHeight = 1 - ( ( $height-100 ) / $height ) ;
						$diffWidth = $diffHeight ;
					}
				}
				$modwidth = $width * $diffWidth ;
				$modheight = $height * $diffHeight ;
				
				$tn = imagecreatetruecolor ( $modwidth, $modheight ) ;
				imagecopyresampled ( $tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height ) ;
			}
			else
			{
				
				list ( $width, $height ) = getimagesize ( $imageName ) ;
				
				$diffWidth = 1 ;
				$diffHeight = 1 ;
				if ( $width > $height )
				{
					if ( $width > 300 )
					{
						$diffWidth = 1 - ( ( $width-300 ) / $width ) ;
						$diffHeight = $diffWidth ;
					}
				}
				else
				{
					if ( $height > 250 )
					{
						$diffHeight = 1 - ( ( $height-250 ) / $height ) ;
						$diffWidth = $diffHeight ;
					}
				}
				$modwidth = $width * $diffWidth ;
				$modheight = $height * $diffHeight ;
				
				$tn = imagecreatetruecolor ( $modwidth, $modheight ) ;
				imagecopyresampled ( $tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height ) ;
			}
		}
	}
	
	imagejpeg ( $tn ) ;
	imagedestroy ( $tn ) ;
	
	imagedestroy ( $image ) ;
	
	
?>
<?php
	
	session_start ( ) ;
	
	
	$imgNum = intval ( $_GET["imgnum"] ) == 0 ? "" : "_".$_GET["imgnum"] ;
	
	if ( intval ( $_GET["clsid"] ) > 0 )
	{
		$imageName = "media/cls_".intval ( $_GET["clsid"] ).$imgNum."_520" ;
		
		if ( file_exists ( $imageName.".jpg" ) )
		{
			header ( "content-type:image/jpg" ) ;
			$imageName .= ".jpg" ;
			$image = imagecreatefromjpeg ( $imageName ) ;
		}
		elseif ( file_exists ( $imageName.".jpeg" ) )
		{
			header ( "content-type:image/jpg" ) ;
			$imageName .= ".jpg" ;
			$image = imagecreatefromjpeg ( $imageName ) ;
		}
		elseif ( file_exists ( $imageName.".png" ) )
		{
			header ( "content-type:image/png" ) ;
			$imageName .= ".png" ;
			$image = imagecreatefrompng ( $imageName ) ;
		}
		elseif ( file_exists ( $imageName.".gif" ) )
		{
			header ( "content-type:image/gif" ) ;
			$imageName .= ".gif" ;
			$image = imagecreatefromgif ( $imageName) ;
		}
		elseif ( file_exists ( $imageName.".bmp" ) )
		{
			header ( "content-type:image/bmp" ) ;
			$imageName .= ".bmp" ;
			$image = imagecreatefromwbmp ( $imageName) ;
		}
		else
		{
			header ( "content-type:image/jpg" ) ;
			$imageName = "media/no_image.jpg" ;
			$image = imagecreatefromjpeg ( $imageName ) ;
		}
		
		
		if ( $image )
		{
			list ( $width, $height ) = getimagesize ( $imageName ) ;
			
			$diffWidth = 1 ;
			$diffHeight = 1 ;
			
			$size_reduce = intval ( $_GET["gallery"] ) == 1 ? 200 : 80 ;
			
			
			if ( $_GET["gallery"] == "full" )
				$size_reduce = ( $width > 500 ? 500 : $width ) ;
			if ( intval ( $_GET["thumb"] ) == 5 )
				$size_reduce = ( $width > 260 ? 260 : $width ) ;
			
			if ( intval ( $_GET["feat"] ) == 1 )
				$size_reduce = 110 ;
			
			if ( $width > $height )
			{
				if ( $width > $size_reduce )
				{
					$diffWidth = 1 - ( ( $width-$size_reduce ) / $width ) ;
					$diffHeight = $diffWidth ;
				}
			}
			else
			{
				if ( $height > $size_reduce )
				{
					$diffHeight = 1 - ( ( $height-$size_reduce ) / $height ) ;
					$diffWidth = $diffHeight ;
				}
			}
			$modwidth = $width * $diffWidth ;
			$modheight = $height * $diffHeight ;
			
			$tn = imagecreatetruecolor ( $modwidth, $modheight ) ;
			imagecopyresampled ( $tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height ) ;
		}
	
	}
	
	
	if ( $tn )
	{
		imagejpeg ( $tn ) ;
		imagedestroy ( $tn ) ;
		imagedestroy ( $image ) ;
		exit ( ) ;
	}
	else
	{
		if ( strchr ( $imageName , ".jpg" ) )
			imagejpeg ( $image ) ;
		if ( strchr ( $imageName , ".bmp" ) )
			image2wbmp ( $image ) ;
		if ( strchr ( $imageName , ".gif" ) )
			imagegif ( $image ) ;
	
		imagedestroy ( $image ) ;
	}
	
	
?>
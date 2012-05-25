<?php
	
	session_start ( ) ;
	
	require ( "config.php" ) ;
	
	require_once ( "classes/manipulate.php" ) ;
	
	$data = new DataManipulator ;
	
	require ( "classes/misc.func.php" ) ;
	
	$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
	$app_init_data = array ( ) ;
	foreach ( $siteSettings as $site )
	{
		$app_init_data[$site["SiteVariable"]] = $site["SiteValue"] ;
	}
	
	if ( intval ( $_POST["ClassifiedID"] ) > 0 )
	{
		$clas_detail = $data->select ( "Classified" , "*" , array ( "AdID" => intval ( $_POST["ClassifiedID"] ) ) ) ;
		$clas_detail = $clas_detail[0] ;
		if ( ! empty ( $clas_detail ) )
		{
			$url = $_SERVER['HTTP_REFERER'] ;
			$body = $app_init_data["SendToFriendEmail"] ;
			str_replace ( "{URL}" , $url , $body ) ;
			str_replace ( "{SITE_URL}" , base_url , $body ) ;
			str_replace ( "{SITE_NAME}" , $app_init_data["SiteTitle"] , $body ) ;
			str_replace ( "{SITE_EMAIL}" , $app_init_data["OwnerEmail"] , $body ) ;
			str_replace ( "{Friend_Name}" , $_POST["FName"] , $body ) ;
			str_replace ( "{Friend_Email}" , $_POST["FEmail"] , $body ) ;
			str_replace ( "{Sender_Name}" , $_POST["FullName"] , $body ) ;
			str_replace ( "{Sender_Email}" , $_POST["EmailAddress"] , $body ) ;
			@mail ( $_POST["FEmail"] , $app_init_data["SiteTitle"] , $body , "from:".$app_init_data["SiteTitle"]."<".$app_init_data["OwnerEmail"].">" ) ;
			$_SESSION["str_system_message"] = "Send to your friend successfully." ;
		}
	}
	

	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;


?>
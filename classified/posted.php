<?php

	
	if ( intval ( $_SESSION["last_ad_id"] ) > 0 )
	{
		
		$array = array ( "IsPosted" => 1 ) ;
		if ( intval ( $app_init_data["DefaultStatus"] ) == 1 )
			$array["IsActive"] = "1" ;
			
		$data->update ( "Classified" , $array , array ( "AdID" => intval ( $_SESSION["last_ad_id"] ) ) ) ;
		$ad_email = $data->select ( "Classified" , "EmailAddress" , array ( "AdID" => intval ( $_SESSION["last_ad_id"] ) ) ) ;
		$ad_email = $ad_email[0] ;
		$body = $app_init_data["ADConfirmationEmail"] ;
		$body = str_replace ( "{URL}" , $url , $body ) ;
		$body = str_replace ( "{SITE_URL}" , base_url , $body ) ;
		$body = str_replace ( "{SITE_NAME}" , $app_init_data["SiteTitle"] , $body ) ;
		$body = str_replace ( "{SITE_EMAIL}" , $app_init_data["OwnerEmail"] , $body ) ;
		$body = str_replace ( "{Friend_Name}" , $_POST["FName"] , $body ) ;
		$body = str_replace ( "{Friend_Email}" , $_POST["FEmail"] , $body ) ;
		$body = str_replace ( "{Sender_Name}" , $_POST["FullName"] , $body ) ;
		$body = str_replace ( "{Sender_Email}" , $_POST["EmailAddress"] , $body ) ;
		@mail ( $ad_email["EmailAddress"] , $app_init_data["SiteTitle"] , $body , "from:".$app_init_data["SiteName"]."<".$app_init_data["OwnerEmail"].">" ) ;
	}
	
	$_SESSION["last_ad_id"] = NULL ;
	
	$_SESSION["str_system_message"] = "Thank You for your posting." ;
	
	header ( "location:".base_url ) ;

?>
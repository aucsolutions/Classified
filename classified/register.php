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
	
	if ( $_POST )
	{
		if ( intval ( $app_init_data["SignupAuthentication"] ) == 0 )
			$_SESSION["capCode"] = strtolower ( $_POST["capSecurity"] ) ;
		if ( strtolower ( $_POST["capSecurity"] ) == $_SESSION["capCode"] )
		{
			foreach ( $_POST as $key=>$val )
				if ( strchr ( $key , "_Setting_" ) )
				{
					$key = str_replace ( "_Setting_" , "" , $key ) ;
					$postdata[$key] = $val ;
				}
			$rec = $data->select ( "Account" , "*" , array ( "EmailAddress" => $postdata["EmailAddress"] ) ) ;
			if ( empty ( $rec ) )
			{
				$last_id = $data->insert ( "Account" , $postdata ) ;
				
				if ( $app_init_data["RegistrationEmail"] != "" )
				{
				
					$body = $app_init_data["RegistrationEmail"] ;
					$body = str_replace ( "{URL}" , $url , $body ) ;
					$body = str_replace ( "{SITE_URL}" , base_url , $body ) ;
					$body = str_replace ( "{SITE_NAME}" , $app_init_data["SiteTitle"] , $body ) ;
					$body = str_replace ( "{SITE_EMAIL}" , $app_init_data["OwnerEmail"] , $body ) ;
					$body = str_replace ( "{Friend_Name}" , $_POST["FName"] , $body ) ;
					$body = str_replace ( "{Friend_Email}" , $_POST["FEmail"] , $body ) ;
					$body = str_replace ( "{Sender_Name}" , $_POST["FullName"] , $body ) ;
					$body = str_replace ( "{Sender_Email}" , $_POST["EmailAddress"] , $body ) ;
					@mail ( $_POST["Email_Setting_Address"] , $app_init_data["SiteTitle"] , $body , "from:".$app_init_data["SiteName"]."<".$app_init_data["OwnerEmail"].">" ) ;
					$_SESSION["str_system_message"] = "Account Created Successfully." ;
				}
			}
			else
			{
				$_SESSION["str_system_message"] = "Email address already exits." ;
			}
			
		}
		else
		{
			$_SESSION["str_system_message"] = "Security Code not matched." ;
		}
		
	}
	

	header ( "location:".base_url ) ;


?>
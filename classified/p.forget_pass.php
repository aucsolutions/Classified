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
	if ( intval ( $app_init_data["IsSiteClose"] ) == 1 )
	{
		exit ( "Site is down for maintainance." ) ;
	}
	
	
	if ( $_POST )
	{
		$loginArray = array ( 
								"EmailAddress" => addslashes ( $_POST["EmailAddress"] ) 
							) ;
		$account_info = $data->select ( "Account" , "*" , $loginArray ) ;
		if ( ! empty ( $account_info ) )
		{
			$body = "Hello ".$account_info[0]["FullName"] ;
			$body .= ", \n Thank you for using ".$app_init_data["SiteTitle"]." \n You have requested your password from us. Your username at ".base_url." is ".$account_info[0]["EmailAddress"] . " and password is ". $account_info[0]["Password"]. " \n --------------- \n Thanks, \n Administrator ".$app_init_data["SiteName"]." \n ".base_url ;
			@mail ( $account_info[0]["EmailAddress"] , "Forget Password Request" , $body , "from:".$app_init_data["SiteName"]."<".$app_init_data["OwnerEmail"].">" ) ;
			$_SESSION["str_system_message"] = "Your password has been sent to your email address." ;
		}
		else
		{
			$_SESSION["str_system_message"] = "Invalid login information." ;
		}
		
	}
	
header ( "location:".base_url ) ;
	


?>
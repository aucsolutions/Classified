<?php
	
	session_start ( ) ;
	
	require ( "config.php" ) ;
	
	if ( intval ( $_POST["AdID"] ) > 0 )
	{
		if ( $_SESSION["capCode"] == $_POST["BBUV"] ) 
		{
			require_once ( "classes/manipulate.php" ) ;
		
			$data = new DataManipulator ;
			
			$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
			$app_init_data = array ( ) ;
			foreach ( $siteSettings as $site )
			{
				$app_init_data[$site["SiteVariable"]] = $site["SiteValue"] ;
			}
			
			
			$classified = $data->select ( "Classified" ,"*" , array ( "AdID" => intval ( $_POST["AdID"] ) ) ) ;
			$classified = $classified[0] ;
			$data->update ( "Classified" , " Replies=Replies+1" , array ( "AdID" => intval ( $_POST["AdID"] ) ) ) ;
			
			@mail ( $classified["EmailAddress"] , "Request posted on your Classified at ".base_url , "Hello Poster, \n Following query request has been recieved against your classified '".$classified["AdTitle"]."' by a visitor with email '".$_POST["FromEmailAddress"]."' : \n ".$_POST["EmailText"]." \n\n --------------------- \n ".$app_init_data["SiteName"]." Team, \n". base_url , "from:".$app_init_data["SiteTitle"]."<".$app_init_data["OwnerEmail"].">" ) ;
		
			$_SESSION["str_system_message"] = "Email has been forwarded to the poster." ;
		}
		else
			$_SESSION["str_system_message"] = "Invalid security code." ;
		
	}
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	


?>
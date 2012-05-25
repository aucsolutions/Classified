<?php
	
	session_start ( ) ;
	if ( $_POST )
	{
		if ( $_POST["Email_Setting_Address"] != "" && $_POST["txtMessage"] != "" )
		{
			@mail ( $app_init_data["OwnerEmail"] , "Contact us from ".$app_init_data["SiteTitle"] , "Hello ".$app_init_data["SiteTitle"]." admin \n ".$_POST["Full_Setting_Name"]." contacted you by online contact form at ".base_url." \n His/her message is \n ".$_POST["txtMessage"] , "from:".$_POST["Email_Setting_Address"] ) ;
			$_SESSION["str_system_message"] = "Your query forwarded successfully." ;
			header ( "location:".base_url ) ;
			exit();
		}
		else
		{
			$_SESSION["str_system_message"] = "Required field is missing." ;
		}
		
	}
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/contact_us.php" ) ;
	


?>
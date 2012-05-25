<?php
	
	
	if ( $qstring[1] != "" )
	{
		switch ( $qstring[1] )
		{
			case "Return" :
				$data->insert ( "Payments" , array ( "Amount" => $app_init_data["ClassifiedPrice"] , "AdID" => intval ( $_SESSION["last_ad_id"] ) ) ) ;
				$data->update ( "Classified" , array ( "PaymentStatus" => "Paid" ) , array ( "AdID" => intval ( $_SESSION["last_ad_id"] ) ) ) ;
				@mail ( $app_init_data["OwnerEmail"] , $app_init_data["SiteTitle"]." payment Recieved" , "Hello admin, \n Payment against Ad ID : ".$_SESSION["last_ad_id"]. " has been recieved in your paypal acocunt. Kindly verify and Do action against it. \n ---------------- \n Thank, \n ".$app_init_data["SiteTitle"], "from:".$app_init_data["OwnerEmail"] ) ;
				$_SESSION["last_ad_id"] = NULL ;
				$_SESSION["str_system_message"] = "Your Payment has been recieved." ;
				header ( "location:".base_url ) ;
				break;
			case "Notify" :
				@mail ( $app_init_data["OwnerEmail"] , $app_init_data["SiteTitle"]." payment Recieved" , "Hello admin, \n Payment against Ad ID : ".$_SESSION["last_ad_id"]. " has been recieved in your paypal acocunt. Kindly verify and Do action against it. \n ---------------- \n Thank, \n ".$app_init_data["SiteTitle"], "from:".$app_init_data["OwnerEmail"] ) ;
				break;
			case "Cancel" :
				$_SESSION["last_ad_id"] = NULL ;
				$_SESSION["str_system_message"] = "Your canceled the payment." ;
				header ( "location:".base_url ) ;
				break;
		}
	}
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/payment.php" ) ;
	

?>
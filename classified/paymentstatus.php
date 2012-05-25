<?php
	
	if ( intval ( $pay_status ) < 1 || intval ( $_SESSION["last_ad_id"] ) < 1 )
	{
		
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	
	switch ( $pay_status )
	{
		case 1 :
			$payment_plan = $data->select ( "PaymentsPlan" , "*" , array ( "PaymentPlanID" => $_SESSION["payment_plan_selected"] ) ) ;
			$data->insert ( "Payments" , array ( "Amount" => $payment_plan[0]["Amount"] , "AdID" => intval ( $_SESSION["last_ad_id"] ) ) ) ;
			@mail ( $app_init_data["OwnerEmail"] , $app_init_data["SiteTitle"]." payment Recieved" , "Hello admin, \n Payment against Ad ID : ".$_SESSION["last_ad_id"]. " has been recieved in your paypal acocunt. Kindly verify and Do action against it. \n ---------------- \n Thank, \n ".$app_init_data["SiteTitle"], "from:".$app_init_data["OwnerEmail"] ) ;
			$_SESSION["str_system_message"] = "Your Payment has been recieved." ;
			break;
		case 2 :
			@mail ( $app_init_data["OwnerEmail"] , $app_init_data["SiteTitle"]." payment Recieved" , "Hello admin, \n Payment against Ad ID : ".$_SESSION["last_ad_id"]. " has been recieved in your paypal acocunt. Kindly verify and Do action against it. \n ---------------- \n Thank, \n ".$app_init_data["SiteTitle"], "from:".$app_init_data["OwnerEmail"] ) ;
			exit();
			break;
		case 3 :
			$_SESSION["str_system_message"] = "Your canceled the payment." ;
			break;
	}
	
	$_SESSION["payment_plan_selected"] = NULL ;
	$_SESSION["last_ad_id"] = NULL ;
	
	header ( "location:".base_url ) ;
	

?>
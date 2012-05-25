<?php

	if ( intval ( $_SESSION["last_ad_id"] ) < 1 )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	$price_alt = array (
							1 => 0 ,
							3 => "Free",
							4 => "Please Contact",
							5 => "Swap / Trade"
					 ) ;
	
	if ( $_POST )
	{
		
		if ( intval ( $_POST["Plan_Featured"] ) > 0 )
		{
			$_SESSION["payment_plan_selected"] = intval ( $_POST["Plan_Featured"] ) ;
			header ( "location:".base_url."c-GoFeaturedPP/".intval ( $_POST["Plan_Featured"] )."/" ) ;
			exit();
		}
		else
		{
			$_SESSION["str_system_message"] = "Payment Plan Not selected." ;
		}
	}
	
	$plans = $data->select ( "PaymentsPlan" , "*" , NULL ) ;
	if ( empty ( $plans ) && floatval ( $app_init_data["ClassifiedPrice"] ) < 0.01 )
	{
		$_SESSION["str_system_message"] = "Thank you for your posting." ;
		header ( "location:".base_url."c-Posted/" ) ;
		exit();
	}
	
	
	
	$classif = $data->select ( "Classified" , "*" , array ( "AdID" => intval ( $_SESSION["last_ad_id"] ) ) ) ;
	if ( empty ( $classif ) )
	{
		exit ( ) ;
	}
	$classified = $classif[0] ;
	
	$extra_fields = $data->select ( "AdExtraField" , "*" , array ( "AdID" => intval ( $_SESSION["last_ad_id"] ) ) , 0 , 500 ) ;
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/featured_option.php" ) ;

?>
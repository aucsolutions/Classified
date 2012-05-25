<?php
	
	if ( intval ( $plan_id ) < 1 )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	$selected_plan = $data->select ( "PaymentsPlan" , "*" , array ( "PaymentPlanID" => $plan_id ) ) ;

	if ( empty ( $selected_plan ) )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	$selected_plan = $selected_plan[0] ;
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/go_to_pp.php" ) ;

?>
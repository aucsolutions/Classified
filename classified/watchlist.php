<?php
	
	$classified = array ( ) ;
	
	if ( intval ( $_SESSION["login_account_id"] ) > 0 )
	{
		$w_list = $data->select ( "WatchList" , "*" , array ( "AccountID" => intval ( $_SESSION["login_account_id"] ) ) ) ;
		
		if ( ! empty ( $w_list ) )
		{
			foreach ( $w_list as $w_data )
			{
				$w_clas = $data->select ( "Classified" ,"*" , array ( "AdID" => $w_data["AdID"] ) ) ;
				array_push( $classified , $w_clas[0] ) ;
			}
		}
	}
	else
	{
		$_SESSION["str_system_message"] = "You must login to visit requested page." ;
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	include ( "theme/".$app_init_data["CurrentSkin"]."/watch_list.php" ) ;

?>
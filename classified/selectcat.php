<?php
	
	if ( ! empty ( $qstring[1] ) )
	{
		$category_previous_selected = intval ( $qstring[1] ) ;
		$category_data = $data->select ( "Category" ,"*" , array ( "HeadCategoryID" => intval ( $qstring[1] ) ) ) ;
	}
	else
	{
		$mainCategory = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => NULL ) , 0 , 100 , " OrderNumber asc" ) ;
	}
	
	
	if ( intval ( $app_init_data["AccountRequiredToPost"] ) == 1 && intval ( $_SESSION["login_account_id"] ) < 1 )
	{
		$_SESSION["str_system_message"] = "You must be Registered and Signed in to post ad." ;
		header ( "location:".base_url ) ;
		exit ( ) ;
	}

	include ( "theme/".$app_init_data["CurrentSkin"]."/select_category.php" ) ;
	
	
		

?>
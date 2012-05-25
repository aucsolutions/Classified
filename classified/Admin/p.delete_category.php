<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$sub_cat = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => intval ( $_GET["id"] ) ) ) ;
		if ( ! empty ( $sub_cat ) )
		{
			$_SESSION["str_system_message"] = "Kindly delete its sub categories first. Category cannot be deleted." ;
		}
		else
		{
			$entities = $data->select ( "Classified" , "*" , array ( "CategoryID" => intval ( $_GET["id"] ) ) ) ;
			if ( ! empty ( $entities ) )
			{
				$_SESSION["str_system_message"] = "This category contains some listings. Kindly delete them first." ;
			}
			else
			{
				$data->delete ( "Category" , array ( "CategoryID" => intval ( $_GET["id"] ) ) ) ;
				$_SESSION["str_system_message"] = "Category deleted successfully." ;
			}
		}
	}
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>
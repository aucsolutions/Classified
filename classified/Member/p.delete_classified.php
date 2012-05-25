<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$data->delete ( "AdExtraField" , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
		$data->delete ( "Classified" , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
		exec ( "chmod ../media/ 777" ) ;
		
		$image_file = "../media/cls_".$_GET["id"]."_520.jpg" ;
		if ( file_exists ( $image_file ) )
			unlink ( $image_file ) ;
			
		for ( $i = 1 ; $i <= 5 ; $i++ )
		{
			$image_file = "../media/cls_".$_GET["id"]."_".$i."_520.jpg" ;
			if ( file_exists ( $image_file ) )
				unlink ( $image_file ) ;
		}
		
		exec ( "chmod ../media/ 755" ) ;
		
		$_SESSION["str_system_message"] = "Classified deleted successfully." ;
	}
	
	header ( "location:classifiedlist.php" ) ;
	exit ( ) ;
?>
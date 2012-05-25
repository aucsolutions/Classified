<?php
	
	require_once ( "../config.php" ) ;
	
	if ( intval ( $_SESSION["login_account_id"] ) == 0 )
	{
		header ( "location:index.php" ) ;
		exit ( ) ;
	}
	
	require_once ( "../classes/misc.func.php" ) ;
	require_once ( "../classes/manipulate.php" ) ;
	$data = new DataManipulator ( ) ;
	
	$title = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "SiteName" ) ) ;
	$title = $title[0] ;
	
	
?>
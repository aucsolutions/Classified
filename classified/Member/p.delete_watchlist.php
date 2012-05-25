<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$data->delete ( "WatchList" , array ( "AccountID" => intval ( $_SESSION["login_account_id"] ) , "AdID" => intval ( $_GET["id"] ) ) , 1 ) ;
		
		$_SESSION["str_system_message"] = "Classified successfully removed from your watchlist." ;
	}
	
	header ( "location:watchlist.php" ) ;
	exit ( ) ;
?>
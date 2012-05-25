<?php
	
	session_start ( ) ;
	
	require ( "config.php" ) ;
	
	require_once ( "classes/manipulate.php" ) ;
	
	$data = new DataManipulator ;
	
	require ( "classes/misc.func.php" ) ;
	
	if ( $_GET )
	{
		$watch_list = $data->select ( "WatchList" , "*" , array ( "AdID" => intval ( $_GET["id"] ) , "AccountID" => intval ( $_SESSION["login_account_id"] ) ) ) ;
		
		if ( empty ( $watch_list ) )
			$data->insert ( "WatchList" , array ( "AccountID" => intval ( $_SESSION["login_account_id"] ) , "AdID" => intval ( $_GET["id"] ) ) ) ;
		else
			$_SESSION["str_system_message"] = "This Ad is already in your watchlist." ;
	}
	

	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;


?>
<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( $_POST )
	{
		if ( ! empty ( $_POST["chkAdID"] ) )
		{
			foreach ( $_POST["chkAdID"] as $adID )
			{
				switch ( $_POST["radOption"] )
				{
					case "del" :
						$data->delete ( "Classified" , array ( "AccountID" => $adID ) ) ;
						$data->delete ( "Account" , array ( "AccountID" => $adID ) ) ;
						break;
					case "actv_1" :
						$data->update ( "Account" , array ( "IsEnable" => "1" ) , array ( "AccountID" => $adID ) ) ;
						break;
					case "actv_0" :
						$data->update ( "Account" , array ( "IsEnable" => "0" ) , array ( "AccountID" => $adID ) ) ;
						break;
					default:
						break;
				}
			}
		}
	}
	if ( intval ( $_GET["id"] ) > 0  )
	{
		if ( isset ( $_GET["actv"] ) )
			$data->update ( "Account" , array ( "IsEnable" => intval ( $_GET["actv"] ) ) , array ( "AccountID" => intval ( $_GET["id"] ) ) ) ;
		if ( isset ( $_GET["del"] ) )
		{
			$data->delete ( "Classified" , array ( "AccountID" => $_GET["id"] ) ) ;
			$data->delete ( "Account" , array ( "AccountID" => $_GET["id"] ) ) ;
		}
	}
	
	$_SESSION["str_system_message"] = "Accounts changed/updated successfully." ;
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>
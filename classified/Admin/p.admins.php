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
					case "actv_1" :
						$data->update ( "Admins" , array ( "IsEnable" => "1" ) , array ( "AdminID" => $adID ) ) ;
						break;
					case "actv_0" :
						$data->update ( "Admins" , array ( "IsEnable" => "0" ) , array ( "AdminID" => $adID ) ) ;
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
			$data->update ( "Admins" , array ( "IsEnable" => intval ( $_GET["actv"] ) ) , array ( "AdminID" => intval ( $_GET["id"] ) ) ) ;
	}
	
	$_SESSION["str_system_message"] = "Admins changed/updated successfully." ;
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>
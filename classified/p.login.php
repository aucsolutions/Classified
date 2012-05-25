<?php
	
	session_start ( ) ;
	
	require ( "config.php" ) ;
	
	require_once ( "classes/manipulate.php" ) ;
	
	$data = new DataManipulator ;
	
	require ( "classes/misc.func.php" ) ;
	
	
	if ( $_POST )
	{
	

		$loginArray = array ( 
								"EmailAddress" => addslashes ( $_POST["EmailAddress"] ) ,
								"Password" => addslashes ( $_POST["Pass"] ) ,
								"IsEnable" => 1
							) ;
		$account_info = $data->select ( "Account" , "*" , $loginArray ) ;
		if ( ! empty ( $account_info ) )
		{
			$_SESSION["login_account_id"] = intval ( $account_info[0]["AccountID"] ) ;
			$_SESSION["login_account_name"] = $account_info[0]["FullName"] ;
			$_SESSION["login_member_email"] = $account_info[0]["EmailAddress"] ;
			$_SESSION["str_system_message"] = "Login successfull" ;
			
		}
		else
		{
			$_SESSION["str_system_message"] = "Invalid login information." ;
		}
		
	}
	
header ( "location:".base_url ) ;
	


?>
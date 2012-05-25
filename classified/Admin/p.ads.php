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
						$data->delete ( "AdExtraField" , array ( "AdID" => intval ( $adID ) ) , 500 ) ;
						$data->delete ( "Classified" , array ( "AdID" => intval ( $adID ) ) , 500 ) ;
						exec ( "chmod ../media/ 777" ) ;
						
						$image_file = "../media/cls_".$adID."_520.jpg" ;
						if ( file_exists ( $image_file ) )
							unlink ( $image_file ) ;
							
						for ( $i = 1 ; $i <= 7 ; $i++ )
						{
							$image_file = "../media/cls_".$adID."_".$i."_520.jpg" ;
							if ( file_exists ( $image_file ) )
								unlink ( $image_file ) ;
						}
						
						exec ( "chmod ../media/ 755" ) ;
						
						break;
					case "spon_1" :
						$data->update ( "Classified" , array ( "IsFeatured" => "1" ) , array ( "AdID" => $adID ) ) ;
						break;
					case "spon_0" :
						$data->update ( "Classified" , array ( "IsFeatured" => "0" ) , array ( "AdID" => $adID ) ) ;
						break;
					case "actv_1" :
						$data->update ( "Classified" , array ( "IsActive" => "1" ) , array ( "AdID" => $adID ) ) ;
						break;
					case "actv_0" :
						$data->update ( "Classified" , array ( "IsActive" => "0" ) , array ( "AdID" => $adID ) ) ;
						break;
					default:
						break;
				}
			}
		}
	}
	if ( intval ( $_GET["id"] ) > 0  )
	{
		if ( isset ( $_GET["spon"] ) )
			$data->update ( "Classified" , array ( "IsFeatured" => intval ( $_GET["spon"] ) ) , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
		if ( isset ( $_GET["actv"] ) )
			$data->update ( "Classified" , array ( "IsActive" => $_GET["actv"] ) , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
	}
	
	$_SESSION["str_system_message"] = "Classified(s) changed/updated successfully." ;
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>
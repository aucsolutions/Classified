<?php
	
	session_start ( ) ;
	
	require ( "config.php" ) ;
	
	require_once ( "classes/manipulate.php" ) ;
	
	$data = new DataManipulator ;
	
	require ( "classes/misc.func.php" ) ;
	
	$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
	$app_init_data = array ( ) ;
	foreach ( $siteSettings as $site )
	{
		$app_init_data[$site["SiteVariable"]] = $site["SiteValue"] ;
	}
	
	
	function daysDifference($endDate, $beginDate)
	{
	
	   //explode the date by "-" and storing to array
	   $date_parts1=explode("-", $beginDate);
	   $date_parts2=explode("-", $endDate);
	   //gregoriantojd() Converts a Gregorian date to Julian Day Count
	   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	   return $end_date - $start_date;
	}
	
	
	
	$active_classified = $data->select ( "Classified" , "AdID,DateAdded" , array ( "IsActive" => 1 ) , 0 , 500 ) ;
	
	if ( ! empty ( $active_classified ) )
	{
		foreach ( $active_classified as $ad )
		{
			$expiry_days = intval ( $app_init_data["DaysToExpire"] ) ;
			$diffr = daysDifference ( date( "Y-m-d" ) , date ( "Y-m-d" , strtotime ( $ad["DateAdded"] ) ) ) ;
			if ( intval ( $diffr ) > $expiry_days )
			{
				$data->update ( "Classified" , array ( "IsActive" => '0' ) , array ( "AdID" => $ad["AdID"] ) ) ;
				
			}
		}
	}

?>
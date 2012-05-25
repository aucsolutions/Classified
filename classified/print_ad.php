<?php
	
	if ( intval ( $entity_id ) < 1 )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}


	$classified = $data->select ( "Classified" ,"*" , array ( "AdID" => intval ( $entity_id ) ) ) ;
	
	if ( empty ( $classified ) )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	$classified = $classified[0] ;
	
	$extra_info = $data->select ( "AdExtraField" ,"*" , array ( "AdID" => intval ( $entity_id ) ) ) ;
	
	if ( ! empty ( $extra_info ) )
	{
		foreach ( $extra_info as  $key => $e_info )
		{
			$extra_field_data = $data->select ( "CategoryExtraField" ,"*" , array ( "CategoryExtraFieldID" => intval ( $e_info["CategoryExtraFieldID"] ) ) ) ;
			$extra_info[$key]["Field_name"] = $extra_field_data[0]["EFName"] ;
		}
	}
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/print_classified.php" ) ;

?>
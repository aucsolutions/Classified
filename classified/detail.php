<?php
	
	if ( intval ( $entity_id ) < 1 )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	
	$price_alt = array (
							1 => 0 ,
							3 => "Free",
							4 => "Please Contact",
							5 => "Swap / Trade"
					 ) ;
	
	
	$classified = $data->select ( "Classified" ,"*" , array ( "AdID" => intval ( $entity_id ) ) ) ;
	
	if ( empty ( $classified ) )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	$classified = $classified[0] ;
	
	if ( intval ( $classified["IsActive"] ) == 0 )
	{
		$_SESSION["str_system_message"] = "Ooops! The Classified ad you are looking for has been expired." ;
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	$data->update ( "Classified" , " Views=Views+1" , array ( "AdID" => intval ( $entity_id ) ) ) ;
	$app_init_data["SEOTitle"] = $classified["AdTitle"] ;
	$app_init_data["SiteKeyword"] = str_replace ( " " , "," , $classified["AdTitle"] ) ;
	$app_init_data["SiteDescription"] = substr ( strip_tags ( $classified["Description"] ) , 0 , 100 ) ;
	
	

	
	$extra_info = $data->select ( "AdExtraField" ,"*" , array ( "AdID" => intval ( $entity_id ) ) ) ;
	
	if ( ! empty ( $extra_info ) )
	{
		foreach ( $extra_info as  $key => $e_info )
		{
			$extra_field_data = $data->select ( "CategoryExtraField" ,"*" , array ( "CategoryExtraFieldID" => intval ( $e_info["CategoryExtraFieldID"] ) ) ) ;
			$extra_info[$key]["Field_name"] = $extra_field_data[0]["EFName"] ;
		}
	}
	
	if ( intval ( $classified["CategoryID"] ) > 0 )
	{
		$category_path_array = array ( ) ;
		get_category_path ( intval ( $classified["CategoryID"] ) , $category_path_array , $data ) ;
		
		$category_path_array = array_reverse ( $category_path_array ) ;
	}
	
	

	include ( "theme/".$app_init_data["CurrentSkin"]."/classified_detail.php" ) ;

?>
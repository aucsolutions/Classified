<?php
	
	if ( intval ( $entity_id ) < 1 )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	$classified = $data->select ( "Classified" ,"*" , array ( "AdID" => intval ( $entity_id ) ) ) ;
	$classified = $classified[0] ;
	
	if ( intval ( $classified["CategoryID"] ) > 0 )
	{
		$category_path_array = array ( ) ;
		get_category_path ( intval ( $classified["CategoryID"] ) , $category_path_array , $data ) ;
		
		$category_path_array = array_reverse ( $category_path_array ) ;
	}
	
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/map_detail.php" ) ;

?>
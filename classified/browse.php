<?php

	$featured_classifieds = $data->select ( "Classified" ,"AdID, AdTitle" , array ( "IsFeatured" => '1' ), 0 , intval ( $app_init_data["SponsoredAdsListingPage"] ) , "DateAdded desc" ) ;

	$page_size = intval ( $app_init_data["MaxListingsPerPage"] ) ;
	$like_array = array ( ) ;
	$array_to_db = array ( "IsActive" => 1 , "IsPosted" => 1 ) ;
	$greater_array = array ( ) ;
	$smaller_array = array ( ) ;
	$category_id_selected = 0 ;
	
	$price_alt = array (
							1 => 0 ,
							3 => "Free",
							4 => "Please Contact",
							5 => "Swap / Trade"
					 ) ;
	
	$ordered_by = "DateAdded desc" ;
	$category_query_string = "/" ;
	if ( ! empty ( $qstring[1] ) )
	{
		if ( strchr ( $qstring[1] , ":" ) )
		{
			
			$parameters = $qstring[1] ;
			$category_query_string = "/" ;
		}
		else
		{
			$category = $data->select ( "SEF_URL" , "*" , array ( "URL" => $qstring[1] ) ) ;
			$category = $category[0] ;
	
			$parameters = $qstring[2] ;
	
			$category_query_string = "/".$qstring[1]."/" ;
			$category_id_selected = intval ( $category["EntityID"] ) ;
			//$array_to_db["CategoryID"] = intval ( $exp_send["cat"] ) ;
			
			
			
			$selected_category_detail = $data->select ( "Category" , "*" , array ( "CategoryID" => intval ( $category["EntityID"] ) ) ) ;
			$selected_category_detail = $selected_category_detail[0] ;
			
			
			$app_init_data["SEOTitle"] = $selected_category_detail["SEOTitle"] == "" ? $selected_category_detail["CategoryName"]." - ".$app_init_data["SiteTitle"] : $selected_category_detail["SEOTitle"] ;
			$app_init_data["SiteDescription"] = $selected_category_detail["SEODescription"] == "" ? $app_init_data["SiteDescription"] : $selected_category_detail["SEODescription"]  ;
			$app_init_data["SiteKeyword"] = $selected_category_detail["SEOKeywords"] == "" ? $app_init_data["SiteKeyword"] : $selected_category_detail["SEOKeywords"]  ;
			
			
			$category_top_banner["MarketingScript"] = $selected_category_detail["TopBanner"] ;
			$category_top_banner["MarketingScript_left"] = $selected_category_detail["LeftBanner"] ;
			$category_id_selected = intval ( $category["EntityID"] ) ;
			$like_array["CategoryStack"] = "z".$category_id_selected."Z" ;
		}	
	}

		$param = explode ( "|" , $parameters ) ;
		$exp_send = array ( ) ;
		if ( ! empty ( $param ) )
		{
			foreach ( $param as $val )
			{
				if ( $val!= "" )
				{
					$var_t_array = explode ( ":" , $val ) ;
					$exp_send[$var_t_array[0]] = $var_t_array[1] ;
				}
			}
		}
		
		
		if ( isset ( $exp_send["q"] ) )
		{
			$like_array["SearchKeywords"] = $exp_send["q"] ;
		}
		if ( isset ( $exp_send["p"] ) )
		{
			$page_number = intval ( $exp_send["p"] ) ;
		}
		if ( $exp_send["gal"] != "" )
		{
			$gallery_set = intval ( $exp_send["gal"] ) ;
		}
		else
		{
			$gallery_set = intval ( $app_init_data["DefaultViewGallery"] ) ;
		}
		if ( $exp_send["typ"] != "" )
		{
			$array_to_db["IsOffer"] = $exp_send["typ"] ;
		}
		
		if ( isset ( $exp_send["p1"] ) )
		{
			$smaller_array["Price"] = floatval ( $exp_send["p1"] ) ;
		}
		if ( isset ( $exp_send["p2"] ) )
		{
			$greater_array["Price"] = floatval ( $exp_send["p2"] ) ;
		}
		if ( isset ( $exp_send["ord"] ) )
		{
			switch ( $exp_send["ord"] )
			{
				case "dasc" :
					$ordered_by = "DateAdded asc" ;
					break ;
				case "ddesc" :
					$ordered_by = "DateAdded desc" ;
					break ;
				case "plow" :
					$ordered_by = "Price asc" ;
					break ;
				case "phi" :
					$ordered_by = "Price desc" ;
					break ;
			}
		}
		
		
		$data->set_greater ( $greater_array ) ;
		$data->set_smaller ( $smaller_array ) ;
		$data->set_like ( $like_array ) ;
		
		$classified = $data->select ( "Classified" ,"*" , $array_to_db , $page_number*$page_size , $page_size , $ordered_by ) ;
		$total_ads = $data->get_num_records ( ) ;
		
		$data->set_greater ( $greater_array ) ;
		$data->set_smaller ( $smaller_array ) ;
		$data->set_like ( $like_array ) ;
		$array_to_db["IsOffer"] = "0" ;
		$wanted_total = $data->count_record ( "Classified" , $array_to_db ) ;
		
		$data->set_like ( $like_array ) ;
		$data->set_greater ( $greater_array ) ;
		$data->set_smaller ( $smaller_array ) ;
		$array_to_db["IsOffer"] = 1 ;
		$offering_total = $data->count_record ( "Classified" , $array_to_db ) ;
		
		include ( "theme/".$app_init_data["CurrentSkin"]."/listing_classified.php" ) ;


?>
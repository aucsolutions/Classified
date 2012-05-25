<?php

	if ( intval ( $_SESSION["last_ad_id"] ) < 1 )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	
	if ( $_POST )
	{
		include ( "classes/data_validation.php" ) ;
		if ( validate_empty ( array ( "Category_post_ID" , "Ad_post_Title" , "Email_post_Address" ) ) )
		{
			foreach ( $_POST as $key=>$val )
				if ( strchr ( $key , "_post_") )
					$postdata[str_replace ( "_post_" , "" , $key )] = $val ;
					
			if ( intval ( $_SESSION["login_account_id"] ) > 0 )
				$postdata["AccountID"] =  intval ( $_SESSION["login_account_id"] ) ;

			$postdata["CategoryStack"] = "" ;
			$postdata["SearchKeywords"] = $_POST["Ad_post_Title"]."," ;
			
			$postdata["IsPosted"] = '0' ;
			$postdata["IsActive"] = '0' ;
			$data->update ( "Classified" , $postdata , array ( "AdID" => intval ( $_SESSION["last_ad_id"] ) ) ) ;
			if ( intval ( $_SESSION["last_ad_id"] ) > 0 )
			{
				$data->delete ( "AdExtraField" , array ( "AdID" => intval ( $_SESSION["last_ad_id"] ) ) , 500 ) ;
				
				if ( ! empty ( $_POST["Ad_EF_Value"] ) )
				{
					foreach ( $_POST["Ad_EF_Value"] as $key => $valu )
						if ( is_array ( $_POST["Ad_EF_Value"][$key] ) )
							foreach ( $_POST["Ad_EF_Value"][$key] as $val )
								$data->insert ( "AdExtraField" , array ( "CategoryExtraFieldID" => $key , "AdExtraFieldValue" => $val , "AdID" => $_SESSION["last_ad_id"] ) ) ;
						else
							$data->insert ( "AdExtraField" , array ( "CategoryExtraFieldID" => $key , "AdExtraFieldValue" => $valu , "AdID" => $_SESSION["last_ad_id"] ) ) ;
				}
				re_generate_sef_url ( $_POST["Ad_post_Title"] , $_SESSION["last_ad_id"] , "Classified" ) ;
				
				header ( "location:".base_url."c-FeaturedOptions/" ) ;
				exit();
			}
		}
		else
			$_SESSION["str_system_message"] = "Required fields are missing." ;
		
	}
	
	$classified = $data->select ( "Classified" , "*" , array ( "AdID"=> intval ( $_SESSION["last_ad_id"] ) ) ) ;
	if ( empty ( $classified ) )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	$classified = $classified[0] ;
	
	$cat_path = array ( ) ;
	
	get_category_path ( $classified["CategoryID"] , $cat_path , $data ) ;
	
	$cat_path = array_reverse ( $cat_path ) ;
	
	
	$extra_fields = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryID" => null ) , 0 , 500 ) ;
	
	$extra_fields_category = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryID" => $classified["CategoryID"] ) , 0 , 500 ) ;
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/modify_form.php" ) ;

?>
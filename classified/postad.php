<?php

	if ( intval ( $sel_id ) < 1 )
	{
		header ( "location:".base_url."c-SelectCategory/" ) ;
		exit ( ) ;
	}
	
	
	
	if ( intval ( $app_init_data["AccountRequiredToPost"] ) == 1 && intval ( $_SESSION["login_account_id"] ) < 1 )
	{
		$_SESSION["str_system_message"] = "You must be Registered and Signed in to post ad." ;
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	if ( $_POST )
	{
		if ( strtolower ( $_POST["capSecurity"] ) != $_SESSION["posting"]["capCode"] )
		{
			$_SESSION["str_system_message"] = "Invalid security code." ;
		}
		else
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
				$category_array = array ( ) ;
				get_category_path ( intval ( $_POST["Category_post_ID"] ) , $category_array , $data ) ;
				if ( ! empty ( $category_array ) )
				{
					foreach ( $category_array as $cate )
					{
						$postdata["CategoryStack"] .= "z".$cate["CategoryID"]."Z" ;
						$postdata["SearchKeywords"] .= $cate["CategoryName"]."," ;
					}
				}
				
				$postdata["IsPosted"] = "0" ;
				$postdata["IsActive"] = "0" ;
				$last_id = $data->insert ( "Classified" , $postdata ) ;
				if ( intval ( $last_id ) > 0 )
				{
					if ( ! empty ( $_FILES ) )
					{
						
						for ( $i = 0 ; $i < 8 ; $i++  )
						{
							$extension = substr ( $_FILES["fileImage"]["name"][$i] , -3 ) ;
							$extension = strtolower ( $extension ) ;
							if ( $extension == "jpg" || $extension == "gif" || $extension == "bmp" || $extension == "jpeg" || $extension == "png" )
							{
								if ( $i == 0  )
									$file_name_onsever = "media/cls_".$last_id."_520.".$extension ;
								else
									$file_name_onsever = "media/cls_".$last_id."_".$i."_520.".$extension ;
								if ( $_FILES["fileImage"]["name"][$i] != "" )
									move_uploaded_file ( $_FILES["fileImage"]["tmp_name"][$i] , $file_name_onsever ) ;
							}
						}
					}
					if ( ! empty ( $_POST["Ad_EF_Value"] ) )
					{
						foreach ( $_POST["Ad_EF_Value"] as $key => $valu )
							if ( is_array ( $_POST["Ad_EF_Value"][$key] ) )
								foreach ( $_POST["Ad_EF_Value"][$key] as $val )
									$data->insert ( "AdExtraField" , array ( "CategoryExtraFieldID" => $key , "AdExtraFieldValue" => $val , "AdID" => $last_id ) ) ;
							else
								$data->insert ( "AdExtraField" , array ( "CategoryExtraFieldID" => $key , "AdExtraFieldValue" => $valu , "AdID" => $last_id ) ) ;
					}
					generate_sef_url ( $_POST["Ad_post_Title"] , $last_id , "Classified" ) ;
					$_SESSION["last_ad_id"] = intval ( $last_id ) ;
					$_SESSION["str_system_message"] = "Thank you for your posting." ;
					
					header ( "location:".base_url."c-FeaturedOptions/" ) ;
					
				}
			}
			else
				$_SESSION["str_system_message"] = "Required fields are missing." ;
		}
		
	}
	
	$cat = $data->select ( "Category" , "*" , array ( "CategoryID"=> intval ( $sel_id ) ) ) ;
	if ( empty ( $cat ) )
	{
		header ( "location:".base_url."c-SelectCategory/" ) ;
		exit ( ) ;
	}
	
	
	$sub_cats = $data->select ( "Category" , "*" , array ( "HeadCategoryID"=> intval ( $sel_id ) ) ) ;
	
	if ( ! empty ( $sub_cats ) )
	{
		header ( "location:".base_url."c-SelectCategory/".$sel_id."/" ) ;
		exit ( ) ;
	}
	
	if ( intval ( $cat[0]["Price"] ) > 0 && ! strchr($_SERVER['REQUEST_URI'],"pp-Return") )
	{
		$price = $cat[0]["Price"] ;
		include ( "theme/".$app_init_data["CurrentSkin"]."/catpay.php" ) ;
		exit ( ) ;
	}
	
	$cat = NULL ;
	
	
	$cat_path = array ( ) ;
	
	get_category_path ( $sel_id , $cat_path , $data ) ;
	
	$cat_path = array_reverse ( $cat_path ) ;
	
	
	$extra_fields = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryID" => null ) , 0 , 500 ) ;
	
	$extra_fields_category = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryID" => $sel_id ) , 0 , 500 ) ;
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/post_form.php" ) ;

?>
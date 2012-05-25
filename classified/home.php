<?php
	
	$featured_classifieds = $data->select ( "Classified" ,"AdID, AdTitle" , array ( "IsFeatured" => '1' ), 0 , intval ( $app_init_data["SponsoredAdsMainPage"] ) , " DateAdded desc" ) ;
	
	$mainCategory = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => NULL ) , 0 , 100 , " OrderNumber asc" ) ;
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/home.php" ) ;

?>
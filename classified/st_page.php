<?php
	
	
	$static_page = $data->select ( "PageManager" ,"*" , array ( "PageManagerID" => intval ( $entity_id ) ) ) ;
	
	$static_page = $static_page[0] ;
	
	$app_init_data["SEOTitle"] = $static_page["PageName"]." - ".$app_init_data["SiteTitle"] ;
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/static_page.php" ) ;

?>
<?php
	
	$qstring = explode ( "/" , $_GET["qstr"] ) ;
	switch ( $qstring[0] )
	{
		case "c-Posted" :
			include ( "posted.php" ) ;
			break;
		case "c-SelectCategory" :
			include ( "selectcat.php" ) ;
			break;
		case "c-CategorySelect" :
			$sel_id = intval ( $qstring[1] ) ;
			include ( "postad.php" ) ;
			break;
		case "category" :
			$sel_id = intval ( $qstring[1] ) ;
			include ( "browse.php" ) ;
			break;
		case "c-BrowseClassified" :
			$sel_id = intval ( $qstring[1] ) ;
			include ( "browse.php" ) ;
			break;
		case "c-PayClassified" :
			include ( "pay.php" ) ;
			break;
		case "c-EditClassified" :
			include ( "editad.php" ) ;
			break;
		case "c-FeaturedOptions" :
			include ( "ad_featured_option.php" ) ;
			break;
		case "c-ViewMap" :
			$entity_id = intval ( $qstring[1] ) ;
			include ( "show_map.php" ) ;
			break;
		case "c-GoFeaturedPP" :
			$plan_id = intval ( $qstring[1] ) ;
			include ( "go_to_pp.php" ) ;
			break ;
		case "c-ContactUs" :
			include ( "contact.php" ) ;
			break;
		case "c-WatchList" :
			include ( "watchlist.php" ) ;
			break;
		case "c-PrintAd" :
			$entity_id = intval ( $qstring[1] ) ;
			include ( "print_ad.php" ) ;
			break;
		case "c-FinalFeatured" :
			$pay_status = 1 ;
			include ( "paymentstatus.php" ) ;
			break;
		case "a-TellAdminPayment" :
			$pay_status = 2 ;
			include ( "paymentstatus.php" ) ;
			break;
		case "c-CancelPayment" :
			$pay_status = 3 ;
			include ( "paymentstatus.php" ) ;
			break;
		case "search" :
			include ( "search.php" ) ;
			break;
		
		case "rss" :
			include ( "rss.php" ) ;
			break;
		
		case "Admin" :
			header ( "location:".base_url."Admin/index.php" ) ;
			exit ( ) ;
			break;
		case "Member" :
			header ( "location:".base_url."Member/index.php" ) ;
			exit ( ) ;
			break;
		
		default :
			include ( "home.php" ) ;
			break;
	}

?>
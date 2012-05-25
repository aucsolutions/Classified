<?php

	require ( "config.php" ) ;
	
	require_once ( "classes/manipulate.php" ) ;
	
	$data = new DataManipulator ;
	
	$like_array = array ( ) ;
	
	$array_to_db = array ( "IsActive" => 1 , "IsPosted" => 1 ) ;
	$page_size = intval ( $app_init_data["RecentAdsMainPage"] ) ;

	if ( ! empty ( $qstring[1] ) )
	{
		$page_size = intval ( $app_init_data["MaxListingsPerPage"] ) ;
		$param = explode ( "|" , $qstring[1] ) ;
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
	}
	
	if ( $exp_send["cat"] != "" )
	{
		$like_array["CategoryStack"] = "z".$exp_send["cat"]."Z" ;
	}
	if ( isset ( $exp_send["q"] ) )
		{
			$like_array["SearchKeywords"] = $exp_send["q"] ;
		}
	if ( $exp_send["typ"] != "" )
	{
		$array_to_db["IsOffer"] = $exp_send["typ"] ;
	}
	$data->set_like ( $like_array ) ;
	$classified = $data->select ( "Classified" ,"*" , $array_to_db , 0 , $page_size , "DateAdded desc" ) ;
	
	
	$now = date("D, d M Y H:i:s T");
	
	$output = "<?xml version=\"1.0\"?>
				<rss version=\"2.0\">
					<channel>
						<title>".$app_init_data["SiteName"]." RSS</title>
						<link>".base_url."/rss/cat:".$exp_send["cat"]."|typ:".$exp_send["typ"]."/</link>
						<description>RSS by ".$app_init_data["SiteTitle"]."</description>
						<language>en-us</language>
						<pubDate>$now</pubDate>
						<lastBuildDate>$now</lastBuildDate>
						<docs>".SITEURL."</docs>
						<managingEditor>".$app_init_data["OwnerEmail"]."</managingEditor>
						<webMaster>fireonmoon@gmail.com</webMaster>
						<image> 
							<title>".$app_init_data["SiteName"]."</title> 
							<url>".base_url."media/logo.jpg</url> 
							<link>".base_url."</link> 
						</image>
				";
			  
	if ( ! empty ( $classified ) )  
	{
		foreach ($classified as $line)
		{
			$desc = htmlentities ( preg_replace ( "@[^A-Za-z0-9\-\s_]+@i" , "" , substr ( strip_tags ( $line['Description'] ) , 0 , 150 ) ) ) ;
			$output .= "<item>
							<title>".htmlentities($line['AdTitle'])."</title>
							<link>" . base_url . get_sef_url ( $line["AdID"] , "Classified" ) ."/</link>
							<description>". $desc ."</description>
						</item>"; 
			

		}
	}

	$output .= "</channel>
			</rss>";
	header("Content-Type: application/rss+xml");
	echo $output;
?>
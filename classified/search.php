<?php
	
	if ( $_POST )
	{
		$qstr = "" ;
		if ( intval ( $_POST["CatId"] ) > 0 )
		{
			$qstr .= "category/" ;
			$qstr .= get_sef_url ( intval ( $_POST["CatId"] ) , "Category" ) ."/" ;
		}
		else
			$qstr .= "c-BrowseClassified/" ;
			
		
		if ( $_POST["Keyword"] != "" )
			$qstr .= "q:".str_replace ( "|" , "", $_POST["Keyword"] )."|" ;
		if ( floatval ( $_POST["minPrice"] ) > 0 )
			$qstr .= "p1:".str_replace ( "|" , "", floatval ( $_POST["minPrice"] ) )."|" ;
		if ( floatval ( $_POST["maxPrice"] ) > floatval ( $_POST["minPrice"] ) )
			$qstr .= "p2:".str_replace ( "|" , "", floatval ( $_POST["maxPrice"] ) )."|" ;
		$qstr .= "p:0|gal:0|typ:|" ;
		
		if ( ! empty ( $_POST["sortBy"] ) )
		{
			switch ( $_POST["sortBy"] )
			{
				case "dasc" :
				case "ddesc" :
				case "plow" :
				case "phi" :
					$qstr .= "ord:".$_POST["sortBy"] ;
					break;
				default:
					$qstr .= "ord:ddesc" ;
					break;
			}
		}

	}
	
	//echo base_url;   http://swapnesh/classified/
	//echo $qstr; c-BrowseClassified/q:samsung|p:0|gal:0|typ:|
	//die;
	
	
	header ( "location:".base_url."$qstr/" ) ;
	exit ( ) ;


?>
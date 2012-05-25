<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	if ( intval ( $_GET["cat_id"] ) > 0 )
	{
		$dataArray = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => intval ( $_GET["cat_id"] ) ) ) ;
		if ( ! empty ( $dataArray ) )
		{
			echo "{ 'sub_cat' : [" ;
			foreach ( $dataArray as $catg )
			{
				echo "{ 'sub_cat_id' : ".$catg["CategoryID"]." , 'sub_cat_name' : '".$catg["CategoryName"]."' }," ;
			}
			echo "] }" ;
		}
	}
	
?>
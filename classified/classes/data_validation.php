<?php

	function validate_integet ( $value )
	{
		return intval ( $value ) ; 
	}
	
	function validate_decimal ( $value )
	{
		return floatval ( $value ) ;
	}
	
	function validate_title_string ( $value )
	{
		$str = str_replace ( "'" , "" , $value ) ;
		$str = str_replace ( "\"" , "" , $str ) ;
		return $str ;
	}
	
	function validate_empty ( $post_validate_values )
	{
		if ( is_array ( $post_validate_values ) )
			foreach ( $post_validate_values as $v )
				if ( $_POST[$v] == "" )
					return 0 ;
		return 1 ;
	}

?>
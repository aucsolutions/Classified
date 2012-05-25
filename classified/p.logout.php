<?php
	
	session_start ( ) ;
	
	require_once ( "config.php" ) ;
	
	session_destroy ( ) ;
	
	header ( "location:".base_url ) ;
	


?>
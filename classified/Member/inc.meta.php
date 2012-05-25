<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title["SiteValue"] ?> :: Classified Script </title>
<link href="../Admin/images/admin_style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../js/yadjs.js" type="text/javascript"></script>

<script language="javascript">
	var time_menu = 500 ;
	var tim_mer = null ;
	$(document).ready ( function ( )
						{
							$("#menu").mouseout ( function ( )
													{
														tim_mer = setTimeout ( "close_menu()" , time_menu ) ;
													}
							 		).mouseover ( function  ( )
													{
														clearTimeout ( tim_mer ) ;
													}
							 
							 ) ;
							 $("#menu > div").click ( function ( )
							 							{
															$(this).addClass("selected_menu").children("ul").slideDown ( "normal" ) ;
														}
							 ) ;
							
							 $(".li_close").click ( function ( )
													{
														$(this).parent().hide();
														$("#menu > span").removeClass ( "selected_menu" ) ;
													}
							 ) ;
						}
	) ;
	
	
	function close_menu ( )
	{
		$("#menu > div").removeClass ( "selected_menu" ) ;
		$("#menu > ul").fadeOut ( "fast" ) ;
	}
	
	function showHelp ( caller_obj )
	{
		if ( caller_obj )
		{
			$(caller_obj).next("div.div_help").toggle ( "normal" ) ;
		}
	}
	
	function validateForm ( )
	{
		var returnValue = true ;
		$("input,select,textarea").each ( function ( )
							{
								if ( $(this).attr("sch_req") == "1" && returnValue )
								{
									if ( $(this).val() == "" )
									{
										alert ( $(this).attr("sch_msg")+" cannot be empty" ) ;
										returnValue = false ;
									}
								}
							}
					
		 ) ;
		 return returnValue ;

	}
</script>

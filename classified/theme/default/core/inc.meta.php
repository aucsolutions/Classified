<title>
	<?php 
		if ( $app_init_data["SEOTitle"] != "" )
			echo $app_init_data["SEOTitle"] ;
		else
			echo $app_init_data["SiteTitle"] ;
	?>
</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="description" content="<?php echo $app_init_data["SiteDescription"] ?>">
<meta name="keywords" content="<?php echo $app_init_data["SiteKeyword"] ?>">

<link href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/c3common.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/all.css" rel="stylesheet" type="text/css">
	
<script type="text/javascript" language="JavaScript" src="<?php echo base_url ?>js/yadjs.js"></script>

<script type="text/javascript">
	function validateForm ( form_obj )
	{
		var returnValue = true ;
		$("#"+form_obj+" input,select,textarea").each ( function ( )
							{
								if ( $(this).attr("sch_req") == "1" && returnValue )
								{
									if ( $(this).val() == "" )
									{
										alert ( $(this).attr("sch_msg")+" <?php echo $lang["lang_form_validation_message"]["str_empty"] ?>" ) ;
										$(this).focus();
										returnValue = false ;
									}
								}
							}
					
		 ) ;
		 return returnValue ;

	}
</script>
<noscript>
<style type="text/css">
.jsonly {
	display:none;
}
.collapseWithJS {
	display:block;
}
</style>
</noscript>
<!-- End of HtmlPageHtmlHead -->
<style media="screen" type="text/css">
#flashCookie {
	visibility:hidden
}
</style>
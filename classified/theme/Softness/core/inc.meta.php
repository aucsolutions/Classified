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


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="stylesheet" href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/a_002.css" type="text/css" charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/a_003.css" type="text/css" charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/a.css" type="text/css" charset="utf-8">

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
<script language="javascript">
	var time_expire = null ;
	function select_dropdown_category ( cat_id , obj_caller )
	{
		$("#search_cat_id").val ( cat_id ) ;
		var cat_name = $(obj_caller).children ( "a" ).text ( ) ;
		$("#searchCat_name").text ( cat_name ) ;
		$("#ul_cat").slideUp("fast");
	}
	
	function select_head_cat ( cat_id , cat_name )
	{
		$("#cat_header_id").val ( cat_id ) ;
		$("#header-selected").text ( cat_name ) ;
		$("#ul_browse_cat").slideUp("fast");
	}
	
	function show_drop_down ( ul_id , obj_caller )
	{
		clearTimeout ( time_expire ) ;
		if ( ul_id == "ul_cat" )
			$("#ul_browse_cat").hide();
		if ( ul_id == "ul_browse_cat" )
			$("#ul_cat").hide();
		var of = $(obj_caller).offset();
		$("#"+ul_id).css({
							"left" : of.left+"px",
							"top" : (of.top+25)+"px"
						}).show();
	}
	function hide_drop_down ( ul_id )
	{
		time_expire = setTimeout ( "hide_it('"+ul_id+"')" , 500 ) ;
	}
	function hide_it ( ul_id )
	{
		$("#"+ul_id).hide();
	}
	
	
	function show_all_cat ( cat_id , obj_caller )
	{
		$("#sub_cat_"+cat_id).toggle();
		if ( $("#sub_cat_"+cat_id).is(":hidden") )
			$(obj_caller).find("strong").text ( "Show All" ) ;
		else
			$(obj_caller).find("strong").text ( "Show Less" ) ;
	}
	
	
</script>

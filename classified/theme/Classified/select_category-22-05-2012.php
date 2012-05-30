<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- Start of HtmlPageHtmlHead -->
<!-- AreaHome -->
<?php
	
	include ( "core/inc.meta.php" ) ;

?>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/css/formwizard.css" />

<script src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/js/formwizard.js" type="text/javascript">
</script>

<script type="text/javascript">

var myform=new formtowizard({
	formid: 'feedbackform',
	persistsection: true,
	revealfx: ['slide', 500]
})

</script>




<script type="text/javascript">
var myform3=new formtowizard({
 formid: 'staff_feedbackform',
 validate: ['staff_username', 'staff_sex', 'staff_addr1'],
 revealfx: ['slide', 500] //<--no comma after last setting
})
</script>




</head>
<body>
<div id="container">
	
		
		<?php
			include ( "inc.header.php" ) ;
		?>
		
	
	<div id="searchsection">
      <div class="leftsection">
        
        <h1><?php echo "Place an Ad" ?></h1>

									<form id="staff_feedbackform">
									
									
									
									

									
									
									

<fieldset class="sectionwrap">
<legend>Basic Information</legend>


									<select name="category" id="category">
									<option value="">Select Ad Category</option>
									
									<?php
									
										if ( ! empty ( $mainCategory ) )
										foreach ( $mainCategory as $cat ) :
									?>	
										<option value="<?php echo $cat["CategoryName"] ?>"><?php echo $cat["CategoryName"] ?></option>
									<?php	
										endforeach ;
									
									?>
									
									
									</select><br />


Name:<br /> <input id="staff_username" type="text" size="35" /><br />
Age:<br /> <input id="staff_age" type="text" size="6" /><br />
Sex: <input type="radio" name="staff_sex" value="male" /> Male <input type="radio" name="staff_sex" value="female" /> Female
</fieldset>

<fieldset class="sectionwrap">
<legend>Shipping Address</legend>
Country:<br /> <input id="staff_country" type="text" size="35" /><br />
State/Province:<br /> <input id="staff_state" type="text" size="35" /><br />
Address #1:<br /> <input id="staff_addr1" type="text" size="35" /><br />
Address #2:<br /> <input id="staff_addr2" type="text" size="35" /><br />
</fieldset>

<fieldset class="sectionwrap">
<legend>Comments</legend>
Any additional instructions:<br /> <textarea id="staff_feedback" style="width:350px;height:150px"></textarea><br />
<input type="submit" />
</fieldset>

</form>
				
      </div>
	<div>
			<?php
				
	include ( "inc.rightsidebar.php" ) ;
?>
		
	</div>	
    </div>
  </div>
</div>
		<!--/content-->
		<?php include ( "inc.footer.php" ) ?>
	</div>
	
</body>
</html>

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





<!---------BLOCK CODE FOR TEXT WORD COUND CSSS ADDED ON 22-05-2012 BY SWAPNESH----->

<SCRIPT LANGUAGE="JavaScript">
<!-- Dynamic Version by: Nannette Thacker -->
<!-- http://www.shiningstar.net -->
<!-- Original by :  Ronnie T. Moore -->
<!-- Web Site:  The JavaScript Source -->
<!-- Use one function for multiple text areas on a page -->
<!-- Limit the number of characters per textarea -->
<!-- Begin
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
//  End -->
</script>




<!----------BLOCK CODE ENDS HERE------------------------------>










</head>
<body>
<div id="container">
	
		
		<?php
			include ( "inc.header.php" ) ;
		?>
		
	
	<div id="searchsection">
      <div class="leftsection">
        
        <h1><?php echo "Place an Ad" ?></h1>

									<form id="staff_feedbackform" name="staff_feedbackform" style="border:2px solid #E5E5E5;padding: 15px 0 9px 13px;margin-top:15px;">
									
									
									
								<!--------THIS BLOCK OF CODE ADDED TO INTRODUCE TEXTAREA VISIBILITY----------->	

								<script type="text/javascript">
								function showSelected( sapna )
								{
								
								var num = sapna.length;
								if(num != 0)
								{
								var textarea = document.getElementById('textarea');
								
								textarea.disabled = false;
								}
								else
								{
								var textarea = document.getElementById('textarea');
								
								textarea.disabled = true;
								}
								
								return false;
								}
								</script>
		
							
								<!-------BLOCK CODE ENDS HERE--------------->
									

<fieldset class="sectionwrap">
<legend>Basic Information</legend>


									<select name="category" id="category" onChange="showSelected(this.value)" >
									<option value="">Select Ad Category</option>
									
									<?php
									
										if ( ! empty ( $mainCategory ) )
										foreach ( $mainCategory as $cat ) :
									?>	
										<option value="<?php echo $cat["CategoryName"] ?>"><?php echo $cat["CategoryName"] ?></option>
									<?php	
										endforeach ;
									
									?>
									
									
									</select><br /><br />

<fieldset class="swapnesh">
<legend>Category Disclaimer</legend>
<textarea cols="90" rows="5" disabled="disabled" id="textarea" class="abhishek"></textarea>
</fieldset>
<a href=""><span style="font-size: 11px; text-decoration:underline;">Click To Download Disclaimer For this category</span></a>
<br />
<br />


<!---Name:<br /> <input id="staff_username" type="text" size="35" /><br />
Age:<br /> <input id="staff_age" type="text" size="6" /><br />
Sex: <input type="radio" name="staff_sex" value="male" /> Male <input type="radio" name="staff_sex" value="female" /> Female
-->
<div style="width:675px;">
<input type="text" name="adtitle" id="adtitle" value="Enter Ad Title" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" style="width:300px; float:left; margin:0 151px 0 0"/>

<div style="width:20px; float:left;">$</div><input type="text" name="price" id="price" value="Price" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"
 style="width:200px; float:left;" />

</div>

<br /><br /><br />


<textarea rows="5" cols="94" name="addesc" id="addesc" onfocus="this.value='';" onblur="if(this.value=='')this.value='Enter Ad description upto 200 characters';" onKeyDown="textCounter(document.staff_feedbackform.addesc,document.staff_feedbackform.remLen2,200)"
onKeyUp="textCounter(document.staff_feedbackform.addesc,document.staff_feedbackform.remLen2,200)"  >Enter Ad description upto 200 characters</textarea><br />
<input readonly type="text" name="remLen2" size="3" maxlength="3" value="200">
characters left
<br>



<!-----WORK of 23-05-2012 CODE BLOCK STARTS HERE - 23/5/2012- -1- -------->

<style type="text/css">
.swa{
font-size:12px;
}
</style>

<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/attachment.png" />
<span class="swa">Add Attachments</span>
<br />
<br />

<span class="swa">&nbsp;&nbsp;&nbsp; Send reply to my  &nbsp;&nbsp;  <input type="radio" name="email" value="email"  checked="checked"/>Email&nbsp;&nbsp;<input type="radio" name="mobile" value="mobile" />Mobile</span>
<br />
<br />

<?php
$conShortcode = $data->select ( "Country" , "CountryID, Abbr" ,  " CountryID ASC" );
?>

									<select name="concode" id="concode" >
									
									
									<?php
									
										if ( ! empty ( $conShortcode ) )
										foreach ( $conShortcode as $cate ) :
									?>	
										<option value="<?php echo $cate["CountryID"] ?>"><?php echo $cate["Abbr"] ?></option>
									<?php	
										endforeach ;
									
									?>
									
									
									</select>

<input type="text" name="mobnum" id="mobnum" value="" style="width:200px; margin:0 151px 0 0"/>
<br />

&nbsp;
<input type="checkbox" name="displayad" value="displayad" />&nbsp;<span class="swa">Display my no. in Ad post</span>
<br />
<br />

<legend>Where would you like your ad to be seen ?</legend>

<input type="radio" name="mulcity" value="mulcity"  checked="checked"/><span class="swa">Post in multiple cities</span>&nbsp;&nbsp;<input type="radio" name="localcity" value="localcity" /><span class="swa">Post in my local city only</span>





<!----CODE BLOCK - 23/5/2012- -1- ENDS HERE -------------->








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

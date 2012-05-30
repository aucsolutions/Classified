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
		//echo $_SERVER['SCRIPT_NAME']."+".$_SERVER['QUERY_STRING'];
			include ( "inc.header.php" ) ;
		?>
		
	
	<div id="searchsection">
      <div class="leftsection">
        
        <h1><?php echo "Place an Ad" ?></h1>
		
		
		
		<script type="text/javascript">
	function validateForm ( form_obj )
	{
		//var returnValue = true ;
		var maincat = document.getElementById('category').value;
		var subcat = document.getElementById('subcategory').value;
		
		
		//alert("Main Category" + maincat + " : "+ "This is Subcategory" + subcat);
		//return false;
		
		if(maincat !='' && subcat!='')
		{
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
		// alert(returnValue);
		 return returnValue ;
		}
		else
		{
		alert("Please select category/subcategory options");
		return false;
		}
	}
</script>
		
		

<form action="" method="post" name="go_tohead" id="form_post_ad" enctype="multipart/form-data" onSubmit="return validateForm('form_post_ad');">
									
									
				<input type="hidden" name="themeVal" value="1" />	
				
				
<input name="Email_post_Address" value="<?php echo $_SESSION["login_member_email"] ?>"  type="hidden" />
				
								
								<!--------THIS BLOCK OF CODE ADDED TO INTRODUCE TEXTAREA VISIBILITY----------->	

								<script type="text/javascript">
								function showSelected( sapna )
								{
								//var divtoshow = 'showdiv'+sapna;
								//document.getElementById('showdiv'+sapna).style.display = "block";
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
<legend></legend>


									<select name="category" id="category" onChange="showSelected(this.value);showSubcategory();" >
									<option value="">Select Ad Category</option>
									
									<?php
									
										if ( ! empty ( $mainCategory ) )
										foreach ( $mainCategory as $cat ) :
									?>	
										<option value="<?php echo $cat["CategoryID"] ?>"><?php echo $cat["CategoryName"] ?></option>
									<?php	
										endforeach ;
									
									?>
									
									
									</select><br /><br />
									
									
										<div id="div_attraction">
										  </div>	
									
									
									
									<!----BLOCK CODE ADDED ON 24.05.2012 By Swapnesh for Sub category Listing QSWA  ----->
									
<script type="text/javascript">

function getXMLHTTP() { //fuction to return the xml http object
var xmlhttp=false;
try{
xmlhttp=new XMLHttpRequest();
}
catch(e){
try{
xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
}catch(e){
try{
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}catch(e1){
xmlhttp=false;
}
}
}
return xmlhttp;
}

function showSubcategory( )
{

var value = document.getElementById('category').value;
var url = '<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/subcategorylist.php?category='+value;
//alert(url);
var req = getXMLHTTP();
if(req){
//alert(url);
req.onreadystatechange = function(){
if(req.status == 200){
document.getElementById('div_attraction').innerHTML = req.responseText;
var activity = document.getElementById('subcategory').value;
//alert(activity);
}
else
{
alert("there was a problem while using XMLHTTP:\n" + req.statusText);
}
}
}
req.open("GET", url, true);
req.send(null);
}
</script>
									

									
									
									<!--BLOCK CODE ENDS HERE-   QSWA   ------------------------------>




<fieldset class="swapnesh">
<legend>Category Disclaimer</legend>
<textarea cols="90" rows="5" disabled="disabled" id="textarea" class="abhishek" name="catdiscontent"></textarea>
</fieldset>
<a href="#"><span style="font-size: 11px; text-decoration:underline;">Click To Download Disclaimer For this category</span></a>
<br />
<br />




<script type="text/javascript">
function pricecheck( myval ){

if( isNaN(myval) === false )
{
return true;
}
else{
alert("Please enter a Price for your Ad listing");
return false;
}
}

</script>



<div style="width:675px;">
<input type="text" name="adtitle" id="adtitle" value="Enter Ad Title" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" style="width:300px; float:left; margin:0 151px 0 0"/>

<div style="width:20px; float:left;">$</div><input type="text" name="price" id="price" value="Price" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue; pricecheck(this.value);"
 style="width:200px; float:left;" />

</div>

<br /><br /><br />


<textarea rows="5" cols="94" name="addesc" id="addesc" onfocus="this.value='';" onblur="if(this.value=='')this.value='Enter Ad description upto 200 characters';" onKeyDown="textCounter(document.go_tohead.addesc,document.go_tohead.remLen2,200)"
onKeyUp="textCounter(document.go_tohead.addesc,document.go_tohead.remLen2,200)"  >Enter Ad description upto 200 characters</textarea><br />
<input readonly type="text" name="remLen2" size="3" maxlength="3" value="200">
<span class="swa">characters left</span>
<br />
<br />






<!-----WORK of 23-05-2012 CODE BLOCK STARTS HERE - 23/5/2012- -1- -------->

<style type="text/css">
.swa{
font-size:12px;
}
div.work_main{overflow:hidden;}
div.work_status{float:left;margin:0 5px 0 0;}
fieldset.sectionwrap{width:550px;}
ul li {margin:0 0 10px 0;}
legend{display:block;padding:0 0 10px 0;clear:both;}
ul li label{display:block;float:left;width:100px;}
li.email_inq input{float:left;margin:0 10px 0 0;}
li.email_inq label{float:left;width:432px;}
li.email_inq div{clear:both;float:none;margin:0 0 10px 0;overflow: hidden;padding: 0 0 8px;}
</style>

<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/attachment.png" />
<span class="swa">Add Attachments</span>
<br />

<!-------FOR IMAGE EDIT----------------->


<div class="input-row">
															<script language="javascript">
																var total_images = 1 ;
																function add_file_field ( )
																{
																	total_images++ ;
																	if ( total_images > 6 )
																		return ;
																	var str_to_embed = '<input name="fileImage[]" size="40" style="width: 500px;" type="file" onChange="add_file_field()"><br>' ;
																	$("#image_stack").append ( str_to_embed ) ;
																}
															</script>
																<div id="imageUpload" class="first-field">
																	<div class="first-label">
																		<?php // echo  $lang["lang_post_form"]["str_images"] ?><br>
																		<span class="help"><?php echo $lang["lang_post_form"]["str_images_desc"] ?></span>
																	</div>
																	
																		<div class="first-input">
																			<div class="upload-action">
																				<div id="image_stack">
																				<input name="fileImage[]" size="40" style="width: 500px;" type="file" onChange="add_file_field()">
																				
																				<br>
																				</div>
																				<span class="help">Maximum 4MB</span>
																			</div>
																		</div>
																</div>
															</div>


<!-----FOR IMAGE EDIT BLOCK CODE ENDS HERE---->

<br />

<span class="swa">&nbsp;&nbsp;&nbsp; Send reply to my  &nbsp;&nbsp;  <input type="radio" name="replyto" value="email"  checked="checked"/>Email&nbsp;&nbsp;<input type="radio" name="replyto" value="mobile" />Mobile</span>
<br />
<br />

<?php
$conShortcode = $data->select ( "Country" , "CountryName, CountryID, Abbr" ,  " CountryID ASC" );
?>

									<select name="concode" id="concode" >
									
									
									<?php
									
										if ( ! empty ( $conShortcode ) )
										foreach ( $conShortcode as $cate ) :
									?>	
										<option value="<?php echo $cate["CountryName"] ?>"><?php echo $cate["Abbr"] ?></option>
									<?php	
										endforeach ;
									
									?>
									
									
									</select>

<input type="text" name="mobnum" id="mobnum" value="" style="width:200px; margin:0 151px 0 0"/>
<br />

&nbsp;



<input type="checkbox" name="displayad" value="1"  onClick="this.value = this.checked ? 1 : 0;" checked="checked" />&nbsp;<span class="swa">Display my no. in Ad post</span>


<br />
<br />

<legend>Where would you like your ad to be seen ?</legend>

<input type="radio" name="mulcity" value="mulcity"  checked="checked"/><span class="swa">Post in multiple cities</span>&nbsp;&nbsp;
<input type="radio" name="mulcity" value="localcity" /><span class="swa">Post in my local city only</span>
<br />
<br />

<!------------------#####BLOCK CODE 25-05-2012 ##1 STARTS HERE##### -------------------->


								<select name="state" id="state" >
								<option value="">Select State</option>
								
								<?php
								
								//$selectState =  $data->select ( "Category" , "*" , array ( "HeadCategoryID" => NULL ) , 0 , 100 , " OrderNumber asc" ) ;
								
								$selectCount =  $data->select ( "Country" , "*", " CountryID  asc" ) ;
								$selectState =  $data->select ( "State" , "*" ) ;
								 
								
								if ( ! empty ( $selectState ) )
								foreach ( $selectState as $state ) :
								?>	
								<option value="<?php echo $cat["StateID"] ?>"><?php echo $cat["StateName"] ?></option>
								<?php	
								endforeach ;
								
								?>
								
								
								</select>
								&nbsp;&nbsp;&nbsp;	
									
									
								<select name="country" id="country" >
								<option value="">Select Country</option>
								
								<?php
								
								if ( ! empty ( $selectCount ) )
								foreach ( $selectCount as $cat ) :
								?>	
								<option value="<?php echo $cat["CountryName"] ?>"><?php echo $cat["CountryName"] ?></option>
								<?php	
								endforeach ;
								
								?>
								
								
								</select>
									
									
									
									<br /><br />
									
									
			<input type="checkbox" id="city1" name="city1" /> City 0.5 	&nbsp;			
			<input type="checkbox" id="city2" name="city2" /> City 0.7	&nbsp;					
			<input type="checkbox" id="city3" name="city3" /> City 0.9	&nbsp;					
			<input type="checkbox" id="city4" name="city4" /> City 1.1
			<br />						
			<input type="checkbox" id="city5" name="city5" /> City 1.5 	&nbsp;			
			<input type="checkbox" id="city6" name="city6" /> City 1.7	&nbsp;					
			<input type="checkbox" id="city7" name="city7" /> City 1.9	&nbsp;					
			<input type="checkbox" id="city8" name="city8" /> City 2.1						
									
			<br />
			<br />
 			<legend>Place in multiple cities</legend>
			<input type="checkbox" id="subcat1" name="subcat1" /> Sub Category 1 	&nbsp;			
			<input type="checkbox" id="subcat2" name="subcat2" /> Sub Category 2	&nbsp;					
			<input type="checkbox" id="subcat3" name="subcat3" /> Sub Category 3	&nbsp;					
			<input type="checkbox" id="subcat4" name="subcat4" /> Sub Category 4
			<br />						
			<input type="checkbox" id="subcat5" name="subcat5" /> Sub Category 5 	&nbsp;			
			<input type="checkbox" id="subcat6" name="subcat6" /> Sub Category 6	&nbsp;					
			<input type="checkbox" id="subcat7" name="subcat7" /> Sub Category 7	&nbsp;					
			<input type="checkbox" id="subcat8" name="subcat8" /> Sub Category 8					
									
			<br />
			<br />
			
			<span class="swa"> Publish Ad For  &nbsp;&nbsp; 
			
								<select name="adpublish" id="adpublish" >
								<option value="1">Publish Ad For 1 Week</option>
								<option value="2">Publish Ad For 2 Week</option>
								<option value="3">Publish Ad For 3 Week</option>
								<option value="4">Publish Ad For 4 Week</option>
								<option value="5">Publish Ad For 5 Week</option>
								</select>
			</span>
			
			<br />
			
			<span class="swa">
			Ad Keyword : &nbsp;&nbsp;
			</span>
			<br />
			<input type="text" name="keyword" id="keyword" size="40" value="Keyword 1, Keyword 2, Keyword 3 " onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
			

<!------------------ BLOCK CODE ENDS HERE ##1 ENDS HERE ---------------------->



<span class="button">Preview</span>
<span class="button">Cancel</span>








<!----CODE BLOCK - 23/5/2012- -1- ENDS HERE -------------->





<!---------CODE BLOCK -1- 24/05/2012 --STARTS HERE ------------>








</fieldset>

<fieldset class="sectionwrap">
<legend></legend>

			<span class="swa">
			Thanks for making the payment against your Ad post!
			</span>
			<br />
			<span class="swa">
			Please Verify your Email address or Phone No. 
			</span>
			<br />
<input type="radio" name="vmobnum" id="vmobnum" />Verify Post Using Mobile No.
<br />
<input type="radio" name="vemail" id="vemail" />Verify Post Using Email Address
</fieldset>









<fieldset class="sectionwrap">
<legend></legend>

<!------START MOBILE VERIFIED------->
<h2 style="color:#333333;"><b>Step 3.</b></h2>
<h2 style="color:#333333;">Mobile Verified!</h2>
<br />
<span class="swa">
Congrats! Your ad verification was successful, your post is now <span style="color:#00CC66">ACTIVE</span> and can be viewed at this link XXXXXXXXXXXXXX. Be sure to check your mobile/email device for responses to your post.
</span>
<br />
<span class="swa">Login anytime to edit or delete your posts and to manage your account.</span>
<!------END MOBILE VERIFIED--------->

<br />
<br />

<!------START EMAIL VERIFIED------->
<h2 style="color:#333333;"><b>Step 3.</b></h2>
<h2 style="color:#333333;">Email Verified!</h2>
<br />
<span class="swa">
Email verification was successful, your post is now <span style="color:#00CC66">ACTIVE</span> and can be viewed at this link XXXXXXXXXXXXXX. Be sure to check your mobile/email device for responses to your post.
</span>
<br />
<span class="swa">Login anytime to edit or delete your posts and to manage your account.</span>
<!------END EMAIL VERIFIED--------->



</fieldset>
<input id="PostAd" value="<?php echo $lang["lang_post_form"]["str_post_button"] ?>" class="newButton" onClick="MainFormObj.submit();this.disabled=true; return false;" type="submit">

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

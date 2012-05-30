<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<?php include ( "core/inc.meta.php" ) ; ?>


<!---------BLOCK CODE FOR TEXT WORD COUND CSSS ADDED ON 22-05-2012 BY SWAPNESH----->

<script type="text/javascript">
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}

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


function showdiv( divtoactive )
{
var myDivs = new Array(1,5,7,9,12,16,19,22,25,106,107); 
var t = 'showdiv' + divtoactive,
r, dv;
for (var i = 0; i < myDivs.length; i++) {
r = 'showdiv' + myDivs[i];
dv = document.getElementById(r);
if (dv) {
if (t === r) {
dv.style.display = 'block';
} else {
dv.style.display = 'none';
}
}
}
return false;
}


function showState( )
{
var value = document.getElementById('country').value;
var url = '<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/showstate.php?country='+value;
//alert(url);
var req = getXMLHTTP();
if(req){
//alert(url);
req.onreadystatechange = function(){
if(req.status == 200){
document.getElementById('div_state').innerHTML = req.responseText;
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



function showCities( stateval )
{
//var value = document.getElementById('country').value;
var url = '<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/showcity.php?state='+stateval;
//alert(url);
var req = getXMLHTTP();
if(req){
//alert(url);
req.onreadystatechange = function(){
if(req.status == 200){
document.getElementById('div_city').innerHTML = req.responseText;
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
		
<form action="" method="post" name="go_tohead" id="form_post_ad" enctype="multipart/form-data" onSubmit="return validateForm('form_post_ad');">
									
									
				<input type="hidden" name="themeVal" value="1" />	
				
				
<input name="Email_post_Address" value="<?php echo $_SESSION["login_member_email"] ?>"  type="hidden" />
				
								
								<!--------THIS BLOCK OF CODE ADDED TO INTRODUCE TEXTAREA VISIBILITY----------->	


		
							
								<!-------BLOCK CODE ENDS HERE--------------->
									

<fieldset class="sectionwrap">
<legend></legend>

									<select name="category" id="category" onChange="showSelected(this.value);showSubcategory();showdiv(this.value);" >
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
									
									
	
									
									
									
									<!----BLOCK CODE ADDED ON 24.05.2012 By Swapnesh for Sub category Listing QSWA  ----->
									
									

									
									
									<!--BLOCK CODE ENDS HERE-   QSWA   ------------------------------>




<fieldset class="swapnesh">
<legend>Category Disclaimer</legend>
<textarea cols="90" rows="5" disabled="disabled" id="textarea" class="abhishek" name="catdiscontent"></textarea>
</fieldset>
<a href="#"><span style="font-size: 11px; text-decoration:underline;">Click To Download Disclaimer For this category</span></a>
<br />
<br />



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
#div_attraction{overflow:hidden;margin:0 0 10px 0;}
#div_attraction div{float:left;width:170px;}
#div_attraction input.input_check{float:left;margin:0 5px 0 0;}
#div_attraction label{display:block;float:left;width:150px;}
div.showdiv{}
div.showdiv ul{list-style:none;margin:0;padding:0;}
div.showdiv ul li {overflow:hidden;}
div.showdiv ul li label{display:block;float:left;width:120px}
</style>

<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/attachment.png" />
<span class="swa">Add Attachments</span>
<br />

<!-------FOR IMAGE EDIT----------------->



<div class="input-row">
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








<div id="showdiv16" class="showdiv" style="display:none;">
<label>Salary/Wages :</label> <input name="salary" id="salary" type="text" size="30" />


<label>Education :</label> <input name="education" id="education" type="text" size="30" />

<label>Work Status :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="fulltime" id="fulltime" /> FullTime</div>
<div class="work_status"><input type="checkbox" name="parttime" id="parttime" /> PartTime</div>
<div class="work_status"><input type="checkbox" name="tempcont" id="tempcont" /> Temp, Contract</div>
<div class="work_status"><input type="checkbox" name="intern" id="intern" /> Internship</div>
</div>

<label>Shift :</label> <input name="zipcode" id="zipcode" type="text" size="30" />

</div>



<div id="showdiv19" class="showdiv" style="display:none;">

<label>Price :</label> <input name="price" id="price" type="text" size="30" />

<label>BR :</label> 
<select name="br" id="br">
<?php 
for ($i=1; $i <= 8; $i++)
{
?> 
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>

</div>

<div id="showdiv22" class="showdiv" style="display:none;">
<ul>
<li>
<label>Rent :</label> <input name="rent" id="rent" type="text" size="30" />
</li>
<li>
<label>BR :</label> 
<select name="br" id="br">
<?php 
for ($i=1; $i <= 8; $i++)
{
?> 
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>
</li>

<li>
<label>Ad placed by :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="owner" id="owner" /> Owner/Property Manager</div>
<div class="work_status"><input type="checkbox" name="agency" id="agency" /> Agency/Location Service</div>
<div class="work_status"><input type="checkbox" name="weekends" id="weekends" /> Weekends</div>
</div>
</li>

<li>
<label>Fee Status :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="fee" id="fee" /> Fee</div>
<div class="work_status"><input type="checkbox" name="nofee" id="nofee" /> No Fee</div>
</div>
</li>



<li>
<label>Pets :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="catsok" id="catsok" /> Cats Ok</div>
<div class="work_status"><input type="checkbox" name="dogsok" id="dogsok" /> Dogs Ok</div>
</div>
</li>

<li>
<label>Gender Preference :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="fee" id="fee" /> Male Only</div>
<div class="work_status"><input type="checkbox" name="nofee" id="nofee" /> Male Preferred</div>
<div class="work_status"><input type="checkbox" name="fee" id="fee" /> Female Only</div>
<div class="work_status"><input type="checkbox" name="nofee" id="nofee" /> Female Preferred</div>
<div class="work_status"><input type="checkbox" name="fee" id="fee" /> Both</div>
<div class="work_status"><input type="checkbox" name="nofee" id="nofee" /> No Pref</div>
</div>
</li>

</ul>
</div>

<div id="showdiv25" class="showdiv" style="display:none;">

<label>Your Age :</label> <input name="age" id="age" type="text" size="30" />

</div>

<div id="showdiv106" class="showdiv" style="display:none;">

<ul>

<li><label>Your Age :</label> <input name="age" id="age" type="text" size="30" /></li>
<li>
<label>Ethnicity :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="Asian" id="Asian" /> Asian</div>
<div class="work_status"><input type="checkbox" name="Black" id="Black" /> Black</div>
<div class="work_status"><input type="checkbox" name="Hispanic" id="Hispanic" /> Hispanic</div>
<div class="work_status"><input type="checkbox" name="White" id="White" /> White</div>
<div class="work_status"><input type="checkbox" name="middleeast" id="middleeast" /> Middle Eastern</div>
<div class="work_status"><input type="checkbox" name="Other" id="Other" /> Other</div>
</div>
</li>

<li>
<label>Do You Provide :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="incall" id="incall" /> Incall</div>
<div class="work_status"><input type="checkbox" name="outcall" id="outcall" /> Outcall</div>
<div class="work_status"><input type="checkbox" name="bothcall" id="bothcall" /> Both</div>
</div>
</li>

<li>
<label>Review TER ID :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="bigdog" id="bigdog" /> Big Doggie</div>
<div class="work_status"><input type="checkbox" name="erotic" id="erotic" /> Erotic MP</div>
<div class="work_status"><input type="checkbox" name="tandab" id="tandab" /> T&A Board Display</div>
</div>
</li>

<li>
<label>Review IDNum :</label> <input name="reviewidnum" id="reviewidnum" type="text" size="30" />
</li>


<li>
<label>Credit cards :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="visa" id="owner" /> Visa</div>
<div class="work_status"><input type="checkbox" name="mastercard" id="mastercard" /> Master Card</div>
<div class="work_status"><input type="checkbox" name="amexp" id="amexp" /> American Express</div>
</div>
</li>

<li>
<label>Visiting :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="yes" id="yes" /> Yes</div>
<div class="work_status"><input type="checkbox" name="no" id="no" /> No</div>
</div>
</li>

</ul>
</div>

<div id="showdiv107" class="showdiv" style="display:none;">

<label>Your Age :</label> <input name="age" id="age" type="text" size="30" />



<label>Review TER ID :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="bigdog" id="bigdog" /> Big Doggie</div>
<div class="work_status"><input type="checkbox" name="erotic" id="erotic" /> Erotic MP</div>
<div class="work_status"><input type="checkbox" name="tandab" id="tandab" /> T&A Board Display</div>
</div>



<label>Review IDNum :</label> <input name="reviewidnum" id="reviewidnum" type="text" size="30" />




<label>Credit cards :</label> 
<div class="work_main">
<div class="work_status"><input type="checkbox" name="visa" id="owner" /> Visa</div>
<div class="work_status"><input type="checkbox" name="mastercard" id="mastercard" /> Master Card</div>
<div class="work_status"><input type="checkbox" name="amexp" id="amexp" /> American Express</div>
</div>



</div>


























<!------------------------------------------FOR SUB CATEGORY FIELDS-------------------------------->


<div class="commondiv" style="display:none;">
<li>
<label>Location :</label>
<input name="location" id="location" type="text" size="30" />
</li>

<li>
<label>Map :</label> <input name="map" id="map" type="text" size="30" />
</li>

<li>
<label>Zipcode :</label> <input name="zipcode" id="zipcode" type="text" size="30" />
</li>



</div>

<!------------------------------------------END----------------------------------------------------->

<span class="swa">Send reply to my  &nbsp;&nbsp;  <input type="radio" name="replyto" value="email"  checked="checked"/>Email&nbsp;&nbsp;<input type="radio" name="replyto" value="mobile" />Mobile</span>
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


<!------------------#####BLOCK CODE 25-05-2012 ##1 STARTS HERE##### -------------------->
<?php
$selectCount =  $data->select ( "awear_vm_country" , "*", " CountryID  asc" ) ;
$selectState =  $data->select ( "awear_vm_state" , "*" ) ;
?>
								
<select name="country" id="country" onChange="showState();" >
<option value="">Select Country</option>

<?php

if ( ! empty ( $selectCount ) )
foreach ( $selectCount as $cat ) :
?>	
<option value="<?php echo $cat["cid"] ?>"><?php echo $cat["country_name"] ?></option>
<?php	
endforeach ;

?>


</select>
									
&nbsp;&nbsp;&nbsp;								
								


<span id="div_state">

</span>

							
									
									

									
									
									<br />
									
			<legend>Place in multiple cities</legend>						
					
				<span id="div_city">

				</span>						
				
			<br />
			<br />
 			<legend>Place in multiple categories</legend>
			<!-----------------------------------------------------------------------------
			<input type="checkbox" id="subcat1" name="subcat1" /> Sub Category 1 	&nbsp;			
			<input type="checkbox" id="subcat2" name="subcat2" /> Sub Category 2	&nbsp;					
			<input type="checkbox" id="subcat3" name="subcat3" /> Sub Category 3	&nbsp;					
			<input type="checkbox" id="subcat4" name="subcat4" /> Sub Category 4
			<br />						
			<input type="checkbox" id="subcat5" name="subcat5" /> Sub Category 5 	&nbsp;			
			<input type="checkbox" id="subcat6" name="subcat6" /> Sub Category 6	&nbsp;					
			<input type="checkbox" id="subcat7" name="subcat7" /> Sub Category 7	&nbsp;					
			<input type="checkbox" id="subcat8" name="subcat8" /> Sub Category 8					
			------------------------------------------------------------------------------->
			
			<!-----PLACE HOLDER FOR SUBCATEGORIES--------->
										<div id="div_attraction">
										 </div>
			
			
			
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



<span class="button" id="preview">Preview</span>
<span class="button" id="cancel">Cancel</span>








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

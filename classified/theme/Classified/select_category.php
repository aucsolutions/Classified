<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<?php include ( "core/inc.meta.php" ) ; ?>


<script type="text/javascript">

$(document).ready(function() {
$(".detailsmain").hide();
$("#aftercontinue").hide();
$("#afterpayment").hide();
$("#finalverify").hide();
  $("#preview").click(function() {
  
  
  var adtitletoshow1 = $("#form_post_ad").serialize();
   //$("#previewadtitle").text(adtitletoshow);
   //alert(adtitletoshow1);
   //var subgh = $('#form_post_ad :input[name="subcategory"]').val();
 //  alert(subgh);
   /****************BLOCK CODE STARTS HERE FOR VALIDATION************************/
   
   
   var adtitle = $('#form_post_ad :input[name="adtitle"]').val();
   var adprice = $('#form_post_ad :input[name="price"]').val();
   var addesc =  $('#form_post_ad :input[name="addesc"]').val();
   var keyword = $('#form_post_ad :input[name="keyword"]').val();
   
	if ( adtitle === 'Enter Ad Title' || adtitle ==='' )
	{
	alert("Please enter a suitable title for your Ad listing");
	return false;
	}
	
	if( isNaN( adprice ) )
	{
	alert("Please enter a Price for your Ad listing");
	return false;
	}
    
	if ( addesc === 'Enter Ad description upto 200 characters' || addesc ==='' )
	{
	alert("Check ad Description");
	return false;
	}
	
	if( addesc.length < 30 )
	{
	alert("Description cannot be less than 30 characters");
	return false;	
	}
	
	if ( keyword === 'Keyword 1, Keyword 2, Keyword 3' || keyword ==='' )
	{
	alert("Add multiple words separated by Comma.");
	return false;
	}   
   
   
   
   /*****************BLOCK CODE ENDS HERE***********************/
   
   var adtitletoshow = $("#form_post_ad").serializeArray();

  // alert(adtitletoshow);
   $.each(adtitletoshow, function(i, field){


   
   if( field.name == 'adtitle'){
   $(".add_head").text(field.value);
  // alert(field.value);
    }
	
	   if( field.name == 'addesc'){
   $(".ad_prev_desc").text(field.value);
  // alert(field.value);
    }
	
		   if( field.name == 'keyword'){
   $(".ad_prev_keyowrd").text(field.value);
  // alert(field.value);
    }
	
	if( field.name == 'price'){
   $(".ad_prev_price").text(field.value);
  // alert(field.value);
    }

	if( field.name == 'category'){
	
   	$(".ad_prev_category").text(field.value);
	
    }	

	if( field.name == 'subcategory'){
   	//alert(field.value);
	$(".ad_prev_subcategory").append(field.value + " ");
	
    }	
	
	});

   
  $("#continue").click(function(){
  $("#inline_content").hide();
  $("#aftercontinue").show();
//alert(adtitletoshow1);
  
  var formdata3 = $('#form_post_ad :input[name="category"]').val();
  $("#aftercontinue").val(formdata3);
  });
   
   
    $("#divform").hide();
	$(".detailsmain").show();
  });
  
  

  
});
</script>

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


/****Added from my current file******/


function showDisclaimer( discselect )
{
/***
if( discselect == 1)
{
document.getElementsByClassName("catlink")[0].innerHTML =  '<a href="<?php echo base_url ?>pdfserver.php?file=Musicians">Click To Download Disclaimer For this category</a>';
}

if( discselect == 5)
{

document.getElementsByClassName("catlink")[0].innerHTML =  '<a href="<?php echo base_url ?>pdfserver.php?file=Services">Click To Download Disclaimer For this category</a>';
}

if( discselect == 22)
{
document.getElementsByClassName("catlink")[0].innerHTML =  '<a href="<?php echo base_url ?>pdfserver.php?file=Rentals">Click To Download Disclaimer For this category</a>';
}
*****/


switch ( discselect )
{
case '1':
document.getElementsByClassName("catlink")[0].innerHTML =  '<a href="<?php echo base_url ?>pdfserver.php?file=Musicians">Click To Download Disclaimer For this category</a>';
break;
case '5':
document.getElementsByClassName("catlink")[0].innerHTML =  '<a href="<?php echo base_url ?>pdfserver.php?file=Musicians">Click To Download Disclaimer For this category</a>';
break;
case '22':
document.getElementsByClassName("catlink")[0].innerHTML =  '<a href="<?php echo base_url ?>pdfserver.php?file=Musicians">Click To Download Disclaimer For this category</a>';
break;
default:
//alert(discselect);
document.getElementsByClassName("catlink")[0].innerHTML = '';
}

}









</script>

<script language="javascript">
var total_images = 1 ;
var num =1;
function add_file( )
{

total_images++ ;
if ( total_images > 6 )
return ;
var str_to_embed = '<input name="fileImage[]" size="40" style="width: 500px;" type="file" onChange="add_file_fieldtrue(this, num);add_file()"><br>' ;
$("#image_stack").append ( str_to_embed ) ;
num++;
}

function add_file_field(input) 
{
	if (input.files && input.files[0]) {
	var reader = new FileReader();
	reader.onload = function(e) {
	$('#preview_img').attr('src', e.target.result)
	.width('248px')
	.height('248px');
	}
	reader.readAsDataURL(input.files[0]);
	}
}

function add_file_fieldtrue(input,num) 
{
var ttt = num-1;
	if (input.files && input.files[0]) {
	var reader = new FileReader();
	reader.onload = function(e) {
	$('#preview_img'+ttt).attr('src', e.target.result)
	.width('70px')
	.height('70px');
	}
	reader.readAsDataURL(input.files[0]);
	}
}
</script>

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
div.showdiv ul{list-style:none;margin:0;padding:0 0 0 25px;}
div.showdiv ul li {overflow:hidden;}
div.showdiv ul li label{display:block;float:left;width:120px}
div.message .button{float:left;}
div.message #cancel{margin:0 159px 0 0;}

div.aftercontinue_container{background:#eee;padding:25px 40px;width:525px;margin:10px auto;}
div.aftercontinue_container h3{font-size: 16px;font-weight: bold;margin:5px 0px 10px 0;}
div.aftercontinue_container h4{font-size:14px;margin:7px 0;padding:0;}
div.aftercontinue_container ul{list-style:none;margin:0;padding:0;}
div.aftercontinue_container ul li{list-style:none;margin:0 0 5px 0;padding:0;overflow:hidden;}
div.aftercontinue_container ul li label{float:left;display:block;width:410px;}
div.aftercontinue_container ul li div{font-weight:bold;}
input#PostAd{margin:0 0 0 635px;}
span#div_city {overflow:hidden;margin:0 0 10px 0;display:block;}
span#div_city div{float:left;width:170px;}
span#div_city div input.input_check{float:left;margin:0 5px 0 0;}
span#div_city div label{display:block;float:left;width:150px;}

</style>



</head>
<body>
<div id="container">
	
		
		<?php
		//echo $_SERVER['SCRIPT_NAME']."+".$_SERVER['QUERY_STRING'];
		include ( "inc.header.php" ) ;
		?>
		
	
	<div id="searchsection">
      <div class="leftsection">
        
        <h1>Place an Ad</h1>
	
	
<form action="" method="post" name="go_tohead" id="form_post_ad" enctype="multipart/form-data" onSubmit="return validateForm('form_post_ad');">	

<input type="hidden" name="themeVal" value="1" />	
<input name="Email_post_Address" value="<?php echo $_SESSION["login_member_email"] ?>"  type="hidden" />
								<!--------THIS BLOCK OF CODE ADDED TO INTRODUCE TEXTAREA VISIBILITY----------->	

<div id="divform">								<!-------BLOCK CODE ENDS HERE--------------->
<fieldset class="sectionwrap">
<legend></legend>
<select class="catName" name="category" id="category" onChange="showSelected(this.value);showSubcategory();showdiv(this.value);showDisclaimer(this.value);" >
									<option value="">Select Ad Category</option>
									
									<?php
									
										if ( ! empty ( $mainCategory ) )
										foreach ( $mainCategory as $cat ) :
									?>	
										<option id="categoryname" value="<?php echo $cat["CategoryID"] ?>"><?php echo $cat["CategoryName"] ?></option>
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
<span class="catlink"></span>
<br />
<br />



<div style="width:675px;">
<input type="text" name="adtitle" id="adtitle" value="Enter Ad Title" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" style="width:300px; float:left; margin:0 151px 0 0"/>

<div style="width:20px; float:left;">$</div><input type="text" name="price" id="price" value="Price" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue; pricecheck(this.value);"
 style="width:200px; float:left;" />

</div>

<br /><br /><br />


<textarea rows="5" cols="94" name="addesc" id="addesc" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value='Enter Ad description upto 200 characters';" onKeyDown="textCounter(document.go_tohead.addesc,document.go_tohead.remLen2,200)"
onKeyUp="textCounter(document.go_tohead.addesc,document.go_tohead.remLen2,200)"  >Enter Ad description upto 200 characters</textarea><br />
<input readonly type="text" name="remLen2" size="3" maxlength="3" value="200">
<span class="swa">characters left</span>
<br />
<br />






<!-----WORK of 23-05-2012 CODE BLOCK STARTS HERE - 23/5/2012- -1- -------->


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
<input name="fileImage[]" size="40" style="width: 500px;" type="file" onChange="add_file_field(this);add_file();">

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
<ul>
<li>
<label>Salary/Wages :</label> <input name="salary" id="salary" type="text" size="30" />
</li>
<li>
<label>Education :</label> <input name="education" id="education" type="text" size="30" />
</li>
<li>
<label>Work Status :</label> 
</li>
<li>
<div class="work_main">
<div class="work_status"><input type="checkbox" name="fulltime" id="fulltime" /> FullTime</div>
<div class="work_status"><input type="checkbox" name="parttime" id="parttime" /> PartTime</div>
<div class="work_status"><input type="checkbox" name="tempcont" id="tempcont" /> Temp, Contract</div>
<div class="work_status"><input type="checkbox" name="intern" id="intern" /> Internship</div>
</div>
</li>
<li>
<label>Shift :</label> <input name="zipcode" id="zipcode" type="text" size="30" />
</li>
</ul>
</div>



<div id="showdiv19" style="display:none;">

<label>Price :</label> <input name="relprice" id="relprice" type="text" size="30" />

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

<div id="showdiv25" style="display:none;">

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
<ul>
<li>
<label>Your Age :</label> <input name="age" id="age" type="text" size="30" />
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
</ul>

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
			<input type="text" name="keyword" id="keyword" size="40" value="Keyword 1, Keyword 2, Keyword 3" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
			

<!------------------ BLOCK CODE ENDS HERE ##1 ENDS HERE ---------------------->



<span class="button" id="preview">Preview Ad</span>
<span class="button" id="cancel" onClick="window.location.reload()">Cancel</span>








<!----CODE BLOCK - 23/5/2012- -1- ENDS HERE -------------->





<!---------CODE BLOCK -1- 24/05/2012 --STARTS HERE ------------>








</fieldset>
</div>

<!------detailsmain--------->
<div class="detailsmain">
          <div class="maincontentsection">
            <div class="addcontainer" id='inline_content' style="padding:0 178px 5px 5px; border:1px solid #E2E1E1;">
              <div class="add_head">
				<!----PLACE FOR AD TITLE------>
			  </div>
              <div class="add_picture">
                <div class="main_picture"><img id="preview_img" style="width:75px; height:75px;" /></div>
                <ul class="productlisting">	
                  <li><img id="preview_img1" style="width:75px; height:75px;" /></li>
                  <li><img id="preview_img2" style="width:75px; height:75px;" /></li>
                  <li><img id="preview_img3" style="width:75px; height:75px;" /></li>
                  <li><img id="preview_img4" style="width:75px; height:75px;" /></li>
                  <li><img id="preview_img5" style="width:75px; height:75px;" /></li>
				  <li></li>
                </ul>
              </div>
              <div class="add_details">
                <div class="detail_section">
                  <div class="detail_left"><span>Posted on:</span><?php echo date("M d, Y") ?></div>
                  <div class="add_rate">$<span class="ad_prev_price"></span></div>
                </div>
                <div class="detail_section">
                  <div class="detail_left"><span>Link URL:</span> <a href="#" class="purplecolor">http://ozthink.com/classified/</a></div>
                  <div class="detail_right"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/mail_icon.jpg" width="16" height="12" alt="" /></div>
                </div>
                <div class="detail_section"><span>Share On:</span> <a href="#"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/tweet_btn.jpg" alt="" width="54" height="20" align="absmiddle" /></a>&nbsp;&nbsp;<a href="#"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/pinit_button.jpg" alt="" width="43" height="20" align="absmiddle" /></a>&nbsp;&nbsp;<a href="#"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/googleplus_button.jpg" alt="" width="32" height="20" align="absmiddle" /></a>&nbsp;&nbsp;<a href="#"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/facebooklike_button.jpg" alt="" width="54" height="20" align="absmiddle" /></a></div>
                <div class="detail_section"><span>Details:</span>
                  <label><span class="ad_prev_desc"></span> </label>
                </div>
                <div class="detail_section"><span>Keyword:</span> <span class="ad_prev_keyowrd"></span></div>
				
		
                <div class="detail_section"><span>Payment Accepted:</span> Cash, Pay Pal, Visa, Master Card</div>
                <div class="report"><a href="#" class="purplecolor">Report Abuse</a></div>
                <div class="message">
				<span class="button" id="cancel" onClick="window.location.reload();">Cancel</span>
				<span class="button" id="edit">Edit</span>
				<span class="button" id="continue">Continue</span>
				
				</div>
              </div>
            </div>
          </div>
        </div>
<!------detailsmain--------->

<!------aftercontinue--------->
<div id="aftercontinue">

<div class="aftercontinue_container">
<h3>Order Summary</h3>
<ul>
<li>
<!---<label>Location Selected:</label>-->
<div></div>
</li>
<li>
<label>Category Selected: </label>
<div><span class="ad_prev_category"></span></div>
</li>
<li>
<!--<label>Sub Category Selected: </label>-->
<div><span class="ad_prev_subcategory"></span>
</div>
</li>
</ul>
</div>
<div style="float:left; margin-left:-230px;">
<input id="PostAd" value="<?php echo $lang["lang_post_form"]["str_post_button"] ?>" class="button" onClick="MainFormObj.submit();this.disabled=true; return false;" type="submit">
</div>
</div>
<!------aftercontinue--------->	



</form>	
	
		<div id="afterpayment">

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

</div>
		
<div id="finalverify">		
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
</div>		
      </div>
<!------left Section--------->	  
	  
	  
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
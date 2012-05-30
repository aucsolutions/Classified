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
/*function showSelected( sapna )
{
var myDivs = new Array(1,5,7,9,12,16,19,22,25,106,107); 
      for(var i=0; i<myDivs.length; i++)
        {
		
            document.getElementById('showdiv'+myDivs[i]).style.display = (myDivs[i] == parseInt(sapna)) ? "block" : "none";
        }

return false;
}
*/


var myDivs = new Array(1,5,7,9,12,16,19,22,25,106,107); 

    function showSelected(sapna) {
        var t = 'showdiv' + sapna,
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

</script>
		
							
								<!-------BLOCK CODE ENDS HERE--------------->
									

<fieldset class="sectionwrap">
<legend>Basic Information</legend>


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

<!-------------------------------------------------------------------------------------------------------------------------


<fieldset class="swapnesh">
<legend>Category Disclaimer</legend>
<textarea cols="90" rows="5" disabled="disabled" id="textarea" class="abhishek"></textarea>
</fieldset>
<a href="#"><span style="font-size: 11px; text-decoration:underline;">Click To Download Disclaimer For this category</span></a>
<br />
<br />


---------------------------------------------------------------------------------------------------------------------------->

<!---Name:<br /> <input id="staff_username" type="text" size="35" /><br />
Age:<br /> <input id="staff_age" type="text" size="6" /><br />
Sex: <input type="radio" name="staff_sex" value="male" /> Male <input type="radio" name="staff_sex" value="female" /> Female
-->

<!-------------------------------------------------------------------------------------------------------------------------

<div style="width:675px;">
<input type="text" name="adtitle" id="adtitle" value="Enter Ad Title" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" style="width:300px; float:left; margin:0 151px 0 0"/>

<div style="width:20px; float:left;">$</div><input type="text" name="price" id="price" value="Price" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"
 style="width:200px; float:left;" />

</div>

<br /><br /><br />


<textarea rows="5" cols="94" name="addesc" id="addesc" onfocus="this.value='';" onblur="if(this.value=='')this.value='Enter Ad description upto 200 characters';" onKeyDown="textCounter(document.staff_feedbackform.addesc,document.staff_feedbackform.remLen2,200)"
onKeyUp="textCounter(document.staff_feedbackform.addesc,document.staff_feedbackform.remLen2,200)"  >Enter Ad description upto 200 characters</textarea><br />
<input readonly type="text" name="remLen2" size="3" maxlength="3" value="200">
<span class="swa">characters left</span>
<br />
<br />


------------------------------------------------------------------------------------------------------------------------->



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
<!---------------------------------------------------------------------------------------------------------------------
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

----------------------------------------------------------->

<!----CODE BLOCK - 23/5/2012- -1- ENDS HERE -------------->





<!---------CODE BLOCK -1- 24/05/2012 --STARTS HERE ------------>




<legend>
WRITE POST
</legend>


<ul style="list-style:none; margin:0px; padding:0px;">


<div class="changecat">
<li>
<label>Title :</label>
<input name="title" id="title" type="text" size="30" />
</li>

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


<li>
<label>Description :</label>
  <textarea name="desc" cols="30" rows="5" id="desc"></textarea>
</li>

</div>





<!--------------------------------*******************************************------------------------------------->


<div id="showdiv16" style="display:none;">
<li>
<label>Salary/Wages :</label> <input name="salary" id="salary" type="text" size="30" />
</li>
<li>
<label>Education :</label> <input name="education" id="education" type="text" size="30" />
</li>
<li>
<label>Work Status :</label> 
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
</div>



<div id="showdiv19" style="display:none;">
<li>
<label>Price :</label> <input name="price" id="price" type="text" size="30" />
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
</div>

<div id="showdiv22" style="display:none;">
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

</div>

<div id="showdiv25" style="display:none;">
<li>
<label>Your Age :</label> <input name="age" id="age" type="text" size="30" />
</li>
</div>

<div id="showdiv106" style="display:none;">

<li>
<label>Your Age :</label> <input name="age" id="age" type="text" size="30" />
</li>

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



</div>

<div id="showdiv107" style="display:none;">
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


</div>





<!--------------------------------*******************************************------------------------------------->






<legend>COMPANY INFORMATION</legend>
<li>
<label>Name :</label> <input name="name" id="name" type="text" size="30" />
</li>

<li>
<label>Phone :</label> <input name="phone" id="phone" type="text" size="30" />
</li>

<li>
<label>Company Name :</label> <input name="compname" id="compname" type="text" size="30" />
</li>


<legend>YOUR EMAIL ADDRESS</legend>
<li>
<label>Email Address :</label> <input name="emailaddr" id="emailaddr" type="text" size="30" />
</li>

<li>
<label>Confirm Email :</label> <input name="conemail" id="conemail" type="text" size="30" />
</li>

<legend>EMAIL INQURIES</legend>

<li class="email_inq">
<div><input type="radio" /><label>Hide my email address from reader (make it anonymous) and forward email inquiries to me.</label><br /></div>
<div><input type="radio" /><label>I do not want to receive any email inquiries (include contact info in ad when using this option)</label><br /></div>
</li>



<legend>DISPLAY OPTIONS</legend>

<li class="email_inq">
<div><input type="radio" /><label>Yes, Show links to my other postings in the buy, sell, trade section</label><br /></div>
<div><input type="radio" /><label>No, do NOT show links to my other postings</label><br /></div>
<div><input type="radio" /><label>Show the date I Joined</label><br /></div>
</li>

<legend>UPLOADS IMAGES</legend>
<li>
<input type="file" name="upload_images" />
</li>

<legend>PROMOTIONS CODE</legend>
<li>
<input type="text" name="promotion_code"
</li>










<!---------CODE BLOCK 24/05/2012 ENDS HERE --------------------->




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

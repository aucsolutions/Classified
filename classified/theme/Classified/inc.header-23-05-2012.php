<!------ANOTHER SCRIPT BLOCK OF CODE ------>


<script language="javascript">
	var time_expire = null ;
	function select_dropdown_category ( cat_id , obj_caller )
	{
		$("#search_cat_id").val ( cat_id ) ;
		var cat_name = $(obj_caller).children ( "a" ).text ( ) ;
		$("#searchCat_name").text ( cat_name ) ;
		$("#ul_cat").slideUp("fast");
	}
	function show_drop_down ( ul_id , obj_caller )
	{
		clearTimeout ( time_expire ) ;
		if ( ul_id == "ul_cat" )
			$("#ul_browse_cat").hide();
		if ( ul_id == "ul_browse_cat" )
			$("#ul_cat").hide();
		var of = $(obj_caller).offset();
		$("#"+ul_id+":hidden").css(
									{
										"left" : of.left+"px"
									}
									).show();
	}
	function hide_drop_down ( ul_id )
	{
		time_expire = setTimeout ( "hide_it('"+ul_id+"')" , 300 ) ;
	}
	function hide_it ( ul_id )
	{
		$("#"+ul_id).hide();
	}
</script>


<!---------BLOCK CODE ENDS HERE------------>


		
<script language="javascript">
	var lastDiv = "" ;
	function showScreen ( divArea )
	{
		lastDiv = divArea ;
		var wd = $(document).width ( ) ;
		var ht = $(document).height ( ) ;

		$("#div_Background").css ( {"left" : "0px" , "top" : "0px" , "opacity" : 0.60} ).width( wd ).height ( ht ).show();
		var n_wd = $("#"+divArea).width ( ) ;
		var n_ht = $("#"+divArea).height ( ) ;
		$("#"+divArea).css ( { "left" : ( ( wd / 2 ) - ( n_wd / 2 ) )+"px" , "opacity" : 0.10 } ).show().animate ( { top : "1%" , opacity : 1.0 } , "normal" ) ;
	}
	
	function close_window ( divArea )
	{
		if ( !divArea )
		{
			$("#"+lastDiv).animate ( { top : "25%" , opacity : 0.10 } , "normal" , function ( )
																					{
																						$(this).hide();
																						$("#div_Background").hide ( ) ;
																					}
			 ) ;
		}
		else
		{
			$("#"+divArea).animate ( { top : "25%" , opacity : 0.10 } , "normal" , function ( )
																					{
																						$(this).hide();
																						$("#div_Background").hide ( ) ;
																					}
			 ) ;
		}
	}
</script>

<div id="wrappercontainer">
  <div id="maincontainer">
<div id="header">
      <div class="logo"><a href="<?php echo base_url ?>"><img src="<?php echo base_url ?>media/logo.jpg" width="150" height="66" alt="" /></a></div>
     
	 <!-----FOR RIGHT SECTION BLOCK----->
	  <div class="rightsection">
        <ul class="rightnav">
		
		
		
		
		
		
		
		
<?php
if ( intval ( $_SESSION["login_account_id"] ) > 0 )
{
?>
<li><a href="<?php echo base_url ?>Member/classifiedlist.php" style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo $lang["lang_header"]["str_my_ads"] ?> </a></li>
	
<li><a href="<?php echo base_url ?>Member/watchlist.php"  style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo $lang["lang_header"]["str_my_watch_list"] ?> </a></li>
	
<li><a  href="<?php echo base_url ?>p.logout.php" style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo $lang["lang_header"]["str_log_out"] ?> </a></li>
	<?php
}
else
{
?>
<li><a href="#" onclick="showScreen ( 'div_Login' ) ;" style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo "Login" ?> </a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">How It Works</a></li>
		          </ul>
   <div class="createaccount">
   <a  href="#" onclick="showScreen ( 'div_SignUp' ) ;" style="text-decoration: none; color: rgb(0, 51, 153);"><?php echo "Create an account" ?> </a>
   </div>
	<?php
}
?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<!-----ADDED THIS BOCK OF CODE FOR TWITTER LIKE EFFECT------>
		
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>

<script type="text/javascript" >
 $(document).ready(function(){
  setTimeout(function(){
  $(".flash").fadeOut("slow", function () {
  $(".flash").remove();
      }); }, 1500);
 });
</script>

<style type="text/css">
.flash {
    background-color: #FFFFFF;
    border: 1px solid #CCCCCC;
    border-radius: 6px 6px 6px 6px;
    float: left;
    font-size: 20px;
    font-weight: bold;
    left: -568px;
    padding: 10px 0 10px 10px;
    position: relative;
    top: -69px;
    width: 538px;
}

</style>






		
		
		
          	<?php if ( $_SESSION["str_system_message"] != null ) : ?>
	<div class="flash">
		<?php echo $_SESSION["str_system_message"]; $_SESSION["str_system_message"] = null ; ?>
	</div>
	<?php endif ; ?>


<!-------END BLOCK CODE ---------->


      </div>
	 <!---RIGHT SECTION BLOCK CODE ENDS HERE----> 
	  <div id="div_Background" style="display:none; background-color:#262626; position:absolute; z-index:101"  onclick="close_window()"></div>
    </div>
  <div id="div_Login" class="popup" style="display:none; top:15%; z-index:105; position:fixed; padding: 8px; width: auto;">
		<table border="0" align="center" cellpadding="0" cellspacing="0" id="facebox" class="facebox">
			<tbody>
				<tr>
					<td class="tl"></td>
					<td class="b"></td>
					<td class="tr"></td>
				</tr>
				<tr>
					<td class="b"></td>
					<td class="body">
						<div style="display: block;" class="content">
							<div id="popup">
								<div id="heading">
									<?php echo $lang["lang_header"]["str_sign_in"] ?>
								</div>
								<div id="content">
									<form action="<?php echo base_url ?>p.login.php" class="new_user" id="new_user" method="post">
										<div style="margin: 0pt; padding: 0pt; display: inline;">
										</div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="19%" height="52"><label for="user_username"><?php echo $lang["lang_header"]["login_form"]["str_your_email"] ?></label></td>
												<td colspan="2"><input id="user_username" name="EmailAddress" size="30" type="text" /></td>
											</tr>
											<tr>
												<td><label for="user_password"><?php echo $lang["lang_header"]["login_form"]["str_your_password"] ?></label></td>
												<td colspan="2"><input id="user_password" name="Pass" size="30" type="password" /></td>
											</tr>
											<tr>
												<td height="49">&nbsp;</td>
												<td width="39%"><p>
														<a href="#" onclick="$('#div_Login').hide(); showScreen ( 'div_Forget_pass' ) ;"><?php echo $lang["lang_header"]["str_forget_pass"] ?>?</a>
													</p></td>
												<td width="42%"><input id="user_submit" name="commit" value="<?php echo $lang["lang_header"]["login_form"]["str_post_button"] ?>" type="submit" class="inputbtn" /></td>
											</tr>
											<tr>
												<td colspan="3"><p><?php echo $lang["lang_header"]["str_dont_have_account_1"] ?>
														<a href="#" onclick="$('#div_Login').hide(); showScreen ( 'div_SignUp' ) ;">Sign Up</a>
														<?php echo $lang["lang_header"]["str_dont_have_account_2"] ?></p></td>
											</tr>
										</table>
									</form>
								</div>
								<div style="clear: both;">
								</div>
							</div>
						</div>
						<div style="display: block;" class="footer">
							<a href="#" class="close" onclick="close_window('div_Login')">
								<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closelabel.gif" title="close" class="close_image">
							</a>
						</div></td>
					<td class="b"></td>
				</tr>
				<tr>
					<td class="bl"></td>
					<td class="b"></td>
					<td class="br"></td>
				</tr>
			</tbody>
		</table>
	</div>
    
	
	
	
	<!--------------------ADDED ON 23/05/2012---------------->
	
	<div id="div_Forget_pass" class="popup" style="display:none; top:15%; z-index:105; position:fixed; padding: 8px; width: auto;">
	
	
	
	
			<div class="mainbox">
  <div class="popupheading"><span>Forgot Password?</span>
    <div class="closebtn">
	<a href="#" class="close" onclick="close_window('div_Forget_pass')">
	<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closebtn.png" width="16" height="16" alt="" />
	</a>
	</div>
  </div>
  <form action="<?php echo base_url ?>p.forget_pass.php" method="post" class="new_user" id="new_user" name="new_user">
  <ul class="inputlist">
    <li><span class="redcolor">*</span>Email Address or Phone No.</li>
    <li>
      <input class="inputbox" type="text" name="EmailAddress" id="txtEmail" />
      &nbsp;&nbsp;

		<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/alert_icon.png" title="close" class="close_image" border="0">

	  </li>
    
    
    
   <!-- 
    <li class="rightalign"> <input type="submit" value="<?php echo $lang["lang_header"]["forget_form"]["str_post_button"] ?>" class="inputbtn" name="submit" /></li>
    -->
    
    	 <li class="rightalign">
	 <a href="javascript:document.new_user.submit();" onclick="">
	  <span class="button">Retrieve Password</a></span></li>
    
	</form>
    <li>
      <div class="leftsection"><a href="#" class="purplecolor">Sign In</a></div>
      <div class="rightsection" style="width: 150px">Join<a href="#" class="purplecolor">Ozthink.com</a> It's Free</div>
    </li>
  </ul>
  
  
  
  
</div>
	
	
	
	
	
	

	
	
	</div>
	
	<!------------------BLOCK CODE ENDS HERE---------------->
	
	
	
	
	<div id="div_SignUp" class="popup" style="display:none; top:15%; z-index:105; position:fixed; padding: 8px; width: auto;">
		<table border="0" align="center" cellpadding="0" cellspacing="0" id="facebox">
			<tbody>
				<tr>
					<td class="tl"></td>
					<td class="b"></td>
					<td class="tr"></td>
				</tr>
				<tr>
					<td class="b"></td>
					<td class="body"><div style="display: block;" class="content">
							<div id="popup">
								<div id="heading">
									Create an Account - Its Free!! 
								</div>
								<div id="content">
									<script language="javascript">
										function validateSignUpForm ( )
										{
											if ( $("#txtConfirmPassword").val() == "" || $("#txtConfirmPassword").val() != $("#txtPassword").val() )
											{
												alert ( "<?php echo $lang["lang_header"]["str_password_match_alert"] ?>" ) ;
												return false;
											}
											else
												return validateForm ( 'new_user' ) ;
										}
									</script>
									<form action="<?php echo base_url ?>register.php" class="new_user" id="new_user" method="post" onsubmit="return validateSignUpForm (  ) ; ">
										<div style="margin: 0pt; padding: 0pt; display: inline;">
										</div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="30%" height="30"><label for="user_username"><?php echo $lang["lang_header"]["register_form"]["str_your_name"] ?></label></td>
												<td><input name="Full_Setting_Name" type="text" id="txtFullName" size="30" gtbfieldid="116" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_name"] ?>" /></td>
											</tr>
											<tr>
												<td height="30"><label for="user_password"><?php echo $lang["lang_header"]["register_form"]["str_your_email"] ?></label></td>
												<td><input name="Email_Setting_Address" type="text" id="txtEmailAddress" size="30" gtbfieldid="117" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_email"] ?>" /></td>
											</tr>
											<tr>
												<td width="30%" height="30"><label for="user_username"><?php echo $lang["lang_header"]["register_form"]["str_your_password"] ?></label></td>
												<td><input name="Password_Setting_" type="password" id="txtPassword" size="30" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_password"] ?>" /></td>
											</tr>
											<tr>
												<td height="30"><label for="user_password"><?php echo $lang["lang_header"]["register_form"]["str_confirm_password"] ?></label></td>
												<td><input name="ConfirmPassword" type="password" id="txtConfirmPassword" size="30" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_confirm_password"] ?>" /></td>
											</tr>
											<tr>
												<td width="30%" height="30"><label for="user_username"><?php echo $lang["lang_header"]["register_form"]["str_your_address"] ?></label></td>
												<td><input name="Address_Setting_" type="text" id="txtAddress" size="30" gtbfieldid="118" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_address"] ?>" /></td>
											</tr>
											<tr>
												<td height="30"><label for="Address_Setting_"><?php echo $lang["lang_header"]["register_form"]["str_your_city"] ?></label></td>
												<td><input name="City_Setting_" type="text" id="Address_Setting_" size="30" gtbfieldid="118" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_city"] ?>" /></td>
											</tr>
											<tr>
												<td width="30%" height="30"><label for="Address_Setting_2"><?php echo $lang["lang_header"]["register_form"]["str_your_zip"] ?></label></td>
												<td><input name="Zip_Setting_" type="text" id="Address_Setting_2" size="30" gtbfieldid="118" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_zip"] ?>" /></td>
											</tr>
											<?php
												$countries = $data->select ( "Country" , "*" , NULL , 0 , 500 ) ;
												if ( ! empty ( $countries ) )
												{
											?>
											<tr>
												<td width="30%" height="30"><label for="address_country"><?php echo $lang["lang_header"]["register_form"]["str_your_country"] ?></label></td>
												<td>
													<select name="Country_Setting_" sch_req="1" id="address_country" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_country"] ?>" >
														
														<?php
															foreach ( $countries as $country )
																echo "<option value='".$country["CountryName"]."'>".$country["CountryName"]."</option>" ;
														?>
													</select>
												</td>
											</tr>
											<?php
												}
											?>
											<?php
												
												if ( intval ( $app_init_data["SignupAuthentication"] ) )
												{
											?>
													<tr>
														<td><?php echo $lang["lang_header"]["register_form"]["str_enter_code"] ?></td>
														<td><img src="<?php echo base_url ?>yadcap.php" />
																<br />
																<input type="text" name="capSecurity" gtbfieldid="118" size="30" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_enter_code"] ?>" />
														</td>
													</tr>
													<?php
												}
											?>
											<tr>
												<td height="39">&nbsp;</td>
												<td><input id="user_submit" value="<?php echo $lang["lang_header"]["register_form"]["str_post_button"] ?>" type="submit" class="inputbtn" /></td>
											</tr>
											<tr>
											</tr>
										</table>
									</form>
								</div>

							</div>
						</div>
						<span style="float:right;margin:0 10px 5px 0;">
							<a href="#" class="close" onclick="close_window('div_SignUp')">
			<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closelabel.gif" title="close" class="close_image" border="0">
							</a>
						</span></td>
					<td class="b"></td>
				</tr>
				<tr>
					<td class="bl"></td>
					<td class="b"></td>
					<td class="br"></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
   <script type="text/javascript">
	var lastDiv = "" ;
	function showScreen ( divArea )
	{
		lastDiv = divArea ;
		var wd = $(document).width ( ) ;
		var ht = $(document).height ( ) ;

		$("#div_Background").css ( {"left" : "0px" , "top" : "0px" , "opacity" : 0.60} ).width( wd ).height ( ht ).show();
		var n_wd = $("#"+divArea).width ( ) ;
		var n_ht = $("#"+divArea).height ( ) ;
		$("#"+divArea).css ( { "left" : ( ( wd / 2 ) - ( n_wd / 2 ) )+"px" , "opacity" : 0.10 } ).show().animate ( { top : "1%" , opacity : 1.0 } , "normal" ) ;
	}
	
	function close_window ( divArea )
	{
		if ( !divArea )
		{
			$("#"+lastDiv).animate ( { top : "25%" , opacity : 0.10 } , "normal" , function ( )
																					{
																						$(this).hide();
																						$("#div_Background").hide ( ) ;
																					}
			 ) ;
		}
		else
		{
			$("#"+divArea).animate ( { top : "25%" , opacity : 0.10 } , "normal" , function ( )
																					{
																						$(this).hide();
																						$("#div_Background").hide ( ) ;
																					}
			 ) ;
		}
	}
</script>

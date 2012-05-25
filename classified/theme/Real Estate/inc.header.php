<div id="header">
	<div class="logo">
		<a href="<?php echo base_url ?>"><img src="<?php echo base_url ?>media/logo.jpg" alt="<?php echo $app_init_data["SiteName"] ?>" border="0" ></a>
	</div>
	
	
	<div id="withoutGreetings">
			<?php
		if ( intval ( $_SESSION["login_account_id"] ) > 0 )
		{
	?>
			<a href="<?php echo base_url ?>Member/classifiedlist.php" style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo $lang["lang_header"]["str_my_ads"] ?> </a>
			&nbsp;|&nbsp;
			<a href="<?php echo base_url ?>Member/watchlist.php"  style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo $lang["lang_header"]["str_my_watch_list"] ?> </a>
			&nbsp;|&nbsp;
			<a  href="<?php echo base_url ?>p.logout.php" style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo $lang["lang_header"]["str_log_out"] ?> </a>
			<?php
		}
		else
		{
	?>
			<a href="#" onclick="showScreen ( 'div_Login' ) ;" style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo $lang["lang_header"]["str_sign_in"] ?> </a>
			&nbsp;|&nbsp;
			<a  href="#" onclick="showScreen ( 'div_SignUp' ) ;" style="text-decoration: none; color: rgb(0, 51, 153);"> <?php echo $lang["lang_header"]["str_register"] ?> </a>
			<?php
		}
	?>
		</div>
		
		
		<div id="top_navigation">
			<ul>
				<?php
					$mainCategory = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => null ) , 0 , 100 , "OrderNumber asc" ) ;
					if ( ! empty ( $mainCategory ) )
						foreach ( $mainCategory as $cat ) :
				?>
				<li><a href="<?php echo base_url."category/".get_sef_url($cat["CategoryID"],"Category") ; ?>/"><?php echo $cat["CategoryName"] ?></a></li>
				<?php 
						endforeach;
				?>
			</ul>
		</div>


</div>

	
	<?php if ( $_SESSION["str_system_message"] != null ) : ?>
	<div style="background-color:#DADADA; border:#999999 solid 2px; font-weight:bold; padding:5px; margin:3px; color:#333333;">
		<?php echo $_SESSION["str_system_message"]; $_SESSION["str_system_message"] = null ; ?>
	</div>
	<?php endif ; ?>
	<div id="div_Background" style="display:none; background-color:#262626; position:absolute; z-index:101"  onclick="close_window()">
	</div>
	<div id="div_Login" class="popup" style="display:none; top:15%; z-index:105; position:fixed; padding: 8px; width: auto;">
		<table border="0" align="center" cellpadding="0" cellspacing="0" id="facebox">
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
	
	<div id="div_Forget_pass" class="popup" style="display:none; top:15%; z-index:105; position:fixed; padding: 8px; width: auto;">
		<table border="0" align="center" cellpadding="0" cellspacing="0" id="facebox">
			<tbody>
				<tr>
					<td class="tl"></td>
					<td class="b"></td>
					<td class="tr"></td>
				</tr>
				<tr>
					<td class="b"></td>
					<td class="body">
					<div id="popup">
					<div id="heading">
						<?php echo $lang["lang_header"]["str_forget_pass"] ?>
					</div>
					<div id="content">
						<form action="<?php echo base_url ?>p.forget_pass.php" method="post" class="new_user" id="new_user">
							<div style="margin: 0pt; padding: 0pt; display: inline;">
							</div>
							<table width="100%" cellspacing="3" cellpadding="2">
								<tr>
									<td align="right" ><label><?php echo $lang["lang_header"]["forget_form"]["str_your_email"] ?></label></td>
									<td><input type="text" name="EmailAddress" id="txtEmail" />
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="100" align="center"><input type="submit" value="<?php echo $lang["lang_header"]["forget_form"]["str_post_button"] ?>" class="inputbtn" />
									</td>
								</tr>
							</table>
						</form>
						</div>
					</div>
					<div style="display: block;" class="footer">
							<a href="#" class="close" onclick="close_window('div_Forget_pass')">
								<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closelabel.gif" title="close" class="close_image" border="0">
							</a>
						</div>
					</td>
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
									Registration
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
												<td width="30%" height="35"><label for="user_username"><?php echo $lang["lang_header"]["register_form"]["str_your_name"] ?></label></td>
												<td><input name="Full_Setting_Name" type="text" id="txtFullName" size="30" gtbfieldid="116" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_name"] ?>" /></td>
											</tr>
											<tr>
												<td height="35"><label for="user_password"><?php echo $lang["lang_header"]["register_form"]["str_your_email"] ?></label></td>
												<td><input name="Email_Setting_Address" type="text" id="txtEmailAddress" size="30" gtbfieldid="117" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_email"] ?>" /></td>
											</tr>
											<tr>
												<td width="30%" height="35"><label for="user_username"><?php echo $lang["lang_header"]["register_form"]["str_your_password"] ?></label></td>
												<td><input name="Password_Setting_" type="password" id="txtPassword" size="30" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_password"] ?>" /></td>
											</tr>
											<tr>
												<td height="35"><label for="user_password"><?php echo $lang["lang_header"]["register_form"]["str_confirm_password"] ?></label></td>
												<td><input name="ConfirmPassword" type="password" id="txtConfirmPassword" size="30" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_confirm_password"] ?>" /></td>
											</tr>
											<tr>
												<td width="30%" height="35"><label for="user_username"><?php echo $lang["lang_header"]["register_form"]["str_your_address"] ?></label></td>
												<td><input name="Address_Setting_" type="text" id="txtAddress" size="30" gtbfieldid="118" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_address"] ?>" /></td>
											</tr>
											<tr>
												<td height="35"><label for="Address_Setting_"><?php echo $lang["lang_header"]["register_form"]["str_your_city"] ?></label></td>
												<td><input name="City_Setting_" type="text" id="Address_Setting_" size="30" gtbfieldid="118" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_city"] ?>" /></td>
											</tr>
											<tr>
												<td width="30%" height="35"><label for="Address_Setting_2"><?php echo $lang["lang_header"]["register_form"]["str_your_zip"] ?></label></td>
												<td><input name="Zip_Setting_" type="text" id="Address_Setting_2" size="30" gtbfieldid="118" sch_req="1" sch_msg="<?php echo $lang["lang_header"]["register_form"]["str_your_zip"] ?>" /></td>
											</tr>
											<?php
												$countries = $data->select ( "Country" , "*" , NULL , 0 , 500 ) ;
												if ( ! empty ( $countries ) )
												{
											?>
											<tr>
												<td width="30%" height="35"><label for="address_country"><?php echo $lang["lang_header"]["register_form"]["str_your_country"] ?></label></td>
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
												<td height="49">&nbsp;</td>
												<td><input id="user_submit" value="<?php echo $lang["lang_header"]["register_form"]["str_post_button"] ?>" type="submit" class="inputbtn" /></td>
											</tr>
											<tr>
											</tr>
										</table>
									</form>
								</div>
								<div style="clear: both;">
								</div>
							</div>
						</div>
						<div style="display: block;" class="footer">
							<a href="#" class="close" onclick="close_window('div_SignUp')">
								<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closelabel.gif" title="close" class="close_image" border="0">
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
		$("#"+divArea).css ( { "left" : ( ( wd / 2 ) - ( n_wd / 2 ) )+"px" , "opacity" : 0.10 } ).show().animate ( { top : "20%" , opacity : 1.0 } , "normal" ) ;
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

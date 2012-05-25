
<div id="banner" class="clearfix tall-header">
		<div id="header-logo">
			<a href="<?php echo base_url ?>">
				<img src="<?php echo base_url ?>media/logo.jpg" alt="<?php echo base_url ?>" title="<?php echo $app_init_data["SiteTitle"] ?>">
			</a>
		</div>
		<!--/logo-->
		<div id="header-nav-search">
			<div id="header-nav-tabs">
				<?php
if ( ! empty ( $static_pages ) )
		foreach ( $static_pages as $page )
		{
			if ( intval ( $page["IncludeHeader"] ) > 0 )
			{
?>
				<?php 
				$active = ( strchr ( $_SERVER['REQUEST_URI'] , get_sef_url ( $page["PageManagerID"] ,"StaticPage" ) ) ?  " activetab" : "") ;
				
			?>
				<a href="<?php echo base_url.get_sef_url ( $page["PageManagerID"] ,"StaticPage" ) ?>/" class="active">
					<?php echo $page["PageName"] ?>
				</a>
				<span class="pipe"> | </span>
				<?php
			}
		}
?>
				<div style="display: none;">
				</div>
			</div>
			<div id="header-search-bar">
				<div id="header-search">
					<form action="<?php echo base_url ?>search/" method="post" name="search-form" id="header-search-form" onsubmit="if (this.Keyword.value == 'Search Classifieds...') this.q.value = ''; return true;">
						<div style="width: 452px;" id="header-container" class="tdrop-container">
							<div class="search-options-text-div">
								<input type="hidden" name="CatID" id="cat_header_id" value="" />
								<input style="width: 320px;" class="search-option-text blur" id="header-text" name="Keyword" value="<?php echo $exp_send["q"] ?>" onfocus="this.focused = true" type="text">
							</div>
							<?php
	if ( ! empty ( $mainCategory ) )
	{
		echo "<ul id='ul_browse_cat' >" ;
		foreach ( $mainCategory as $cat )
			echo "<li><a href='#' onclick=\"select_head_cat ( ".$cat["CategoryID"]." , '".$cat["CategoryName"]."' ); \">".$cat["CategoryName"]."</a></li>" ;
		echo "</ul>" ;
	}
?>
							<span class="search-option-link" id="header-link" >
							<a id="header-selected" href="javascript:void(null)" onclick="show_drop_down ( 'ul_browse_cat' , this ) ;" onmouseout="hide_drop_down('ul_browse_cat');">in</a>
							</span>
						</div>
						<input src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/button_findit.gif" id="header-search-button" width="79" height="26" type="image">
						<div class="clearing">
						</div>
					</form>
				</div>
				<!-- /header-search -->
			</div>
			<!-- /header-search-bar -->
		</div>
		<div id="header-right-menu">
			<div id="header-right-menu-links">
				<?php
	if ( intval ( $_SESSION["login_account_id"] ) > 0 )
	{
?>
				<a href="<?php echo base_url ?>Member/classifiedlist.php" style="text-decoration: none; color: rgb(0, 51, 153);">
					<?php echo $lang["lang_header"]["str_my_ads"] ?>
				</a>
				&nbsp;|&nbsp;
				<a href="<?php echo base_url ?>Member/watchlist.php"  style="text-decoration: none; color: rgb(0, 51, 153);">
					<?php echo $lang["lang_header"]["str_my_watch_list"] ?>
				</a>
				&nbsp;|&nbsp;
				<a  href="<?php echo base_url ?>p.logout.php" style="text-decoration: none; color: rgb(0, 51, 153);">
					<?php echo $lang["lang_header"]["str_log_out"] ?>
				</a>
				<?php
	}
	else
	{
?>
				<a href="#" onclick="showScreen ( 'div_Login' ) ;" style="text-decoration: none; color: rgb(0, 51, 153);">
					<?php echo $lang["lang_header"]["str_sign_in"] ?>
				</a>
				&nbsp;|&nbsp;
				<a  href="#" onclick="showScreen ( 'div_SignUp' ) ;" style="text-decoration: none; color: rgb(0, 51, 153);">
					<?php echo $lang["lang_header"]["str_register"] ?>
				</a>
				<?php
	}
?>
			</div>
			<div id="header-right-menu-post-promo" class="clearfix">
				<div id="post-hidden-modals" style="display: none; width: 335px;">
				</div>
				<a href="<?php echo base_url ?>c-SelectCategory/" title="Post" class="post-link clearfix">
					<img id="free-balloon" src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/free_balloon.gif" alt="Post a FREE Ad" title="Post a FREE Ad" align="top" border="0">
					<img id="post-ad-button" src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/post_button_silver.gif" alt="Post a FREE Ad" title="Post a FREE Ad" align="top" border="0">
				</a>
			</div>
		</div>
	</div>
<?php if ( $_SESSION["str_system_message"] != null ) : ?>
<div style="background-color:#ffffff; border:#000000 solid 2px; font-weight:bold; padding:5px; margin:3px;">
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
					<td class="body"><div style="display: block;" class="content">
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
					<td class="body"><div id="popup">
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

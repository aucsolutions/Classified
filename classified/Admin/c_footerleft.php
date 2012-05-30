<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_home"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	if ( $_POST )
	{
		foreach ( $_POST as $fieldName => $fieldValue )
		{
			if ( strchr ( $fieldName , "_Setting_" ) )
			{
				$fName = str_replace ( "_Setting_" , "" , $fieldName ) ;
				$data->update ( "SiteManager" , array ( "SiteValue" => $fieldValue ) , array ( "SiteVariable" => $fName ) ) ;
			}
			if ( $_FILES["fleLogo"]["name"] ) 
			{
				exec ( "chmod ../media/ 777" ) ;
				move_uploaded_file ( $_FILES["fleLogo"]["tmp_name"] , "../media/logo.jpg" ) ;
				exec ( "chmod ../media/ 755" ) ;
			}
		}
		$_SESSION["str_system_message"] = "Site settings saved successfully." ;
	}
	$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
	$dataArray = array ( ) ;
	foreach ( $siteSettings as $site )
		$dataArray[$site["SiteVariable"]] = $site["SiteValue"] ;
	
	$siteSettings = null ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3> Application Settings </h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data">
						<table cellpadding="2" cellspacing="1" width="80%">
							
							<tr>
								<td class="form_title" >&nbsp;</td>
								<td>
									<label>
									<input name="IsSite_Setting_Close" type="radio" id="chkClose" value="1" <?php echo intval ( $dataArray["IsSiteClose"] ) == 1 ? "checked='checked'" : "" ?> /> Close Site Temporarily</label>
									<br />
									<label><input name="IsSite_Setting_Close" type="radio" id="chkClose" value="0" <?php echo intval ( $dataArray["IsSiteClose"] ) == 0 ? "checked='checked'" : "" ?> /> Make the site Online</label>
									<br />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">This option will down the site.</div>
								</td>
							</tr>
							
							<tr>
								<td class="form_title" ><label for="txtSiteTitle">Application Name</label></td>
								<td><input name="Site_Setting_Name" type="text" class="form_text" id="txtSiteName" value="<?php echo $dataArray["SiteName"] ?>" size="35" maxlength="35" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">This value will be your website name, it will be used in text and emails.</div>
								</td>
							</tr>
							<tr>
								<td class="form_title" ><label for="txtSiteTitle">Site Title</label></td>
								<td><input name="Site_Setting_Title" type="text" class="form_text" id="txtSiteTitle" value="<?php echo $dataArray["SiteTitle"] ?>" size="35" maxlength="35" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">This value will be your website title.</div>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Keywords</td>
								<td><input name="Site_Setting_Keyword" type="text" class="form_text" id="txtSiteKeywords" value="<?php echo $dataArray["SiteKeyword"] ?>" size="50" maxlength="50" />
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">This value will your website keywords, used for Search Engines to find your site.</div>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Owner Email</td>
								<td><input name="Owner_Setting_Email" type="text" class="form_text" id="txtOwnerEmail" value="<?php echo $dataArray["OwnerEmail"] ?>" size="50" maxlength="150" />
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">This email will be used to send emails, from the system.</div>
								</td>
							</tr>
							<tr>
								<td class="form_title" valign="top" >Site Description</td>
								<td valign="top"><textarea name="Site_Setting_Description" cols="60" rows="3" class="form_textarea" id="txtDescription"><?php echo $dataArray["SiteDescription"] ?></textarea>
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">Site description will be assessed by the search engines.</div>
								</td>
							</tr>
							<tr>
								<td class="form_title" >WYSIWYG Editor</td>
								<td><label>
									<input name="IsEditor_Setting_Allow" type="radio" value="1" <?php echo intval ( $dataArray["IsEditorAllow"] ) == 1 ? "checked='checked'" : "" ?> />
									Enable</label>
									<span style="color:#7F7F7F; font-size:12px;">Enable users to write AD descriptions easily</span>
									<br />
									<label>
									<input name="IsEditor_Setting_Allow" type="radio" value="0" <?php echo intval ( $dataArray["IsEditorAllow"] ) == 0 ? "checked='checked'" : "" ?> />
									Disable</label>
									<span style="color:#7F7F7F; font-size:12px;">If you want to let users enter plain text only for the AD description</span>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Site Logo</td>
								<td><input type="file" name="fleLogo" />
									<br />
									<?php
										echo "<img src='../media/logo.jpg?".date("y-d-m h:M")."' border='0' >" ;
									?>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Captcha Code</td>
								<td><label>
									<input name="Signup_Setting_Authentication" type="radio" value="1" <?php echo intval ( $dataArray["SignupAuthentication"] ) == 1 ? "checked='checked'" : "" ?> />
									Yes</label>
									<span style="color:#7F7F7F; font-size:12px;">Enable Security Code when sign up.</span>
									<br />
									<label>
									<input name="Signup_Setting_Authentication" type="radio" value="0" <?php echo intval ( $dataArray["SignupAuthentication"] ) == 0 ? "checked='checked'" : "" ?> />
									No</label>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Default Ad Status</td>
								<td><label>
									<input name="Default_Setting_Status" value="1" type="radio" <?php echo intval ( $dataArray["DefaultStatus"] ) == 1 ? "checked='checked'" : "" ?> />
									Active</label>
									<span style="color:#7F7F7F; font-size:12px;">If you want ADs when posted, it makes them online immediately</span>
									<br />
									<label>
									<input name="Default_Setting_Status" value="0" type="radio" <?php echo intval ( $dataArray["DefaultStatus"] ) == 0 ? "checked='checked'" : "" ?> />
									InActive</label>
									<span style="color:#7F7F7F; font-size:12px;">If you want ADs to be verified by ADMIN</span>
								</td>
							</tr>
							
							<tr>
								<td class="form_title" >User Registration Required </td>
								<td><label>
									<input name="AccountRequiredTo_Setting_Post" type="radio" value="1" <?php echo intval ( $dataArray["AccountRequiredToPost"] ) == 1 ? "checked='checked'" : "" ?> />
									Yes</label>
									<span style="color:#7F7F7F; font-size:12px;">Do not allow user to post ad without registration.</span>
									<br />
									<label>
									<input name="AccountRequiredTo_Setting_Post" type="radio" value="0" <?php echo intval ( $dataArray["AccountRequiredToPost"] ) == 0 ? "checked='checked'" : "" ?> />
									No</label>
									<span style="color:#7F7F7F; font-size:12px;">Allow user or guest to post ad.</span>
								</td>
							</tr>
							
							
							<tr>
								<td class="form_title" >Language </td>
								<td>
									
									<select name="DefaultLanguage_Setting_">
										<?php
											$i = 0 ;
											$h = opendir ( "../lang/" ) ;
											while ( $f = readdir ( $h ) )
												if ( $f != "." && $f != ".." && strchr ( $f , ".php" ) )
												{
													if ( $dataArray["DefaultLanguage"] == $f )
														$checked = "selected='selected'" ;
													else
														$checked = "" ;
													
													echo "<option $checked value='".$f."'>".str_replace(".php","",$f)."</option>" ;
												}
										?>
										
									</select>
									
									
								</td>
							</tr>
							
							
							
							<tr>
								<td class="form_title" valign="top" >Currency Symbol</td>
								<td valign="top"><input type="text" maxlength="3" name="CurrencySymbol_Setting_" class="form_textarea" id="txtSymbol" value="<?php echo $dataArray["CurrencySymbol"] ?>" />
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">Currency Symbol to be used in the website.</div>
								

								</td>
							</tr>
							
							
							<tr>
								<td class="form_title" valign="top" >Notifier</td>
								<td valign="top"><textarea name="Notifier_Setting_" cols="60" rows="3" class="form_textarea" id="txtNotifier"><?php echo $dataArray["Notifier"] ?></textarea>
								<br />
								Appear After: 
								<input type="text" name="NotifierTime_Setting_" value="<?php echo $dataArray["NotifierTime"] ?>" onblur="if ( isNaN ( this.value ) ) this.value='5' ;" />
								Seconds 
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">Display Notifier after defined Seconds</strong></div>
								</td>
							</tr>
							
							
							
							<tr>
								<td class="form_title" valign="top" >Google Analytics</td>
								<td valign="top"><textarea name="Google_Setting_Analytics" cols="60" rows="3" class="form_textarea" id="txtAnalytics"><?php echo $dataArray["GoogleAnalytics"] ?></textarea>
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">Tracker code on the website like <strong>Google Analytics</strong></div>
								</td>
							</tr>
							
							<tr>
								<td class="form_title" >Google Maps Key</td>
								<td><input name="Google_Setting_MapKey" type="text" class="form_text" id="txtGoogleMap" value="<?php echo $dataArray["GoogleMapKey"] ?>" size="60" maxlength="120" />
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">The map key issued by Google.com, its free you can get one<br /> for you website by <a href="http://code.google.com/apis/maps/signup.html" target="_blank">clicking here</a>.</div>
								</td>
							</tr>
							<tr>
								<td colspan="10" class="form_title" align="right" ><input type="submit" value="Save Settings" class="submit_button" />
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<?php include ( "inc.footer.php" ) ; ?>
			<!-- end #container -->
		</div>
	</body>
</html>

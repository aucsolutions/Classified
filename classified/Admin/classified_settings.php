<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	
	if ( $_POST )
	{
		foreach ( $_POST as $fieldName => $fieldValue )
		{
			if ( strchr ( $fieldName , "_Setting_" ) )
			{
				$fName = str_replace ( "_Setting_" , "" , $fieldName ) ;
				$data->update ( "SiteManager" , array ( "SiteValue" => $fieldValue ) , array ( "SiteVariable" => $fName ) ) ;
			}
		}
		if ( ! empty ( $_POST["EF_Category"] ) )
		{
			foreach ( $_POST["EF_Category"] as $key => $value )
			{
				$fileds = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryExtraFieldID" => $key ) ) ;
				if ( ! empty ( $fileds ) )
				{
					if ( $value != "" )
					{
						$dataPost = array ( "EFName" => $_POST["EF_Category"][$key] , "DefaultValue"  => $_POST["EF_Category_Default"][$key] , "IsRequired"  => intval ( $_POST["EF_Category_required"][$key] ) , "FieldType" => $_POST["EF_Type"][$key] ) ;
						$data->update ( "CategoryExtraField" , $dataPost , array ( "CategoryExtraFieldID" => $key ) ) ;
					}
					else
					{
						$data->delete ( "AdExtraField" , array ( "CategoryExtraFieldID" => $key ) , 100000 ) ;
						$data->delete ( "CategoryExtraField" , array ( "CategoryExtraFieldID" => $key ) , 10 ) ;
					}
				}
				else if ( $value != "" )
				{
					$dataPost = array ( "EFName" => $_POST["EF_Category"][$key] , "DefaultValue"  => $_POST["EF_Category_Default"][$key] , "IsRequired"  => intval ( $_POST["EF_Category_required"][$key] ) , "FieldType" => $_POST["EF_Type"][$key] ) ;
					$data->insert ( "CategoryExtraField" , $dataPost ) ;
				}
			}
		}
		
		$_SESSION["str_system_message"] = "Changes made successfully." ;
		
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
				<h3> Classified Ads Settings</h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
						<table cellpadding="2" cellspacing="1" width="70%">
							<tr>
								<td width="28%" valign="top" class="form_title" >Default Classified Price</td>
								<td width="72%" valign="top">
									<input type="text" class="form_text" name="Classified_Setting_Price" size="40" value="<?php echo number_format($dataArray["ClassifiedPrice"],2) ?>" sch_req="1" sch_msg="USERNAME" onblur="if ( isNaN ( this.value ) || this.value=='' ) this.value='0.00'" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Amount you want to charge for every classified on the website.<br /> <strong>NOTE: If posting price is defined, category price will be ignored.</strong>
									</div>
								</td>
							</tr>
							
							<tr>
								<td class="form_title" >Days to Expire</td>
								<td><input name="DaysTo_Setting_Expire" type="text" class="form_text" id="txtGoogleMap" value="<?php echo intval ( $dataArray["DaysToExpire"] ) ?>" size="60" maxlength="120" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">
									The number of days a listing must expire. You must set AutoCron to enable this feature. 
								</div>
								</td>
							</tr>
							
							<script language="javascript">
								function add_extra_field ( )
								{
									var tableString = "<table width='100%'  style='border-bottom:#000000 solid 1px;'><tr><td>Field Name </td><td><input type='text' name='EF_Category[]' size='40' maxlength='99' /> &nbsp;&nbsp; <label><input type='checkbox' name='EF_Category_required[]' value='1' /> Required</label></td></tr><tr><td>Type</td><td><select name='EF_Type[]'><option value='text' >Simple Text</option><option value='textarea' >Multi Line Text</option><option value='combo' >Dropdown (Select)</option><option value='check' >Checkbox</option><option value='radio' >Radio</option></select></td></tr><tr><td>Default Value</td><td><textarea name='EF_Category_Default[]' rows='2' cols='45' ></textarea></td></tr></table>" ;
									$("#div_extra_fields").append ( tableString ) ;
								}
							</script>
							<tr>
								<td class="form_title" >Extra Fields</td>
								<td>
									<div style="font-size:12px;" id="div_extra_fields">
										<div align="right">
											<input type="button" value="ADD" style="background-image:url(images/icons/add.png); background-repeat:no-repeat; background-position:left; height:24px; width:64px; border:#242424 solid 1px;" onclick="add_extra_field()" /><img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
											<div class="div_help" align="left">
												Extra fields are extra info you want from user, when posting ad. If FieldName is empty it will be ignored. Default value can be empty or anything. If comma separated then dropdown will be shown to user to select one of the comma separated value.
											</div>
										</div>
							<?php
								
								$extra_fields = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryID" => null ) , 0 , 500 ) ;
								if ( ! empty ( $extra_fields ) )
									foreach ( $extra_fields as $extra_field )
									{
							?>
											<table width="100%" style='border-bottom:#000000 solid 1px;'>
											<tr>
												<td>Field Name </td>
												<td><input type="text" name="EF_Category[<?php echo $extra_field["CategoryExtraFieldID"] ?>]" size="40" maxlength="99" value="<?php echo $extra_field["EFName"] ?>" /> &nbsp;&nbsp; <label><input type="checkbox" name="EF_Category_required[<?php echo $extra_field["CategoryExtraFieldID"] ?>]" value="1" <?php echo intval ( $extra_field["IsRequired"] ) == 1 ? "checked='checked'" : "" ?> /> Required</label></td>
											</tr>
											<tr>
												<td>
													Type
												</td>
												<td>
													<select name="EF_Type[<?php echo $extra_field["CategoryExtraFieldID"] ?>]">
														<option value="text" <?php echo $extra_field["FieldType"] == "text" ? "selected='selected'" : "" ?> >Simple Text</option>
														<option value="textarea" <?php echo $extra_field["FieldType"] == "textarea" ? "selected='selected'" : "" ?> >Multi Line Text</option>
														<option value="combo" <?php echo $extra_field["FieldType"] == "combo" ? "selected='selected'" : "" ?> >Dropdown (Select)</option>
														<option value="check" <?php echo $extra_field["FieldType"] == "check" ? "selected='selected'" : "" ?> >Checkbox</option>
														<option value="radio" <?php echo $extra_field["FieldType"] == "radio" ? "selected='selected'" : "" ?> >Radio</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>
													Default Value
												</td>
												<td>
													<textarea type="text" name="EF_Category_Default[<?php echo $extra_field["CategoryExtraFieldID"] ?>]" rows='2' cols='45' ><?php echo $extra_field["DefaultValue"] ?></textarea>
												</td>
											</tr>
										</table>
								
							<?php
										}
								
							?>
									</div>
								</td>
							</tr>
							
							
							<tr>
								<td colspan="10" class="form_title" align="right" >
								<input type="submit" value="Save Setting" class="submit_button" />
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

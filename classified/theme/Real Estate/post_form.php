<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<?php
	
	include ( "core/inc.meta.php" ) ;

?>

<?php
	if ( intval ( $app_init_data["IsEditorAllow"] ) )
	{
?>
<script type="text/javascript" src="<?php echo base_url ?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<?php
	}
?>
</head>
<body>
<div id="main">
	<div id="top">
		<!-- Start of HtmlPageHeader_01 -->
		<?php
			include ( "inc.header.php" ) ;
		?>
	</div>
	<div id="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td style="padding: 15px;" valign="top" width="80%">
					
					<form action="" method="post" name="go_tohead" id="form_post_ad" enctype="multipart/form-data" onSubmit="return validateForm('form_post_ad');">
						<table id="homecatgroup" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody>
								<tr>
									<td class="adKj-rm round-middle">
										<input name="Category_post_ID" value="<?php echo intval ( $sel_id ) ?>" type="hidden">
										<table class="ad-inner" border="0" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td class="ad-inner-rtl round-top-left">&nbsp;</td>
													<td class="ad-inner-rtm round-top-middle">
														<span style="font-weight: bolder;"><?php echo $lang["lang_post_form"]["str_ad_detail"] ?></span>
													</td>
													<td class="ad-inner-rtr round-top-right">&nbsp;</td>
												</tr>
												<tr>
													<td class="ad-inner-rml round-middle-left">&nbsp;</td>
													<td class="ad-inner-rm round-middle">
														<table border="0" cellpadding="5" cellspacing="0">
															<tbody>
																<tr>
																	<td> <?php echo $lang["lang_post_form"]["str_select_category"] ?> : <strong>
																		<?php 
																			
																			if ( ! empty ( $cat_path ) )
																				foreach ( $cat_path as $cat)
																				{
																					echo $cat["CategoryName"] ." &raquo; " ;
																				}
																			echo "Your Ad" ;
																		?></strong>																	</td>
																</tr>
																<tr>
																	<td class="ContentBorder">
																		
																		<?php echo $subCat["CategoryDescription"] ?>																	</td>
																</tr>
															</tbody>
														</table>
														<div id="postAdForm">
															<div class="input-row">
																<div class="first-field">
																	<div class="first-label required">
																		&nbsp;
																	</div>
																	<div class="first-input" style="padding-top: 3px;">
																		<small><?php echo $lang["lang_post_form"]["str_required"] ?></small>
																	</div>
																</div>
															</div>
															<div class="input-row">
																<div class="first-field">
																	<div formfield="label" class="first-label required">
																		<?php echo $lang["lang_post_form"]["str_ad_type"] ?>
																	</div>
																	<div class="first-input">
																		<div>
																			<ul>
																				<li>
																					<label><input name="Is_post_Offer" value="1" checked="checked" type="radio">
																					<?php echo $lang["lang_post_form"]["str_ad_type_offering"] ?>
																					&nbsp;&nbsp;<font color="#666666">- <?php echo $lang["lang_post_form"]["str_ad_type_offering_desc"] ?></font>			</label>																	</li>
																				<li>
																					<label><input name="Is_post_Offer" value="0" type="radio">
																					<?php echo $lang["lang_post_form"]["str_ad_type_want"] ?>
																					&nbsp;&nbsp;<font color="#666666">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- <?php echo $lang["lang_post_form"]["str_ad_type_want_desc"] ?></font></label>																				</li>
																			</ul>
																		</div>
																		<div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="input-row">
																<div class="first-field">
																	<div formfield="label" class="first-label required">
																		<?php echo $lang["lang_post_form"]["str_price"] ?>
																	</div>
																	<script language="javascript">
																		function enablePriceField( id_price )
																		{
																			if ( id_price == 1 )
																				$("#Price_post_").attr ( "disabled","" ) ;
																			else
																				$("#Price_post_").attr ( "disabled","disabled" ) ;
																		}
																		function validatePriceField ( )
																		{
																			var pr = $("#Price_post_").val () ;
																			for ( i=0 ; i<6 ; i++ )
																				pr = pr.replace ( ",","" ) ;
																			$("#Price_post_").val (pr) ;
																		}
																	</script>
																	<div class="first-input">
																		<div>
																			<ul>
																				<li>
																					<input name="Price_post_Alternative" value="1" checked="checked" onClick="enablePriceField(1)" type="radio">
																					<?php echo $app_init_data["CurrencySymbol"] ?>
																					<input name="Price_post_" value="" id="Price_post_" size="10" formobj="MainFormObj" onBlur="validatePriceField()" maxlength="12" type="text" >
																				</li>
																				<li>
																					<label><input name="Price_post_Alternative" value="3" onClick="enablePriceField(3)" type="radio">
																					<?php echo $lang["lang_post_form"]["str_price_free"] ?></label> </li>
																				<li>
																					<label><input name="Price_post_Alternative" value="4" onClick="enablePriceField(4)" type="radio">
																					<?php echo $lang["lang_post_form"]["str_price_contact"] ?></label> </li>
																				<li>
																					<label><input name="Price_post_Alternative" value="5" onClick="enablePriceField(5)" type="radio">
																					<?php echo $lang["lang_post_form"]["str_price_swap"] ?></label> </li>
																			</ul>
																		</div>
																		<div>
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="input-row">
																<div class="first-field">
																	<div formfield="label" class="first-label required">
																		<?php echo $lang["lang_post_form"]["str_title"] ?>
																	</div>
																	<div class="first-input">
																		<a name="Title">																		</a>
																		<div>
																			<input name="Ad_post_Title" value="" style="width: 500px;" ontitledest="en_US" maxlength="64" type="text"  sch_req="1" sch_msg="Title" >
																		</div>
																		<div>
																		</div>
																	</div>
																</div>
															</div>
															<?php
															if ( ! empty ( $extra_fields_category ) )
																foreach ( $extra_fields_category as $field )
																{
															?>
																<div class="input-row">
																	<div class="first-field">
																		<div formfield="label" class="first-label required">
																			<?php echo $field["EFName"] ?> : 
																		</div>
																		<div class="first-input">
																			
																			<div>
																			<?php
																				if ( $field["FieldType"] == "combo" )
																				{
																					$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
																					echo "<select name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."]'>" ;
																					foreach ( $str_cmb as $v_value )
																						echo "<option value='".$v_value."'>".$v_value."</option>" ;
																					echo "</select>" ;
																				}
																				else if ( $field["FieldType"] == "textarea" ) 
																				{
																			?>
																				<textarea name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 300px; height:100px" ></textarea>
																			<?php
																				}
																				else if ( $field["FieldType"] == "radio" )
																				{
																					$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
																					foreach ( $str_cmb as $v_value )
																						echo "<label><input type='radio' name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."]' value='".$v_value."' >".$v_value."</label>" ;
																				}
																				else if ( $field["FieldType"] == "check" )
																				{
																					$str_cmb = NULL ;
																					$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
																					foreach ( $str_cmb as $v_value )
																						echo "<label><input type='checkbox' name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."][]' value='".$v_value."' >".$v_value."</label>" ;
																				}
																				else
																				{
																			?>
																				<input type="text" name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 500px;" >
																			<?php
																				}
																			?>
																			</div>
																			<div>
																			</div>
																		</div>
																	</div>
																</div>
																	
															<?php
																}
																if ( ! empty ( $extra_fields ) )
																	foreach ( $extra_fields as $field )
																	{
															?>
																<div class="input-row">
																	<div class="first-field">
																		<div formfield="label" class="first-label required">
																			<?php echo $field["EFName"] ?> : 
																		</div>
																		<div class="first-input">
																			
																			<div>
																				<?php
																				if ( $field["FieldType"] == "combo" )
																				{
																					$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
																					echo "<select name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."]'>" ;
																					foreach ( $str_cmb as $v_value )
																						echo "<option value='".$v_value."'>".$v_value."</option>" ;
																					echo "</select>" ;
																				}
																				else if ( $field["FieldType"] == "textarea" ) 
																				{
																			?>
																				<textarea name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 300px; height:100px" ></textarea>
																			<?php
																				} 
																				else if ( $field["FieldType"] == "radio" )
																				{
																					$str_cmb = NULL ;
																					$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
																					foreach ( $str_cmb as $v_value )
																						echo "<label><input type='radio' name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."]' value='".$v_value."' >".$v_value."</label>" ;
																				}
																				else if ( $field["FieldType"] == "check" )
																				{
																					$str_cmb = NULL ;
																					$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
																					foreach ( $str_cmb as $v_value )
																						echo "<label><input type='checkbox' name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."][]' value='".$v_value."' >".$v_value."</label>" ;
																				}
																				else
																				{
																			?>
																				<input type="text" name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 500px;" >
																			<?php
																				}
																			?>
																			</div>
																			<div>
																			</div>
																		</div>
																	</div>
																</div>
															<?php
																}
															?>
															<div class="input-row">
																<div class="first-field">
																	<div formfield="label" class="first-label required">
																		<?php echo $lang["lang_post_form"]["str_description"] ?>
																	</div>
																	<div class="first-input">
																		<a name="Description">																		</a>
																		<div>
																		<textarea name="Description_post_" id="txtDescription" style="width:500px; height:200px;"></textarea>
																		</div>
																	</div>
																</div>
															</div>
															<div class="input-row">
															<script language="javascript">
																var total_images = 1 ;
																function add_file_field ( )
																{
																	total_images++ ;
																	if ( total_images > 7 )
																		return ;
																	var str_to_embed = '<input name="fileImage[]" size="40" style="width: 500px;" type="file" onChange="add_file_field()"><br>' ;
																	$("#image_stack").append ( str_to_embed ) ;
																}
															</script>
																<div id="imageUpload" class="first-field">
																	<div class="first-label">
																		<?php echo $lang["lang_post_form"]["str_images"] ?><br>
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
															<div class="input-row">
																<div class="first-field">
																	<div formfield="label" class="first-label required">
																		<?php echo $lang["lang_post_form"]["str_email"] ?>
																	</div>
																	<div class="first-input">
																		
																		<div>
																			<input name="Email_post_Address" value="<?php echo $_SESSION["login_member_email"] ?>" style="width: 500px;" type="text"  sch_req="1" sch_msg="Email Address" onBlur="if(this.value.indexOf('@') < 2) { alert ( 'Please provide correct email address.' ) ; this.value = '' ; }" >
																		</div>
																		<div>
																		</div>
																		<div class="help">
																			<?php echo $lang["lang_post_form"]["str_email_desc"] ?>
																		</div>
																	</div>
																</div>
															</div>
															<div class="input-row">
																<div class="first-field">
																	<div formfield="label" class="first-label">
																		<?php echo $lang["lang_post_form"]["str_address"] ?>
																	</div>
																	<div class="first-input">
																		<a name="AddressStreet">																		</a>
																		<div>
																			<input id="Address_post_Street" name="Address_post_Street" value="" style="width: 500px; color: rgb(102, 102, 102);" maxlength="65" type="text"  sch_req="1" sch_msg="Street" >
																		</div>
																		<div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="input-row">
																<div class="first-field">
																	<div formfield="label" class="first-label required">
																		&nbsp;
																	</div>
																	<div class="first-input">
																		<a name="AddressCity">																		</a>

																			<input id="Address_post_City" name="Address_post_City" style="width: 118px; color: rgb(102, 102, 102);" maxlength="65" type="text" value="City" onFocus="this.value = ''"  onBlur="if ( this.value == '' ) this.value='City'; ">
																			and
																			<input id="AddressRegion" name="Address_post_Region"  style="width: 116px; color: rgb(102, 102, 102);" maxlength="65" type="text" value="State" onFocus="this.value = ''"  onBlur="if ( this.value == '' ) this.value='State'; ">
																			OR
																			<input id="AddressZip" name="Address_post_Zip"  style="width: 80px; color: rgb(102, 102, 102);" maxlength="65" type="text"  value="Zip Code" onFocus="this.value = ''"  onBlur="if ( this.value == '' ) this.value='Zip Code'; ">
																			<select name="Address_post_Country" sch_req="1" sch_msg="Country" >
																				<option value="">--Country--</option>
																				<?php
																					$countries = $data->select ( "Country" , "*" , NULL , 0 , 500 , " CountryName" ) ;
																					if ( ! empty ( $countries ) )
																						foreach ( $countries as $country )
																							echo "<option value='".$country["CountryName"]."'>".$country["CountryName"]."</option>" ;
																				?>
																			</select>
																	</div>
																</div>
															</div>
															
															
															
															
															
															
															<div class="input-row">
																<div class="first-field">
																	<div formfield="label" class="first-label">
																		<?php echo $lang["lang_post_form"]["str_enter_code"] ?>
																	</div>
																	<div class="first-input">
																		
																		<div>
																			<img src="<?php echo base_url ?>yadcap.php?posting=1" />
																			<br />
																			<input type="text" name="capSecurity" gtbfieldid="118" size="30" sch_req="1" sch_msg="Security Code" />
																		</div>
																		<div>
																		</div>
																	</div>
																</div>
															</div>
															
														</div></td>
													<td class="ad-inner-rmr round-middle-right">&nbsp;</td>
												</tr>
												
												
												<tr>
													<td class="ad-inner-rbl round-bottom-left">&nbsp;</td>
													<td class="ad-inner-rbm round-bottom-middle" width="100%">&nbsp;</td>
													<td class="ad-inner-rbr round-bottom-right">&nbsp;</td>
												</tr>
											</tbody>
										</table>

										<table border="0" cellpadding="0" cellspacing="5" width="100%">
											<tbody>
												<tr valign="top">
													<td colspan="3" style="padding-left: 10px; padding-bottom: 5px; padding-top: 10px;" align="left"> <?php echo $lang["lang_post_form"]["str_post_instruction"] ?>. </td>
												</tr>
												<tr valign="top">
													<td colspan="3" align="left">
														<div class="postPreview">
														<input id="PostAd" value="<?php echo $lang["lang_post_form"]["str_post_button"] ?>" class="newButton" onClick="MainFormObj.submit();this.disabled=true; return false;" type="submit">
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
				
				include ( "inc.footer.php" ) ;
			?>
	</div>
	
	
</div>
</body>
</html>

<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	if ( intval ( $_GET["id"] ) < 1 )
	{
		header ( "location:classifiedlist.php" ) ;
		exit ( );
	}
	
	include_once ( "../classes/misc.func.php" ) ;
	
	
	if ( $_POST )
	{
		$arrayToSave = array ( ) ;
		foreach ( $_POST as $fieldName => $fieldValue )
		{
			if ( strchr ( $fieldName , "_post_" ) )
			{
				$fName = str_replace ( "_post_" , "" , $fieldName ) ;
				$arrayToSave[$fName] = addslashes ( $fieldValue ) ;
			}
		}
		$status = "0" ;
		$siteSettings = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "DefaultStatus" ) , 0 , 50 ) ;
		$dataArray = array ( ) ;
		foreach ( $siteSettings as $site )
		{
			if ( intval ( $site["SiteValue"] ) == 1 )
				$status = "1" ;
			else
				$status = "0" ;
		}
		$siteSettings = null ;
		
		$arrayToSave["IsActive"] = $status ;
		$data->update ( "Classified" , $arrayToSave , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
		$data->delete ( "AdExtraField" , array ( "AdID" => intval ( $_GET["id"] ) ) , 500 ) ;
			
		if ( ! empty ( $_POST["Ad_EF_Value"] ) )
		{
			foreach ( $_POST["Ad_EF_Value"] as $key => $valu )
				if ( is_array ( $_POST["Ad_EF_Value"][$key] ) )
					foreach ( $_POST["Ad_EF_Value"][$key] as $val )
						$data->insert ( "AdExtraField" , array ( "CategoryExtraFieldID" => $key , "AdExtraFieldValue" => $val , "AdID" => $_GET["id"] ) ) ;
				else
					$data->insert ( "AdExtraField" , array ( "CategoryExtraFieldID" => $key , "AdExtraFieldValue" => $valu , "AdID" => $_GET["id"] ) ) ;
		}
		//re_generate_sef_url ( $arrayToSave["AdTitle"] , $_GET["id"] , "Classified" ) ;
		$_SESSION["str_system_message"] = "Ad modified successfully." ;
		header ( "location:classifiedlist.php" ) ;
		exit();
	}
	
	
	$adDetail = $data->select ( "Classified" , "*" , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
	$classified = $adDetail[0] ;
	
	if ( intval ( $classified["AccountID"] ) != intval ( $_SESSION["login_account_id"] ) )
	{
		header ( "location:classifiedlist.php" ) ;
		exit();
	}
	
	$extra_fields_category = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryID" => intval ( $classified["CategoryID"] ) ) ) ;
	
	$extra_info = $data->select ( "AdExtraField" ,"*" , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
	
	if ( ! empty ( $extra_info ) )
	{
		foreach ( $extra_info as  $key => $e_info )
		{
			$extra_field_data = $data->select ( "CategoryExtraField" ,"*" , array ( "CategoryExtraFieldID" => intval ( $e_info["CategoryExtraFieldID"] ) ) ) ;
			$extra_info[$key]["Field_name"] = $extra_field_data[0]["EFName"] ;
		}
	}
	
	$siteSettings = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "DefaultLanguage" ) , 0 , 50 ) ;
	$dataArray = array ( ) ;
	foreach ( $siteSettings as $site )
	{
		$sitevalue[$site["SiteVariable"]] = $site["SiteValue"] ;
		include_once ( "../lang/".$site["SiteValue"] ) ;
	}
	$siteSettings = null ;
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	
	<style>
		.first-label.required
		{
			float:left;
			width:150px;
		}
		.first-input
		{
			float:left;
		}
		.input-row
		{
			margin-top:5px;
			padding: 4px;
			clear:both;
		}
	</style>
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3>
					<?php echo $adDetail["AdTitle"] ?>
				</h3>
				
				<form action="" method="post" id="form_post_ad" onSubmit="return validateForm('form_post_ad');">
						
						<div id="postAdForm">
							
							<div class="input-row">
								<div class="first-field">
									<div formfield="label" class="first-label required">
										<?php echo $lang["lang_post_form"]["str_ad_type"] ?>
									</div>
									<div class="first-input">
										<div>
											<ul>
												<li>
													<label><input name="Is_post_Offer" value="1" <?php echo intval ( $classified["IsOffer"] ) == 1 ? "checked='checked'" : "" ?> type="radio">
													<?php echo $lang["lang_post_form"]["str_ad_type_offering"] ?>
													&nbsp;&nbsp;<font color="#666666">- <?php echo $lang["lang_post_form"]["str_ad_type_offering_desc"] ?></font>			</label>																	</li>
												<li>
													<label><input name="Is_post_Offer" value="0" <?php echo intval ( $classified["IsOffer"] ) == 0 ? "checked='checked'" : "" ?> type="radio">
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
													<input name="Price_post_Alternative" value="1" onClick="enablePriceField(1)" type="radio" <?php echo intval ( $classified["PriceAlternative"] ) == 1 ? "checked='checked'" : "" ?> />
													<?php echo $app_init_data["CurrencySymbol"] ?>
													<input name="Price_post_" id="Price_post_" size="10" formobj="MainFormObj" onKeyUp="validatePriceField()" maxlength="12" type="text" <?php echo intval ( $classified["PriceAlternative"] ) == 1 ? " value='".$classified["Price"]."'" : "disabled='disabled' value=''" ?>  >
												</li>
												<li>
													<label><input name="Price_post_Alternative" value="3" <?php echo intval ( $classified["PriceAlternative"] ) == 3 ? "checked='checked'" : "" ?> onClick="enablePriceField(3)" type="radio">
													<?php echo $lang["lang_post_form"]["str_price_free"] ?></label> </li>
												<li>
													<label><input name="Price_post_Alternative" value="4" <?php echo intval ( $classified["PriceAlternative"] ) == 4 ? "checked='checked'" : "" ?> onClick="enablePriceField(4)" type="radio">
													<?php echo $lang["lang_post_form"]["str_price_contact"] ?></label> </li>
												<li>
													<label><input name="Price_post_Alternative" value="5" <?php echo intval ( $classified["PriceAlternative"] ) == 5 ? "checked='checked'" : "" ?> onClick="enablePriceField(5)" type="radio">
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
											<input name="Ad_post_Title" value="<?php echo $classified["AdTitle"] ?>" style="width: 500px;" ontitledest="en_US" maxlength="64" type="text"  sch_req="1" sch_msg="Title" >
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
									$ad_values = $data->select ( "AdExtraField" , "*" , array ( "CategoryExtraFieldID" => $field["CategoryExtraFieldID"] , "AdID" => $classified["AdID"] ) ) ;
									if ( empty ( $ad_values ) )
										continue ;
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
														if ( $ad_values[0]["AdExtraFieldValue"] == $v_value )
															echo "<option value='".$v_value."' selected='selected' >".$v_value."</option>" ;
														else
															echo "<option value='".$v_value."'>".$v_value."</option>" ;
													echo "</select>" ;
												}
												else if ( $field["FieldType"] == "textarea" ) 
												{
											?>
												<textarea name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 300px; height:100px" ><?php echo $ad_values[0]["AdExtraFieldValue"] ?></textarea>
											<?php
												}
												else if ( $field["FieldType"] == "radio" )
												{
													$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
													foreach ( $str_cmb as $v_value )
													{
														echo "<label><input type='radio' name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."]' value='".$v_value."' " ;
														foreach ( $ad_values as $ad_val )
															if ( $ad_val["AdExtraFieldValue"] == $v_value )
															{
																echo " checked='checked' " ;
																break;
															}
														echo " >".$v_value."</label>" ;
													}
												}
												else if ( $field["FieldType"] == "check" )
												{
													$str_cmb = NULL ;
													$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
													foreach ( $str_cmb as $v_value )
													{
														echo "<label><input type='checkbox' name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."][]' value='".$v_value."' " ;
														foreach ( $ad_values as $ad_val )
															if ( $ad_val["AdExtraFieldValue"] == $v_value )
															{
																echo " checked='checked' " ;
																break;
															}
														echo " >".$v_value."</label>" ;
													}
												}
												else
												{
											?>
												<input type="text" name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 500px;" value="<?php echo $ad_values[0]["AdExtraFieldValue"] ?>" >
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
										$ad_values = $data->select ( "AdExtraField" , "*" , array ( "CategoryExtraFieldID" => $field["CategoryExtraFieldID"] , "AdID" => $classified["AdID"] ) ) ;
										if ( empty ( $ad_values ) )
											continue ;
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
														if ( $ad_values[0]["AdExtraFieldValue"] == $v_value )
															echo "<option value='".$v_value."' selected='selected' >".$v_value."</option>" ;
														else
															echo "<option value='".$v_value."'>".$v_value."</option>" ;
													echo "</select>" ;
												}
												else if ( $field["FieldType"] == "textarea" ) 
												{
											?>
												<textarea name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 300px; height:100px" ><?php echo $ad_values[0]["AdExtraFieldValue"] ?></textarea>
											<?php
												} 
												else if ( $field["FieldType"] == "radio" )
												{
													$str_cmb = NULL ;
													$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
													foreach ( $str_cmb as $v_value )
													{
														echo "<label><input type='radio' name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."]' value='".$v_value."' " ;
														foreach ( $ad_values as $ad_val )
															if ( $ad_val["AdExtraFieldValue"] == $v_value )
															{
																echo " checked='checked' " ;
																break;
															}
														echo " >".$v_value."</label>" ;
													}
												}
												else if ( $field["FieldType"] == "check" )
												{
													$str_cmb = NULL ;
													$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
													foreach ( $str_cmb as $v_value )
													{
														echo "<label><input type='checkbox' name='Ad_EF_Value[".$field["CategoryExtraFieldID"]."][]' value='".$v_value."' " ;
														foreach ( $ad_values as $ad_val )
															if ( $ad_val["AdExtraFieldValue"] == $v_value )
															{
																echo " checked='checked' " ;
																break;
															}
														echo " >".$v_value."</label>" ;
													}
												}
												else
												{
											?>
												<input type="text" name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 500px;" value="<?php echo $ad_values[0]["AdExtraFieldValue"] ?>" >
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
										<textarea name="Description_post_" id="txtDescription" style="width:500px; height:200px;"><?php echo $classified["Description"] ?></textarea>
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
											<input name="Email_post_Address" value="<?php echo $classified["EmailAddress"] ?>" style="width: 500px;" type="text"  sch_req="1" sch_msg="Email Address" onBlur="if(this.value.indexOf('@') < 2) { alert ( 'Please provide correct email address.' ) ; this.value = '' ; }" >
										</div>
										<div>
										</div>
									</div>
								</div>
							</div>
							<div class="input-row">
								<div class="first-field">
									<div formfield="label" class="first-label required">
										<?php echo $lang["lang_post_form"]["str_address"] ?>
									</div>
									<div class="first-input">
										<a name="AddressStreet">																		</a>
										<div class="first-input">
											<input id="Address_post_Street" name="Address_post_Street" value="<?php echo $classified["AddressStreet"] ?>" style="width: 500px; color: rgb(102, 102, 102);" maxlength="65" type="text"  sch_req="1" sch_msg="Street" >
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

											<input id="Address_post_City" name="Address_post_City" style="width: 118px; color: rgb(102, 102, 102);" maxlength="65" type="text" value="<?php echo $classified["AddressCity"] ?>" onFocus="this.value = ''"  onBlur="if ( this.value == '' ) this.value='City'; ">
											and
											<input id="AddressRegion" name="Address_post_Region"  style="width: 116px; color: rgb(102, 102, 102);" maxlength="65" type="text" value="<?php echo $classified["AddressRegion"] ?>" onFocus="this.value = ''"  onBlur="if ( this.value == '' ) this.value='State'; ">
											OR
											<input id="AddressZip" name="Address_post_Zip"  style="width: 80px; color: rgb(102, 102, 102);" maxlength="65" type="text"  value="<?php echo $classified["AddressZip"] ?>" onFocus="this.value = ''"  onBlur="if ( this.value == '' ) this.value='Zip Code'; ">
											<select name="Address_post_Country" sch_req="1" sch_msg="Country" >
												<option value="">--Country--</option>
												<?php
													$countries = $data->select ( "Country" , "*" , NULL , 0 , 500 , " CountryName" ) ;
													if ( ! empty ( $countries ) )
														foreach ( $countries as $country )
															if ( $classified["AddressCountry"] == $country["CountryName"] )
																echo "<option value='".$country["CountryName"]."' selected='selected'>".$country["CountryName"]."</option>" ;
															else
																echo "<option value='".$country["CountryName"]."'>".$country["CountryName"]."</option>" ;
												?>
											</select>
									</div>
								</div>
							</div>
							
							
							
							<div class="input-row">
								<div class="first-field">
									<div formfield="label" class="first-label required">
										&nbsp;
									</div>
									<div class="first-input">
										<input type="submit" value="Save Ad" />
										&nbsp; 
										<input type="button" value="Cancel" onclick="window.history.back(1);" />
									</div>
								</div>
							</div>
							
						</div>
							
				</form>
			</div>
			<?php include ( "inc.footer.php" ) ; ?>
			<!-- end #container -->
		</div>
	</body>
</html>

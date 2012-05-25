<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	
	if ( $_POST )
	{
		//include ( "../classes/data_validation.php" ) ;
		if ( validate_empty ( array ( "Category_post_ID" , "Ad_post_Title" , "Email_post_Address" ) ) )
		{
			foreach ( $_POST as $key=>$val )
				if ( strchr ( $key , "_post_") )
					$postdata[str_replace ( "_post_" , "" , $key )] = $val ;
					
			$postdata["AccountID"] =  intval ( $_SESSION["login_account_id"] ) ;
			
			$postdata["CategoryStack"] = "" ;
			$postdata["SearchKeywords"] = $_POST["Ad_post_Title"]."," ;
			$category_array = array ( ) ;
			get_category_path ( intval ( $_POST["Category_post_ID"] ) , $category_array , $data ) ;
			if ( ! empty ( $category_array ) )
			{
				foreach ( $category_array as $cate )
				{
					$postdata["CategoryStack"] .= "z".$cate["CategoryID"]."Z" ;
					$postdata["SearchKeywords"] .= $cate["CategoryName"]."," ;
				}
			}
			
			$postdata["IsActive"] = intval ( $app_init_data["DefaultStatus"] ) ;
			$last_id = $data->insert ( "Classified" , $postdata ) ;
			if ( intval ( $last_id ) > 0 )
			{
				if ( ! empty ( $_FILES ) )
				{
					
					for ( $i = 0 ; $i < 8 ; $i++  )
					{
						$extension = substr ( $_FILES["fileImage"]["name"][$i] , -3 ) ;
						$extension = strtolower ( $extension ) ;
						if ( $extension == "jpg" || $extension == "gif" || $extension == "bmp" )
						{
							if ( $i == 0  )
								$file_name_onsever = "media/cls_".$last_id."_520.".$extension ;
							else
								$file_name_onsever = "media/cls_".$last_id."_".$i."_520.".$extension ;
							if ( $_FILES["fileImage"]["name"][$i] != "" )
								move_uploaded_file ( $_FILES["fileImage"]["tmp_name"][$i] , $file_name_onsever ) ;
						}
					}
				}
				if ( ! empty ( $_POST["Ad_EF_Value"] ) )
				{
					foreach ( $_POST["Ad_EF_Value"] as $key => $valu )
						$data->insert ( "AdExtraField" , array ( "CategoryExtraFieldID" => $key , "AdExtraFieldValue" => $valu , "AdID" => $last_id ) ) ;
				}
				generate_sef_url ( $_POST["Ad_post_Title"] , $last_id , "Classified" ) ;
				$_SESSION["str_system_message"] = "Thank you for your posting. Your posting will be online in next 24 hours" ;
			}
		}
		else
			$_SESSION["str_system_message"] = "Required fields are missing." ;
		
	}
	
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
				<h3> Classified AD</h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ();">
						<table cellpadding="2" cellspacing="1" width="80%">
							
							<tr>
								<td class="form_title" >&nbsp;</td>
								<td>
									<ul>
										<li>
											<label><input name="Is_post_Offer" value="1" checked="checked" type="radio">
											I am offering
											&nbsp;&nbsp;<font color="#666666">- You are offering an item for sale</font>			</label>																	</li>
										<li>
											<label><input name="Is_post_Offer" value="0" type="radio">
											I want
											&nbsp;&nbsp;<font color="#666666">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- You want to buy an item</font></label>																				</li>
									</ul>								</td>
							</tr>
							
							<tr>
								<td class="form_title" ><label for="txtSiteTitle">Price</label></td>
								<td>
									<ul>
																<li>
																	<input name="Price_post_Alternative" value="1" checked="checked" onclick="enablePriceField(1)" type="radio">
																	$
																	<input name="Price_post_" value="" id="Price_post_" size="10" formobj="MainFormObj" onkeyup="validatePriceField()" maxlength="12" type="text">
																</li>
																<li>
																	<label><input name="Price_post_Alternative" value="3" onclick="enablePriceField(3)" type="radio">
																	Free</label> </li>
																<li>
																	<label><input name="Price_post_Alternative" value="4" onclick="enablePriceField(4)" type="radio">
																	Please contact</label> </li>
																<li>
																	<label><input name="Price_post_Alternative" value="5" onclick="enablePriceField(5)" type="radio">
																	Swap / Trade</label> </li>
															</ul>								</td>
							</tr>
							<tr>
								<td class="form_title" ><label for="txtSiteTitle"> Title</label></td>
								<td><input name="Ad_post_Title" value="" style="width: 500px;" ontitledest="en_US" maxlength="64" type="text"  sch_req="1" sch_msg="Title" />																</td>
							</tr>
							
							<tr>
								<td class="form_title" ><label for="txtSiteTitle"> Category</label></td>
								<td>
									<select name="Category_post_ID" sch_req="1" sch_msg="Category" >
							<option value=""> ---- Select ---- </option>
							<?php
								$main_categories = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => NULL ) ) ;
								if ( ! empty ( $main_categories ) )
								{
									foreach ( $main_categories as $main_cat )
									{
										echo "<optgroup label='".$main_cat["CategoryName"]."'>" ;
											
										$sub_cat = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => $main_cat["CategoryID"] ) ) ;
										if ( ! empty ( $sub_cat ) )
										{
											foreach ( $sub_cat as $sub_c )
											{
												if ( intval ( $_GET["cat"] ) == intval ( $sub_c["CategoryID"] ) )
													echo "<option value='".$sub_c["CategoryID"]."' selected='selected'>".$sub_c["CategoryName"]."</option>" ;
												else
													echo "<option value='".$sub_c["CategoryID"]."'>".$sub_c["CategoryName"]."</option>" ;
											}
										}
											
										echo "</optgroup>" ;
									}
								}
							?>
						</select>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Extra Info</td>
								<td>
								
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
																if ( strchr ( $field["DefaultValue"] , "," ) )
																{
																	$str_cmb = explode ( "," , $field["DefaultValue"] ) ;
																	echo "<select name='Ad_EF_".$field["CategoryExtraFieldID"]."_Value'>" ;
																	foreach ( $str_cmb as $v_value )
																	echo "<option value='".$v_value."'>".$v_value."</option>" ;
																	echo "</select>" ;
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
																<input type="text" name="Ad_EF_Value[<?php echo $field["CategoryExtraFieldID"] ?>]" <?php echo intval ( $field["IsRequired"] ) == 1 ? "sch_req='1' sch_msg='This Field'" : "" ?> style="width: 500px;"  >
															</div>
															<div>
															</div>
														</div>
													</div>
												</div>
											<?php
												}
											?>								</td>
							</tr>
							<tr>
								<td class="form_title" >Details</td>
								<td><textarea name="Description_post_" id="txtDescription" style="width:500px; height:200px;"></textarea>
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">This email will be used to send emails, from the system.</div>								</td>
							</tr>
							
							<tr>
								<td class="form_title" >Images</td>
								<td>
								
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
											<div id="image_stack">
												<input name="fileImage[]" size="40" style="width: 500px;" type="file" onchange="add_file_field()">
											</div>																			</td>
							</tr>
							<tr>
								<td class="form_title" > Email</td>
								<td><input name="Email_post_Address" value="" style="width: 500px;" type="text"  sch_req="1" sch_msg="Email Address" >
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">This email will be used to send emails, from the system.</div>								</td>
							</tr>
							<tr>
								<td class="form_title" >Address</td>
								<td><input id="Address_post_Street" name="Address_post_Street" value="" style="width: 500px; color: rgb(102, 102, 102);" maxlength="65" type="text"  sch_req="1" sch_msg="Street" >
								<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
								<div class="div_help">This email will be used to send emails, from the system.</div>								</td>
							</tr>
							<tr>
								<td class="form_title" >Owner Email</td>
								<td>
								<input id="Address_post_City" name="Address_post_City" style="width: 218px; color: rgb(102, 102, 102);" maxlength="65" type="text" value="City" onfocus="if ( this.value == 'City' ) this.value=''; ">
								and
								<input id="AddressRegion" name="Address_post_Region"  style="width: 146px; color: rgb(102, 102, 102);" maxlength="65" type="text" value="Province" onfocus="if ( this.value == 'Province' ) this.value=''; ">
								OR
								<input id="AddressZip" name="Address_post_Zip"  style="width: 80px; color: rgb(102, 102, 102);" maxlength="65" type="text"  value="Zip Code" onfocus="if ( this.value == 'Zip Code' ) this.value=''; ">								</td>
							</tr>
							
							
							<tr>
								<td colspan="10" class="form_title" align="right" ><input type="submit" value="Save Settings" class="submit_button" />								</td>
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

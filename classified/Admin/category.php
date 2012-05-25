<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_category"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	
	$form_data = array ( ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$dataArray = $data->select ( "Category" , "*" , array ( "CategoryID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	
	
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		$postArray["Category_Setting_Name"] = validate_title_string ( $postArray["Category_Setting_Name"] ) ;
		$postArray["Price_Setting_"] = validate_decimal ( $postArray["Price_Setting_"] ) ;
		$postArray["Order_Setting_Number"] = validate_integet ( $postArray["Order_Setting_Number"] ) ;
		
		if ( intval ( $postArray["CategoryID"] > 0 ) )
		{
			$dataValues = array ( ) ;
			foreach ( $postArray as $field => $value )
			{
				if ( strchr ( $field , "_Setting_" ) )
				{
					$fName = str_replace ( "_Setting_" , "" , $field ) ;
					$dataValues[$fName] = $value ;
				}
			}
			if ( intval ( $dataValues["HeadCategoryID"] ) == 0 )
			{
				$dataValues["HeadCategoryID"] = NULL ;
			}
			$data->update ( "Category" , $dataValues , array ( "CategoryID" => $postArray["CategoryID"] ) ) ;
			
			re_generate_sef_url ( $_POST["Category_Setting_Name"] , $postArray["CategoryID"] , "Category" ) ;
			
			if ( ! empty ( $_POST["EF_Category"] ) )
			{
				foreach ( $_POST["EF_Category"] as $key => $value )
				{
					$fileds = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryExtraFieldID" => $key ) ) ;
					if ( ! empty ( $fileds ) )
					{
						if ( $value != "" )
						{
							$dataPost = array ( "EFName" => $_POST["EF_Category"][$key] , "DefaultValue"  => $_POST["EF_Category_Default"][$key] , "CategoryID"  => $postArray["CategoryID"] , "IsRequired"  => intval ( $_POST["EF_Category_required"][$key] ) , "FieldType" => $_POST["EF_Type"][$key] ) ;
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
						$dataPost = array ( "EFName" => $_POST["EF_Category"][$key] , "DefaultValue"  => $_POST["EF_Category_Default"][$key] , "CategoryID"  => $postArray["CategoryID"] , "IsRequired"  => intval ( $_POST["EF_Category_required"][$key] ) , "FieldType" => $_POST["EF_Type"][$key] ) ;
						$data->insert ( "CategoryExtraField" , $dataPost ) ;
					}
				}
			}
			if ( $_FILES["fleIcon"]["name"] != "" )
			{
				exec ( "chmod ../media/ 777" ) ;
				move_uploaded_file ( $_FILES["fleIcon"]["tmp_name"] , "../media/cls_cat_".$postArray["CategoryID"]."_5520.jpg" ) ;
				exec ( "chmod ../media/ 755" ) ;
			}
			$_SESSION["str_system_message"] = "Category modified successfully." ;
			header ( "location:catlist.php" ) ;
			exit ( ) ;
		}
		else
		{
			
			$dataValues = array ( ) ;
			if ( intval ( $postArray["Head_Setting_CategoryID"] ) == 0 )
				$postArray["Head_Setting_CategoryID"] = "" ;
			foreach ( $postArray as $field => $value )
			{
				if ( strchr ( $field , "_Setting_" ) && $value != "" )
				{
					$fName = str_replace ( "_Setting_" , "" , $field ) ;
					$dataValues[$fName] = $value ;
				}
			}
			$id = $data->insert ( "Category" , $dataValues ) ;
			if ( intval ( $id ) > 0 )
			{
				if ( ! empty ( $_POST["EF_Category"] ) )
				{
					foreach ( $_POST["EF_Category"] as $key => $value )
					{
						if ( $value != "" )
						{
							$dataPost = array ( "EFName" => $_POST["EF_Category"][$key] , "DefaultValue"  => $_POST["EF_Category_Default"][$key] , "CategoryID"  => $id , "IsRequired"  => intval ( $_POST["EF_Category_required"][$key] ) , "FieldType" => $_POST["EF_Type"][$key] ) ;
							$data->insert ( "CategoryExtraField" , $dataPost ) ;
						}
					}
				}
				generate_sef_url ( $_POST["Category_Setting_Name"] , $id , "Category" ) ;
				if ( $_FILES["fleIcon"]["name"] != "" )
				{
					exec ( "chmod ../media/ 777" ) ;
					move_uploaded_file ( $_FILES["fleIcon"]["tmp_name"] , "../media/cls_cat_".$id."_5520.jpg" ) ;
					exec ( "chmod ../media/ 755" ) ;
				}
				$_SESSION["str_system_message"] = "Category added successfully." ;
			}
			
			header ( "location:catlist.php" ) ;
			exit ( ) ;
		}
		
	}
	
	
	$siteSettings = null ;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	<style>
		#ul_categories
		{
			list-style-type:none;
			cursor:pointer;
			margin-left:18px;
			padding:5px;
			font-size:12px;
			
		}
		#ul_categories span
		{
			background-image:url(images/icons/bullet_go.png);
			background-position:left;
			background-repeat:no-repeat;
			padding-left:15px;
		}
		
	</style>
	<script language="javascript">
		var categories_crawled = new Array() ;
		var iterator = 0 ;
		function key_found ( cat_key_id )
		{
			for ( i = 0 ; i <= iterator ; i++  )
				if ( categories_crawled[i] == cat_key_id )
					return true;
			return false ;
		}
		function select_category ( cat_id , li_obj )
		{
			if ( key_found ( cat_id ) )
				return ;
			categories_crawled[++iterator] = cat_id ;
			last_selected_category_id = cat_id ;
			$("#hid_head_category").val ( cat_id ) ;
			$("#ul_categories > *").css ( { "background-color" : "#ffffff" } ) ;
			$(li_obj).css ( { "background-color" : "#D8DEE9" } ) ;
			$.getJSON ( "json.sub_categories.php?cat_id="+cat_id , function ( dat )
																			{
																				var ul_dynamic = $( "<div style='padding-left:25px;'>" ) ;
																				$.each ( dat.sub_cat , function ( ind, dataitem )
																								{
																									$("<div onclick='select_category("+dataitem.sub_cat_id+",this)'>").text(dataitem.sub_cat_name).appendTo ( ul_dynamic ) ;
																								}
																				 ) ;
																				 $(li_obj).after ( ul_dynamic ) ;
																			}
			 ) ;
		}
	</script>
	
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3> Category </h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
						<table cellpadding="2" cellspacing="1" width="70%" >
							<tr>
								<td width="24%" valign="top" class="form_title" >Category Title</td>
								<td width="76%" valign="top"><input type="text" name="Category_Setting_Name" size="50" maxlength="100" class="form_text" value="<?php echo $form_data["CategoryName"] ?>"  sch_req="1" sch_msg="Category Name"  />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										The title of the category to display on the site.
									</div></td>
							</tr>
							<tr>
								<td width="24%" valign="top" class="form_title" >SEO Title</td>
								<td width="76%" valign="top"><input type="text" name="SEO_Setting_Title" size="50" maxlength="100" class="form_text" value="<?php echo $form_data["SEOTitle"] ?>"  sch_req="1" sch_msg="SEO Title"  />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										SEO title of the category if browsed by user.
									</div></td>
							</tr>
							
							<tr>
								<td width="24%" valign="top" class="form_title" >SEO Keywords</td>
								<td width="76%" valign="top"><textarea type="text" name="SEO_Setting_Keywords"  class="form_textarea" rows="4" cols="50" ><?php echo $form_data["SEOKeywords"] ?></textarea>
								</td>
							</tr>
							<tr>
								<td width="24%" valign="top" class="form_title" >SEO Description</td>
								<td width="76%" valign="top"><textarea type="text" name="SEO_Setting_Description"  class="form_textarea" rows="4" cols="50" ><?php echo $form_data["SEODescription"] ?></textarea>
								</td>
							</tr>
							<tr>
								<td width="24%" valign="top" class="form_title" >Description</td>
								<td width="76%" valign="top"><textarea type="text" name="Category_Setting_Description"  class="form_textarea" rows="4" cols="50" ><?php echo $form_data["CategoryDescription"] ?></textarea>
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										This description will be shown to user when searching or listing is filtered to this category.
									</div>
								</td>
							</tr>
							<tr>
								<td width="24%" valign="top" class="form_title" >Top Banner</td>
								<td width="76%" valign="top"><textarea type="text" name="Top_Setting_Banner"  class="form_textarea" rows="4" cols="50" ><?php echo $form_data["TopBanner"] ?></textarea>
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										This description will be shown to user when searching or listing is filtered to this category.
									</div>
								</td>
							</tr>
							<tr>
								<td width="24%" valign="top" class="form_title" >Left Banner</td>
								<td width="76%" valign="top"><textarea type="text" name="Left_Setting_Banner"  class="form_textarea" rows="4" cols="50" ><?php echo $form_data["LeftBanner"] ?></textarea>
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										This description will be shown to user when searching or listing is filtered to this category.
									</div>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Head Category</td>
								<td>
								<?php
									if ( intval ( $form_data["CategoryID"] ) > 0 )
									{
								?>
									<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#4E3C6C">Selected : 
									<?php
										$category_path = array ( ) ;
										if ( intval ( $form_data["CategoryID"] ) > 0 )
										{
											get_category_path ( $form_data["CategoryID"] , $category_path , $data ) ;
											$category_path = array_reverse ( $category_path ) ;
											foreach ( $category_path as $cat ) 
												echo $cat["CategoryName"] . " &raquo; " ;
										}
									?>
									</span>
								<?php
									}
								?>
									<input type="hidden" name="Head_Setting_CategoryID" id="hid_head_category" value="<?php echo  intval ( $form_data["HeadCategoryID"] ) ?>" />
									
									<span id="spn_loading" style="display:none;"></span>
									
									<div id="ul_categories">
										<?php
											$categories = $data->select ( "Category" , "*" , array( "HeadCategoryID" => null ) ) ;
											if ( ! empty ( $categories ) )
												foreach ( $categories as $cat )
													echo "<span onclick='select_category(".$cat["CategoryID"].",this)'>".$cat["CategoryName"]."</span><br>" ;
										?>
										</div>
										

								</td>
							</tr>
							<tr>
								<td class="form_title" >Price</td>
								<td><input type="text" size="4" name="Price_Setting_" maxlength="6" class="form_text" value="<?php echo $form_data["Price"] ?>" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										If you want this ADs in this category to be paid, enter the Dollar amount to charge from the poster. Empty or 0.00 for free.
									</div>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Order</td>
								<td><input type="text" name="Order_Setting_Number" size="8" maxlength="6" class="form_text" value="<?php echo $form_data["OrderNumber"] ?>" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Enter the number at which this category to be displayed to the user. Maximum the number lower will be the category order.
									</div>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Icon</td>
								<td><input type="file" name="fleIcon" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										This icon will be shown to user where this Category is displayed.
									</div>
									<?php
										$file_name = "../media/cls_cat_".$form_data["CategoryID"]."_5520.jpg" ;
										if ( file_exists ( $file_name ) )
											echo "<br><img src='$file_name' />" ;
									?>
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
												Extra fields are extra info you want from user, when posting to this category. If FieldName is empty it will be ignored. Default value can be empty or anything. If comma separated then dropdown will be shown to user to select one of the comma separated value.
											</div>
										</div>
							<?php
								if ( intval ( $form_data["CategoryID"] ) > 0 )
								{
									$extra_fields = $data->select ( "CategoryExtraField" , "*", array ( "CategoryID" => intval ( $form_data["CategoryID"] ) ) , 0 , 500 ) ;
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
								}
								else
								{
							?>
										<table width="100%" style='border-bottom:#000000 solid 1px;'>
											<tr>
												<td>Field Name </td>
												<td><input type="text" name="EF_Category[]" size="40" maxlength="99" /> &nbsp;&nbsp; <label><input type="checkbox" name="EF_Category_required[]" value="1" /> Required</label></td>
											</tr>
											<tr>
												<td>
													Type
												</td>
												<td>
													<select name="EF_Type[]">
														<option value="text" >Simple Text</option>
														<option value="textarea" >Multi Line Text</option>
														<option value="combo" >Dropdown (Select)</option>
														<option value="check" >Checkbox</option>
														<option value="radio" >Radio</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>
													Default Value
												</td>
												<td>
													<textarea type="text" name="EF_Category_Default[]" rows='2' cols='45' ></textarea>
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
								<input type="hidden" name="CategoryID" value="<?php echo $form_data["CategoryID"] ?>" />
								<input type="submit" value="Save Category" class="submit_button" />
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

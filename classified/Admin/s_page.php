<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_page"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	$form_data = array ( ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$dataArray = $data->select ( "PageManager" , "*" , array ( "PageManagerID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		$postArray["Page_Setting_Name"] = validate_title_string ( $postArray["Page_Setting_Name"] ) ;
		
		if ( intval ( $postArray["PageID"] > 0 ) )
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
			$data->update ( "PageManager" , $dataValues , array ( "PageManagerID" => $postArray["PageID"] ) ) ;
			if ( $_FILES["fleIcon"]["name"] != "" )
			{
				exec ( "chmod ../media/ 777" ) ;
				move_uploaded_file ( $_FILES["fleIcon"]["tmp_name"] , "../media/cls_page_".$postArray["PageID"]."_5720.jpg" ) ;
				exec ( "chmod ../media/ 755" ) ;
			}
			$_SESSION["str_system_message"] = "Static Page modified successfully." ;
			header ( "location:s_pages.php" ) ;
			exit ( ) ;
		}
		else
		{
			
			$dataValues = array ( ) ;
			foreach ( $postArray as $field => $value )
			{
				if ( strchr ( $field , "_Setting_" ) && $value != "" )
				{
					$fName = str_replace ( "_Setting_" , "" , $field ) ;
					$dataValues[$fName] = $value ;
				}
			}
			$id = $data->insert ( "PageManager" , $dataValues ) ;
			if ( intval ( $id ) > 0 )
			{
				generate_sef_url ( $_POST["Page_Setting_Name"] , $id , "StaticPage" ) ;
				if ( $_FILES["fleIcon"]["name"] != "" )
				{
					exec ( "chmod ../media/ 777" ) ;
					move_uploaded_file ( $_FILES["fleIcon"]["tmp_name"] , "../media/cls_page_".$id."_5720.jpg" ) ;
					exec ( "chmod ../media/ 755" ) ;
				}
				$_SESSION["str_system_message"] = "Static Page added successfully." ;
			}
			
			header ( "location:s_pages.php" ) ;
			exit ( ) ;
		}
		
	}
	
	
	$siteSettings = null ;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	<script type="text/javascript" src="<?php echo base_url ?>js/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			theme : "simple"
		});
	</script>
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
	
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3> Static Page</h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
						<table cellpadding="2" cellspacing="1" width="80%">
							<tr>
								<td width="24%" valign="top" class="form_title" >Page Name</td>
								<td width="76%" valign="top"><input type="text" name="Page_Setting_Name" size="50" maxlength="100" class="form_text" value="<?php echo $form_data["PageName"] ?>"  sch_req="1" sch_msg="Category Name"  />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										The title of the category to display on the site.
									</div></td>
							</tr>
							<tr>
								<td width="24%" valign="top" class="form_title" >Text</td>
								<td width="76%" valign="top"><textarea type="text" name="Page_Setting_Contents"  class="form_textarea" style="width:550px; height:400px;" ><?php echo $form_data["PageContents"] ?></textarea>
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Text of the static page.
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
										$file_name = "../media/cls_page_".$form_data["PageManagerID"]."_5720.jpg" ;
										if ( file_exists ( $file_name ) )
											echo "<br><img src='$file_name' />" ;
									?>
								</td>
							</tr>
							<tr>
								<td class="form_title" >Include in Header</td>
								<td>
									<?php
										if ( ! empty ( $form_data ) )
										{
									?>
									<label><input type="radio" name="Include_Setting_Header" value="1" <?php echo intval ( $form_data["IncludeHeader"] ) == 1 ? "checked='checked'" : "" ?> /> YES</label>
									<label><input type="radio" name="Include_Setting_Header" value="0" <?php echo intval ( $form_data["IncludeHeader"] ) == 0 ? "checked='checked'" : "" ?> /> NO</label>
									<?php
										}
										else
										{
									?>
										<label><input type="radio" name="Include_Setting_Header" value="1" checked="checked" /> YES</label>
										<label><input type="radio" name="Include_Setting_Header" value="0" /> NO</label>
									<?php
										}
									?>
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Include this link in the Header links or not.
									</div>
									
								</td>
							</tr>
							<tr>
								<td class="form_title" >Include in Footer</td>
								<td>
									<?php
										if ( ! empty ( $form_data ) )
										{
									?>
									<label><input type="radio" name="Include_Setting_Footer" value="1" <?php echo intval ( $form_data["IncludeFooter"] ) == 1 ? "checked='checked'" : "" ?> /> YES</label>
									<label><input type="radio" name="Include_Setting_Footer" value="0" <?php echo intval ( $form_data["IncludeFooter"] ) == 0 ? "checked='checked'" : "" ?>  /> NO</label>
									<?php
										}
										else
										{
									?>
									<label><input type="radio" name="Include_Setting_Footer" value="1" checked="checked" /> YES</label>
									<label><input type="radio" name="Include_Setting_Footer" value="0" /> NO</label>
									<?php
										}
									?>
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Include this link in the Footer links or not.
									</div>
									
								</td>
							</tr>
							
							<tr>
								<td colspan="10" class="form_title" align="right" >
								<input type="hidden" name="PageID" value="<?php echo $form_data["PageManagerID"] ?>" />
								<input type="submit" value="Save Static Page" class="submit_button" />
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

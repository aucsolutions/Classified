<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_account"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	$form_data = array ( ) ;
	
	if ( intval ( $_GET["id"] ) == 1 )
	{
		$_SESSION["str_system_message"] = "Master Admin cannot be modified or deleted." ;
		header ( "location:adminlist.php" ) ;
		exit ( ) ;
	}

	if ( intval ( $_GET["id"] ) > 0 )
	{
		$dataArray = $data->select ( "Admins" , "*" , array ( "AdminID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		$postArray["Admin_Setting_Password"] = md5 ( $postArray["Admin_Setting_Password"] ) ;
		if ( intval ( $postArray["AdminID"] > 0 ) )
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
			$data->update ( "Admins" , $dataValues , array ( "AdminID" => $postArray["AdminID"] ) ) ;
			
			$_SESSION["str_system_message"] = "Administrator modified successfully." ;
			header ( "location:adminlist.php" ) ;
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
			$name_check = $data->select ( "Admins" , "*" , array ( "AdminEmail" => $_POST["Admin_Setting_Email"] ) ) ;
			if ( empty ( $name_check ) )
			{
				$id = $data->insert ( "Admins" , $dataValues ) ;
				if ( intval ( $id ) > 0 )
				{
					$_SESSION["str_system_message"] = "Administrator added successfully." ;
				}
				header ( "location:adminlist.php" ) ;
				exit ( ) ;
			}
			else
			{
				$_SESSION["str_system_message"] = "Administrator with this email already exits." ;
			}
			
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
	
	<!-- Copyright 2000, 2001, 2002, 2003 Macromedia, Inc. All rights reserved. -->
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3>Administrator</h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
						<table cellpadding="2" cellspacing="1" width="70%">
							
						<?php
							if ( intval ( $_GET["id"] ) == 0 )
							{
						?>
							
							<tr>
								<td width="24%" valign="top" class="form_title" >Email Address</td>
								<td width="76%" valign="top"><input type="text" name="Admin_Setting_Email" size="50" maxlength="100" class="form_text" value="<?php echo $form_data["AdminEmail"] ?>"  sch_req="1" sch_msg="Admin Email address"  />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Email Address of the administrator
								</div></td>
							</tr>
							<tr>
								<td width="24%" valign="top" class="form_title" >Password</td>
								<td width="76%" valign="top"><input type="text" name="Admin_Setting_Password" size="50" maxlength="100" class="form_text" value=""  sch_req="1" sch_msg="Password"  />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Password for this Administrator
									</div></td>
							</tr>
						<?php
							}
							else
							{
						?>
							<tr>
								<td width="24%" valign="top" class="form_title" >Email Address</td>
								<td width="76%" valign="top"><?php echo $form_data["AdminEmail"] ?></td>
							</tr>
						<?php
							}
						?>
							
							<tr>
								<td width="24%" valign="top" class="form_title" >&nbsp;</td>
								<td width="76%" valign="top" style="padding-left:15px;">
									<table>
										<tr>
											<td>Allow Site Management</td>
											<td>
												<label><input type="radio" name="IsSite_Setting__Manage" value="1" <?php echo intval ( $form_data["IsSite_Manage"] ) > 0 ? "checked='checked'" : "" ?> /> Yes</label>
												<label><input type="radio" name="IsSite_Setting__Manage" value="0" <?php echo intval ( $form_data["IsSite_Manage"] ) == 0 ? "checked='checked'" : "" ?> /> No</label>
											</td>
										</tr>
										<tr>
											<td>Allow Classified Ad Management</td>
											<td>
												<label><input type="radio" name="IsAd_Setting__Manage" value="1" <?php echo intval ( $form_data["IsAd_Manage"] ) > 0 ? "checked='checked'" : "" ?> /> Yes </label>
												<label><input type="radio" name="IsAd_Setting__Manage" value="0" <?php echo intval ( $form_data["IsAd_Manage"] ) == 0 ? "checked='checked'" : "" ?> /> No </label>
											</td>
										</tr>
										<tr>
											<td>Allow Account Management</td>
											<td>
												<label><input type="radio" name="IsAccount_Setting__Manage" value="1" <?php echo intval ( $form_data["IsAccount_Manage"] ) > 0 ? "checked='checked'" : "" ?> /> Yes </label>
												<label><input type="radio" name="IsAccount_Setting__Manage" value="0" <?php echo intval ( $form_data["IsAccount_Manage"] ) == 0 ? "checked='checked'" : "" ?> /> No </label>
											</td>
										</tr>
										<tr>
											<td>Allow Payment Management</td>
											<td>
												<label><input type="radio" name="IsPayment_Setting__Manage" value="1" <?php echo intval ( $form_data["IsPayment_Manage"] ) > 0 ? "checked='checked'" : "" ?> /> Yes </label>
												<label><input type="radio" name="IsPayment_Setting__Manage" value="0" <?php echo intval ( $form_data["IsPayment_Manage"] ) == 0 ? "checked='checked'" : "" ?> /> No </label>
											</td>
										</tr>
										<tr>
											<td>Allow Category Management</td>
											<td>
												<label><input type="radio" name="IsCategory_Setting__Manage" value="1" <?php echo intval ( $form_data["IsCategory_Manage"] ) > 0 ? "checked='checked'" : "" ?> /> Yes </label>
												<label><input type="radio" name="IsCategory_Setting__Manage" value="0" <?php echo intval ( $form_data["IsCategory_Manage"] ) == 0 ? "checked='checked'" : "" ?> /> No </label>
											</td>
										</tr>
										<tr>
											<td>Allow Static Page Management</td>
											<td>
												<label><input type="radio" name="IsPage_Setting__Manage" value="1" <?php echo intval ( $form_data["IsPage_Manage"] ) > 0 ? "checked='checked'" : "" ?> /> Yes </label>
												<label><input type="radio" name="IsPage_Setting__Manage" value="0" <?php echo intval ( $form_data["IsPage_Manage"] ) == 0 ? "checked='checked'" : "" ?> /> No </label>
											</td>
										</tr>
									</table>
									
								</td>
							</tr>
							
							
							<tr>
								<td colspan="10" class="form_title" align="right" >
								<input type="hidden" name="AdminID" value="<?php echo $form_data["AdminID"] ?>" />
								<input type="submit" value="Save Admin" class="submit_button" />
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

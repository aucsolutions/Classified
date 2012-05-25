<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		
		if ( $postArray["New_Password_1"] === $postArray["New_Password_2"]  )
		{
			$admin_detail = $data->select ( "Admins" , "*" , array ( "AdminPassword" => md5 ( $postArray["OLD_Password"] ) , "AdminID" => intval ( $_SESSION["login_admin_id"] ) ) ) ;
			if ( ! empty ( $admin_detail ) )
			{
				$postArray["New_Password_1"] = md5 ( $postArray["New_Password_1"] ) ;
				$data->update ( "Admins" , array ( "AdminPassword" => $postArray["New_Password_1"] ) , array ( "AdminPassword" => md5 ( $postArray["OLD_Password"] ) , "AdminID" => intval ( $_SESSION["login_admin_id"] ) ) ) ;
				
				$_SESSION["str_system_message"] = "Your admin password changed successfully." ;
				header ( "location:logout.php" ) ;
				exit ( ) ;
			}
			else
			{
				$_SESSION["str_system_message"] = "Old password not correct." ;
			}
		}
		else
		{
			$_SESSION["str_system_message"] = "New password not matched." ;
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
				<h3>Change Password</h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
						<table cellpadding="2" cellspacing="1" width="70%">
						
							<tr>
								<td width="29%" valign="top" class="form_title" >Email Address</td>
								<td width="71%" valign="top"><?php echo $_SESSION["login_admin_email"] ?></td>
							</tr>
							<tr>
								<td width="29%" valign="top" class="form_title" >Old Password</td>
								<td width="71%" valign="top"><input type="text" name="OLD_Password" size="50" maxlength="100" class="form_text" value=""  sch_req="1" sch_msg="Admin Email address"  />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Old Password
								</div></td>
							</tr>
							<tr>
								<td width="29%" valign="top" class="form_title" >New Password</td>
								<td width="71%" valign="top"><input type="text" name="New_Password_1" size="50" maxlength="100" class="form_text" value=""  sch_req="1" sch_msg="Password"  />
									
									</td>
							</tr>
							<tr>
								<td width="29%" valign="top" class="form_title" >Confirm New Password</td>
								<td width="71%" valign="top"><input type="text" name="New_Password_2" size="50" maxlength="100" class="form_text" value=""  sch_req="1" sch_msg="Password"  />
									
									</td>
							</tr>
							
							<tr>
								<td colspan="10" class="form_title" align="right" >
								<input type="submit" value="Change Password" class="submit_button" />
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

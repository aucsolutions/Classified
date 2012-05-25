<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	if ( $_POST )
	{
		$data->update ( "SiteManager" , array ( "SiteValue" => $_POST["EmailBody"] ) , array ( "SiteVariable" => $_POST["hid_email"] ) ) ;
	}
	
	switch ( $_GET["type"] )
	{
		case "confirm" :
			$email = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "ADConfirmationEmail" ) ) ;
			$email = $email[0] ;
			$field_name = "ADConfirmationEmail" ;
			break;
		case "registration" :
			$email = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "RegistrationEmail" ) ) ;
			$email = $email[0] ;
			$field_name = "RegistrationEmail" ;
			break;
		case "sendtofriend" :
			$email = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "SendToFriendEmail" ) ) ;
			$email = $email[0] ;
			$field_name = "SendToFriendEmail" ;
			break;
		default :
			header ( "location:home.php" ) ;
			break;
		
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
				<h3> Email Body </h3>
				<div align="center">
					<form class="application_form" action="" method="post" >
						<table cellpadding="2" cellspacing="1">
							<tr>
								<td class="form_title" valign="top" >Email Body </td>
								<td valign="top">
									
									<textarea name="EmailBody" rows="9" cols="70"><?php echo $email["SiteValue"] ?></textarea>
								
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Email template when sending to the users.
									</div></td>
									<td valign="top">
										<select size="10">
											<option>{SITE_URL} Site url</option>
											<option>{SITE_NAME} Site name</option>
											<option>{SITE_EMAIL} Owner Email</option>
										</select>
									</td>
							</tr>
							<tr>
								<td colspan="10" class="form_title" align="right" >
									<input type="hidden" name="hid_email" value="<?php echo $field_name ?>" />
									<input type="submit" value="Save Template" class="submit_button" />
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

<?php
	
	session_start ( ) ;
	
	if ( intval ( $_SESSION["login_admin_id"] ) > 0 )
	{
		header ( "location:home.php" ) ;
		exit ( ) ;
	}
	
	require_once ( "../config.php" ) ;
	require_once ( "../classes/manipulate.php" ) ;
	$data = new DataManipulator ( ) ;
	
	$title = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "SiteName" ) ) ;
	$title = $title[0] ;
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "inc.meta.php" ) ; ?>
<link rel="stylesheet" href="images/all.css" />
</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3>&nbsp; </h3>
    
	<div id="div_Login" class="popup" align="center" style="top:15%; z-index:105; padding: 8px; width: auto;">
		<table border="0" align="center" cellpadding="0" cellspacing="0" id="facebox">
			<tbody>
				<tr>
					<td class="tl"></td>
					<td class="b"></td>
					<td class="tr"></td>
				</tr>
				<tr>
					<td class="b"></td>
					<td class="body">
						<div style="display: block;" class="content">
							<div id="popup">
								<div id="heading">
									Admin Sign In
								</div>
								<div id="content">
									<form action="p.login.php" class="new_user"  method="post">
										<div style="margin: 0pt; padding: 0pt; display: inline;">
										</div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="19%" height="52"><label for="user_username">UserName:</label></td>
												<td colspan="2"><input id="user_username" name="txtEmailAddress" size="30" type="text" /></td>
											</tr>
											<tr>
												<td><label for="user_password">Password:</label></td>
												<td colspan="2"><input id="user_password" name="psd_password" size="30" type="password" /></td>
											</tr>
											<tr>
												<td height="49">&nbsp;</td>
												<td width="39%">
													<p style="display:none;">
														<a href="#" onclick="$('#div_Login').hide(); showScreen ( 'div_Forget_pass' ) ;">Forget Password?</a>
													</p></td>
												<td width="42%"><input id="user_submit" name="commit" value="Let me in!" type="submit" class="inputbtn" /></td>
											</tr>
											
										</table>
									</form>
								</div>
								<div style="clear: both;">
								</div>
							</div>
						</div>
						<div style="display: block;" class="footer">
							<a href="<?php echo base_url ?>" class="close" >
								<img src="../Admin/images/closelabel.gif" title="close" class="close_image">
							</a>
						</div></td>
					<td class="b"></td>
				</tr>
				<tr>
					<td class="bl"></td>
					<td class="b"></td>
					<td class="br"></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>

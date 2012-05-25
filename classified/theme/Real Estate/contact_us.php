<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- Start of HtmlPageHtmlHead -->
<!-- AreaHome -->
<?php
	
	include ( "core/inc.meta.php" ) ;

?>
</head>
<body class="js-enabled">
<div id="main" style="width: 100%;">
	<div id="top">
		<!-- Start of HtmlPageHeader_01 -->
		
		<?php
			include ( "inc.header.php" ) ;
		?>
		
		<div id="pagestatus_new" style="">
		</div>
	</div>
	<div id="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td style="padding: 15px;" valign="top" width="80%">
						<form action="" method="post" onSubmit="return validateForm();">
							
							<table>
								<tr>
									<td>
										Your Email Address:
									</td>
									<td>
										<input type="text" name="Email_Setting_Address" id="txtEmailAddress" sch_req="1" sch_msg="Email Address" value="<?php echo $_POST["Email_Setting_Address"] ?>" />
									</td>
								</tr>
								
								<tr>
									<td>
										Full Name
									:</td>
									<td>
										<input type="text" name="Full_Setting_Name" id="FullName" sch_req="1" sch_msg="Full Name" value="<?php echo $_POST["Full_Setting_Name"] ?>" />
									</td>
								</tr>
								<tr>
									<td valign="top">
										Message
									:</td>
									<td>
										<textarea name="txtMessage" rows="5" cols="65"><?php echo $_POST["txtMessage"] ?></textarea>
									</td>
								</tr>
								<tr>
									<td>&nbsp;
									</td>
									<td>
										<img src="<?php echo base_url ?>yadcap.php">
										<br>
										<input type="text" name="capSecurity">
									</td>
								</tr>
								<tr>
									<td colspan="11" align="center">
										<input type="submit" value="Send Mail" >
									</td>
								</tr>
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

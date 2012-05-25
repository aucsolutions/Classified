<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	if ( intval ( $_GET["ac_id"] ) < 1 )
	{
		header ( "location:inbox.php" ) ;
		exit();
	}
	
	$account = $data->select ( "Account" , "*" , array ( "AccountID" => $_GET["ac_id"] ) ) ;
	$account = $account[0] ;
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		$dataValues = array ( ) ;
		foreach ( $postArray as $field => $value )
		{
			if ( strchr ( $field , "_Setting_" ) )
			{
				$fName = str_replace ( "_Setting_" , "" , $field ) ;
				$dataValues[$fName] = $value ;
			}
		}
		$dataValues["ToAccountID"] = intval ( $_GET["ac_id"] ) ;
		$data->insert ( "Messages" , $dataValues ) ;
		header ( "location:inbox.php" ) ;
		exit();
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
				<h3>Private Message To <?php echo $account["FullName"] ?> </h3>
				<div align="center">
				

					<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
						<table cellpadding="2" cellspacing="1" width="70%">
						
							<tr>
								<td width="29%" valign="top" class="form_title" >Subject</td>
								<td width="71%" valign="top"><input type="text" name="Subject_Setting_" size="50" maxlength="100" class="form_text" value=""  sch_req="1" sch_msg="Name"  />
									
								</td>
							</tr>
							<tr>
								<td width="29%" valign="top" class="form_title" >Body </td>
								<td width="71%" valign="top">
								<textarea name="Body_Setting_" style="width:500px; height:300px;"></textarea>
									
								</td>
							</tr>
							
							
							
							<tr>
								<td colspan="10" class="form_title" align="right" >
								<input type="submit" value="Send Message" class="submit_button" />
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

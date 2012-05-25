<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_home"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	if ( $_POST )
	{
		foreach ( $_POST as $fieldName => $fieldValue )
		{
			if ( strchr ( $fieldName , "_Setting_" ) )
			{
				$fName = str_replace ( "_Setting_" , "" , $fieldName ) ;
				$data->update ( "SiteManager" , array ( "SiteValue" => $fieldValue ) , array ( "SiteVariable" => $fName ) ) ;
			}
			if ( $_FILES["fleLogo"]["name"] ) 
			{
				exec ( "chmod ../media/ 777" ) ;
				move_uploaded_file ( $_FILES["fleLogo"]["tmp_name"] , "../media/logo.jpg" ) ;
				exec ( "chmod ../media/ 755" ) ;
			}
		}
		$_SESSION["str_system_message"] = "Site settings saved successfully." ;
	}
	$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
	$dataArray = array ( ) ;
	foreach ( $siteSettings as $site )
		$dataArray[$site["SiteVariable"]] = $site["SiteValue"] ;
	
	$siteSettings = null ;
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
				<h3> Site Themes </h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data">
						<table cellpadding="2" cellspacing="1" width="80%">
							
							<?php
								$i = 0 ;
								$h = opendir ( "../theme/" ) ;
								while ( $f = readdir ( $h ) )
									if ( $f != "." && $f != ".." && ! strchr ( $f , "." ) )
									{
										if ( $dataArray["CurrentSkin"] == $f )
											$checked = "checked='checked'" ;
										else
											$checked = "" ;
										if ( $i % 3 == 0 )
											echo "<tr>" ;
							?>
										
											<td align="center">
												<label>
												<?php echo $f ?>
												<br />
												<img src="../theme/<?php echo $f ?>/images/theme.jpg" alt="No Image" />
												<br />
												<input type="radio" name="Current_Setting_Skin" value="<?php echo $f ?>" <?php echo $checked ?> /> </label>
											</td>
										
											
							<?php
										if ( $i++ % 3 == 2 )
											echo "</tr>" ;
									}
								closedir ( $h ) ;
									
							?>
							
							
							<tr>
								<td colspan="10" class="form_title" align="right" ><input type="submit" value="Set Selected Theme" class="submit_button" />
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

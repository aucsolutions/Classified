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
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$dataArray = $data->select ( "Country" , "*" , array ( "CountryID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		if ( intval ( $postArray["CountryID"] > 0 ) )
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
			$data->update ( "Country" , $dataValues , array ( "CountryID" => $postArray["CountryID"] ) ) ;
			
			$_SESSION["str_system_message"] = "Country modified successfully." ;
			header ( "location:country.php" ) ;
			exit();
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
			$name_check = $data->select ( "Country" , "*" , array ( "CountryName" => $_POST["Country_Setting_Name"] ) ) ;
			if ( empty ( $name_check ) )
			{
				$id = $data->insert ( "Country" , $dataValues ) ;
				if ( intval ( $id ) > 0 )
				{
					$_SESSION["str_system_message"] = "Country added successfully." ;
					header ( "location:country.php" ) ;
					exit();
				}
			}
			else
			{
				$_SESSION["str_system_message"] = "Country with this name already exits." ;
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
			<h3>Country</h3>
			<div align="center">
				<table width="95%">
					<tr>
						<td width="50%" valign="top"><form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
								<table cellpadding="2" cellspacing="1" width="98%">
									<tr>
										<td width="24%" valign="top" class="form_title" >Country</td>
										<td width="76%" valign="top"><input type="text" name="Country_Setting_Name" size="50" maxlength="100" class="form_text" value="<?php echo $form_data["CountryName"] ?>"  sch_req="1" sch_msg="Country Name"  />
											<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
											<div class="div_help">
												Country Name
											</div></td>
									</tr>
									<tr>
										<td width="24%" valign="top" class="form_title" >Abbriviation</td>
										<td width="76%" valign="top"><input type="text" name="Abbr_Setting_" size="50" maxlength="100" class="form_text" sch_req="1" sch_msg="Abbriviation" value="<?php echo $form_data["Abbr"] ?>" />
											<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
											<div class="div_help">
												Abbrivation for this country
											</div></td>
									</tr>
									<tr>
										<td width="24%" valign="top" class="form_title" >&nbsp;</td>
										<td width="76%" valign="top" style="padding-left:15px;">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="10" class="form_title" align="right" ><input type="hidden" name="CountryID" value="<?php echo $form_data["CountryID"] ?>" />
											<input type="submit" value="Save Country" class="submit_button" />
										</td>
									</tr>
								</table>
							</form></td>
							
						<td valign="top">
							<table width="100%" class="listings">
									<tr class="listing_heading">
										<th> Name </th>
										<th> Abbr </th>
										<th> Actions </th>
									</tr>
									<?php
										$i = 0 ;
										$ads = $data->select ( "Country" , "*", null , 0 , 250 ) ;
										if ( ! empty ( $ads ) )
										foreach ( $ads as $ad) :
											$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
									?>
									<tr class="<?php echo $css_class ?>">
										<td width="61%"><?php echo $ad["CountryName"] ?>
										</td>
										<td width="20%"><?php echo $ad["Abbr"] ?>
										</td>
										<td width="19%" align="center"><a href="?id=<?php echo $ad["CountryID"] ?>" title="Edit this AdSense">
												<img src="images/icons/wrench.png" border="0" alt="Edit" />
											</a>
											&nbsp;&nbsp;
											<a href="#" title="Delete AdSense" onclick="deleteAd ( <?php echo $ad["CountryID"] ?> )">
												<img src="images/icons/delete.png" border="0" alt="Delete" />
											</a>
										</td>
									</tr>
									<?php
										endforeach ;
									?>
								</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php include ( "inc.footer.php" ) ; ?>
		<!-- end #container -->
	</div>
</body>
</html>

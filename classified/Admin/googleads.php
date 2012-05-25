<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_home"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	$form_data = array ( ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$dataArray = $data->select ( "MarketingAdManager" , "*" , array ( "MarketingAdID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		if ( intval ( $postArray["MarketingAdID"] > 0 ) )
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
			$id = $data->update ( "MarketingAdManager" , $dataValues , array ( "MarketingAdID" => $postArray["MarketingAdID"] ) ) ;
			$_SESSION["str_system_message"] = "Ad-Sense updated successfully." ;
		}
		else
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
			$id = $data->insert ( "MarketingAdManager" , $dataValues ) ;
			if ( intval ( $id ) > 0 )
				$_SESSION["str_system_message"] = "Ad-Sense added successfully." ;
		}
		
	}
	
	
	$siteSettings = null ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	<script language="javascript">
		function deleteAd ( ad_id )
		{
			if ( parseInt ( ad_id ) )
				if ( window.confirm ( "Are you sure you want to delete this ad?" ) )
					window.location = "p.del_g_ad.php?id="+ad_id ;
		}
	</script>
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3> Banners Management </h3>
				<div align="center">
					<table width="100%">
						<tr>
							<td width="50%" valign="top"><form class="application_form" action="" method="post" onsubmit="return  validateForm ( ) ;">
									<table cellpadding="2" cellspacing="1" width="100%">
										<tr>
											<td width="36%" valign="top" class="form_title" > Banner Code</td>
											<td width="64%" valign="top"><textarea name="Marketing_Setting_Script" cols="50" rows="7" class="form_textarea" id="txtDescription" sch_req="1" sch_msg="AdSense Code" ><?php echo $form_data["MarketingScript"] ?></textarea>
												<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
												<div class="div_help">
													The google AdSense to display where you want to be selected.
												</div></td>
										</tr>
										<tr>
											<td class="form_title" >Placing</td>
											<td><select name="Marketing_Setting_Placing" size="10" class="form_select" sch_req="1" sch_msg="Placing">
													<option <?php echo $form_data["MarketingPlacing"] == "Home Top" ? "selected='selected'": "" ?> >Home Top</option>
													<option <?php echo $form_data["MarketingPlacing"] == "Home Bottom" ? "selected='selected'": "" ?>>Home Bottom</option>
													<option <?php echo $form_data["MarketingPlacing"] == "Home Right" ? "selected='selected'": "" ?>>Home Right</option>
													<option <?php echo $form_data["MarketingPlacing"] == "Listing Top" ? "selected='selected'": "" ?>>Listing Top</option>
													<option <?php echo $form_data["MarketingPlacing"] == "Listing Bottom" ? "selected='selected'": "" ?>>Listing Bottom</option>
													<option <?php echo $form_data["MarketingPlacing"] == "Listing Left" ? "selected='selected'": "" ?>>Listing Left</option>
													<option <?php echo $form_data["MarketingPlacing"] == "Detail Top" ? "selected='selected'": "" ?>>Detail Top</option>
													<option <?php echo $form_data["MarketingPlacing"] == "Detail Right" ? "selected='selected'": "" ?>>Detail Right</option>
													<option <?php echo $form_data["MarketingPlacing"] == "Detail Bottom" ? "selected='selected'": "" ?>>Detail Bottom</option>
													
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="10" class="form_title" align="right" ><input type="hidden" name="MarketingAdID" value="<?php echo $form_data["MarketingAdID"] ?>" />
												<input type="submit" value="Save Banner" class="submit_button" />
											</td>
										</tr>
									</table>
								</form></td>
							<td valign="top"><table width="100%" class="listings">
									<tr class="listing_heading">
										<th> ID </th>
										<th> Place </th>
										<th> Actions </th>
									</tr>
									<?php
										$i = 0 ;
										$ads = $data->select ( "MarketingAdManager" , "*", null , 0 , 250 ) ;
										if ( ! empty ( $ads ) )
										foreach ( $ads as $ad) :
											$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
									?>
									<tr class="<?php echo $css_class ?>">
										<td width="21%"><?php echo $ad["MarketingAdID"] ?>
										</td>
										<td width="60%"><?php echo $ad["MarketingPlacing"] ?>
										</td>
										<td width="19%" align="center"><a href="?id=<?php echo $ad["MarketingAdID"] ?>" title="Edit this AdSense">
												<img src="images/icons/wrench.png" border="0" alt="Edit" />
											</a>
											&nbsp;&nbsp;
											<a href="#" title="Delete AdSense" onclick="deleteAd ( <?php echo $ad["MarketingAdID"] ?> )">
												<img src="images/icons/delete.png" border="0" alt="Delete" />
											</a>
										</td>
									</tr>
									<?php
										endforeach ;
									?>
								</table></td>
						</tr>
					</table>
				</div>
			</div>
			<?php include ( "inc.footer.php" ) ; ?>
			<!-- end #container -->
		</div>
	</body>
</html>

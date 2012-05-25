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
		}
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
				<h3> Listings Management </h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data">
						<table cellpadding="2" cellspacing="1" width="70%">
							<tr>
								<td width="34%" valign="top" class="form_title" >Recent ADs (Main Page)</td>
								<td width="66%" valign="top"><input type="text" name="Recent_Setting_AdsMainPage" cols="30" rows="3" class="form_textarea" id="txtDescription" value="<?php echo $dataArray["RecentAdsMainPage"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Number of recently approved ADs on main page.
									</div></td>
							</tr>
							<tr>
								<td class="form_title" valign="top" >Recent ADs (Listing Page)</td>
								<td valign="top"><input type="text" name="Recent_Setting_AdsMainListingPage" cols="30" rows="3" class="form_textarea" id="txtDescription" value="<?php echo $dataArray["RecentAdsMainListingPage"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Maximum Recently approved ADs on listing page.
									</div></td>
							</tr>
							<tr>
								<td class="form_title" valign="top" >Sponsored ADs (Main Page)</td>
								<td valign="top"><input type="text" name="Sponsored_Setting_AdsMainPage" cols="30" rows="3" class="form_textarea" id="txtDescription"  value="<?php echo $dataArray["SponsoredAdsMainPage"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Maximum Sponsored ADs on Main page.
									</div></td>
							</tr>
							<tr>
								<td class="form_title" valign="top" >Sponsored ADs (Listing Page)</td>
								<td valign="top"><input type="text" name="Sponsored_Setting_AdsListingPage" cols="30" rows="3" class="form_textarea" id="txtDescription"  value="<?php echo $dataArray["SponsoredAdsListingPage"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Maximum Sponsored ADs on listing page.
									</div></td>
							</tr>
							<tr>
								<td class="form_title" valign="top" >Maximum Listings (Per Page)</td>
								<td valign="top"><input type="text" name="Max_Setting_ListingsPerPage" cols="30" rows="3" class="form_textarea" id="txtDescription"  value="<?php echo $dataArray["MaxListingsPerPage"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Number of Listings on per page.
									</div></td>
							</tr>
							<tr>
								<td class="form_title" >Default Listing View</td>
								<td><label>
									<input name="DefaultView_Setting_Gallery" value="1" type="radio" <?php echo intval ( $dataArray["DefaultViewGallery"] ) == 1 ? "checked='checked'" : "" ?> />
									<img src="images/icons/picture.png" />
									
									Gallery</label>
									<span style="color:#7F7F7F; font-size:12px;">If you want ADs listing to be view as Gallery by default.</span>
									<br />
									<label>
									<input name="DefaultView_Setting_Gallery" value="0" type="radio" <?php echo intval ( $dataArray["DefaultViewGallery"] ) == 0 ? "checked='checked'" : "" ?> />
									<img src="images/icons/application_view_tile.png" />
									List </label>
									<span style="color:#7F7F7F; font-size:12px;">If you want ADs listing to be view as List by default.</span>
								</td>
							</tr>
							<tr>
								<td colspan="10" class="form_title" align="right" >
									<input type="submit" value="Save Listing Settings" class="submit_button" />
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

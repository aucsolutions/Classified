<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	if ( intval ( $_GET["id"] ) < 1 )
	{
		header ( "location:classifiedlist.php" ) ;
		exit ( );
	}
	
	include_once ( "../classes/misc.func.php" ) ;
	
	$adDetail = $data->select ( "Classified" , "*" , array ( "AdID" => intval ( $_GET["id"] ) , "AccountID" => $_SESSION["login_account_id"] ) ) ;
	$adDetail = $adDetail[0] ;
	
	
	if ( intval ( $adDetail["CategoryID"] ) > 0 )
	{
		$category_path_array = array ( ) ;
		get_category_path ( intval ( $adDetail["CategoryID"] ) , $category_path_array , $data ) ;
		
		$category_path_array = array_reverse ( $category_path_array ) ;
	}
	
	
	
	$extra_info = $data->select ( "AdExtraField" ,"*" , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
	
	if ( ! empty ( $extra_info ) )
	{
		foreach ( $extra_info as  $key => $e_info )
		{
			$extra_field_data = $data->select ( "CategoryExtraField" ,"*" , array ( "CategoryExtraFieldID" => intval ( $e_info["CategoryExtraFieldID"] ) ) ) ;
			$extra_info[$key]["Field_name"] = $extra_field_data[0]["EFName"] ;
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
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $dataArray["GoogleMapKey"] ?>" type="text/javascript"></script>
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3>
					<?php echo $adDetail["AdTitle"] ?>
				</h3>
				<div align="left">
					<?php
						echo "Home" ;
						if ( ! empty ( $category_path_array ) )
							foreach ( $category_path_array as $cats )
								echo " &raquo; ".$cats["CategoryName"] ;
					?>
				</div>
				<form action="p.ads.php" method="post">
					<table width="100%" class="detail">
						<tr>
							<td width="56%">
						<div>
									<?php
							$image_Name = "../media/cls_".$adDetail["AdID"]."_520.jpg" ;
							if ( file_exists ( $image_Name ) )
								echo "<img id='img_main' src='classified_img.php?path=$image_Name&full=1' alt='No Image'>" ;
						?>
									<div>
										<?php
									for ( $i = 1 ; $i <= 5 ; $i++ )
									{
										$image_Name = "../media/cls_".$adDetail["AdID"]."_".$i."_520.jpg" ;
										if ( file_exists ( $image_Name ) )
											echo "<img src='classified_img.php?path=$image_Name' alt='No Image'>" ;
									}
								?>
									</div>
								</div></td>
							<td width="44%" valign="top" style="font-size:13px;"><span style="color:#7B3C3E">Posted By :
								<a href="mailto:<?php echo $adDetail["EmailAddress"] ?>">
									<?php echo $adDetail["EmailAddress"] ?>
								</a>
								</span>
								<br />
								<span style="color:#4B6F42">Posted On : <?php echo date( "F j, Y" , strtotime ( $adDetail["DateAdded"] ) ) ?></span>
								<br />
								<br />
								Type : <?php echo intval ( $adDetail["IsOffer"] ) == 1 ? "Offer" : "Wants" ?>
								<br />
								Price : <strong style="color:#652C2D; font-size:14px">$<?php echo number_format ( $adDetail["Price"] ) ?></strong>
								<br />
								
								<table cellpadding="2" cellspacing="0" style="border:#BFBFBF solid 1px; font-size:14px;">
											<?php
												if ( ! empty ( $extra_info ) )
												{
													foreach ( $extra_info as $fild )
													{
											?>
												<tr>
													<td style="color:#959595;"> 
														<?php echo $fild["Field_name"] ?>
													</td>
													<td style="color:#292929;">
														<?php echo $fild["AdExtraFieldValue"] ?>
													</td>
												</tr>
											<?php
													}
												}
											?>
											</table>
								
								<div style="padding:3px; margin:2px; color:#1F1F1F">
									Address
									<address style="font-weight:bold;">
									<?php echo $adDetail["AddressStreet"] .", ". $adDetail["AddressCity"] .", ". $adDetail["AddressRegion"] .", ". $adDetail["AddressZip"] ?>
									</address>
									<br />
									
									
									<script type="text/javascript">
    					
										var map = new GMap2(document.getElementById("divMapShowingArea"));
										
										function initialize()
										{
											if (GBrowserIsCompatible())
											{
												
												map.setCenter(new GLatLng(43.798590, -80.244141), 3);
												
												map.setUIToDefault();
												map.enableGoogleBar();
				
												setProperty ( <?php echo $adDetail["GoogleLatitude"] ?> , <?php echo $adDetail["GoogleLongitude"] ?> , '<?php echo $adDetail["AddressStreet"] .", ". $adDetail["AddressCity"] .", ". $adDetail["AddressRegion"] .", ". $adDetail["AddressZip"] ?>', 'Ad Location' );
											}
										}
										
										function setProperty ( strLat , strLong , address, description )
										{
											var blueIcon = new GIcon(G_DEFAULT_ICON);
											if ( parseInt ( isSold ) == 0 )
												blueIcon.image = "http://www.agentlane.ca/images/green.png";
											else
												blueIcon.image = "http://www.agentlane.ca/images/red.png";
											
											//markerOptions = { icon:blueIcon };
				
											map.setCenter(new GLatLng ( strLat, strLong ) , 3 ) ;
											var latlng = new GLatLng ( strLat, strLong ) ;
											if ( isSold == 0 )
												var marker = new GMarker ( latlng , markerOptions ) ;
											else
												var marker = new GMarker ( latlng , markerOptions ) ;
											GEvent.addListener ( marker, "click", function()
																					{
																						marker.openInfoWindowHtml("<h2>"+address+"</h2><div>"+description+"<br>"+agentAddress+"</div>");
																					}
																);
				
											map.addOverlay ( marker ) ;
										}
										
										initialize ( ) ;
										
									</script>
									
									<br />
									Visits : <?php echo intval ( $adDetail["Views"] ) ?>
									<br />
									# of times Contacted : <?php echo intval ( $adDetail["Replies"] ) ?>
								</div>
								<br />
								<div >
								<script language="javascript">
									function deleteAd ( ad_id )
									{
										if ( parseInt ( ad_id ) > 0 )
											if ( window.confirm ( "Are you sure you want to delete this ad" ) )
											{
												window.location = "p.delete_classified.php?id="+ad_id ;
											}
									}
								</script>
									<a href="#" onclick="deleteAd ( <?php echo intval ( $adDetail["AdID"] ) ?> ) ;" title="Delete Ad" style="text-decoration:none; background-color:#8B3032; vertical-align:middle; border:#000000 solid 1px; padding:4px; margin:3px; color:#FFFFFF;">
										<img src="../Admin/images/icons/delete.png" border="0" alt="Delete" />
										Delete This Classified
									</a>
									<br />

								</div></td>
						</tr>
						<tr>
							<td valign="top" colspan="100"><?php echo $adDetail["Description"] ?>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<?php include ( "inc.footer.php" ) ; ?>
			<!-- end #container -->
		</div>
	</body>
</html>

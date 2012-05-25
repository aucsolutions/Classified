<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<!-- Start of HtmlPageHtmlHead -->
	<!-- AreaHome -->
<?php
	$meta_title = $classified["AdTitle"] ;
	include ( "core/inc.meta.php" ) ;
	
	if ( strlen ( $app_init_data["GoogleMapKey"] ) > 5 )
	{
?>
<script src="http://maps.google.com/maps?file=api&v=2&key=<?php echo $app_init_data["GoogleMapKey"] ?>" type="text/javascript"></script>
<?php
	}
?>
	
	</head>
	
	<body>
		

		<div id="div_SendToFriend" style="display:none; top:15%;  z-index:105; position:fixed; padding: 8px; width: 400px;">
			
			<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/tl.png); background-repeat:no-repeat; width:20px; height:20px;"></td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/top.png); background-repeat:repeat-x; height:20px;" ></td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/tr.png); background-repeat:no-repeat; width:20px; height:20px;"></td>
		</tr>
		
		<tr>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/left.png); background-repeat:repeat-y; width:20px;"></td>
			<td style="background-color:#FFFFFF;" >
			
			
				<div align="right" style="">
				<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/delete.png" style="cursor:pointer;" onClick="close_window('div_SendToFriend')" />
			</div>
				<form action="<?php echo base_url ?>p.send_to_friend.php" method="post" onSubmit="return validateForm ( ) ; ">
			<input type="hidden" name="ClassifiedID" value="<?php echo $classified["AdID"] ?>">
			<table width="100%">
				<tr>
					<td align="right" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold">Your Name</td>
					<td>
						<input type="text" name="FullName" id="txtFullName" style="border:#3B3B3B solid 1px;"  sch_req="1" sch_msg="Your Name"  />
					</td>
				</tr>
				<tr>
					<td align="right" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold"> Your Email Address</td>
					<td>
						<input type="text" name="EmailAddress" id="txtEmailAddress" style="border:#3B3B3B solid 1px;"  sch_req="1" sch_msg="Your Email"  />
					</td>
				</tr>
				<tr>
					<td align="right" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold">Friends Name</td>
					<td>
						<input type="text" name="FName" id="txtFName" style="border:#3B3B3B solid 1px;"  sch_req="1" sch_msg="Password"  />
					</td>
				</tr>
				<tr>
					<td align="right" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold">Friend's Email</td>
					<td>
						<input type="text" name="FEmail" id="txtFEmail" style="border:#3B3B3B solid 1px;"  sch_req="1" sch_msg="Confirm Password"  />
					</td>
				</tr>
				
				<tr>
					<td colspan="100" align="center">
						<input type="submit" value="Send To My Friend"  style="border:#3B3B3B solid 1px; background-color:#BCBCBC; color:#000000; font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; "  />
					</td>
				</tr>
			</table>
			</form>
			
			
			</td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/right.png); background-repeat:repeat-y; width:20px;"></td>
		</tr>
		
		
		<tr>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/bl.png); background-repeat:no-repeat; width:20px; height:20px;"></td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/bottom.png); background-repeat:repeat-x; height:20px;" ></td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/br.png); background-repeat:no-repeat; width:20px; height:20px;"></td>
		</tr>
	</table>
			
		</div>
		
		
		<div id="div_image_zoom" style="display:none; top:15%;  z-index:105; position:fixed; padding: 8px; width: auto;">
			
			<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/tl.png); background-repeat:no-repeat; width:20px; height:20px;"></td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/top.png); background-repeat:repeat-x; height:20px;" ></td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/tr.png); background-repeat:no-repeat; width:20px; height:20px;"></td>
		</tr>
		
		<tr>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/left.png); background-repeat:repeat-y; width:20px;"></td>
			<td style="background-color:#FFFFFF;" align="center" >
			
			
				<div align="right" style="">
					<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/delete.png" style="cursor:pointer;" onClick="close_window('div_image_zoom')" />
				</div>
				
				<img src="" border="0" style="" id="img_zoom" />
				
			
			
			</td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/right.png); background-repeat:repeat-y; width:20px;"></td>
		</tr>
		
		
		<tr>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/bl.png); background-repeat:no-repeat; width:20px; height:20px;"></td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/bottom.png); background-repeat:repeat-x; height:20px;" ></td>
			<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/br.png); background-repeat:no-repeat; width:20px; height:20px;"></td>
		</tr>
	</table>
			
		</div>
		
		
		<div id="container">
			
		<?php
			include ( "inc.header.php" ) ;
		?>
			<div id="middle" style="padding-left:10px; padding-right:10px; padding-top:15px; padding-bottom:10px; background-color:#FFFFFF;">
				
				<table valign="top" border="0" width="100%">
					<tbody>
						<?php
							if ( ! empty ( $category_path_array ) )
							{
						?>
						<tr>
							<td align="left">
								 <?php
								 	echo "<a href='".base_url."'>".$app_init_data["SiteTitle"]."</a>" ;
									foreach ( $category_path_array as $cat_path )
										echo " &raquo; <a href='".base_url."category/".get_sef_url($cat_path["CategoryID"],"Category")."/'>".$cat_path["CategoryName"]."</a>" ;
								 ?>
								 	&raquo; <?php echo $lang["lang_map_detail"]["str_ad_id"] ?> <?php echo $classified["AdID"] ?> 
							</td>
							<td align="right">
								<a href="<?php echo base_url ?>c-CategorySelect/<?php echo intval ( $classified["CategoryID"] ) ?>/"> <img style="vertical-align: middle; position: relative; left: -5px;" src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/post_a_classified_ad.gif" border="0"> <?php echo $lang["lang_map_detail"]["str_post_ad_category"] ?></a> &nbsp;
							</td>
						</tr>
						<?php
							}
						?>
						<tr>
							<td colspan="10" align="center">
								<?php
									$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Detail Top" ) ) ;
									if ( ! empty ( $g_ads ) )
										foreach ( $g_ads as $g_ad )
											echo $g_ad["MarketingScript"] ;
								?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid rgb(192, 192, 192);" align="left" valign="bottom"><div id="viewAd-header">
									<div id="viewAd-header-content">
										<div>
											<h1 id="preview-local-title"><?php echo $classified["AdTitle"] ?></h1>
										</div>
									</div>
								</div></td>
							<td align="right" style="border-bottom: 1px solid rgb(192, 192, 192);">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td colspan="100" align="left">
								<a href="<?php echo base_url.get_sef_url ( $classified["AdID"] , "Classified" ) ; ?>/"> <?php echo $lang["lang_map_detail"]["str_back_to_detail"] ?></a>
								
								<br><br>
								<br>


								<div id="mapit" style="width:95%; height:400px; margin-left:10px; margin-top:15px;">
								
								</div>
								<script type="text/javascript">
    					
												var map = new GMap2(document.getElementById("mapit"));
												
												var geocoder = new GClientGeocoder();
												map.setUIToDefault();
												function showAddress(address)
												{
												  geocoder.getLatLng ( address,	function(point)
												  								{
																				  if (!point)
																				  {
																					alert(address + " not found");
																				  }
																				  else
																				  {
																					map.setCenter(point, 16);
																					var marker = new GMarker(point);
																					map.addOverlay(marker);
																					marker.openInfoWindowHtml("<strong>Address : </strong><br>"+address+"<br><a href='http://maps.google.com/maps?daddr="+address+"&hl=en' target='_blank'>View Directions</a>");
																				  }
																				}
												  					);
												}
												
												showAddress ( '<?php echo $classified["AddressStreet"].", ".$classified["AddressCity"].", ".$classified["AddressRegion"].", ".$classified["AddressCountry"] ?>' ) ;
										
									</script>
							
							</td>
						</tr>
						<tr>
							<td style="padding-top: 20px;" align="left" valign="top"><br>
								<div align="left" style="margin:4px;">
					<?php
					$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Detail Bottom" ) ) ;
					if ( ! empty ( $g_ads ) )
						foreach ( $g_ads as $g_ad )
							echo $g_ad["MarketingScript"] ;
					?>
					</div>
								
							</td>
							
						</tr>
						
					</tbody>
				</table>
				<br>
					
				<?php
				
				include ( "inc.footer.php" ) ;
			?>
			</div>
			
		</div>
	</body>
</html>
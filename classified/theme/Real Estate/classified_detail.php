<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- Start of HtmlPageHtmlHead -->
<!-- AreaHome -->
<?php

	include ( "core/inc.meta.php" ) ;
if ( strlen ( $app_init_data["GoogleMapKey"] ) > 5 )
	{
?>
<script src="http://maps.google.com/maps?file=api&v=2&key=<?php echo $app_init_data["GoogleMapKey"] ?>" type="text/javascript"></script>
<?php
	}
?>
<script language="javascript">
		var selected_image_number = 0 ;
		function zoom_image (  )
		{
			if ( selected_image_number == 0 )
				var img_src = "<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=full" ;
			else
				var img_src = "<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=full&imgnum="+selected_image_number ;

			var zom_img = new Image ;
			zom_img.src = img_src ;
			$("#spn_loading").show();
			zom_img.onload = function ( )
								{
									$("#img_zoom").attr("src", img_src ) ;
									showScreen ( 'div_image_zoom' ) ;
									$("#spn_loading").hide();
								} ;
			
		}
		function select_image ( image_number )
		{
			selected_image_number = image_number ;
			$("#spn_loading").show();
			var img_src = "<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=1&thumb=5&imgnum="+image_number ;
			var zom_img = new Image ;
			zom_img.src = img_src ;
			$("#spn_loading").show();
			zom_img.onload = function ( )
								{
									$("#main_image").attr("src", img_src ) ;
									$("#spn_loading").hide();
								} ;
		}
		 
		function next_image ( )
		{
			if ( current_image < total_images )
				select_image ( ++current_image ) ;
		}
		
		function prev_image ( )
		{
			if ( current_image > 1 )
				select_image ( --current_image ) ;
			if ( current_image == 0 )
				select_image ( 0 ) ;
		}
		
	</script>
</head>
<body>
	<div id="div_SendToFriend" class="popup" style="display:none; top:15%;  z-index:105; position:fixed; padding: 8px; width: auto;">
		
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
									Send to Friend
								</div>
								<div id="content">
									<form action="<?php echo base_url ?>p.send_to_friend.php" class="new_user" id="new_user" method="post">
										<input type="hidden" name="ClassifiedID" value="<?php echo $classified["AdID"] ?>">
										<div style="margin: 0pt; padding: 0pt; display: inline;">
										</div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="30%" height="35"><label for="user_username">Your Name:</label></td>
												<td><input name="FullName" type="text" id="txtFullName" size="30" gtbfieldid="116" sch_req="1" sch_msg="Your Name" /></td>
											</tr>
											<tr>
												<td height="35"><label for="user_password">Email:</label></td>
												<td><input name="EmailAddress" type="text" id="txtEmailAddress" size="30" gtbfieldid="117" sch_req="1" sch_msg="Your Email" /></td>
											</tr>
											<tr>
												<td width="30%" height="35"><label for="user_username">Friends Name:</label></td>
												<td><input name="FName" type="text" id="fName" size="30" sch_req="1" sch_msg="Friends Name" /></td>
											</tr>
											<tr>
												<td height="35"><label for="user_password">Friend's Email:</label></td>
												<td><input name="FEmail" type="text" id="fEmail" size="30" sch_req="1" sch_msg="Friends Email" /></td>
											</tr>
											
											<tr>
												<td height="49">&nbsp;</td>
												<td><input id="user_submit" name="commit" value="Send to Friend" type="submit" class="inputbtn" /></td>
											</tr>
											<tr>
											</tr>
										</table>
									</form>
								</div>
								<div style="clear: both;">
								</div>
							</div>
						</div>
						<div style="display: block;" class="footer">
							<a href="#" class="close"  onclick="close_window('div_SendToFriend')">
								<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closelabel.gif" title="close" class="close_image">
							</a>
						</div>
						
					</td>
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
	<div id="div_image_zoom" style="display:none; top:15%;  z-index:105; position:fixed; padding: 8px; width: auto;">
	
		
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
									Zoom
								</div>
								<div id="content">
									<img src="" border="0" style="" id="img_zoom" />
								</div>
								<div style="clear: both;">
								</div>
							</div>
						</div>
						<div style="display: block;" class="footer">
							<a href="#" class="close"  onclick="close_window('div_image_zoom')">
								<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closelabel.gif" title="close" class="close_image">
							</a>
						</div>
						
					</td>
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
	<div id="main">
		<div id="top">
			<!-- Start of HtmlPageHeader_01 -->
			<?php
			include ( "inc.header.php" ) ;
		?>
			<div id="pagestatus_new" style="">
			</div>
		</div>
		<div id="middle" style="padding-left:10px; padding-right:10px; padding-top:15px; padding-bottom:10px;">
			
		
			
			<table valign="top" border="0" width="100%">
				<tbody>
					<?php
							if ( ! empty ( $category_path_array ) )
							{
						?>
					<tr>
						<td align="left">
							<div class="category_path">
							<?php
								 	echo "<a href='".base_url."'>".$app_init_data["SiteTitle"]."</a>" ;
									foreach ( $category_path_array as $cat_path )
										echo " &raquo; <a href='".base_url."category/".get_sef_url($cat_path["CategoryID"],"Category")."/'>".$cat_path["CategoryName"]."</a>" ;
								 ?>
							&raquo; <?php echo $lang["lang_detail"]["str_ad_id"] ?> <?php echo $classified["AdID"] ?>
							</div>
						</td>
						<td align="right"><a href="<?php echo base_url ?>c-CategorySelect/<?php echo intval ( $classified["CategoryID"] ) ?>/">
								<img style="vertical-align: middle; position: relative; left: -5px;" src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/post_a_classified_ad.gif" border="0">
								<?php echo $lang["lang_detail"]["str_post_ad_category"] ?></a>
							&nbsp; </td>
					</tr>
					<?php
							}
						?>
					<tr>
						<td colspan="10" align="center"><?php
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
										<h1 id="preview-local-title"><?php echo (intval ( $classified["IsOffer"] ) == 0 ? "Wanted:":""). $classified["AdTitle"] ?></h1>
									</div>
								</div>
							</div></td>
						<td align="right" style="border-bottom: 1px solid rgb(192, 192, 192);"><table>
								<tr>
									<!--<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/share.gif); background-repeat:no-repeat; background-position:left; padding-left:17px;" ><a href="#" onClick="showScreen ( 'div_SendToFriend' ) ;">Share</a></td>-->
									<td>
										<!-- AddThis Button BEGIN -->
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&pub=xa-4afe640357965f22"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub=xa-4afe640357965f22"></script>
<!-- AddThis Button END -->

									</td>
									<td align="center" style="font-size:12px; color:#959595;">&nbsp;&nbsp; | &nbsp;&nbsp;</td>
									<td style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/print.gif); background-repeat:no-repeat; background-position:left; padding-left:17px;"><a href="<?php echo base_url ?>c-PrintAd/<?php echo $classified["AdID"] ?>/">
									<?php echo $lang["lang_detail"]["str_print"] ?> 
									</a></td>
								</tr>
							</table></td>
					</tr>
					<tr>
						<td style="padding-top: 20px;" align="left" valign="top">
						<table id="Images" border="0" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
											<table class="detail_gallery">
												<tr>
													<td style="padding-right: 5px;" valign="top"><div style=" padding:8px; width:310px;">
												<br>
												<div class="gallery" align="center" >
													<table border="0" cellpadding="0" cellspacing="0">
														<tbody>
															<tr>
																<td class="imageStack"><img id="main_image" src="<?php echo base_url ; ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=1&thumb=5" border="0" alt="No Image" />
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<br>
												<div align="center"><span id="spn_loading" style="display:none">
												<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/loader.gif">
												</span>
												</div>
												<br>
												<center>
													<table class="img-next-prev" border="0" cellpadding="0" cellspacing="0">
														<tbody>
															<tr>
																<td align="center"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/prev.gif" border="0" style="cursor:pointer;" onClick="prev_image();">
																</td>
																<td  style="padding-left:5px; padding-right:5px;" valign="middle"><a href="#" title="Zoom" onClick="zoom_image ( ) ;">
																		<div id="ViewLargeImage" style="-moz-border-radius:5px; border:#AAAAAA solid 1px;">
																			<div style="background-image:url(<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/zoom.gif); background-repeat:repeat-x; height:23px; padding-left:2px; padding-right:4px;">
																				<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/zoom_img.gif" width="14" height="17" border="0">
																				<span style="margin-bottom:5px;"><?php echo $lang["lang_detail"]["str_view_image"] ?></span>
																			</div>
																		</div>
																	</a>
																</td>
																<td align="center"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/next.gif" border="0" style="cursor:pointer;" onClick="next_image();" >
																</td>
															</tr>
														</tbody>
													</table>
												</center>
												<br>
												
											</div></td>
													<td valign="top">
															<?php
																	$k = 0 ;
																		for ( $i = 1 ; $i < 7 ; $i++ )
																		{
																			if ( file_exists( "media/cls_".$classified["AdID"]."_".$i."_520.jpg" ) )
																			{
																				$k++ ;
																	?>
																<img src="<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&imgnum=<?php echo $i ?>&gallery=0" style="cursor:pointer; margin:2px;" onClick="select_image ( <?php echo $i ?> ) ;">
																<?php
																			}
																	
																		}
																	?>
																	<script language="javascript">var total_images = <?php echo $k; ?>; var current_image = 0 ;</script>
														</td>
												</tr>
											</table>
										</td>
										
										
										</tr>
										<tr>
										<td valign="top">
											<div id="ad-desc" class="ad-desc">
												<?php echo $classified["Description"] ?>
											</div>
											
											<div style="">
												<table class="detail_data" cellpadding="5" cellspacing="0" style="font-size:12px;">
													<tr>
														<td colspan="100">&nbsp;</td>
													</tr>
													<tr>
														<td class='detail_title'> <?php echo $lang["lang_detail"]["str_date_listed"] ?> </td>
														<td class='detail_data'><?php echo date ( "F j, Y" , strtotime ( $classified["DateAdded"] ) ) ; ?>
														</td>
													</tr>
													<tr>
														<td class='detail_title'> <?php echo $lang["lang_detail"]["str_address"] ?>:</td>
														<td class='detail_data'><?php echo $classified["AddressStreet"] ?> , <?php echo $classified["AddressCity"] ?>, <?php echo $classified["AddressRegion"] ?>, <?php echo $classified["AddressZip"] ?>, <?php echo $classified["AddressCountry"] ?>
														
														<?php
															if ( strlen ( $app_init_data["GoogleMapKey"] ) > 5 )
															{
														?>
															<br>
															<a href="#mapit"><?php echo $lang["lang_detail"]["str_view_map"] ?></a>
														<?php
															}
														?>
														</td>
													</tr>
													<tr>
														<td class='detail_title'> <?php echo $lang["lang_detail"]["str_price"] ?> </td>
														<td class='detail_data'><?php
																if ( intval ( $classified["PriceAlternative"] ) > 1 )
																	echo $price_alt[intval ( $classified["PriceAlternative"] )] ;
																else
																	 echo $app_init_data["CurrencySymbol"].number_format ( $classified["Price"] , 2 ) ;
															?>
														</td>
													</tr>
												<?php
													$last_id = 0 ;
													if ( ! empty ( $extra_info ) )
													{
														foreach ( $extra_info as $fild )
														{
															if ( $fild["CategoryExtraFieldID"] != $last_id )
																$last_id = $fild["CategoryExtraFieldID"] ;
															else
																continue ;
															$values = $data->select ( "AdExtraField" , "*" , array ( "CategoryExtraFieldID" => $fild["CategoryExtraFieldID"] , "AdID" => $fild["AdID"] ) ) ;
															if ( empty ( $fild["AdExtraFieldValue"] ) )
																continue ;
												?>
													<tr>
														<td class='detail_title'><?php echo $fild["Field_name"] ?>
														</td>
														<td class='detail_data'>
														<?php 
															if ( count ( $values ) > 1 )
																foreach ( $values as $v )
																	echo $v["AdExtraFieldValue"]." - " ;
															else
																echo $fild["AdExtraFieldValue"] ;
														?>
														</td>
													</tr>
													<?php
														}
													}
												?>
												</table>
											</div>
											
											<div align="center" style="margin:15px;">
												<span style="background-color:#343434; color:#FEFEFE; padding-top:5px; padding-bottom:5px; padding-left:10px; padding-right:10px; "> <?php echo $lang["lang_detail"]["str_visits"] ?> : <?php echo $classified["Views"] ?>
												</span>
											</div>
											
										</td>
									</tr>
									<tr>
										<td>
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
								</tbody>
							</table>
							<div id="viewAd-actions" class="viewAd-actions">
								<ul>
									<?php
											if ( intval ( $classified["AccountID"] ) > 0 )
											{
										?>
									<li><span class="poa">
										<a href="#"> <?php echo $lang["lang_detail"]["str_poster_ads"] ?> </a>
										</span></li>
									<?php
											}
										?>
								</ul>
								<ul>
									<li>
										<?php
											if ( intval ( $_SESSION["login_account_id"] ) > 0 )
											{
										?>
										<div id="wl_text" style="">
											<a href="<?php echo base_url ?>p.watch.php?id=<?php echo $classified["AdID"] ?>" > <?php echo $lang["lang_detail"]["str_add_to_watch_list"] ?> </a>
										</div>
										<?php
											}
										?>
									</li>
								</ul>
							</div>
							<br>
							<div class="sponsoredLinks">
								&nbsp; <?php echo $lang["lang_detail"]["str_sponsor_links"] ?> 
							</div>
							<div align="left" style="margin:4px;">
								<?php
					$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Detail Bottom" ) ) ;
					if ( ! empty ( $g_ads ) )
						foreach ( $g_ads as $g_ad )
							echo $g_ad["MarketingScript"] ;
					?>
							</div></td>
						<!-- google_ad_section_start(weight=ignore) -->
						<td class="viewadrightcol" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tbody>
									<tr>
										<td width="100%">
										
										
										<div align="left" class="detail_form">
											<div class="heading">
												<?php echo $lang["lang_detail"]["contact_poster_form"]["str_heading"] ?>
											</div>
											<div class="container">
												<form id="ReplyToAdForm" action="<?php echo base_url ; ?>reply_class_ad.php" method="post" name="viewadfrm" onSubmit="return validateForm('ReplyToAdForm');">
												<input name="AdID" value="<?php echo $classified["AdID"] ?>" type="hidden" sch_req="1" sch_msg="Your email ">
												<table>
													<tr>
														<th>
															<?php echo $lang["lang_detail"]["contact_poster_form"]["str_your_email"] ?>
														</th>
														<td>
															<input name="FromEmailAddress" value="" size="30" style="width: 100%;" type="text"  sch_req="1" sch_msg="Your email " >
														</td>
													</tr>
													
													<tr>
														<th>
															<?php echo $lang["lang_detail"]["contact_poster_form"]["str_message"] ?>
														</th>
														<td>
															<textarea name="EmailText" rows="5" style="width: 100%;" cols="25" title=""  sch_req="1" sch_msg="Message" ></textarea>
														</td>
													</tr>
													<tr>
														<th>
															<?php echo $lang["lang_detail"]["contact_poster_form"]["str_verif_code"] ?>
														</th>
														<td>
															<img class="imageAlign" alt="Enable images to see number" style="border:#AAAAAA solid 1px;" src="<?php echo base_url ?>yadcap.php" border="0" >
															<br>
															<?php echo $lang["lang_detail"]["contact_poster_form"]["str_enter_code"] ?>
															<br>
															<input name="BBUV" value="" id="BbUserInputId" size="7" type="text">
														</td>
													</tr>
													<tr>
														<td colspan="110">
															<input id="send" class="newButton" value="<?php echo $lang["lang_detail"]["contact_poster_form"]["str_post_button"] ?>" style="margin-bottom: 10px;" type="submit">
														</td>
													</tr>
													
												</table>
													
												</form>
											</div>	
										
										</div>
										
											<div align="center">
												<?php
														$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Detail Right" ) ) ;
														if ( ! empty ( $g_ads ) )
															foreach ( $g_ads as $g_ad )
																echo $g_ad["MarketingScript"] ;
													?>
											</div></td>
									</tr>
								</tbody>
							</table></td>
						<!-- google_ad_section_end(weight=ignore) -->
					</tr>
				</tbody>
			</table>
			<br>
			<?php
			
				
				include ( "inc.footer.php" ) ;
			?>
		</div>
		<div id="myFavorites-panel">
		</div>
	</div>
</body>
</html>

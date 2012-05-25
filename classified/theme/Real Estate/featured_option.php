<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
	
	include ( "core/inc.meta.php" ) ;

?>
<?php
	if ( intval ( $app_init_data["IsEditorAllow"] ) )
	{
?>
<script type="text/javascript" src="<?php echo base_url ?>js/tiny_mce/tiny_mce.js">
</script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<?php
	}
?>
</head>
<body>
	<div id="main">
		<div id="top">
		<?php
			include ( "inc.header.php" ) ;
		?>
		</div>
		<div id="middle">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td style="padding: 15px;" valign="top" width="80%"><table id="homecatgroup" border="0" cellpadding="0" cellspacing="0" width="100%">
								<tbody>
									<tr>
										<td class="adKj-rm round-middle"><table class="ad-inner" border="0" cellpadding="0" cellspacing="0">
												<tbody>
													<tr>
														<td class="ad-inner-rtl round-top-left">&nbsp;</td>
														<td class="ad-inner-rtm round-top-middle"><span style="font-weight: bolder;"><?php echo $classified["AdTitle"] ?></span>
														</td>
														<td class="ad-inner-rtr round-top-right">&nbsp;</td>
													</tr>
													<tr>
														<td class="ad-inner-rml round-middle-left">&nbsp;</td>
														<td class="ad-inner-rm round-middle"><div id="postAdForm">
																<div class="input-row">
																	<div class="first-field">
																		<div class="first-label required">
																			&nbsp;
																		</div>
																	</div>
																</div>
																<table id="Images" border="0" cellpadding="0" cellspacing="0">
																	<tbody>
																		<tr>
																			<td style="padding-right: 5px;" valign="top"><div style="border:#D2D2D2 solid 1px; -moz-border-radius:5px; padding:8px; width:310px;">
																					<br>
																					<div class="gallery" align="center" >
																						<table border="0" cellpadding="0" cellspacing="0">
																							<tbody>
																								<tr>
																									<td class="imageStack"><img id="main_image" src="<?php echo base_url ; ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=1" border="0" alt="No Image" />
																									</td>
																								</tr>
																							</tbody>
																						</table>
																					</div>
																					<br>
																					<span id="spn_loading" style="display:none">
																					<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/loader.gif">
																					</span>
																					<br>
																					<center>
																						<?php
															for ( $i = 1 ; $i < 7 ; $i++ )
															{
																if ( file_exists( "media/cls_".$classified["AdID"]."_".$i."_520.jpg" ) )
																{
														?>
																						<img src="<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&imgnum=<?php echo $i ?>&gallery=0" style="cursor:pointer; margin:2px;" onClick="select_image ( <?php echo $i ?> ) ;">
																						<?php
																}
														
															}
														?>
																					</center>
																				</div></td>
																			<td valign="top"><div style="">
																					<table cellpadding="5" cellspacing="0" style="font-size:14px;border:#BFBFBF solid 1px; -moz-border-radius:3px;">
																						<tr>
																							<td style="color:#959595; border-bottom:#BFBFBF solid 1px;"> <?php echo $lang["lang_featured_option"]["str_date_listed"] ?> </td>
																							<td style="color:#292929; border-bottom:#BFBFBF solid 1px;"><?php echo date ( "F j, Y" , strtotime ( $classified["DateAdded"] ) ) ; ?>
																							</td>
																						</tr>
																						<tr>
																							<td style="color:#959595; border-bottom:#BFBFBF solid 1px;"> <?php echo $lang["lang_featured_option"]["str_address"] ?>:</td>
																							<td style="color:#292929; border-bottom:#BFBFBF solid 1px;"><?php echo $classified["AddressStreet"] ?> , <?php echo $classified["AddressCity"] ?>, <?php echo $classified["AddressRegion"] ?>, <?php echo $classified["AddressZip"] ?>
																							</td>
																						</tr>
																						<tr>
																							<td style="color:#959595; border-bottom:#BFBFBF solid 1px;"> <?php echo $lang["lang_featured_option"]["str_price"] ?> </td>
																							<td style="color:#292929; border-bottom:#BFBFBF solid 1px;"><?php
																if ( intval ( $classified["PriceAlternative"] ) > 1 )
																	echo $price_alt[intval ( $classified["PriceAlternative"] )] ;
																else
																	 echo $app_init_data["CurrencySymbol"].number_format ( $classified["Price"] , 2 ) ;
															?>
																							</td>
																						</tr>
												<?php
													$last_field_id = 0 ;
													$filed_name = NULL ;
													if ( ! empty ( $extra_fields ) )
													{
														foreach ( $extra_fields as $fild )
														{
															if ( empty ( $fild["AdExtraFieldValue"] ) )
																continue ;
															if ( $last_field_id != intval ( $fild["CategoryExtraFieldID"] ) )
															{
																$last_field_id = intval ( $fild["CategoryExtraFieldID"] ) ;
																$filed_name = $data->select ( "CategoryExtraField" , "*" , array ( "CategoryExtraFieldID" => $last_field_id ) ) ;
																$filed_name = $filed_name[0] ;
																echo '</td></tr>
																	<tr>
																		<td style="color:#959595; border-bottom:#BFBFBF solid 1px;">'.$filed_name["EFName"].'</td>
																		<td style="color:#292929; border-bottom:#BFBFBF solid 1px;">'.$fild["AdExtraFieldValue"] ;
															}
															else
																echo " - ".$fild["AdExtraFieldValue"] ;
														}
													}
												?>
																					</table>
																				</div>
																				<br>
																				<div id="ad-desc" class="ad-desc">
																					<?php echo $classified["Description"] ?>
																				</div></td>
																		</tr>
																	</tbody>
																</table>
																<script language="javascript">
																function show_plan ( )
																{
																	if ( ! $("#ul_featured").is(":hidden") )
																		document.frm_plans.submit();
																	$("#ul_featured:hidden").slideDown("normal");
																}
															</script>
																<div class="postAd">
																	<div>
																		<?php
																		$category_path_array = array ( ) ;
																		get_category_path ( intval ( $classified["CategoryID"] ) , $category_path_array , $data ) ;
																		
																		$category_path_array = array_reverse ( $category_path_array ) ;
																		echo "<a href='".base_url."'>".$app_init_data["SiteTitle"]."</a>" ;
																		foreach ( $category_path_array as $cat_path )
																			echo " &raquo; <a href='".base_url."category/".get_sef_url($cat_path["CategoryID"],"Category")."/'>".$cat_path["CategoryName"]."</a>" ;
																	 ?>
																	 	&raquo; <?php echo $lang["lang_featured_option"]["str_your_ad"] ?>
																	</div>
																	<form action="" method="post" name="frm_plans">
																		<div style="margin:8px;" align="center">
																			<ul id="ul_featured" style="display:none;">
																				<li> <?php echo $lang["lang_featured_option"]["featured_form"]["str_instruction"] ?> ? </li>
																				<?php
																			foreach ( $plans as $plan ) :
																		?>
																				<li style="margin-top:5px; padding:3px;">
																					<label style="font-weight:normal;">
																					<input name="Plan_Featured" value="<?php echo $plan["PaymentPlanID"] ?>"  type="radio">
																					<?php
																						echo $app_init_data["PayPalCurrencyCode"]." ".$plan["Amount"] . " (".$plan["DaysToExpire"]." days)" ;
																					?>
																					&nbsp;&nbsp;
																					</label>
																				</li>
																				<?php
																			endforeach ;
																		?>
																			</ul>
																		</div>
																		<br>
																		<br>
																		<?php
																				if ( floatval ( $app_init_data["ClassifiedPrice"] ) > 0 )
																				{
																					$payment = " for ".$app_init_data["PayPalCurrencyCode"]." ".floatval ( $app_init_data["ClassifiedPrice"] ) ;
																					echo $app_init_data["PaymentNotes"] ;
																					}
																				else
																					$payment = "" ;
																			?>
																		<div align="center">
																			<input type="button" value="<?php echo $lang["lang_featured_option"]["featured_form"]["str_edit_button"] ?>" class="newButton" onClick="window.location='<?php echo base_url ?>c-EditClassified/'" />
																			&nbsp; &nbsp; 
																			<input type="button" value="<?php echo $lang["lang_featured_option"]["featured_form"]["str_post_button"] ?> <?php echo $payment ?>" class="newButton" onClick="<?php echo $payment == "" ? "window.location='".base_url."c-Posted/'" : "window.location='".base_url."c-PayClassified/'" ?>" />
																			<?php
																				if ( ! empty ( $plans ) )
																				{
																			?>
																			&nbsp; &nbsp;
																			<input id="PostFeatuerdAd" value="<?php echo $lang["lang_featured_option"]["featured_form"]["str_post_featured_button"] ?>" class="newButton" type="button" onClick="show_plan();" >
																		</div>
																		<?php 
																				}
																			?>
																		&nbsp; &nbsp;
																	</form>
														  </div>
																<div class="input-row">
																</div>
															</div></td>
														<td class="ad-inner-rmr round-middle-right">&nbsp;</td>
													</tr>
													<tr>
														<td class="ad-inner-rbl round-bottom-left">&nbsp;</td>
														<td class="ad-inner-rbm round-bottom-middle" width="100%">&nbsp;</td>
														<td class="ad-inner-rbr round-bottom-right">&nbsp;</td>
													</tr>
												</tbody>
											</table>
											<table border="0" cellpadding="0" cellspacing="5" width="100%">
												<tbody>
													<tr valign="top">
														<td colspan="3" style="padding-left: 10px; padding-bottom: 5px; padding-top: 10px;" align="left"> <?php echo $lang["lang_post_form"]["str_post_instruction"] ?> . </td>
													</tr>
													<tr valign="top">
														<td colspan="3" align="left">&nbsp;</td>
													</tr>
												</tbody>
											</table></td>
									</tr>
								</tbody>
							</table></td>
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

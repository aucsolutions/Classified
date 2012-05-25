<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	<!-- Start of HtmlPageHtmlHead -->
	<!-- AreaHome -->
<?php
	$meta_title = $classified["AdTitle"] ;
	include ( "core/inc.meta.php" ) ;

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
			var img_src = "<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=1&imgnum="+image_number ;
			var zom_img = new Image ;
			zom_img.src = img_src ;
			$("#spn_loading").show();
			zom_img.onload = function ( )
								{
									$("#main_image").attr("src", img_src ) ;
									$("#spn_loading").hide();
								} ;
		}
		
		$(document).ready ( function ( )
							{
								window.print();
							}
		 ) ;
	</script>
	</head>
	
	<body class="js-enabled">
		
			
			
		<div id="main" style="width: 100%;">
			
			<div id="middle" style="padding-left:10px; padding-right:10px; padding-top:15px; padding-bottom:10px;">
				<img src="<?php echo base_url ?>media/logo.jpg" border="0">
				<table valign="top" border="0" width="100%">
					<tbody>
						
						<tr>
							<td style="border-bottom: 1px solid rgb(192, 192, 192);" align="left" valign="bottom"><div id="viewAd-header">
									<div id="viewAd-header-content">
										<div>
											<h1 id="preview-local-title"><?php echo $classified["AdTitle"] ?></h1>
											<br>
											<?php echo $lang["lang_detail"]["str_ad_id"] ?> : <?php echo $classified["AdID"] ?> 
										</div>
									</div>
								</div></td>
							
						</tr>
						<tr>
							<td style="padding-top: 20px;" align="left" valign="top">
							
								
								<div >
									<table cellpadding="3" cellspacing="0" style="font-size:14px;">
									<tr>
										<td style="color:#161616; font-weight:bold"> 
											<?php echo $lang["lang_detail"]["str_date_listed"] ?>
										</td>
										<td style="color:#161616;">
											<?php echo date ( "F j, Y" , strtotime ( $classified["DateAdded"] ) ) ; ?>
										</td>
									</tr>
									<tr>
										<td style="color:#161616; font-weight:bold">  <?php echo $lang["lang_detail"]["str_address"] ?>:</td>
										<td style="color:#161616; ">
										<?php echo $classified["AddressStreet"] ?> , <?php echo $classified["AddressCity"] ?>, <?php echo $classified["AddressRegion"] ?>, <?php echo $classified["AddressZip"] ?>
										</td>
									</tr>
									<tr>
										<td style="color:#161616; font-weight:bold">
											<?php echo $lang["lang_detail"]["str_price"] ?>
										</td>
										<td style="color:#161616; ">
											<strong><?php echo $app_init_data["CurrencySymbol"] ?><?php echo number_format ( $classified["Price"] , 2 ) ?></strong>
										</td>
									</tr>
									
									
								<?php
									if ( ! empty ( $extra_info ) )
									{
										foreach ( $extra_info as $fild )
										{
								?>
									<tr>
										<td style="color:#161616; font-weight:bold">
											<?php echo $fild["Field_name"] ?>
										</td>
										<td style="color:#161616; ">
											<?php echo $fild["AdExtraFieldValue"] ?>
										</td>
									</tr>
								<?php
										}
									}
								?>
									
									
								</table>
								</div>
								<br>

								<div id="ad-desc" class="ad-desc">
									<?php echo $classified["Description"] ?>
								</div>
								
								<br>
								
								
							</td>
						</tr>
						<tr>
							<td style="padding: 5px;" valign="top">
								<div>
								<br>

								<div class="gallery" align="center">
									
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
								<span id="spn_loading" style="display:none"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/loader.gif"></span>
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
								
</div>
							</td>
						</tr>
						<tr>
							<td><div align="center" style="margin:15px;">
									
										<?php echo $lang["lang_detail"]["str_visits"] ?> : <?php echo $classified["Views"] ?>
									
								</div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="myFavorites-panel">
			</div>
		</div>
	</body>
</html>

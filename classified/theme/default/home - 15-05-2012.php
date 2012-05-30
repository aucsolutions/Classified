<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- Start of HtmlPageHtmlHead -->
<!-- AreaHome -->
<?php
	include ( "core/inc.meta.php" ) ;

?>
</head>
<body class="js-enabled">
	<div id="main" style="width: 100%;">
		<div id="top">
			<?php
			include ( "inc.header.php" ) ;
		?>
		<?php
		if ( $app_init_data["Notifier"] != "" )
		{
	?>
		<div id="div_Notifier" class="popup" style="display:none; top:15%; z-index:105; position:fixed; padding: 8px; width: auto;">
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
										<?php echo $lang["lang_home"]["str_notifier"] ?>
									</div>
									<div id="content">
											<div style="margin: 0pt; padding: 0pt; display: inline;">
											</div>
											<?php echo $app_init_data["Notifier"] ?>
									</div>
									<div style="clear: both;">
									</div>
								</div>
							</div>
							<div style="display: block;" class="footer">
								<a href="#" class="close" onclick="close_window('div_Notifier')">
									<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closelabel.gif" title="close" class="close_image">
								</a>
							</div></td>
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
	<script language="javascript">
		setTimeout ( "showScreen('div_Notifier')" , <?php echo intval ( $app_init_data["NotifierTime"] ) * 1000 ?> ) ;
	</script>
	<?php
		}
	?>
			<div id="pagestatus_new" style="">
			</div>
		</div>
		<div id="middle">
		<div align="center" style="margin:5px;">
			<?php
			$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Home Top" ) ) ;
			if ( ! empty ( $g_ads ) )
				foreach ( $g_ads as $g_ad )
					echo $g_ad["MarketingScript"]."<br><br>" ;
		?>
		</div>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
			
			<tr>
			
			<td style="padding: 15px;" valign="top" width="80%">
			
			<div style="margin-bottom: 5px;">
				<p style="margin-top: 20px;">
				</p>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody>
						<tr>
							<td colspan="2" valign="top" width="50%"><div class="catlist">
									<table border="0" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>
												<td halign="left" valign="center"><a href="<?php echo base_url ?>c-SelectCategory/">
														<h2 class="homeMetaCatName">
															<img style="vertical-align: middle; position: relative; left: -5px;" src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/post_a_classified_ad.gif" border="0">
															<?php echo $lang["lang_home"]["str_post_ad_free"] ?></h2>
													</a>
													<?php echo $lang["lang_home"]["str_post_ad_free_desc"] ?></td>
											</tr>
										</tbody>
									</table>
								</div></td>
							<td valign="top" width="33%"><div class="catlist">
									<table border="0" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>
												<td halign="left" valign="center"><a href="<?php echo base_url ; ?>c-BrowseClassified/">
														<h2 class="homeMetaCatName">
															<img style="vertical-align: middle; position: relative; left: -5px;" src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/see_all_ads.gif" border="0">
															<?php echo $lang["lang_home"]["str_all_ads"] ?></h2>
													</a>
													<?php echo $lang["lang_home"]["str_all_ads_desc"] ?></td>
											</tr>
										</tbody>
									</table>
								</div></td>
						</tr>
						<tr>
							<td colspan="100"><div style="margin-left:25px; border:#D3D3D3 solid 1px; padding:5px;">
									<table>
										<tr>
											<?php
				if ( ! empty ( $featured_classifieds ) )
					foreach ( $featured_classifieds as $cls_ad )
						echo "<td align='center'>
							<a href='".get_sef_url ( $cls_ad["AdID"] , "Classified" ) ."/' style='font-size:11px;'>
								<img src='".base_url."classified_img.php?clsid=".$cls_ad["AdID"]."&feat=1' border='0'>
									<br>".substr ( $cls_ad["AdTitle"] , 0 , 20 )."
							</a>
						</td>" ;
			?>
										</tr>
									</table>
								</div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
			<table id="homecatgroup" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td valign="top"><div class="catlist" style="margin-left:20px;" >
								<?php
										$i = 0 ;
										if ( ! empty ( $mainCategory ) )
											foreach ( $mainCategory as $cat ) :
									?>
								<?php
													if ( $i == 0 || $i == 3 || $i == 6 )
														echo "<div style='vertical-align:top; margin-left:10px; margin-top:10px; width:270px; height:auto; position:inherit; float:left;'>" ;
													$temp_src = base_url."media/cls_cat_".$cat["CategoryID"]."_5520.jpg" ;
													echo "<a href='".base_url."category/".get_sef_url($cat["CategoryID"],"Category")."/'><img src='".$temp_src."' style='vertical-align: middle; position: relative; left: -5px;' border='0' vspace='1' /></a>" ;
													
													echo "<a href='".base_url."category/".get_sef_url($cat["CategoryID"],"Category")."/'>
														<h2 class='homeMetaCatName'>".$cat["CategoryName"]."</h2>
													</a>" ;
														$subCat = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => $cat["CategoryID"] ) ) ;
													if ( ! empty ( $subCat ) ):
														echo "<ul style='list-style-image:url(".base_url."theme/default/images/bullet.gif);'>" ;
														foreach ( $subCat as $subCat ) :
															echo "<li><a href='".base_url."category/".get_sef_url($subCat["CategoryID"],"Category")."/'>".$subCat["CategoryName"]."</a>&nbsp; </li>							" ;
														endforeach ;
														echo "</ul>" ;
													endif ;
													
													if ( $i == 2 || $i==5 )
														echo "</div>" ;
													$i++ ;
												?>
								<?php
										endforeach ;
									?>
							</div>
				</div>
				
				</td>
				
				</tr>
				
				</tbody>
				
			</table>
			</td>
			
			<td style="padding: 15px 15px 15px 10px;" valign="top"><?php
						include ( "inc.menu.php" ) ;
					?></td>
			</tr>
			</tbody>
			
		</table>
		<div align="center">
			<?php
				$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Home Bottom" ) ) ;
				if ( ! empty ( $g_ads ) )
					foreach ( $g_ads as $g_ad )
						echo $g_ad["MarketingScript"] ;
			?>
		</div>
		<br>
		<script language="JavaScript" type="Text/Javascript">
<!-- // Hide script from older browsers // script by http://www.hypergurl.com 
			var urlAddress = "<?php echo base_url ?>"; 
			var pageName = "<?php echo $app_init_data["SiteTitle"] ?>";
			function addToFavorites()
			{
				if (window.external)
				{
					window.external.AddFavorite(urlAddress,pageName) ;
				}
				else
				{
					alert("<?php echo $lang["lang_home"]["str_add_to_fav_alert"] ?>"); 
				}
			} // -->
</script>
		<div style="margin-left:15px; font-size:14px; font-weight:bold;">
			Please add
			<a href="javascript:;" onClick="addToFavorites();"><?php echo $app_init_data["SiteTitle"]." ".$lang["lang_home"]["str_book_mark"] ?> </a>
			or make
			<a href="javascript:;" onClick="this.style.behavior='url(#default#homepage)'; this.setHomePage('<?php echo base_url ?>');"><?php echo $app_init_data["SiteTitle"]." ".$lang["lang_home"]["str_home_page"] ?></a>
			.
		</div>
		<br>
		<?php
				include ( "inc.footer.php" ) ;
			?>
	</div>
	<!-- Start of HtmlPageTail -->
	<div id="myFavorites-panel">
	</div>
	</div>
</body>
</html>

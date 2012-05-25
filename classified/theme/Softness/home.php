<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- Start of HtmlPageHtmlHead -->
<!-- AreaHome -->
<?php
	include ( "core/inc.meta.php" ) ;

?>
</head>
<body >
	<div id="container">
		<?php
			include ( "inc.header.php" ) 
		?>
		<!--/banner-->
		<div id="content" class="home out">
			<div id="left-nav">
				<div id="narrow-options" class="orange-module">
					<div class="orange-tab">
						<h3><?php echo $lang["lang_header"]["str_browse_ads"] ?></h3>
					</div>
					
					
					
					<?php
							$i = 0 ;
							if ( ! empty ( $mainCategory ) )
								foreach ( $mainCategory as $cat ) :
									echo "<div class='narrow-option expanded clearfix'>" ;
									$temp_src = base_url."media/cls_cat_".$cat["CategoryID"]."_5520.jpg" ;
									echo "<h3><a href='".base_url."category/".get_sef_url($cat["CategoryID"],"Category")."/'>".$cat["CategoryName"]."</a></h3>" ;
									$subCat = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => $cat["CategoryID"] ) ) ;
									
									$i = 0 ;
									
									if ( ! empty ( $subCat ) ):
										echo "<ul>" ;
										foreach ( $subCat as $subCat ) :
											if ( $i++ == 4 )
											{
												echo "<li><a href='javascript:void(null);' onclick='show_all_cat(".$cat["CategoryID"]." , this)'><strong>Show All</strong></a></li></ul><ul id='sub_cat_".$cat["CategoryID"]."' style='display:none;'>" ;
											}
											echo "<li><a href='".base_url."category/".get_sef_url($subCat["CategoryID"],"Category")."/'>".$subCat["CategoryName"]."</a>&nbsp; </li> " ;
										endforeach ;
										echo "</ul>" ;
									endif ;
									
									$i++ ;
									echo "</div>" ;
							endforeach ;
						?>
					
					
					
				</div>
			</div>
			<!--/left-->
			<div id="right-columns">
				<div id="right-inside-wrapper">
					<div id="home-content-fade">
						<div id="home-intro">
							<div class="wrapper-container">
								<h3><?php echo $app_init_data["SiteName"] ?></h3>
							</div>
							<div class="wrapper-container">
								<div id="search-bar-container" class="clearfix">
									<div id="home-search-left">
										<div id="home-search-right">
											<div id="home-search">
												<form action="<?php echo base_url ?>search/" method="post" name="search-form">
													<fieldset>
													<label for="home-what"></label>
													<input name="Keyword" id="home-what" value="<?php echo $exp_send["q"] ?>" type="text">
													</fieldset>
													<fieldset>
													<label for="home-where"></label>
														<input name="CatId" id="search_cat_id" value="0" type="hidden">
													<div id="searchCat_name" class="home_form_select" onclick="show_drop_down ( 'ul_cat', this ) ;" >
														<?php echo $lang["lang_header"]["search_form"]["str_all_ads"] ?>
														
													</div>
													</fieldset>
													<fieldset class="home-submit-button">
													<label></label>
													<input src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/button_findit.gif" class="submit-image" type="image">
													
													</fieldset>
												</form>
											</div>
											<?php
													if ( ! empty ( $mainCategory ) )
													{
														echo "<ul id='ul_cat' >" ;
														foreach ( $mainCategory as $cat )
															echo "<li onclick='select_dropdown_category ( ".$cat["CategoryID"]." , this );'><a href='#'>".$cat["CategoryName"]."</a></li>" ;
														echo "</ul>" ;
													}
												?>
											
										</div>
										
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
					<div id="latest-listings" class="blue-module">
						<div id="latest-listings-header" class="clearfix">
							<div id="listings-tab" class="clearfix">
								<h3><?php echo $lang["lang_left_menu"]["str_new_ads"] ?> </h3>
							</div>
						</div>
						<div id="slide-holder">
						
							<?php
						$ads = $data->select ( "Classified" , "*" , array ( "IsActive" => 1 , "IsPosted" => 1 ) , 0 , intval ( $app_init_data["RecentAdsMainPage"] ) , " DateAdded desc" ) ;
						if ( ! empty ( $ads ) )
							foreach ( $ads as $ad ) :
								
					?>
					
					
							<div class="slide-show clearfix" id="show0">
								<div class="slide-image">
									<a href="<?php echo get_sef_url ( $ad["AdID"] , "Classified" ) ; ?>/">
										<img alt="<?php echo $ad["AdTitle"] ?>p" title="<?php echo $ad["AdTitle"] ?>" src="<?php echo base_url."classified_img.php?clsid=".$ad["AdID"]."&feat=1" ?>">
										
									</a>
								</div>
								<div class="slide-desc price">
									<a href="<?php echo get_sef_url ( $ad["AdID"] , "Classified" ) ; ?>/">
										<?php echo $app_init_data["CurrencySymbol"].$ad["Price"] ?>
									</a>
								</div>
								<div class="slide-desc title">
									<?php echo $ad["AdTitle"] ?>
								</div>
								
							</div>
							
							
							
					<?php
						if ( $i % 3 == 2 )
							echo '<div class="divider"></div>' ;
						$i++ ;
							endforeach ;
					?>		
							
							
						
						</div>
						
					</div>
					<div id="city-view-container" class="orange-module">
						<div id="city-view-tab-left">
							<div class="city-view-tab">
								<div id="city-view-tab-right">
									<div id="city-view-nav">
										<h4><?php echo $lang["lang_listing"]["str_featured"] ?></h4>
									</div>
								</div>
							</div>
						</div>
						
						<div id="city-container">
							<div >
								<table width="100%">
								<?php
									$i = 0 ;
									if ( ! empty ( $featured_classifieds ) )
										foreach ( $featured_classifieds as $cls_ad )
										{
											if ( $i % 4 == 0 )
												echo "<tr>" ;
											echo "<td align='center' width='25%'>
												<a href='".get_sef_url ( $cls_ad["AdID"] , "Classified" ) ."/' style='font-size:11px;'>
													<img src='".base_url."classified_img.php?clsid=".$cls_ad["AdID"]."&feat=1' border='0'>
														<br>".substr ( $cls_ad["AdTitle"] , 0 , 20 )."
												</a>
											</td>" ;
											
											if ( $i++ % 4 == 3 )
												echo "</tr>" ;
										}
								?>
								</table>
							</div>
							
							<div class="clearing">
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<!--/right-columns-->
			<div class="clearing">
			</div>
		</div>
		<!--/content-->
		<?php include ( "inc.footer.php" ) ?>
	</div>
	
</body>
</html>

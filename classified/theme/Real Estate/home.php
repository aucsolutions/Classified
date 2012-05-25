<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- Start of HtmlPageHtmlHead -->
<!-- AreaHome -->
<?php
	include ( "core/inc.meta.php" ) ;

?>
</head>
<body>
	<div id="main" >
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
		
		<div id="home_search">
			<a href="<?php echo base_url ?>c-SelectCategory/"><div class="c_left">&nbsp;</div></a>
			<div class="c_right">
				<div class="heading">Property Search</div>
				<div class="container">
					<form action="<?php echo base_url ?>search/" method="post">
						<table>
							<tr>
								<td colspan="100" class="search_find" align="left"><h2>Find:
									<?php
										if ( ! empty ( $mainCategory ) )
											foreach ( $mainCategory as $cat ) :
									?>
										<label><input type="radio" value="<?php echo $cat["CategoryID"] ?>" name="CatId"><?php echo $cat["CategoryName"] ?></label>
									<?php
										endforeach ;
									?>
									</h2>
								</td>
							</tr>
							<tr>
								<td style="padding-top:8px;" align="left">
									<input type="text" name="Keyword" class="input_home_search">
									&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
									<strong>Price</strong>
										<select name="minPrice">
											<option value="">No Min</option>
											<?php
												for ( $i = 10000 ; $i < 100000 ; $i +=10000 )
													echo "<option value='$i'>".number_format($i , 0)."</option>" ;
											?>
										</select>
									to
										<select name="maxPrice">
											<option value="">No Max</option>
											<?php
												for ( $i = 10000 ; $i < 100000 ; $i +=10000 )
													echo "<option value='$i'>".number_format($i , 0)."</option>" ;
											?>
										</select>
								</td>
							</tr>
							<tr>
								<td align="left">
									<input type="image" src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/button.png">
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		
		<div align="left" class="featured_property">
			<div class="heading">
				<?php echo $lang["lang_listing"]["str_featured"] ?>
			</div>
			<div class="container">
				<ul>
			<?php
				if ( ! empty ( $featured_classifieds ) )
					foreach ( $featured_classifieds as $cls_ad )
						echo "<li>
							<a href='".base_url.get_sef_url ( $cls_ad["AdID"] , "Classified" ) ."/'>
								<img src='".base_url."classified_img.php?clsid=".$cls_ad["AdID"]."&feat=1' border='0'>
									<br>".substr ( $cls_ad["AdTitle"] , 0 , 20 )."
							</a>
						</li>" ;
			?>
			</ul>
			</div>
		</div>
		
		<div class="top_categories" align="left">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="left">
						
					</td>
					<?php
						$i = 0 ;
						if ( ! empty ( $mainCategory ) )
							foreach ( $mainCategory as $cat ) :
								if ( $i++ > 4  )
									break;
								$temp_src = base_url."media/cls_cat_".$cat["CategoryID"]."_5520.jpg" ;
					?>
					<td class="middle">
						<a href="<?php echo base_url."category/".get_sef_url($cat["CategoryID"],"Category") ; ?>/">
							<table>
							<tr>
								<td rowspan="5" valign="top"><img src="<?php echo $temp_src ?>"></td>
							</tr>
							<tr>
								<td valign="top">
									<h2><?php echo $cat["CategoryName"] ?></h2>
									<div class="desc"><?php echo substr($cat["CategoryDescription"] , 0 , 100) ?></div>
								</td>
							</tr>
						</table>
						</a>
						
						
					</td>
					<?php 
							endforeach;
					?>
					<td class="right">
						
					</td>
				</tr>
			</table>
			
		</div>
		
		<div align="left" class="featured_property">
			<div class="heading">
				<?php echo $lang["lang_left_menu"]["str_new_ads"] ?>
				<a href="<?php echo base_url ?>rss/"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/xml.gif" border="0" ></a>
			</div>
			<div class="container">
				<ul>
				<?php
						$ads = $data->select ( "Classified" , "*" , array ( "IsActive" => 1 , "IsPosted" => 1 ) , 0 , intval ( $app_init_data["RecentAdsMainPage"] ) , " DateAdded desc" ) ;
						if ( ! empty ( $ads ) )
							foreach ( $ads as $cls_ad ) :
								echo "<li>
										<a href='".base_url.get_sef_url ( $cls_ad["AdID"] , "Classified" ) ."/'>
											<img src='".base_url."classified_img.php?clsid=".$cls_ad["AdID"]."&feat=1' border='0'>
												<br>".substr ( $cls_ad["AdTitle"] , 0 , 20 )."
										</a>
									</li>" ;
							endforeach ;
					?>
				</ul>
			</div>	
		
		</div>
		
		
		<div align="center">
			<?php
				$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Home Bottom" ) ) ;
				if ( ! empty ( $g_ads ) )
					foreach ( $g_ads as $g_ad )
						echo $g_ad["MarketingScript"] ;
			?>
		</div>
		<div>
			<a href="<?php echo base_url ?>c-BrowseClassified/"><h2>All Classified ADS</h2></a>
		</div>
		<?php
				include ( "inc.footer.php" ) ;
			?>
	</div>
	
	
</body>
</html>

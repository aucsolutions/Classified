<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
	$home = 100 ;
	include ( "core/inc.meta.php" ) ;

?>
</head>
<body >
	<div id="main">
		<?php
			include ( "inc.header.php" ) 
		?>
		<!--/banner-->
		<div id="page" class="box">
			<!-- Catalog -->
			<div class="box">
				
				<div class="home_featured">
					<table>
						<tr>
					<?php
						if ( ! empty ( $featured_classifieds ) )
							foreach ( $featured_classifieds as $cls_ad )
								echo "<td>
									<a href='".get_sef_url ( $cls_ad["AdID"] , "Classified" ) ."/'>
										<img src='".base_url."classified_img.php?clsid=".$cls_ad["AdID"]."&feat=1' border='0'>
											<br>".substr ( $cls_ad["AdTitle"] , 0 , 20 )."
									</a>
								</td>" ;
					?>
						</tr>
					</table>
				</div>
				
				<div align="center">
					<?php
						$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Home Top" ) ) ;
						if ( ! empty ( $g_ads ) )
							foreach ( $g_ads as $g_ad )
								echo $g_ad["MarketingScript"] ;
					?>
				</div>
				
				<br>
				<div id="col-l">
					<div class="title01-top">
					</div>
					<div class="title01">
						<div class="title01-in">
							<p class="f-right noprint">
								<strong>
								<a href="<?php echo base_url ?>c-SelectCategory/" class="add"><?php echo $lang["lang_home"]["str_post_ad_free"] ?></a>
								</strong></p>
							<h2 class="ico-list"><a href="<?php echo base_url ; ?>c-BrowseClassified/"><?php echo $lang["lang_home"]["str_all_ads"] ?></a></h2>
						</div>
					</div>
					<div class="title01-bottom">
					</div>
					<div class="box">
						<dl class="cat" >
							
							<?php
									$i = 0 ;
									
									$total_cats = count ( $mainCategory ) ;
									if ( ! empty ( $mainCategory ) )
										foreach ( $mainCategory as $cat ) :
												$j = 0 ;
												if ( $i == ceil ( $total_cats / 2 ) )
													echo "</dl><dl class='cat f-right'>" ;
												$temp_src = base_url."media/cls_cat_".$cat["CategoryID"]."_5520.jpg" ;
												echo "<dt style='background-image:url(".$temp_src.");'>" ;
												
												echo "<a href='".base_url."category/".get_sef_url($cat["CategoryID"],"Category")."/'>
													".$cat["CategoryName"]."</a></dt>" ;
													$subCat = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => $cat["CategoryID"] ) ) ;
												if ( ! empty ( $subCat ) ):
													echo "<dd>" ;
													foreach ( $subCat as $subCat ) :
														if ( $j++ == 3 )
															echo "<a href='javascript:void(null);' onclick='show_all_cat(".$cat["CategoryID"]." , this)'><strong>More</strong></a> &nbsp; <span id='sub_cat_".$cat["CategoryID"]."' style='display:none;'>" ;
														echo "<a href='".base_url."category/".get_sef_url($subCat["CategoryID"],"Category")."/'>".$subCat["CategoryName"]."</a>&nbsp;" ;
													endforeach ;
														if ( $j > 3 )
															echo "</span>" ;
													echo "</dd>" ;
												endif ;
												
												$i++ ;
									endforeach ;
								?>
							
							</dl>
						</div>

					<!-- /box -->
					<hr class="noscreen" />
				</div>
				<!-- Sidebar -->
				<div id="col-r" class="noprint">
					<!-- Login -->
					<div id="signup">
						<h3><?php echo $lang["lang_header"]["str_sign_in"] ?></h3>
						<div class="in">
							<form action="<?php echo base_url ?>p.login.php" method="post">
								<table class="nom">
									<tr>
										<td><label for="inp-user"><?php echo $lang["lang_header"]["login_form"]["str_your_email"] ?>:</label></td>
										<td colspan="2"><input type="text" size="30" style="width:190px;" name="EmailAddress" id="inp-user" /></td>
									</tr>
									<tr>
										<td><label for="inp-pass"><?php echo $lang["lang_header"]["login_form"]["str_your_password"] ?>:</label></td>
										<td colspan="2"><input type="password" size="30" style="width:190px;" name="Pass" id="inp-pass" /></td>
									</tr>
									<tr>
										<td></td>
										<td class="smaller">&nbsp;
										
											</td>
										<td class="t-right"><input type="image" value="Login" src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/signup-button.gif" /></td>
									</tr>
								</table>
							</form>
						</div>
						<!-- /in -->
						<div class="in02">
							<ul class="nom">
								<li class="ico-reg"><strong>
									<a href="#" onClick="$('#div_Login').hide(); showScreen ( 'div_SignUp' ) ;"><?php echo $lang["lang_header"]["str_dont_have_account_1"] ?></a>
									</strong></li>
								<li class="ico-send">
									<a href="#" onclick="$('#div_Login').hide(); showScreen ( 'div_Forget_pass' ) ;"><?php echo $lang["lang_header"]["str_forget_pass"] ?>?</a>
								</li>
							</ul>
						</div>
						<!-- /in02 -->
					</div>
					<!-- /signup -->
					<hr class="noscreen" />
					<div id="signup-bottom">
					</div>
					
					<?php
						$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Home Right" ) ) ;
						if ( ! empty ( $g_ads ) )
							foreach ( $g_ads as $g_ad )
								echo $g_ad["MarketingScript"] ;
					?>
					
					
					<hr class="noscreen" />
				</div>
				<!-- /col-r -->
			</div>
			<!-- /box -->
			<div class="title01-top">
			</div>
			<div class="title01">
				<div class="title01-in">
					<h3 class="ico-info"><?php echo $lang["lang_left_menu"]["str_new_ads"] ?></h3>
				</div>
			</div>
			<div class="title01-bottom">
			</div>
			<div class="box">
				<div class="col50">
					
					<?php
						$i = 0 ;
						$ads = $data->select ( "Classified" , "*" , array ( "IsActive" => 1 , "IsPosted" => 1 ) , 0 , intval ( $app_init_data["RecentAdsMainPage"] ) , " DateAdded desc" ) ;
						$total_ads = count ( $ads ) ;
						if ( ! empty ( $ads ) )
							foreach ( $ads as $ad ) :
								if ( $i++ == ceil ( $total_ads / 2 ) )
									echo "</div><div class='col50 f-right'>" ;
					?>
					<div class="new-link">
						<p><strong>
							<a href="<?php echo get_sef_url ( $ad["AdID"] , "Classified" ) ; ?>/">
								<?php echo $ad["AdTitle"] ?>
							</a>
							</strong>
							&ndash;
							<span>
							<a href="<?php echo get_sef_url ( $ad["AdID"] , "Classified" ) ; ?>/" class="ico-card">Details</a>
							</span> 
							<br />
							</p>
						<p><?php echo substr ( strip_tags($ad["Description"]) , 0 , 100 ); ?></p>
						<hr class="noscreen" />
					</div>
					<?php
							endforeach ;
					?>
					
					
					
					
					
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
			<!-- /box -->
		</div>
		<!--/content-->
		<?php include ( "inc.footer.php" ) ?>
	</div>
</body>
</html>

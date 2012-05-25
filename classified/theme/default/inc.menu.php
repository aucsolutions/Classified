<div style="margin-bottom: 15px; width:300px;">
			<div class="listmodule">
				<span class="listtitle">
				<div style="float: left;">
					<?php echo $lang["lang_left_menu"]["str_new_ads"] ?>
				</div>
				<div style="float: right;">
					<a href="<?php echo base_url ?>rss/"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/xml.gif" border="0" ></a>
				</div>
				<div style="clear: both;">
				</div>
				</span>
				<ul>
					<?php
						$ads = $data->select ( "Classified" , "*" , array ( "IsActive" => 1 , "IsPosted" => 1 ) , 0 , intval ( $app_init_data["RecentAdsMainPage"] ) , " DateAdded desc" ) ;
						if ( ! empty ( $ads ) )
							foreach ( $ads as $ad ) :
					?>
					<li>
						<a href="<?php echo get_sef_url ( $ad["AdID"] , "Classified" ) ; ?>/">
							<?php echo $ad["AdTitle"] ?>
						</a>
					</li>
					<?php
							endforeach ;
					?>
				</ul>
			</div>
			<div class="listmodule" style="margin-top:7px;">
				<div style="text-align: center;">
					<center>
					<?php
						$g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Home Right" ) ) ;
						if ( ! empty ( $g_ads ) )
							foreach ( $g_ads as $g_ad )
								echo $g_ad["MarketingScript"] ."<br><br>" ;
					?>
					</center>
					

				</div>
			</div>
			
		</div>

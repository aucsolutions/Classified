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
    <div id="searchsection">
	
	<?php
	

if ( intval ( $_SESSION["login_account_id"] ) > 0  )
{
echo "Login As: ".$_SESSION["login_member_email"] ;
//echo $data->count_record ( "Classified" , array ( "IsActive" => 1 , "AccountID" => $_SESSION["login_account_id"] ) ) ;
}
else
{
?>
  
      <div class="leftsection">
        <div class="mainsearch">
          <div class="search">
            <div class="search_tagline"> It&#8217;s that fast! <span>the better way to find what you want</span></div>
            <div class="searchbox">
              <ul class="searchbox-section">
                <li>
                  <input name="" type="text" class="search-inputbox" value="Keywords" />
                </li>
                <li>
                  <input name="" type="text" class="search-inputbox" value="Categories" />
                  <div class="arrow" id="megaanchor">▼</div>
				  <div id="megamenu1" class="megamenu">
				  
				  

				  <?php
				  echo "<div style='background-color:#e0e0e0;margin-bottom:2px;text-align:center;'>"."All Categories"."</div>";
										$i = 0 ;
										if ( ! empty ( $mainCategory ) )
											foreach ( $mainCategory as $cat ) :
									?>
								<?php
													if ( $i == 0 || $i == 3 || $i == 6 )
													
														echo '<div class="column">' ;
													
													echo "<h3>".$cat["CategoryName"]."</h3>";
														$subCat = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => $cat["CategoryID"] ) ) ;
													if ( ! empty ( $subCat ) ):
														echo "<ul>" ;
														foreach ( $subCat as $subCat ) :
															echo "<li><a href='".base_url."category/".get_sef_url($subCat["CategoryID"],"Category")."/'>".$subCat["CategoryName"]."</a></li>" ;
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
				  
				  
				  
                </li>
                <li>
                  <input name="" type="text" class="search-inputbox" value="Current Location" />
                  <div class="arrow">▼</div>
                </li>
              </ul>
<div class="search-btn"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/search_btn.jpg" width="127" height="35" alt="" /></div>

            </div>
          </div>
          <div class="premiumadd-slider">
            <div class="heading">Premium Paid Ad Placement: City, State</div>
            <div class="slidermain">
              <div class="leftarrow"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/left_arrow.png" width="16" height="27" alt="" /></div>
              <div class="imageslider">
                <ul>
                  <li><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/img_1.jpg" width="125" height="125" alt="" /> <span>Toshiba REGZA 32" 720p LCD HDTV 32C110U</span></li>
                  <li><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/img_2.jpg" width="125" height="125" alt="" /> <span>Apple iPhone 4S (Latest Model) ...</span></li>
                  <li><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/img_3.jpg" width="125" height="125" alt="" /> <span>Honda CBR250R with 250cc powerful ...</span></li>
                  <li><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/img_4.jpg" width="125" height="125" alt="" /> <span>Men's skincare products by L'Oreal.</span></li>
                  <li><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/img_5.jpg" width="125" height="125" alt="" /> <span>New Canon EOS Rebel T3 12.2 MP Digital ...</span></li>
                </ul>
              </div>
              <div class="rightarrow"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/right_arrow.png" width="16" height="27" alt="" /></div>
            </div>
          </div>
        </div>
        <div class="appstote">
          <div class="addstore"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/phone.png" alt="" width="166" height="93" align="left" />The OZthink  mobile app allows you to post your classi?eds directly from your smart phone. It&#8217;s faster and easier to snap a photo, edit your details and post online.<br />
            <img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/appstore_img.jpg" alt="" width="121" height="40" align="right" /><br />
            Simply download the app to get started.</div>
          <div class="followus"><span>Find Us On</span><br />
            <img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/facebook.jpg" width="38" height="38" alt="" />&nbsp;&nbsp;<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/twitter.jpg" width="38" height="38" alt="" />&nbsp;&nbsp;<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/gtalk.jpg" width="38" height="38" alt="" />&nbsp;&nbsp;<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/pacount.jpg" width="38" height="38" alt="" /></div>
        </div>
      </div>
	  
<?php

}

?>
	  
	<div>
			<?php
				
	include ( "inc.rightsidebar.php" ) ;
?>
		
	</div>	
    </div>
  </div>
</div>
		<!--/content-->
		<?php include ( "inc.footer.php" ) ?>
	</div>
	
</body>
</html>

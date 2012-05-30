<!--- COMMENTE BLOCK CODE FOR FOOTER BY SWAPNESH ON 2012-05-17
<div id="footer" class="clearfix yui-ac">
			<div id="footer-container">
				<ul class="hmenu">
					<li class="first">
						<a href="<?php echo base_url ?>">
							<?php echo $lang["lang_footer"]["str_home_link"] ?>
						</a>
					</li>
					
					<?php
						if ( ! empty ( $static_pages ) )
							foreach ( $static_pages as $page )
							{
								if ( intval ( $page["IncludeFooter"] ) > 0 )
									echo "<li><div class='pipe'>|</div><a href='".base_url.get_sef_url ( $page["PageManagerID"] ,"StaticPage" )."/'>".$page["PageName"]."</a></li>" ;
							}
					?>
				</ul>
			</div>
		</div>
<div align="right">Powered by <a href="http://www.classifiedscript.org" target="_blank">Php Classifieds Script</a> &nbsp; </div>
<br>
--------------------------------------------------BLOCK CODE ENDS HERE-------------------------------------------------------->

<div id="footer">
  <div class="wrapper">
    <div class="footertop">
      <div class="footerleft"><?php echo $lang["lang_footer"]["str_copy_right"] ?> <?php // echo date("Y")." ".$app_init_data["SiteName"] ?></div>
      <div class="footerright">
        <ul class="footernav">
<!--          <li><a href="#">About Us</a></li>
          <li><a href="#">FAQS</a></li>
          <li><a href="#">Terms & Conditions</a></li>
          <li><a href="#">Privacy Policy</a></li>-->
		  		<?php
			if ( ! empty ( $static_pages ) )
				foreach ( $static_pages as $page )
				{
					if ( intval ( $page["IncludeFooter"] ) > 0 )
						echo "<li><a href='".base_url.get_sef_url ( $page["PageManagerID"] ,"StaticPage" )."/'>".$page["PageName"]."</a></li>" ;
				}
		?>
        </ul>
      </div>
    </div>
    <div class="footerbottom">
      <div class="footerleft"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce condimentum arcu a metus dictum vehicula. Maecenas ornare vulputate est in venenatis. Etiam erat urna, pretium eu accumsan id, accumsan convallis sapien.</span></div>
      <div class="footerright"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/paypal.jpg" width="134" height="89" alt="" /><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/nmi_logo.jpg" width="146" height="89" alt="" /></div>
    </div>
  </div>
</div>



<?php
	echo $app_init_data["GoogleAnalytics"] ;
?>
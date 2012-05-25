<div id="footer">
	
		<ul>
			<li>
				<a href="<?php echo base_url ?>">
					<?php echo $lang["lang_footer"]["str_home_link"] ?>
				</a>
			</li>
		<?php
			if ( ! empty ( $static_pages ) )
				foreach ( $static_pages as $page )
				{
					if ( intval ( $page["IncludeFooter"] ) > 0 )
						echo "<li><a href='".base_url.get_sef_url ( $page["PageManagerID"] ,"StaticPage" )."/'>".$page["PageName"]."</a></li>" ;
				}
		?>
			<!--<li>
				<a href="<?php echo base_url ?>c-ContactUs/">
					Contact Us
				</a>
			</li>-->
			
			<br>
			<li class="lastitem"><?php echo $lang["lang_footer"]["str_copy_right"] ?> <?php echo date("Y")." ".$app_init_data["SiteName"] ?> </li>
		</ul>
		<div align="right">Powered by <a href="http://www.classifiedscript.org" target="_blank">Php Classifieds Script</a> &nbsp; </div>
	
</div>

<?php
	echo $app_init_data["GoogleAnalytics"] ;
?>
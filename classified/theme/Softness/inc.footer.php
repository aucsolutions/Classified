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

<?php
	echo $app_init_data["GoogleAnalytics"] ;
?>
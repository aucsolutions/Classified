



<div id="footer">
    <hr class="noscreen" />

        <p class="f-right noprint">
            <?php
				if ( ! empty ( $static_pages ) )
					foreach ( $static_pages as $page )
					{
						if ( intval ( $page["IncludeFooter"] ) > 0 )
							echo "<a href='".base_url.get_sef_url ( $page["PageManagerID"] ,"StaticPage" )."/'>".$page["PageName"]."</a> | " ;
					}
			?>
        </p>

        <p><?php echo $lang["lang_footer"]["str_copy_right"] ?> <?php echo date("Y")." ".$app_init_data["SiteName"] ?>  <br />
        </p>
    </div>
	<div align="right">Powered by <a href="http://www.classifiedscript.org" target="_blank">Php Classifieds Script</a> &nbsp; </div>

<?php
	echo $app_init_data["GoogleAnalytics"] ;
?>
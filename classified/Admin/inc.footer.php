<style type="text/css">
<!--
.style1 {
	font-size: 10px;
	color: #009999;
}
.style2 {font-size: 10px}
-->
</style>
</td>
	</tr>
	
	<tr>
		<td colspan="100">
		<div id="footer">
    <div class="footer_menu" align="left" style="margin-top:10px; clear:both;">
	<p style="margin-left:4px;">
		<a href="<?php echo base_url ?>" target="_blank" style="font-size:12px; font-weight:bold; color:#ffffff; margin-left:3px;"> Home</a>
		<?php
			$static_pages = $data->select ( "PageManager" , "*" , array ( "IncludeFooter" => 1 ) ) ;
			if ( ! empty ( $static_pages ) )
				foreach ( $static_pages as $page )
				{
					echo " &nbsp; <a href='".base_url.get_sef_url ( $page["PageManagerID"] ,"StaticPage" )."/' style='font-size:12px; font-weight:bold; color:#ffffff; margin-left:3px;' target='_blank'>".$page["PageName"]."</a>" ;
				}
		?>
	</p>
  	</div>
</div>
<div align="right"><span class="style2">Powered by</span> <a href="http://www.classifiedscript.org" target="_blank" class="style1">Php Classifieds Script</a> &nbsp; </div>
		</td>
	</tr>


</table>
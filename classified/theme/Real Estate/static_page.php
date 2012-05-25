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
<div id="main">
	<div id="top">
		<!-- Start of HtmlPageHeader_01 -->
		
		<?php
			include ( "inc.header.php" ) ;
		?>
		
		<div id="pagestatus_new" style="">
		</div>
	</div>
	<div id="middle" align="center">
		<table border="0" cellpadding="5" cellspacing="3" width="90%" align="center">
			<tbody>
				<tr>
					<td valign="top" align="right">
						
						
						
						<div class="listmodule" style="margin-top:15px;" align="left">
							<span class="listtitle">
							<div style="float: left;">
								<?php echo $app_init_data["SiteName"] ?>
							</div>
							<div style="clear: both;">
							</div>
							</span>
							<ul>
								<?php
								if ( ! empty ( $static_pages ) )
									foreach ( $static_pages as $page )
									{
										echo "<li><a href='".base_url.get_sef_url ( $page["PageManagerID"] ,"StaticPage" )."/'>".$page["PageName"]."</a></li>" ;
									}
								?>
							</ul>
						</div>
						
						
						
						
						
					</td>
					<td style="padding: 15px;" valign="top" width="80%" align="left">
						
							<h1><?php echo $static_page["PageName"] ?></h1>

							<div>
								<?php echo $static_page["PageContents"] ?>
							</div>
					</td>
					
										
				</tr>
			</tbody>
		</table>
		
			<?php
				
				include ( "inc.footer.php" ) ;
			?>

		
	</div>
	
	
	<div id="myFavorites-panel">
	</div>
	
</div>

</body>
</html>

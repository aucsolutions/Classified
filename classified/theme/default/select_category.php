<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- Start of HtmlPageHtmlHead -->
<!-- AreaHome -->
<?php
	
	include ( "core/inc.meta.php" ) ;

?>
</head>
<body class="js-enabled">
<div id="main" style="width: 100%;">
	<div id="top">
		<!-- Start of HtmlPageHeader_01 -->
		
		<?php
			include ( "inc.header.php" ) ;
		?>
		
		<div id="pagestatus_new" style="">
		</div>
	</div>
	<div id="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td style="padding: 15px;" valign="top" width="80%">
						
						
						<table id="homecatgroup" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody>
									<tr>
										<td valign="top">
											<div class="catlist" style="margin-left:20px;" >
									<?php
										$i = 0 ;
										if ( ! empty ( $mainCategory ) )
											foreach ( $mainCategory as $cat ) :
									?>
											
												<?php
													if ( $i == 0 || $i == 3 || $i == 6 )
														echo "<div style='vertical-align:top; margin-left:10px; margin-top:10px; width:270px; height:auto; float:left;'>" ;
													$temp_src = base_url."media/cls_cat_".$cat["CategoryID"]."_5520.jpg" ;
													echo "<img src='".$temp_src."' style='vertical-align: middle; position: relative; left: -5px;' border='0' vspace='1' />" ;
													
													echo "<h2 class='homeMetaCatName'>".$cat["CategoryName"]."</h2>" ;
														$subCat = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => $cat["CategoryID"] ) ) ;
													if ( ! empty ( $subCat ) ):
														echo "<ul style='list-style-image:url(".base_url."theme/default/images/bullet.gif);'>" ;
														foreach ( $subCat as $subCat ) :
															echo "<li><a href='".base_url."c-CategorySelect/".$subCat["CategoryID"]."/'>".$subCat["CategoryName"]."</a>&nbsp; </li> " ;
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
										</div>
										</td>
								</tr>
							</tbody>
						</table>
						
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

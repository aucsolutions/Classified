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
<div id="main">
		
		<?php
			include ( "inc.header.php" ) ;
		?>
		
	
		<div id="page" class="box" >
						
		<div id="left-nav">
			<div id="narrow-options" class="orange-module">
				<div class="orange-tab">
					<h3>&nbsp;</h3>
				</div>
				
				<ul style="list-style-type:none;">
				
				<?php
				if ( ! empty ( $static_pages ) )
					foreach ( $static_pages as $page )
					{
						echo "<li><a href='".base_url.get_sef_url ( $page["PageManagerID"] ,"StaticPage" )."/'>".$page["PageName"]."</a></li>" ;
					}
				?>
				
				</ul>
				
			</div>
		</div>
		
		
		<div id="right-columns" style="background-color:#FFFFFF;">
			<div id="right-inside-wrapper">
				<h1><?php echo $static_page["PageName"] ?></h1>

				<div>
					<?php echo $static_page["PageContents"] ?>
				</div>
			</div>
		</div>
		</div>
			
		
	
	<?php
				
	include ( "inc.footer.php" ) ;
?>
</div>


</body>
</html>

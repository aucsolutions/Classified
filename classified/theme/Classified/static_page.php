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
      <div class="leftsection">
        
        <h1><?php echo $static_page["PageName"] ?></h1>

									<?php echo $static_page["PageContents"] ?>
				
      </div>
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

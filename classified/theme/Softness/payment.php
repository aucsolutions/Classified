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
Please wait <img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/loader.gif" border="0">
<form name="PPForm" id="PPForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick" />
<input type="hidden" name="item_name" value="<?php echo $app_init_data["SiteTitle"] ." Classified Ad Post " ?>" />
<input type="hidden" name="quantity" value="1" />
<input type="hidden" name="amount" value="<?php echo number_format ( $app_init_data["ClassifiedPrice"] , 2 ) ?>" />
<input type="hidden" name="item_number" value="<?php echo $_SESSION["last_ad_id"] ?>" />
<input type="hidden" name="business" value="<?php echo $app_init_data["PayPalUserName"] ?>" />
<input type="hidden" name="currency_code" value="<?php echo $app_init_data["PayPalCurrencyCode"] ?>" />
<input type="hidden" name="custom" value="<?php echo $app_init_data["SiteTitle"] ?> " />
<input type="hidden" name="lc" value="US" />
<input type="hidden" name="country" value="SG" />
<input type="hidden" name="cpp_header_image" value="<?php echo base_url ?>media/logo.jpg" />

<input type="hidden" name="no_shipping" value="1" />
<input type="hidden" name="no_note" value="0" />
<input type="hidden" name="return" value="<?php echo base_url ?>c-PayClassified/Return/" />
<input type="hidden" name="notify_url" value="<?php echo base_url ?>c-PayClassified/Notify/" />
<input type="hidden" name="cancel_return" value="<?php echo base_url ?>c-PayClassified/Cancel/" />

</form>
<script language="javascript">
	document.PPForm.submit();
</script>

</body>
</html>

						
						
						
						
						
					
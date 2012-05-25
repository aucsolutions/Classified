<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_payment"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	if ( $_POST )
	{
		foreach ( $_POST as $fieldName => $fieldValue )
		{
			if ( strchr ( $fieldName , "_Setting_" ) )
			{
				$fName = str_replace ( "_Setting_" , "" , $fieldName ) ;
				$data->update ( "SiteManager" , array ( "SiteValue" => $fieldValue ) , array ( "SiteVariable" => $fName ) ) ;
			}
		}
		if ( ! empty ( $_POST["EF_Plan_Amount"] ) )
			foreach ( $_POST["EF_Plan_Amount"] as $key => $amount )
			{
				$pay = $data->select ( "PaymentsPlan" , "*" , array ( "PaymentPlanID" => $key ) ) ;
				if ( ! empty ( $pay ) )
				{
					if ( empty ( $amount ) )
						$data->delete ( "PaymentsPlan" , array ( "PaymentPlanID" => $key ) ) ;
					else
						$data->update ( "PaymentsPlan" , array ( "Amount" => $amount , "DaysToExpire" => $_POST["EF_Plan_Days"][$key] ) , array ( "PaymentPlanID" => $key ) ) ;
				}
				else
				{
					
					$data->insert ( "PaymentsPlan" , array ( "Amount" => $amount , "DaysToExpire" => $_POST["EF_Plan_Days"][$key] ) ) ;
				}
			}
		$_SESSION["str_system_message"] = "Payments settings saved successfully." ;
	}
	$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
	$dataArray = array ( ) ;
	foreach ( $siteSettings as $site )
		$dataArray[$site["SiteVariable"]] = $site["SiteValue"] ;
	
	$siteSettings = null ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3> Payment Settings </h3>
				<div align="center">
					<form class="application_form" action="" method="post" onsubmit="return validateForm ( ) ;">
						<table cellpadding="2" cellspacing="1" width="70%">
							<tr>
								<td width="28%" valign="top" class="form_title" >Payment Notes</td>
								<td width="72%" valign="top">
									<textarea class="form_textarea" name="Payment_Setting_Notes" rows="3" cols="41" ><?php echo $dataArray["PaymentNotes"] ?></textarea>
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										This text will be shown when posting the classifieds, to the user, if Default Classified Price is not 0</strong>
									</div></td>
							</tr>
							<tr>
								<td width="28%" valign="top" class="form_title" >Paypal Email</td>
								<td width="72%" valign="top">
									<input type="text" class="form_text" name="PayPal_Setting_UserName" size="40" value="<?php echo $dataArray["PayPalUserName"] ?>" sch_req="1" sch_msg="Paypal email address" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Express Checkout username provided by the paypal.
									</div></td>
							</tr>

							<tr>
								<td class="form_title" valign="top" >Currency Code</td>
								<td valign="top">
									<input type="text" class="form_text" name="PayPal_Setting_CurrencyCode" size="5" maxlength="5" value="<?php echo $dataArray["PayPalCurrencyCode"] ?>"  sch_req="1" sch_msg="Currency Code" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										The currency code of your paypal transactions. e.g USD for US Dollar, CAD for Canadian Dollar, EUR for Euros and GBP for Pound sterling. You can find more <a href="https://www.paypal.com/cgi-bin/webscr?cmd=p/sell/mc/mc_wa-outside" target="_blank">Currency Codes HERE</a> .
									</div>								</td>
							</tr>
							
							
							<tr>
								<td class="form_title" valign="top" >Featured Plans</td>
								<td valign="top">
									<script language="javascript">
								function add_extra_field ( )
								{
									var tableString = "<div style='border-bottom:#000000 solid 1px; padding:5px; margin:5px;'>Amount : <input type='text' name='EF_Plan_Amount[]' maxlength='10' size='7' /> &nbsp;&nbsp; Days : <input type='text' name='EF_Plan_Days[]' size='7' maxlength='10' /></div>" ;
									$("#div_extra_fields").append ( tableString ) ;
								}
							</script>
									<div align="right">
											<input type="button" value="ADD" style="background-image:url(images/icons/add.png); background-repeat:no-repeat; background-position:left; height:24px; width:64px; border:#242424 solid 1px;" onclick="add_extra_field()" /><img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
											<div class="div_help" align="left">
												Featured plans.
											</div>
										</div>
									
									<div id="div_extra_fields">
									<?php
											$extra_fields = $data->select ( "PaymentsPlan" , "*", NULL ) ;
											if ( ! empty ( $extra_fields ) )
												foreach ( $extra_fields as $extra_field )
												{
									?>
												<div style='border-bottom:#000000 solid 1px; padding:5px; margin:5px;'>
													Amount : <input type="text" name="EF_Plan_Amount[<?php echo $extra_field["PaymentPlanID"] ?>]" size="7" maxlength="99" value="<?php echo $extra_field["Amount"] ?>" />
													&nbsp;&nbsp; Days : <input type="text" name="EF_Plan_Days[<?php echo $extra_field["PaymentPlanID"] ?>]" size="7" maxlength="10" value="<?php echo $extra_field["DaysToExpire"] ?>" />
												</div>
										
									<?php
												}
									
									?>
									</div>								</td>
							</tr>
							
							
							
							<tr>
								<td colspan="10" class="form_title" align="right" ><input type="submit" value="Save Settings" class="submit_button" />								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<?php include ( "inc.footer.php" ) ; ?>
			<!-- end #container -->
		</div>
	</body>
</html>

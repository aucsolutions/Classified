<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	
	include_once ( "../classes/misc.func.php" ) ;
	
	
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
			<h3>Contact to developers</h3>
			<div style="font-size: 11px; font-style: normal; font-weight: normal;">
<form method="post" action="support.php?send">

<?php
$ipi = getenv("REMOTE_ADDR");
$httprefi = getenv ("HTTP_REFERER");
$httpagenti = getenv ("HTTP_USER_AGENT");
?>

<input type="hidden" name="ip" value="<?php echo $ipi ?>" />
<input type="hidden" name="httpref" value="<?php echo $httprefi ?>" />
<input type="hidden" name="httpagent" value="<?php echo $httpagenti ?>" />

Your Name: <br />
<input type="text" name="visitor" size="35" />
<br /><br />
Your Email:<br />
<input type="text" name="visitormail" size="35" />
<br /> <br />
Message:<br />
<select name="attn" size="1">
<option value=" Report a bug ">Report a bug </option>
<option value=" General Support ">General Support </option>
<option value=" Feature Request ">Feature Request </option>
<option value=" Urgent ">Urgent Help </option>
</select>
<br /><br />
Mail Message:
<br />
<textarea name="notes" rows="4" cols="40"></textarea>
<br />
<input type="submit" value="Send Mail" />
<br />
</form>

<?php 
if(isset($_GET[send]) || $_REQUEST[send]!='') {

$ip = $_POST['ip'];
$httpref = $_POST['httpref'];
$httpagent = $_POST['httpagent'];
$visitor = $_POST['visitor'];
$visitormail = $_POST['visitormail'];
$notes = $_POST['notes'];
$attn = $_POST['attn'];


if (eregi('http:', $notes)) {
die ("Do NOT try that! ! ");
}
if(!$visitormail == "" && (!strstr($visitormail,"@") || !strstr($visitormail,".")))
{
echo "<h2>Enter valid e-mail</h2>\n";
$badinput = "<h2>The message was not sent!</h2>\n";
echo $badinput;
die ();
}

if(empty($visitor) || empty($visitormail) || empty($notes )) {
echo "<h2>Fill in all fields</h2>\n";
die ();
}

$todayis = date("l, F j, Y, g:i a") ;

$attn = $attn ;
$subject = $attn;

$notes = stripcslashes($notes);

$message = " $todayis [EST] \n
About: $attn \n
Message: $notes \n
From: $visitor ($visitormail)\n
Additional Info : IP = $ip \n
Browser Info: $httpagent \n
Referral : $httpref \n
";

$from = "From: $visitormail\r\n";

mail("support@scriptoffice.com", $subject, $message, $from);

echo 'Thank you! Your message was sent to scriptoffice.com';

}
?></div>
			<br />
						<br />
						Support Center: <a href="http://support.scriptoffice.com">http://support.scriptoffice.com</a><br>
							</div>
		<?php include ( "inc.footer.php" ) ; ?>
		<!-- end #container -->
	</div>
</body>
</html>

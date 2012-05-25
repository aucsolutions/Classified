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
			<h3><u>Update Checker</u></h3>
			<div style="font-size: 11px; font-style: normal; font-weight: normal;">
<br>
Installed version: <?php echo VERSION;?><br>
<br>
Available version: <?php $txt=file_get_contents('http://classifiedscript.org/check/version.txt'); echo $txt; 
if(VERSION == $txt) {
echo '<br><br>Sorry, no new updates at this time';
}
echo '<hr><br><h4>What\'s new:</h4>';
$txt=file_get_contents('http://classifiedscript.org/check/news.txt'); echo $txt;
?>
			<br /><br />
<!-- 	<h3>New file updates checker</h3>
	<br /><br />-->
<?php
/*
$txt=file_get_contents('http://classifiedscript.org/check/files.txt');
$data1=explode(":", $txt);
$data1=explode(" ", $data1);
//$new_files = explode("\n", $data1);

print_r($data1);
//print_r($new_files);

echo 'Your files:<br> '.$new_files[0].' : '.md5_file('../'.$new_files[0]);
echo '<br><br>';
$names=$new_files[1];
echo $names; 
foreach ($new_files as $a) {
//	echo $a;
}
*/
echo '<table width="80%" style="font-size: 11px; font-style: normal; font-weight: normal; "><tr><td>File Name</td><td>Hash</td></tr><tr>';
if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && is_file($file)) {
            echo "<tr><td>".$file."</td><td>".md5_file($file)."</td><tr>";
        }
    }
    closedir($handle);
}
echo "</tr></table>";

echo '<table width="80%" style="font-size: 11px; font-style: normal; font-weight: normal; "><tr><td>File Name</td><td>Hash</td></tr><tr>';
if ($handle = opendir('../')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "../" && $file != ".." && is_file($file)) {
            echo "<tr><td>".$file."</td><td>".md5_file($file)."</td><tr>";
        }
    }
    closedir($handle);
}
echo "</tr></table>";

?>			
			</div>
			<br />
						<br />
													</div>
		<?php include ( "inc.footer.php" ) ; ?>
		<!-- end #container -->
	</div>
</body>
</html>

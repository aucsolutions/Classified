<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "inc.meta.php" ) ; ?>
<style type="text/css">
<!--
.style1 {font-size: 10px}
-->
</style>

</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Application Summary </h3>
    <table cellspacing="8" cellpadding="0" border="0" width="100%" style="border:#cccccc 1px solid; background-color:#FFFFFF;">
      <tr>
        <td style="width:50%; margin-left:6px; background-color:#FFFFFF;"><table cellspacing="8" cellpadding="0" border="0" width="100%" style="border:#CCCCCC 1px solid; padding:6px; background-color:#FFFFFF;">
            <tr>
              <td class="textTitle" style="color:#990000;font-size:16px;font-weight:bold;" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td class="menu_top_link" style="width:65%;font-weight:bold;"><a href="classifiedlist.php?st=1" class="mainpage1">Active Classifieds </a><a href="authors.php" class="menuOption"></a></td>
              <td class="textValue" ><?php
									echo $data->count_record ( "Classified" , array ( "IsActive" => 1 ) ) ;
								?></td>
            </tr>
            <tr>
              <td class="mainpage1"><a href="classifiedlist.php?st=0"  class="mainpage1">InActive Classifieds</a><a href="authors.php?tp=1" class="mainpage1"></a></td>
              <td class="textValue"><?php
									echo $data->count_record ( "Classified" , array ( "IsActive" => '0' ) ) ;
								?></td>
            </tr>
            <tr>
              <td class="textTitle"><a href="paymentlist.php" class="mainpage1">Payments</a></td>
              <td class="textValue"><?php
									echo $data->count_record ( "Payments" , NULL ) ;
								?></td>
            </tr>
            <tr>
              <td class="textTitle"><a href="authors.php?tp=3" class="menuOption"></a></td>
              <td class="textValue">&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle"><a href="authors.php?st=0" class="menuOption"></a></td>
              <td class="textValue">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="10">&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle" style="color:#990000;font-size:16px;font-weight:bold;" colspan="2">&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td class="menuOption" align="left">&nbsp;</td>
              <td class="textValue">&nbsp;</td>
            </tr>
            <tr>
              <td class="menuOption" align="left">&nbsp;</td>
              <td class="textValue">&nbsp;</td>
            </tr>
            <tr>
              <td class="menuOption"  align="left">&nbsp;</td>
              <td class="textValue">&nbsp;</td>
            </tr>
        </table></td>
        <td style="width:50%; margin-left:6px; background-color:#FFFFFF;"><table cellspacing="8" cellpadding="0" border="0" width="100%" style="border:#cccccc 1px solid; padding:6px; background-color:#FFFFFF;">
            <tr>
              <td class="textTitle" style="color:#990000;font-size:16px;font-weight:bold;" colspan="2">&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle"><a href="accounts.php?st=1"  class="mainpage1">Active User Accounts</a><a href="categories.php" class="menuOption"></a></td>
              <td class="textValue"><?php
									echo $data->count_record ( "Account" , array ( "IsEnable" => '1' ) ) ;
								?></td>
            </tr>
            <tr>
              <td class="textTitle"><a href="accounts.php?st=0"  class="mainpage1">Banned User Accounts</a><a href="#" class="menuOption"></a></td>
              <td class="textValue"><?php
									echo $data->count_record ( "Account" , array ( "IsEnable" => '0' ) ) ;
								?></td>
            </tr>
			 <tr>
              <td class="textTitle"><a href="catlist.php" class="mainpage1">Total Categories</a></td>
              <td class="textValue"><?php
									echo $data->count_record ( "Category" , NULL ) ;
								?></td>
            </tr>
            <tr>
              <td class="textTitle" style="color:#990000;font-size:16px;font-weight:bold;" colspan="2">&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle" style="width:65%;font-weight:bold;"><a href="articles.php" class="menuOption"></a></td>
              <td class="textValue" style="font-weight:bold;">&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle"><a href="articles.php?st=1" class="menuOption"></a></td>
              <td class="textValue">&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle"><a href="articles.php?st=3" class="menuOption"></a></td>
              <td class="textValue">&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle"><a href="articles.php?st=2" class="menuOption"></a></td>
              <td class="textValue">&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle"><a href="articles.php?st=4" class="menuOption"></a></td>
              <td class="textValue">&nbsp;</td>
            </tr>
            <tr>
              <td class="textTitle"><a href="articles.php?hot=1" class="menuOption"></a></td>
              <td class="textValue">&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>

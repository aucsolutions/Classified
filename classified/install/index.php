<?
  function mysql_import_file ($filename)
  {
    $lines = file ($filename);
    if (!$lines)
    {
      $errmsg = '' . 'cannot open file ' . $filename;
      return false;
    }

    $scriptfile = false;
    foreach ($lines as $line)
    {
      $line = trim ($line);
      if (!ereg ('^--', $line))
      {
        $scriptfile .= ' ' . $line;
        continue;
      }
    }

    $queries = explode (';', $scriptfile);
    foreach ($queries as $query)
    {
      $query = trim ($query);
      ++$querycount;
      if ($query == '')
      {
        continue;
      }

      if (!mysql_query ($query))
      {
        $queryerrors .= '' . 'Line ' . $querycount . ' - ' . mysql_error () . '<br>';
        continue;
      }
    }

    if ($queryerrors)
    {
      echo '' . '<b>Errors Occured</b><br><br>Please open a ticket with the debug information below for support<br><br>File: ' . $filename . '<br>' . $queryerrors;
    }

    return true;
  }

  error_reporting (7);
  $latestversion = '5.1';
  echo '<html>
<head>
<title>Classified ADS PHP Script</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width=100% border=0 align="center" cellpadding=0 cellspacing=0>
  <tr>
    <td height="21" bgcolor="#EFEFEF" style="border-bottom:1px solid #999999; padding-left:12px;">&nbsp;</td>
    <td heig';
  echo 'ht="20" bgcolor="#EFEFEF" style="border-bottom:1px solid #999999; padding-right:12px;"><div align="right">';
  echo date ('l <b>|</b> jS F Y <b>|</b> g:ia');
  echo '</div></td>
  </tr>
<tr>
<td background="images/logobg.gif" height="71" colspan=2 style="padding-left:44px" bgcolor="#8FBCE9"><table width=100% cellspacing=0 cellpadding=0><tr><td width=219><div align="center">
<img src="images/toplogo.png"></div></td>
<td background="images/logobg.gif" width="730" align=center bgcolor="#8FBCE9"></td>
</tr></table></td></tr>
<tr>
	<tr>
	  <td height="';
  echo '39" colspan="2" background="images/topbg2.gif" class="menuLink" style="border-bottom:1px solid #999999;">&nbsp;</td>
  </tr>
	<tr bgcolor="#FFFFFF">
	  <td colspan="2" valign="top" bgcolor="#FFFFFF" style="padding-top:13px;padding-bottom:13px;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10" bgcolor="#F4F4F4" style="border-top: solid 1p';
  echo 'x #CCCCCC;">';
  echo '<s';
  echo 'pan class="style10">&nbsp;</span></td>
        </tr>
<tr><td class="pageheaderrow">';
  echo '<s';
  echo 'pan class="style8">INSTALL/UPGRADE CLASSIFIED SCRIPT</span></td></tr>
<tr><td class="pagecontentbox" valign="top">

';
  $step = $_REQUEST['step'];
  $type = $_REQUEST['type'];
  
  if ($step == '')
  {
    echo '
<p><b>End User License Agreement</b></p>
<p>Please review the license terms before installing Classified ADS PHP Script</p>
<p align="center"><textarea style="width:700px;font-family:Tahoma;font-size:10px;color:#666666" rows="25" readonly>
End User License Agreement

Information submitted by a buyer will not be shared, sold, reused in lists, or be used for any other purpose than to complete a transaction or address a   customer service concern.

Refund Policy

Classifiedscript.org is positive that you will be completely satisfied with our Script and you can rest assure that your order is backed  by a 100% Money Back Guarantee if you find yourself in positions below:

    * We not deliver the Script. OR,
    * Our support team are not able to get it solved via the  email support.
    
    Support Center: http://support.scriptoffice.com
    Support email: support@scriptoffice.com or support@classifiedscript.org
        
P.S.>> IF SCRIPT ALREADY INSTALLED, PLEASE REMOVE $install="1"; FROM CONFIG.PHP
';

echo '
</textarea></p>
<p align=center><input type="submit" value="I AGREE" class="button" onClick="window.location=\'';
    echo $PHP_SELF;
    echo '?step=2\'"> <input type="button" value="I DISAGREE" class="button" onClick="window.location=\'';
    echo $PHP_SELF;
    echo '\'">

';
  }
  else
  {
    if ($step == '2')
    {
      echo '	
	
<p><b>System Requirement Checks</b></p>
<p style="font-size: 16px;">
&raquo; PHP Version .......... ';
      if ('4.2.0' <= phpversion ())
      {
        echo '<font color=#99cc00><B>Passed</B></font>';
      }
      else
      {
        echo 'Your PHP version needs to be upgraded to at least V5.1.0 before you can use Classified Script.';
        $error = '1';
      }

      echo '<br>
&raquo; MySQL .......... ';
      if (function_exists ('mysql_connect'))
      {
        echo '<font color=#99cc00><B>Passed</B></font>';
      }
      else
      {
        echo 'MySQL support is not available in this PHP installation.  It is required by Classified Script for it to function.';
        $error = '1';
      }

      echo '<br>
&raquo; CURL .......... ';
      if (function_exists ('curl_init'))
      {
        echo '<font color=#99cc00><B>Passed</B></font>';
      }
      else
      {
        echo 'You should have CURL installed <font color="red" size="-2">(We do not guarantee proper work without this module! Contact to your hosting provider to install cURL PHP module)</font>';
      }

          echo '<br>
&raquo; GD .......... ';
      if (extension_loaded('gd') && function_exists('gd_info'))
      {
        echo '<font color=#99cc00><B>Passed</B></font>';
      }
      else
      {
        echo 'You must have GD or GD2 installed';
        $error = '1';
      }
     
      echo '</p>

<b>Permissions Checks</b></p>
<p style="font-size: 16px;">
&raquo; Configuration File .......... ';
      if (is_writable ('../config.php'))
      {
        echo '<font color=#99cc00><B>Passed</B></font>';
      }
      else
      {
        echo 'You should set permissions for the config.php file so it can be written to (CHMOD 777) <font color="red" size="-2">(You may put needed code manually at the end)</font>';
        
      }

      echo '<br>
&raquo; Media Folder Permissions .......... ';
      if (is_writable ('../media/'))
      {
        echo '<font color=#99cc00><B>Passed</B></font>';
      }
      else
      {
        echo 'You must set permissions for the media folder so it can be written to (CHMOD 777)';
        $error = '1';
      }

      echo '</p>

';
      if ($error == '1')
      {
        echo '<p><b>Error!  Some Preinstallation Checks Failed.</b> You must correct the errors above before you can continue with installation.</p>
';
      }
      else
      {
        echo '<form method="post" action="';
        echo $PHP_SELF;
        echo '?step=3">
<p><b>Installation Type</b></p>
<p>Choose your installation type from below.  Please ensure you <B>backup</B> your database before upgrading.</p>
<p><input type="radio" name="type" value="newinstall" checked> New Install V';
        echo $latestversion;
        echo '<br>
';
        include '../config.php';
         
        echo '<input type="radio" name="type" value="upgrade50"';
        if (VERSION == '5.0')
        {
          echo ' checked';
        }
        else
        {
          echo ' disabled';
        }

        echo '> Upgrade from v.5.0 to v.'.$latestversion;
		echo '<br />';
        echo '<input type="radio" name="type" value="upgrade49"';
        if (VERSION == '4.9')
        {
          echo ' checked';
        }
        else
        {
          echo ' disabled';
        }

        echo '> Upgrade from v.4.9 to v.'.$latestversion;
        
        echo '</p>
<p align="center">
<input type="submit" value="Begin Installation" class="button"></p>
</form>
';
      }

      echo '
';
    }
    else
    {
      if ($step == '3')
      {
        echo '
<form method="post" action="';
        echo $PHP_SELF;
        echo '?step=4">
<!--<p><b>License Key</b></p>
<p>You can obtain license <a href="http://classifiedscript.org/register.php">here</a></p>
<table>
<tr><td width=120>License Key</td><td><input type="text" name="licensekey" size="20"></td></tr>
</table>
-->
<p><b>Your domain name</b></p>
<p>e.g. <b>http://www.yourdomain.com/ <font color="red" size="-2">(DON\'T FORGET ending slash)</font></p>
<table>
<tr><td width=120>Domain</td><td><input type="text" name="domain" size="40" value="http://'.$_SERVER[HTTP_HOST].'/"></td></tr>
</table>


<p><b>Database Connection ';
        echo 'Section Details</b></p>
<p>You must now create a MySQL database in your control panel and assign a user to it.  Once this is complete, enter the connection details below.</p>
<table>
<tr><td width=120>Database Host</td><td><input type="text" name="dbhost" size="20" value="localhost"></td></tr>
<tr><td>Database Name</td><td><input type="text" name="dbname" size="20" value=""></td></tr>
<tr><td>Database Username</td>';
        echo '<td><input type="text" name="dbusername" size="20" value=""></td></tr>
<tr><td>Database Password</td><td><input type="text" name="dbpassword" size="20"></td></tr>
<tr><td>Import all 100+ Categories in database provided</td>
<td><input type="checkbox" name="category" value="1" checked="checked" /></td></tr>
</table>

<p align="center"><input type="submit" value="Continue &raquo;" class="button"></p>
</form>

';
      }
      else
      {
        if ($step == '4')
        {
         if ($_REQUEST['domain'] == '')
          {
            echo 'You did not enter your domain name.  You must go back and correct this.';
            exit ();
          }

$htm = ".htm";
$output = "<?php
define ( base_url , '" . $_REQUEST['domain'] . "' ) ; 
define ( DBSERVER , '" . $_REQUEST['dbhost'] . "' ) ; 
define ( DBNAME , '" . $_REQUEST['dbname'] . "' ) ; 
define ( DBUSERNAME , '" . $_REQUEST['dbusername'] . "' ) ; 
define ( DBPASSWORD , '" . $_REQUEST['dbpassword'] . "' ) ; 
define ( URLPOSTFIX , '" . $htm . "' ) ; 
define ( VERSION, '" . $latestversion . "' ) ;
error_reporting ( 0 ) ; 
?>";
          $fp = fopen ('../config.php', 'w');
          fwrite ($fp, $output);
          fclose ($fp);
          include '../config.php';
          $link = mysql_connect (DBSERVER, DBUSERNAME, DBPASSWORD);
          if (!(mysql_select_db (DBNAME)))
          {
            exit ('Could not connect to the database - check the database connection details you entered and go back and correct them if necessary');
          }

          mysql_import_file ('sql/maindb.sql');
          mysql_import_file ('sql/country.sql');
          if($_REQUEST['category'] == 1) {
          mysql_import_file ('sql/category.sql');
          mysql_import_file ('sql/sef.sql');
          }
          echo '
<p><b>Setup Administrator Account</b></p>
<form method="post" action="';
          echo $PHP_SELF;
          echo '?step=5">
<p><b>Here is Administrator login:</b></p>
<table>
<tr><td>Login:</td><td><input type="text" name="email" size="50" value="admin" readonly /></td></tr>
<tr><td>Passwor';
echo 'd:</td><td><input type="text" name="password" size="20" value="admin" readonly /></td></tr>
</table>
<p align="center"><input type="submit" value="Continue" class="button"></p>
</form>

';
          
        }
        else
        {
          if ($step == '5')
          {
            include '../config.php';
            $link = mysql_connect (DBSERVER, DBUSERNAME, DBPASSWORD);
            if (!(mysql_select_db (DBNAME)))
            {
              exit ('Could not connect to the database - check the database connection details you entered and go back and correct them if necessary');
              
            }
            echo '
<p><b>Installation Complete</b></p>

<p>Here\'s what you should do next:</p>

<p><b>1. Delete the Install Folder</b></p>
<p>Make sure you delete the <b><i>install</i></b> directory from your server now setup has been completed - leaving it on your server is a big security risk.</p>

<p><b>2. Setup the Cron Job</b></p>
<p>You should setup a cron job in your control panel to run using the following command once';
            echo ' per day:<br>
<input type="text" size="120" value="php -q ';
            $pos = strrpos ($_SERVER['SCRIPT_FILENAME'], '/');
            $filename = substr ($_SERVER['SCRIPT_FILENAME'], 0, $pos);
            $pos = strrpos ($filename, '/');
            $filename = substr ($filename, 0, $pos);
            echo $filename;
            echo '/cron.php"></p>

<p><b>3. Set READ ONLY permissions for config.php file (644)</b></p>';
echo '<p>You can do that by any FTP-client or SSH (chmod 644 config.php)<br>
Please do not hesitate to <a href="http://support.scriptoffice.com">contact us</a></p>

<p><b>4. Completed the above?</b>(default: admin/admin)</p>';
echo '<p><a href="../Admin/">Click here to go to the admin area</a></p>


<p><b>Thank you for choosing Classified Script!</b></p>

';
          }
                        }
                      }
                    }
                  }
                
 echo '
</td>
        </tr>
		<tr>
          <td height="10" bgcolor="#F4F4F4" style="border-bottom: solid 1px #CCCCCC;">';
  echo '<s';
  echo 'pan class="style10">&nbsp;</span></td>
        </tr>
      </table>	  </td>
	</tr>
	
	<tr>
		<td style="border-top:1px solid #999999;padding:12px" height="30" colspan=2 bgcolor="#ECECEC">';
  echo '<s';
  echo 'pan class="style2"><a href="http://www.classifiedscript.org">Classified Script Home Page</a> | <a href="http://support.scriptoffice.com">Support Center</a></span></td>
	</tr>
</table>
</body>
</html>
';
?>
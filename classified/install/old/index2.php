<?php
	
	session_start ( ) ;
	
	
	if ( $_POST )
	{
		switch ( $_POST["step"] )
		{
			case "1" :
				// first Step posted
				exec ( "chmod ../config.php 777" ) ;
				
				$_SESSION["url"] = $_POST["txtSiteUrl"] ;
				$_SESSION["dbserver"] = $_POST["txtDatabaseServer"] ;
				$_SESSION["dbpassword"] = $_POST["txtDatabasePassword"] ;
				$_SESSION["dbusername"] = $_POST["txtDatabaseUserName"] ;
				$_SESSION["dbname"] = $_POST["txtDatabaseName"] ;
				mysql_connect ( $_SESSION["dbserver"] , $_SESSION["dbusername"] , $_SESSION["dbpassword"] ) or die ( header ("location:index.php" ) ) ;
				mysql_select_db ( $_SESSION["dbname"] ) or die ( header ("location:index.php" ) ) ;
				
				$contents = "<?php \r\n define ( base_url , '".$_POST["txtSiteUrl"]."' ) ; \r\n define ( DBSERVER , '".$_POST["txtDatabaseServer"]."' ) ; \r\n define ( DBPASSWORD , '".$_POST["txtDatabasePassword"]."' ) ; \r\n define ( DBUSERNAME , '".$_POST["txtDatabaseUserName"]."' ) ; \r\n define ( DBNAME , '".$_POST["txtDatabaseName"]."' ) ; \r\n define ( URLPOSTFIX , '.htm' ) ; \r\n error_reporting ( 0 ) ; \r\n ?>" ;
				
				$conf = fopen ( "../config.php" , "w" ) ;
				
				fwrite( $conf , $contents ) ;
				
				fclose ( $conf ) ;
				
				exec ( "chmod ../config.php 755" ) ;
				header ( "location:index.php?step=1" ) ;
				exit () ; 
				break;
			case "2" :
				
				// second Step posted
				$contents = file_get_contents ( "maindb.sql" ) ;
				$array = explode ( ";" , $contents ) ;
				mysql_connect ( $_SESSION["dbserver"] , $_SESSION["dbusername"] , $_SESSION["dbpassword"] ) or die ( mysql_error ( ) ) ;
				mysql_select_db ( $_SESSION["dbname"] ) or die ( "SQL Error importing." ) ;
				
				foreach ( $array as $con )
				{
					if ( strlen ( $con ) > 5 )
						mysql_query ( $con ) or die ( mysql_error ( ) ) ;
				}
				
				if ( intval ( $_POST["chkCategory"] ) == 1 )
				{
					
					$contents = file_get_contents ( "category.sql" ) ;
					mysql_query ( $contents ) or die ( "Category Import Error (375)." ) ;
					$contents = file_get_contents ( "sef.sql" ) ;
					mysql_query ( $contents ) or die ( "Category Import Error (550)." ) ;
					
				}
				
				header ( "location:index.php?step=2" ) ;
				exit () ; 
				break;
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title> <<< Classified : Installer >>> </title>
	<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
	<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/jss/yadjs.js"></script>   
	<style type="text/css">
<!--
.heading 
{
	color: #000000;
	font-size:20px;
	font-weight:bold;
	font-family:Arial, Helvetica, sans-serif;
	margin:20px;
	border-bottom:#466491 solid 2px;
	border-right:#466491 solid 1px;
	border-top:#466491 solid 1px;
	border-left: #466491 solid 1px;
	padding:5px;
}
.formArea
{
	background-color:#CFD6D5;
	margin:20px;
	border:#466491 dotted 1px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
}
.formTable
{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#5F4383;
}

-->
	</style>
</head>

<body>

<!-- Wraper -->
<div id="wraper">

    <div align="center" style="background-color:#FDFDFD; padding:50px;">
    
<?php
	if ( intval ( $_GET["step"] ) < 1 )
	{
?>
		
		<div class="heading" align="left">Step 1</div>
		<div class="formArea">
			<form action="" method="post">
				<input type="hidden" name="step" value="1" />
				<table class="formTable" cellspacing="15">
					<tr>
						<td align="right" valign="top">
							Web Site (URL) 
						</td>
						<td>
							<input type="text" name="txtSiteUrl" value="http://<?php echo $_SERVER['HTTP_HOST'].str_replace ( "install/index.php","",$_SERVER['SCRIPT_NAME']); ?>" />
							<br />
							<span style="font-size:11px; color:#578055;">
								URL must end with / . This be the URL of YAD.<br />
								EXAMPLE : http://www.mydirectory.com/
							</span>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top">
							Database Server 
						</td>
						<td>
							<input type="text" name="txtDatabaseServer" value="localhost" /><br />
							<span style="font-size:11px; color:#578055;">
								MySQL Database server is the server your database resides.<br />
								DEFAULT is " localhost "
							</span>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top">
							Database Name 
						</td>
						<td>
							<input type="text" name="txtDatabaseName" value="" /><br />
							<span style="font-size:11px; color:#578055;">
								Database name that you created for YAD directory to run at.
							</span>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top">
							Database Username 
						</td>
						<td>
							<input type="text" name="txtDatabaseUserName" value="" /><br />
							<span style="font-size:11px; color:#578055;">
								Database UserName that you created for YAD
								<br /> directory to run with Database name.
							</span>
						</td>
					</tr>
					<tr>
						<td align="right">
							Database Password 
						</td>
						<td>
							<input type="text" name="txtDatabasePassword" value="" />
						</td>
					</tr>
					<tr>
						<td align="center" colspan="10">
							<input type="submit" value="Proceed To Next Step" />
						</td>
					</tr>
					
					
				</table>
			</form>
		</div>
<?php
	}
	elseif ( intval ( $_GET["step"] ) == 1 )
	{
?>
		
		<div class="heading" align="left">Step 2</div>
		<div class="formArea">
			<form action="" method="post">
				<input type="hidden" name="step" value="2" />
				<table class="formTable" cellspacing="15">
					<tr>
						<td align="left" colspan="10">
							<label>
								<input type="checkbox" name="chkCategory" value="1" checked="checked" />
								Import all 100+ Categories in database provided.							</label>
						</td>
					</tr>
					
					<tr>
						<td align="center" colspan="10">
							<input type="submit" value="Proceed To Next Step" />
						</td>
					</tr>
				</table>
			</form>
		</div>
<?php
	}
	else
	{
?>
		
		<div class="heading" align="left">
			Step 4
		</div>
		<div class="formArea">
			Every thing successfully created. you can now browse your site <a href="<?php echo $_SESSION["url"] ?>"><?php echo $_SESSION["url"] ?></a>
			<br />
			<div style="font-size:14px; font-weight:bold; color:#92413D; margin:5px;">Kindly open your ftp and delete the folder "INSTALL" for security reasons.</div>
		</div>
<?php
	}
?>	


		
    </div>
    
</div> 


</body>
</html>
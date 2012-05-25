<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
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
    <h3>  </h3>
    	
		<table width="75%">
			<tr>
				<td width="48%" align="center" style="border:#cccccc 1px solid;">
					<table cellspacing="8">
						<tr>
							<td><a href="classifiedlist.php?st=1" class="mainpage1">
								My Active Classifieds
								</a></td>
							<td>
								<?php
									echo $data->count_record ( "Classified" , array ( "IsActive" => 1 , "AccountID" => $_SESSION["login_account_id"] ) ) ;
								?>
							</td>
						</tr>
						<tr>
							<td>
								<a href="classifiedlist.php?st=0" class="mainpage1">
									My InActive Classifieds
								</a>
								</td>
							<td><?php
									echo $data->count_record ( "Classified" , array ( "IsActive" => '0' , "AccountID" => $_SESSION["login_account_id"] ) ) ;
								?></td>
						</tr>
						
						
					</table>
				</td>
			</tr>
			
		</table>
		
		
		
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>

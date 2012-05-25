<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_account"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
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
    <h3> Administrators Users</h3>
    	
		
		<form action="p.admins.php" method="post">
		
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_action">
					<td colspan="100">
						With Selected :
						<label><input type="radio" name="radOption" value="del" /> <img src="images/icons/delete.png" /> 
						Delete</label>
						
						
						<label><input type="radio" name="radOption" value="actv_1" /> <img src="images/icons/bell_go.png" /> 
						Mark Enable</label>
						<label><input type="radio" name="radOption" value="actv_0" /> <img src="images/icons/bell_error.png" /> 
						Mark disable</label>
						
						<input type="submit" value="GO" class="submit_button" />
						
					</td>
				</tr>
				<tr class="listing_heading">
					<th width="2%">&nbsp;
						
					</th>
					<th>
						Administrators 
					</th>
					<th>
						Created
					</th>
					<th>
						Actions
					</th>
				</tr>
				<?php
					$i = 0 ;
					$ads = $data->select ( "Admins" , "*" , null , intval ( $_GET["p"] ) * $pageSize , $pageSize ) ;
					foreach ( $ads as $ad) :
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
					<tr class="<?php echo $css_class ?>">
						<td>
							<input type="checkbox" name="chkAdID[]" value="<?php echo $ad["AdminID"] ?>" />
						</td>
						<td width="46%">
							<?php echo $ad["AdminEmail"] ?>
							
						</td>
						
						
						<td width="14%">
							<?php echo date( "F j, Y" , strtotime ( $ad["DateAdded"] ) ) ?>
						</td>
						<td width="23%" align="center">
							<a href="admin.php?id=<?php echo $ad["AdminID"] ?>" title="Edit this Admin">
								<img src="images/icons/wrench.png" border="0" alt="Edit" />
							</a>
						</td>
					</tr>
				<?php
					endforeach ;
				?>
				<?php
					include ( "inc.paging.php" ) ;
				?>
			</table>
		</form>
		<br />
		<br />
		
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>

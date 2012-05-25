<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_payment"] ) == 0 )
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
    <h3> Payments </h3>
    	
		<table width="100%" class="listings" cellpadding="3" cellspacing="0">
			<tr class="listing_heading">
				<th>
					Payment ID
				</th>
				<th>
					Classified
				</th>
				<th>
					Amount
				</th>
				
				<th>
					Actions
				</th>
			</tr>
			<?php
				$i = 0 ;
				$ads = $data->select ( "Payments" , "*", null , intval ( $_GET["p"] ) * $pageSize , $pageSize ) ;
				if ( ! empty ( $ads ) )
				foreach ( $ads as $ad) :
					$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
			?>
				<tr class="<?php echo $css_class ?>">
					<td width="17%">
						<?php echo $ad["PaymentID"] ?>
					</td>
					<td width="41%">
						<?php
							$ad_detail = $data->select ( "Classified" , "*" , array ( "AdID" => $ad["AdID"] ) ) ;
						 	$ad_detail = $ad_detail[0] ;
							echo $ad_detail["AdTitle"] ;
						 ?>
					</td>
					
					<td width="11%">
						<strong>$<?php echo number_format ( $ad["Amount"] ) ?></strong>
					</td>
					<td width="20%" align="center">
						<a href="category.php?id=<?php echo $ad["CategoryID"] ?>" title="Edit this Category">
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
		<br />
		<br />
		
		
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>

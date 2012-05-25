<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	$classified = array ( ) ;
	
	$w_list = $data->select ( "WatchList" , "*" , array ( "AccountID" => intval ( $_SESSION["login_account_id"] ) ) ) ;
	if ( ! empty ( $w_list ) )
	{
		foreach ( $w_list as $w_data )
		{
			$w_clas = $data->select ( "Classified" ,"*" , array ( "AdID" => $w_data["AdID"] ) ) ;
			array_push( $classified , $w_clas[0] ) ;
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "inc.meta.php" ) ; ?>
<script language="javascript">
	function deleteAd ( ad_id )
	{
		if ( parseInt ( ad_id ) > 0 )
			if ( window.confirm ( "Are you sure you want to delete this ad from your watch list?" ) )
			{
				window.location = "p.delete_watchlist.php?id="+ad_id ;
			}
	}
</script>
</head>
<body class="oneColElsCtrHdr">
	<div id="container">
		<?php include ( "inc.header.php" ) ; ?>
		<div id="mainContent">
			<h3> My Watchlist </h3>
			
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_heading">
					<th width="4%"> Ad ID </th>
					<th>  Ad </th>
					<th> Type </th>
					<th> Price </th>
					<th> Posted </th>
					<th> Actions </th>
				</tr>
				<?php
					$i = 0 ;
					
					$like_array = array ( ) ;
					
					if ( ! empty ( $classified ) )
					foreach ( $classified as $ad ) :
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
				<tr class="<?php echo $css_class ?>">
					<td valign="top"><?php echo $ad["AdID"] ?>
					</td>
					<td width="50%"><em>Title :</em>
						<?php echo $ad["AdTitle"] ?>
						<br />
						<div style="font-weight:normal; font-size:12px; margin-left:10px; margin-top:3px; padding:3px; border-left:#BBBBBB solid 2px;">
							<?php echo substr(strip_tags ( $ad["Description"] ) , 0 , 140 ) ?>...
						</div></td>
					<td width="8%"><?php echo intval ( $ad["IsOffer"] ) == 1 ? "Offer" : "Wants" ?>
					</td>
					<td width="8%"><strong>$<?php echo number_format ( $ad["Price"] ) ?></strong>
					</td>
					<td width="10%"><?php echo date( "F j, Y" , strtotime ( $ad["DateAdded"] ) ) ?>
					</td>
					<td width="17%" align="center">
						<a href="#" title="Delete Ad" onclick="deleteAd ( <?php echo $ad["AdID"] ?> )">
							<img src="../Admin/images/icons/delete.png" border="0" alt="Delete" />
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
		<!-- end #container -->
	</div>
</body>
</html>

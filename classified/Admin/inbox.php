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
			<h3> Messages </h3>
			
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_heading">
					<th>  Message </th>
					<th> Posted </th>
					<th width="4%">Action</th>
				</tr>
				<?php
					$i = 0 ;
					$data->set_smaller ( array ( "FromAccountID" => 1 ) ) ;
					$classified = $data->select ( "Messages" , "*" , NULL , intval ( $_GET["p"] ) * $pageSize , $pageSize , "DateAdded desc" ) ;
					if ( ! empty ( $classified ) )
					foreach ( $classified as $ad ) :
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
				<tr class="<?php echo $css_class ?>">
					<td width="73%"><em>Subject :</em>
						<?php echo $ad["Subject"] ?>
						<br />
						<div style="font-weight:normal; font-size:12px; margin-left:10px; margin-top:3px; padding:3px; border-left:#BBBBBB solid 2px;">
							<?php echo $ad["Body"] ?>...
					</div></td>
					<td width="23%"><?php echo date( "F j, Y" , strtotime ( $ad["DateAdded"] ) ) ?>					</td>
					
					<td>
						<a href="send_message.php?ac_id=<?php echo $ad["FromAccountID"] ?>" title="Reply to message"><img src="images/icons/email_add.png" alt="Reply" border="0" /></a>
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

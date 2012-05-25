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
			if ( window.confirm ( "Are you sure you want to delete this ad" ) )
			{
				window.location = "p.delete_classified.php?id="+ad_id ;
			}
	}
</script>
</head>
<body class="oneColElsCtrHdr">
	<div id="container">
		<?php include ( "inc.header.php" ) ; ?>
		<div id="mainContent">
			<h3> My Classified </h3>
			<form action="" method="get">
				<table class="listings" width="100%">
					<tr>
						<td width="9%"> Search </td>
						<td width="52%"> Keyword
							<input type="text" name="kwd" value="<?php echo $_GET["kwd"] ?>" size="50" />
						</td>
						<td width="21%"><input type="submit" value="SEARCH" style="font-weight:bold;" />
						</td>
					</tr>
				</table>
			</form>
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_heading">
					<th width="4%"> Ad ID </th>
					<th> Posted Ad </th>
					<th> Type </th>
					<th> Price </th>
					<th> Posted </th>
					<th> Actions </th>
				</tr>
				<?php
					$i = 0 ;
					$req_array = array ( "AccountID" => $_SESSION["login_account_id"] ) ;
					$like_array = array ( ) ;
					if ( isset ( $_GET["st"] ) )
						$req_array["IsActive"] = (string) intval ( $_GET["st"] ) ;
					if ( $_GET["kwd"] != "" )
					{
						$like_array["AdTitle"] = $_GET["kwd"] ;
						$data->set_like ( $like_array ) ;
					}
					
					$ads = $data->select ( "Classified" , "*" , $req_array , intval ( $_GET["p"] ) * $pageSize , $pageSize , "DateAdded desc" ) ;
					if ( ! empty ( $ads ) )
					foreach ( $ads as $ad) :
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
						<a href="detail.php?id=<?php echo $ad["AdID"] ?>" title="Detail of this ad">
							<img src="../Admin/images/icons/report_picture.png" border="0" alt="Edit" />						</a>
						&nbsp;
						<a href="modifyad.php?id=<?php echo $ad["AdID"] ?>" title="Edit this AD">
							<img src="../Admin/images/icons/script_edit.png" alt="Edit" width="16" height="16" border="0" />						</a>
						&nbsp;
						<a href="#" title="Delete Ad" onclick="deleteAd ( <?php echo $ad["AdID"] ?> )">
							<img src="../Admin/images/icons/delete.png" border="0" alt="Delete" />						</a>					</td>
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

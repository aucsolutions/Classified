<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_ad"] ) == 0 )
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
    <h3> Classified </h3>
    	
		<form action="" method="get">
			<table class="listings" width="100%">
				<tr>
					<td width="5%">
						Search
					</td>
					<td width="15%">
						Ad ID 
							<input type="text" name="ad_id" size="10" />
					</td>
					<td width="47%">
						Keyword 
							<input type="text" name="kwd" value="<?php echo $_GET["kwd"] ?>" size="50" />
					</td>
					<td width="16%">
						<select name="cat" >
							<option value=""> ---- Select ---- </option>
							<?php
								$main_categories = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => NULL ) ) ;
								if ( ! empty ( $main_categories ) )
								{
									foreach ( $main_categories as $main_cat )
									{
										echo "<optgroup label='".$main_cat["CategoryName"]."'>" ;
											
										$sub_cat = $data->select ( "Category" , "*" , array ( "HeadCategoryID" => $main_cat["CategoryID"] ) ) ;
										if ( ! empty ( $sub_cat ) )
										{
											foreach ( $sub_cat as $sub_c )
											{
												if ( intval ( $_GET["cat"] ) == intval ( $sub_c["CategoryID"] ) )
													echo "<option value='".$sub_c["CategoryID"]."' selected='selected'>".$sub_c["CategoryName"]."</option>" ;
												else
													echo "<option value='".$sub_c["CategoryID"]."'>".$sub_c["CategoryName"]."</option>" ;
											}
										}
											
										echo "</optgroup>" ;
									}
								}
							?>
						</select>
					</td>
					<td width="17%">
						<input type="submit" value="SEARCH" style="font-weight:bold;" />
					</td>
				</tr>
			</table>
		</form>
		<form action="p.ads.php" method="post">
		
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_action">
					<td colspan="100">
						With Selected :
						<label><input type="radio" name="radOption" value="del" /> <img src="images/icons/delete.png" /> 
						Delete</label>
						<label><input type="radio" name="radOption" value="spon_1" /> <img src="images/icons/flag_green.png" /> 
						Mark Sponsored</label>
						<label><input type="radio" name="radOption" value="spon_0" /> <img src="images/icons/flag_red.png" /> 
						UnMark Sponsored</label>
						<label><input type="radio" name="radOption" value="actv_1" /> <img src="images/icons/bell_go.png" /> 
						Mark Active</label>
						<label><input type="radio" name="radOption" value="actv_0" /> <img src="images/icons/bell_error.png" /> 
						Mark InActive</label>
						
						<input type="submit" value="GO" class="submit_button" />
						
					</td>
				</tr>
				<tr class="listing_heading">
					<th width="3%">&nbsp;
						
					</th>
					<th width="4%">
						Ad ID
					</th>
					<th>
						Posted Ad 
					</th>
					<th>
						Type
					</th>
					<th>
						Price
					</th>
					<th>
						Posted
					</th>
					<th>
						Actions
					</th>
				</tr>
				<?php
					$i = 0 ;
					$req_array = array ( ) ;
					$like_array = array ( ) ;
					if ( isset ( $_GET["st"] ) )
					{
						if ( intval ( $_GET["st"] ) == 0 )
							$req_array["IsActive"] = "0" ;
						else
							$req_array["IsActive"] = "1" ;
					}
					if ( $_GET["kwd"] != "" )
					{
						$like_array["AdTitle"] = $_GET["kwd"] ;
						$data->set_like ( $like_array ) ;
					}
					if ( intval ( $_GET["ac_id"] ) > 0 )
						$req_array["AccountID"] = intval ( $_GET["ac_id"] ) ;
					if ( intval ( $_GET["cat"] ) > 0 )
						$req_array["CategoryID"] = intval ( $_GET["cat"] ) ;
					
					if ( intval ( $_GET["ad_id"] ) > 0 )
						$req_array["AdID"] = intval ( $_GET["ad_id"] ) ;
					$ads = $data->select ( "Classified" , "*" , $req_array , intval ( $_GET["p"] ) * $pageSize , $pageSize , "DateAdded desc" ) ;
					if ( ! empty ( $ads ) )
					foreach ( $ads as $ad) :
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
					<tr class="<?php echo $css_class ?>">
						<td>
							<input type="checkbox" name="chkAdID[]" value="<?php echo $ad["AdID"] ?>" />
						</td>
						<td valign="top">
							<?php echo $ad["AdID"] ?>
						</td>
						<td width="50%">
							<em>Title :</em> <a href="detail.php?id=<?php echo $ad["AdID"] ?>" class="title_link"><?php echo $ad["AdTitle"] ?></a>
							<!--<?php echo intval ( $ad["AccountID"] ) > 0 ? "<span style='color:#666666; font-size:11px; font-weight:normal'> (Registered) </span>" : "" ?>-->
							<br />
							
							<div style="font-weight:normal; font-size:12px; margin-left:10px; margin-top:3px; padding:3px; border-left:#BBBBBB solid 2px;">
							<?php echo substr(strip_tags ( $ad["Description"] ) , 0 , 140 ) ?>...
							</div>
						</td>
						<td width="8%">
							<?php echo intval ( $ad["IsOffer"] ) == 1 ? "Offer" : "Wants" ?>
						</td>
						<td width="8%">
							<strong>$<?php echo number_format ( $ad["Price"] ) ?></strong>
						</td>
						<td width="10%">
							<?php echo date( "F j, Y" , strtotime ( $ad["DateAdded"] ) ) ?>
						</td>
						<td width="17%" align="center">
							<a href="detail.php?id=<?php echo $ad["AdID"] ?>" title="Detail of this ad">
								<img src="images/icons/report_picture.png" border="0" alt="Edit" />							</a>
							&nbsp;
							<a href="modifyad.php?id=<?php echo $ad["AdID"] ?>" title="Modify this ad">
								<img src="images/icons/script_edit.png" alt="Edit" width="16" height="16" border="0" />							</a>
							&nbsp;
							<a href="#" title="Delete Ad" onclick="deleteAd ( <?php echo $ad["AdID"] ?> )">
								<img src="images/icons/delete.png" border="0" alt="Delete" />							</a>
							&nbsp;
							<?php if ( intval ( $ad["IsFeatured"] ) == 0 ) : ?>
								<a href="p.ads.php?id=<?php echo $ad["AdID"] ?>&spon=1" title="Make Sponsored">
									<img src="images/icons/flag_green.png" border="0" alt="Delete" />								</a>
							<?php else: ?>
								<a href="p.ads.php?id=<?php echo $ad["AdID"] ?>&spon=0" title="UNMARK Sponsored">
									<img src="images/icons/flag_red.png" border="0" alt="Delete" />								</a>	
							<?php endif; ?>
							&nbsp;
							<?php if ( intval ( $ad["IsActive"] ) == 1 ) : ?>
								<a href="p.ads.php?id=<?php echo $ad["AdID"] ?>&actv=0" title="Make Inactive">
									<img src="images/icons/bell_error.png" border="0" alt="Delete" />								</a>
							<?php else: ?>
								<a href="p.ads.php?id=<?php echo $ad["AdID"] ?>&actv=1" title="Make Active">
									<img src="images/icons/bell_go.png" border="0" alt="Delete" />								</a>	
							<?php endif; ?>						</td>
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

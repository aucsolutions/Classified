<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	if ( intval ( $_SESSION["admin_rights"]["r_ad"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	
	if ( intval ( $_GET["id"] ) < 1 )
	{
		header ( "location:classifiedlist.php" ) ;
		exit ( );
	}
	
	include_once ( "../classes/misc.func.php" ) ;
	
	$adDetail = $data->select ( "Classified" , "*" , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
	$adDetail = $adDetail[0] ;
	
	
	if ( intval ( $adDetail["CategoryID"] ) > 0 )
	{
		$category_path_array = array ( ) ;
		get_category_path ( intval ( $adDetail["CategoryID"] ) , $category_path_array , $data ) ;
		
		$category_path_array = array_reverse ( $category_path_array ) ;
	}
	
	
	
	$extra_info = $data->select ( "AdExtraField" ,"*" , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
	
	if ( ! empty ( $extra_info ) )
	{
		foreach ( $extra_info as  $key => $e_info )
		{
			$extra_field_data = $data->select ( "CategoryExtraField" ,"*" , array ( "CategoryExtraFieldID" => intval ( $e_info["CategoryExtraFieldID"] ) ) ) ;
			$extra_info[$key]["Field_name"] = $extra_field_data[0]["EFName"] ;
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	<!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $dataArray["GoogleMapKey"] ?>" type="text/javascript"></script>-->
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3>
					<?php echo $adDetail["AdTitle"] ?>
				</h3>
				<div align="left">
					<?php
						echo "Home" ;
						if ( ! empty ( $category_path_array ) )
							foreach ( $category_path_array as $cats )
								echo " &raquo; ".$cats["CategoryName"] ;
					?>
				</div>
				<form action="p.ads.php" method="post">
					<table width="100%" class="detail">
						<tr>
							<td width="56%">
						<div>
									<?php
							$image_Name = "../media/cls_".$adDetail["AdID"]."_520.jpg" ;
							if ( file_exists ( $image_Name ) )
								echo "<img id='img_main' src='classified_img.php?path=$image_Name&full=1' alt='No Image'>" ;
						?>
									<div>
										<?php
									for ( $i = 1 ; $i <= 5 ; $i++ )
									{
										$image_Name = "../media/cls_".$adDetail["AdID"]."_".$i."_520.jpg" ;
										if ( file_exists ( $image_Name ) )
											echo "<img src='classified_img.php?path=$image_Name' alt='No Image'>" ;
									}
								?>
									</div>
								</div></td>
							<td width="44%" valign="top" style="font-size:13px;">
								
							<?php
								if ( intval ( $adDetail["AccountID"] ) > 0 )
								{
									$account = $data->select ( "Account" , "*" , array ( "AccountID" => $adDetail["AccountID"] ) ) ;
							?>
								
								<span style="color:#990000; font-size:14px;">Posted By :
								<a href="classifiedlist.php?ac_id=<?php echo $adDetail["AccountID"] ?>" title="All Ads by this poster.">
									<?php echo $account[0]["FullName"] ?>
								</a>
								</span>
								<br />
							<?php
								}
							?>
								<span style="color:#7B3C3E">Contact Email :
								<a href="mailto:<?php echo $adDetail["EmailAddress"] ?>">
									<?php echo $adDetail["EmailAddress"] ?>
								</a>
								</span>
								<br />
								<span style="color:#4B6F42">Posted On : <?php echo date( "F j, Y" , strtotime ( $adDetail["DateAdded"] ) ) ?></span>
								<br />
								<br />
								Type : <?php echo intval ( $adDetail["IsOffer"] ) == 1 ? "Offer" : "Wants" ?>
								<br />
								Price : <strong style="color:#652C2D; font-size:14px">$<?php echo number_format ( $adDetail["Price"] ) ?></strong>
								<br />
								
								<table cellpadding="2" cellspacing="0" style="border:#BFBFBF solid 1px; font-size:14px;">
											<?php
												if ( ! empty ( $extra_info ) )
												{
													foreach ( $extra_info as $fild )
													{
											?>
												<tr>
													<td style="color:#959595;"> 
														<?php echo $fild["Field_name"] ?>
													</td>
													<td style="color:#292929;">
														<?php echo $fild["AdExtraFieldValue"] ?>
													</td>
												</tr>
											<?php
													}
												}
											?>
											</table>
								
								<div style="padding:3px; margin:2px; color:#1F1F1F">
									Address
									<address style="font-weight:bold;">
									<?php echo $adDetail["AddressStreet"] .", ". $adDetail["AddressCity"] .", ". $adDetail["AddressRegion"] .", ". $adDetail["AddressZip"] ?>
									</address>
									
									
									
									<br />
									Visits : <?php echo intval ( $adDetail["Views"] ) ?>
									<br />
									# of times Contacted : <?php echo intval ( $adDetail["Replies"] ) ?>
								</div>
								<br />
								<div >
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
									<a href="#" onclick="deleteAd ( <?php echo intval ( $adDetail["AdID"] ) ?> ) ;" title="Delete Ad" style="text-decoration:none; background-color:#8B3032; vertical-align:middle; border:#000000 solid 1px; padding:4px; margin:3px; color:#FFFFFF;">
										<img src="images/icons/delete.png" border="0" alt="Delete" />
										Delete This Classified
									</a>
									<br /><br />

									<?php if ( intval ( $adDetail["IsFeatured"] ) == 0 ) : ?>
									<a href="p.ads.php?id=<?php echo $adDetail["AdID"] ?>&spon=1" title="Make Sponsored" style="text-decoration:none; background-color:#B8CFB1; vertical-align:middle; border:#000000 solid 1px; padding:4px; margin:3px; color:#000000;">
										<img src="images/icons/flag_green.png" border="0" alt="Sponsor" />
										Mark Sponsored
									</a>
									<?php else: ?>
									<a href="p.ads.php?id=<?php echo $adDetail["AdID"] ?>&spon=0" title="UNMARK Sponsored" style="text-decoration:none; background-color:#F0E6E6; vertical-align:middle; border:#000000 solid 1px; padding:4px; margin:3px; color:#000000;">
										<img src="images/icons/flag_red.png" border="0" alt="Unmark" />
										Unmark Sponsored
									</a>
									<?php endif; ?>
									<br /><br />
									<?php if ( intval ( $adDetail["IsActive"] ) == 0 ) : ?>
									<a href="p.ads.php?id=<?php echo $adDetail["AdID"] ?>&actv=1" title="Make Inactive" style="text-decoration:none; background-color:#E4E6ED; vertical-align:middle; border:#000000 solid 1px; padding:4px; margin:3px; color:#000000;">
										<img src="images/icons/bell_error.png" border="0" alt="Active" />
										Active
									</a>
									<?php else: ?>
									<a href="p.ads.php?id=<?php echo $adDetail["AdID"] ?>&actv=0" title="Make Active" style="text-decoration:none; background-color:#EBEAC5; vertical-align:middle; border:#000000 solid 1px; padding:4px; margin:3px; color:#000000;">
										<img src="images/icons/bell_go.png" border="0" alt="Inactive" />
										Inactive
									</a>
									<?php endif; ?>
								</div></td>
						</tr>
						<tr>
							<td valign="top" colspan="100"><?php echo $adDetail["Description"] ?>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<?php include ( "inc.footer.php" ) ; ?>
			<!-- end #container -->
		</div>
	</body>
</html>

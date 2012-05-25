<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_category"] ) == 0 )
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
	function alert_del ( obj_id , obj_text )
	{
		if ( parseInt ( obj_id ) > 0 )
		{
			var yes_no = window.confirm ( "Are you sure you want to delete "+obj_text+" ?" ) ;
			if ( yes_no )
				window.location = "p.delete_category.php?id="+obj_id ;
		}
	}
</script>
</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Categories </h3>
    	
		<div>
			
		</div>
		
		
		<form action="" method="get">
			<table class="listings" width="100%">
				<tr>
					<td width="7%">
						Search
					</td>
					<td width="26%">
						<input type="text" name="kwd" value="<?php echo $_GET["kwd"] ?>" size="50" />
					</td>
					
					<td width="51%">
						<input type="submit" value="SEARCH" style="font-weight:bold;" />
					</td>
				</tr>
			</table>
		</form>
		
		<table width="100%" class="listings" cellpadding="3" cellspacing="0">
			<tr class="listing_heading">
				<th>
					Category				</th>
				<th>
					Order				</th>
				<th>
					Price				</th>
				<th>
					Actions				</th>
			</tr>
			<?php
				$i = 0 ;
				$data_array = array ( ) ;
				if ( $_GET["kwd"] != "" )
				{
					$data->set_like ( array ( "CategoryName" => $_GET["kwd"] ) ) ;
				}
				$ads = $data->select ( "Category" , "*", $data_array , intval ( $_GET["p"] ) * $pageSize , $pageSize , " HeadCategoryID asc" ) ;
				$totalRecords = $data->get_num_records ( ) ;
				if ( ! empty ( $ads ) )
				foreach ( $ads as $ad) :
					$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
			?>
				<tr class="<?php echo $css_class ?>">
					<td width="63%">
						<?php 
							if ( intval ( $ad["HeadCategoryID"] ) > 0 )
							{
								$cat_array = array ( ) ;
								get_category_path ( $ad["CategoryID"] , $cat_array , $data ) ;
								if ( ! empty ( $cat_array ) )
								{
									$cat_array = array_reverse ( $cat_array ) ;
									foreach ( $cat_array as $cat )
										echo $cat["CategoryName"] . " &raquo; " ;
								}
							}
							else
								echo $ad["CategoryName"] ;
						?>
						<div style="margin-left:15px; margin-top:3px; border-left:#4E466A solid 2px; padding:3px; font-size:11px; font-weight:normal;"><?php echo $ad["CategoryDescription"] ?></div>
					</td>
					<td width="9%">
						<?php echo $ad["OrderNumber"] ?>					</td>
					<td width="10%">
						<strong>$<?php echo number_format ( $ad["Price"] ) ?></strong>					</td>
					<td width="18%" align="center">
						<a href="category.php?id=<?php echo $ad["CategoryID"] ?>" title="Edit this Category">
							<img src="images/icons/wrench.png" border="0" alt="Edit" />
						</a>
						&nbsp;&nbsp;
						
							<img src="images/icons/delete.png" border="0" alt="Delete" style="cursor:pointer;" onclick="alert_del(<?php echo $ad["CategoryID"] ?> , '<?php echo $ad["CategoryName"] ?>');" title="Delete" />
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

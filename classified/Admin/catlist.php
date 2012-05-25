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
	
	function show_options ( div_obj )
	{
		$("<span>").text("dd").appendTo ( div_obj ) ;
	}
	
	function hide_options ( div_obj )
	{
		$(div_obj).children ("span").remove();
	}
	
	var url_img = "url(images/minus.gif)" ;
	
	$(document).ready ( function ( )
						{
							$(".ul_main_categories li").find("ul").hide();
							$(".ul_main_categories li").click ( function ( ev )
																{
																	if ( ev.target == this )
																	{
																		if ( $(this).children("ul").is(":hidden") )
																			url_img = "url(images/minus.gif)" ;
																		else
																			url_img = "url(images/plus.gif)" ;
																		$(this).css( {"list-style-image" : url_img }).find ("ul").toggle("normal");
																	}
																}
															 ) ;
						}
					 ) ;
	
</script>
<style>
	ul.ul_main_categories
	{
		list-style-image:url(images/plus.gif);
	}
	
	ul.ul_main_categories li
	{
		width:250px;
		cursor:pointer;
		margin:2px;
		margin-left:3px;
	}
	ul.ul_main_categories li:hover
	{
	}
	ul.ul_main_categories ul
	{
		padding:0px;
		margin-left:10px;
		width:auto;
	}
	ul.ul_main_categories li div
	{
		float:right;
		margin-right:4px;
		
	}
</style>
</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Categories </h3>
    	
		<div>
			
		</div>
		
		
		<form action="categorylist.php" method="get">
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
		
		<div>
			<ul class="ul_main_categories">
			<?php
				$ads = $data->select ( "Category" , "*", array ( "HeadCategoryID" => NULL ) , intval ( $_GET["p"] ) * $pageSize , $pageSize , " HeadCategoryID asc" ) ;
				$totalRecords = $data->get_num_records ( ) ;
				if ( ! empty ( $ads ) )
				foreach ( $ads as $ad) :
			?>	
				<li cat_id="<?php echo $ad["CategoryID"] ?>">
					<?php echo $ad["CategoryName"] ?>
					<div>
						<a href="category.php?id=<?php echo $ad["CategoryID"] ?>" title="Edit this Category">
							<img src="images/icons/wrench.png" border="0" alt="Edit" />
						</a>
						<a href='#' onclick='alert_del(<?php echo $ad["CategoryID"] ?>,"Category");'><img src='images/icons/delete.png' border='0'></a>
					</div>
					<?php
						$sub = $data->select ( "Category" , "*", array ( "HeadCategoryID" => $ad["CategoryID"] ) ) ;
						if ( ! empty ( $sub ) )
						{
							echo "<ul>" ;
							
							foreach ( $sub as $subc )
							{
					?>
								<li cat_id='<?php echo $subc["CategoryID"] ?>' style="font-weight:normal;"><?php echo $subc["CategoryName"] ?>
									<div>
										<a href="category.php?id=<?php echo $subc["CategoryID"] ?>" title="Edit this Category">
											<img src="images/icons/wrench.png" border="0" alt="Edit" />
										</a>
										<a href='#' onclick='alert_del(<?php echo $subc["CategoryID"] ?>,"Category");'>
											<img src='images/icons/delete.png' border='0'>
										</a>
									</div>
								</li>
					<?php	
							}
							echo "</ul>" ;
						}
					?>
				</li>
			<?php
				endforeach;
			?>
			</ul>
		</div>
		<br />
		<br />
		
		
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>

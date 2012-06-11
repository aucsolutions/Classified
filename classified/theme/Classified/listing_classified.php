<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<?php
	
	include ( "core/inc.meta.php" ) ;
	if ( strlen ( $app_init_data["GoogleMapKey"] ) > 5 )
	{
?>
	<script src="http://maps.google.com/maps?file=api&v=2&key=<?php echo $app_init_data["GoogleMapKey"] ?>" type="text/javascript"></script>
<?php
	}
?>

<style type="text/css">
.swa{
font-size:12px;
}
div.work_main{overflow:hidden;}
div.work_status{float:left;margin:0 5px 0 0;}
div.sectionwrap{width:680px;padding:10px;border:solid 1px #ccc;overflow:hidden;}
ul li {margin:0 0 10px 0;}
legend{display:block;padding:0 0 10px 0;clear:both;}
ul li label{display:block;float:left;width:100px;}
li.email_inq input{float:left;margin:0 10px 0 0;}
li.email_inq label{float:left;width:432px;}
li.email_inq div{clear:both;float:none;margin:0 0 10px 0;overflow: hidden;padding: 0 0 8px;}
#div_attraction{overflow:hidden;margin:0 0 10px 0;}
#div_attraction div{float:left;width:170px;}
#div_attraction input.input_check{float:left;margin:0 5px 0 0;}
#div_attraction label{display:block;float:left;width:150px;}
div.showdiv{}
div.showdiv ul{list-style:none;margin:0;padding:0 0 0 25px;}
div.showdiv ul li {overflow:hidden;}
div.showdiv ul li label{display:block;float:left;width:120px}
div.message .button{float:left;}
div.message #cancel{margin:0 159px 0 0;}

div.aftercontinue_container{background:#eee;padding:25px 40px;width:525px;margin:10px auto;}
div.aftercontinue_container h3{font-size: 16px;font-weight: bold;margin:5px 0px 10px 0;}
div.aftercontinue_container h4{font-size:14px;margin:7px 0;padding:0;}
div.aftercontinue_container ul{list-style:none;margin:0;padding:0;}
div.aftercontinue_container ul li{list-style:none;margin:0 0 5px 0;padding:0;overflow:hidden;}
div.aftercontinue_container ul li label{float:left;display:block;width:410px;}
div.aftercontinue_container ul li div{font-weight:bold;}
input#PostAd{margin:0 0 0 635px;}
span#div_city {overflow:hidden;margin:0 0 10px 0;display:block;}
span#div_city div{float:left;width:170px;}
span#div_city div input.input_check{float:left;margin:0 5px 0 0;}
span#div_city div label{display:block;float:left;width:150px;}
div.payment_proccess{margin:0 auto;width:603px;}
div.payment_proccess h2{margin:0 0 12px 0;}
div.payment_proccess ul{list-style:none;margin:0;padding:0;}
div.payment_proccess ul li{margin:0 0 12px 0;}
div.payment_proccess ul li input.input_big{width:590px;height:30px;padding:5px;}
div.payment_proccess ul li input.input_medium{width:280px;height:25px;padding:5px;}
div.payment_proccess ul li input.input_small{width:180px;height:20px;padding:5px;}
div.payment_proccess ul li input.chose_method{margin:0 12px;}

/*****Swapnesh CSS *****/
.centerImg{
border:1px solid #999999;
width:600px;
margin-top:5px;
}

.centerImg img{ 
height:100px;
width:112px;
margin:2px 0 2px 2px;
}

</style>

</head>

<div id="container">
<?php
include ( "inc.header.php" ) ;
?>
<div id="searchsection" style="overflow:hidden;">
<div class="leftsection">

<div class="detailsmain">
<div class="leftcontainer">
            <div class="smallsearch"> Refine Search
              <input name="" type="text" class="searchinput" value="Keyword" />
            </div>
            <div class="categorysection">
              <div class="cat_head">Category <span><a href="#" class="purplecolor">All</a> | <a href="#" class="purplecolor">Clear</a></span></div>
              <ul class="categorylist">
                <li>Community
                  <ul>
                    <li>
                      <input name="" type="checkbox" value="" />
                      Child Care</li>
                    <li>
                      <input name="" type="checkbox" value="" />
                      Classes/Workshops</li>
                    <li>
                      <input name="" type="checkbox" value="" />
                      General</li>
                    <li>
                      <input name="" type="checkbox" value="" />
                      Groups</li>
                    <li>
                      <input name="" type="checkbox" value="" />
                      Lost and Found</li>
                    <li>
                      <input name="" type="checkbox" value="" />
                      Volunteers</li>
                  </ul>
                </li>
                <li>Real Estates</li>
                <li>Musician</li>
                <li>Services</li>
                <li>Auto Motive</li>
                <li>Buy, Sell, Trade</li>
              </ul>
            </div>
            <div class="locationsection">
              <div class="location_head">Locations <span><a href="#" class="purplecolor">All</a></span></div>
			  
<?php
$selectCount =  $data->select ( "awear_vm_country" , "*", " CountryID  asc" ) ;
$selectState =  $data->select ( "awear_vm_state" , "*" ) ;
?>
			  
			  
              <select class="country" name="country" style="width:160px; margin-bottom:2px;">
                <option value="">Select Country</option>
				
				<?php
				
				if ( ! empty ( $selectCount ) )
				foreach ( $selectCount as $cat ) :
				?>	
				<option value="<?php echo $cat["cid"] ?>" <?php  if($cat["cid"] == 223){ echo 'selected="selected"';} ?> ><?php echo $cat["country_name"]  ?></option>
				<?php	
				endforeach ;
				
				?>
				
              </select>
              <select class="locate_dropdown" name="">
                <option>Select State</option>
              </select>
              <input name="" type="text" class="cityinput" value="City" />
              <div class="go_button">Go</div>
            </div>
          </div>


<div class="maincontentsection">
<?php 
 if ( intval ( $category_id_selected ) > 0 ) : 
 ?>
<?php
	echo "<a href='".base_url."'>".$app_init_data["SiteTitle"] ."</a> " ;
	$cat_array_path = array  ( ) ;
	get_category_path ( intval ( $category_id_selected ) , $cat_array_path , $data ) ;
	$cat_array_path = array_reverse ( $cat_array_path ) ;
	if ( ! empty ( $cat_array_path ) )
		foreach ( $cat_array_path as $cat )
			if ( intval ( $exp_send["cat"] ) == $cat["CategoryID"] )
				echo " &raquo; ".$cat["CategoryName"] ;
			else
				echo " &raquo; <a href='".base_url."category/".get_sef_url( $cat["CategoryID"] , "Category" )."/'>".$cat["CategoryName"]."</a>" ;
?>	
<?php endif ; ?>

<table style="clear: both;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td valign="top" width="260">
					<!----
					<div id="sbLeftNav" class="styleA">
							<div class="innerLeftNav" style="padding-left: 10px; ">
								<div id="search-nav2"> <span class="listtitle" id="refineResults"><?php echo $lang["lang_listing"]["str_current_matches"] ?> <span class="titlecount"> (<?php echo intval ( $total_ads ) ?>)</span></span>
									<div>
										<div class="filter">
										
	<?php 
	
		if ( intval ( $selected_category_detail["HeadCategoryID"] ) > 0 )
		{
			$head_category_detail = $data->select ( "Category" , "*" , array ( "CategoryID" => intval ( $selected_category_detail["HeadCategoryID"] ) ) ) ;
			$head_category_detail = $head_category_detail[0] ;

			echo "<div>" ;
		
			$data->set_greater ( $greater_array ) ;
			$data->set_smaller ( $smaller_array ) ;
			$like_array["CategoryStack"] = "z".intval ( $head_category_detail["CategoryID"] )."Z" ;
			$data->set_like ( $like_array ) ;
			$total_records_sub_element = $data->count_record ( "Classified" , $array_to_db ) ;
			echo "<a href='".base_url."category/".get_sef_url ( $head_category_detail["CategoryID"] , "Category" )."/'>". $head_category_detail["CategoryName"]."</a>($total_records_sub_element)" ;
			
			echo "</div>" ;
			$sub_cats = get_sub_categories ( intval ( $head_category_detail["CategoryID"] ) , $data ) ;
			echo "<div style='margin-left:5px;'>" ;
			if ( ! empty ( $sub_cats ) )
			{
				foreach ( $sub_cats as $cat )
				{
					
					$data->set_greater ( $greater_array ) ;
					$data->set_smaller ( $smaller_array ) ;
					$like_array["CategoryStack"] = "z".intval ( $cat["CategoryID"] )."Z" ;
					$data->set_like ( $like_array ) ;
					$total_records_sub_element = $data->count_record ( "Classified" , $array_to_db ) ;
					echo "<a href='".base_url."category/".get_sef_url ( $cat["CategoryID"] , "Category" )."/'>". $cat["CategoryName"]."</a>($total_records_sub_element) <br>" ;
					if ( intval ( $cat["CategoryID"] ) == intval ( $selected_category_detail["CategoryID"] ) )
					{
						$sub_cat_selected = get_sub_categories ( intval ( $selected_category_detail["CategoryID"] ) , $data ) ;
						if ( ! empty ( $sub_cat_selected ) )
						{
							echo "<div style='margin-left:5px;'>" ;
							foreach ( $sub_cat_selected as $sub_sub_cat )
							{
								$data->set_greater ( $greater_array ) ;
								$data->set_smaller ( $smaller_array ) ;
								$like_array["CategoryStack"] = "z".intval ( $sub_sub_cat["CategoryID"] )."Z" ;
								$data->set_like ( $like_array ) ;
								$total_records_sub_element = $data->count_record ( "Classified" , $array_to_db ) ;
								echo "<a href='".base_url."category/".get_sef_url ( $sub_sub_cat["CategoryID"] , "Category" )."/'>". $sub_sub_cat["CategoryName"]."</a>($total_records_sub_element) <br>" ;
							}
							echo "</div>" ;
						}
					}
					
				}
			}
			echo "</div>" ;
			
		}
		else
		{
			echo "<div>" ;
		
			$data->set_greater ( $greater_array ) ;
			$data->set_smaller ( $smaller_array ) ;
			$like_array["CategoryStack"] = "z".intval ( $selected_category_detail["CategoryID"] )."Z" ;
			$data->set_like ( $like_array ) ;
			$total_records_sub_element = $data->count_record ( "Classified" , $array_to_db ) ;
			if ( intval ( $selected_category_detail["CategoryID"] ) > 0 )
				echo "<a href='".base_url."category/".get_sef_url ( $selected_category_detail["CategoryID"] , "Category" ) ."/'>". $selected_category_detail["CategoryName"]."</a>($total_records_sub_element)" ;
			
	
			echo "</div>" ;
			$sub_cats = get_sub_categories ( intval ( $selected_category_detail["CategoryID"] ) , $data ) ;
			echo "<div style='margin-left:5px;'>" ;
			if ( ! empty ( $sub_cats ) )
			{
				foreach ( $sub_cats as $cat )
				{
					$data->set_greater ( $greater_array ) ;
					$data->set_smaller ( $smaller_array ) ;
					$like_array["CategoryStack"] = "z".intval ( $cat["CategoryID"] )."Z" ;
					$data->set_like ( $like_array ) ;
					$total_records_sub_element = $data->count_record ( "Classified" , $array_to_db ) ;
					echo "<a href='".base_url."category/".get_sef_url ( $cat["CategoryID"] , "Category" ) ."/'>". $cat["CategoryName"]."</a>($total_records_sub_element) <br>" ;
					
				}
			}
			echo "</div>" ;
		}
		
		
		
	
	
	?>
										
										</div>
										
										<div class="separatedfilter filter"> <span class="filterTitle" id="adTypeFilter"><?php echo $lang["lang_listing"]["str_types_selection"] ?>:</span><br>
											<ul class="child">
												<li><span class="selectedItem"> <strong><?php echo $lang["lang_listing"]["str_all_types"] ?></strong> </span> </li>
												<ul class="child">
													<li><span> <a href="<?php echo base_url.$qstring[0].$category_query_string.get_sef_search_listing_url ( $parameters , "typ" , "typ:1" ) ?>/"><?php echo $lang["lang_listing"]["str_type_offer"] ?></a>(<?php echo $offering_total ?>)</span> </li>
													<li><span> <a href="<?php echo base_url.$qstring[0].$category_query_string.get_sef_search_listing_url ( $parameters , "typ" , "typ:0" ) ?>/"><?php echo $lang["lang_listing"]["str_type_want"] ?></a>(<?php echo $wanted_total ?>) </span> </li>
													
												</ul>
											</ul>
										</div>
										<div class="separatedfilter filter"> <span class="filterTitle" id="adTypeFilter"><?php echo $lang["lang_listing"]["str_price"] ?>:</span><br>
											<form action="<?php echo base_url ?>search/" method="post">
												<input type="hidden" name="CatId" value="<?php echo intval ( $category_id_selected ) ?>" >
												<input type="hidden" name="Keyword" value="<?php echo $exp_send["q"] ?>" >
												<table style="width: 99%;" border="0" cellpadding="0" cellspacing="0">
												<tbody>
													<tr>
														<td id="filterContent" valign="top" width="90%">
																<div class="first-field">
																	<div formfield="label" class="first-label"><?php echo $lang["lang_listing"]["str_price_enter"] ?></div>
																	<div class="first-input">
																		<input class="tipField" name="minPrice" style="width: 90px;" maxlength="12" title="from" type="text" value="<?php echo $exp_send["p1"] ?>">
																		-
																		<input class="tipField" name="maxPrice" style="width: 90px;" maxlength="12" title="to" value="<?php echo $exp_send["p2"] ?>" type="text">
																	</div>
																</div>
															</td>
													</tr>
													<tr>
														<td colspan="10"><input id="updateSearch" class="newButton" value="<?php echo $lang["lang_listing"]["str_post_button"] ?>" type="submit"></td>
													</tr>
												</tbody>
											</table>
											</form>
										</div>
									</div>
								</div>
								
								
								<?php
									if ( intval ( $_SESSION["login_account_id"] ) < 1 )
									{
								?>
								<div class="listmodule" id="subInvite" style="margin-top: 5px;">
									<ul>
										<li> <span style="font-family: Arial; font-size: 13px; color: rgb(0, 0, 0);"> <?php echo $lang["lang_listing"]["str_register_to_manage"] ?> </span> </li>
									</ul>
									<br>
									<ul>
										<li>
											<input id="subscribe" value="<?php echo $lang["lang_listing"]["str_sign_up_button"] ?>" class="newButton" type="button" onClick="showScreen ( 'div_SignUp' ) ;">
										</li>
									</ul>
								</div>
								<?php
									}
								?>
								<br>
								<div align="center">
								<?php
									if ( $category_top_banner["MarketingScript_left"] != "" )
										echo $category_top_banner["MarketingScript_left"] ;
									else
									{
										$g_ads = $data->select ( "MarketingAdManager" ,"*" , array ( "MarketingPlacing" => "Listing Left" ) ) ;
										if ( ! empty ( $g_ads ) )
										
										foreach ( $g_ads as $g_ad )
											echo $g_ad["MarketingScript"] ;
									}
								?>
								</div>
								<div id="adlink"></div>
								<p align="center"> </p>
								
							</div>
						</div>
					------>	
						
					</td>
					<td valign="top" width="100%"><div id="sbResultsListing">
							<div class="sbInnerDiv">
								<div id="head2AdSense" style="clear: both;"></div>
								<!-- google_ad_section_start(weight=ignore) -->
								<table id="searchTopBarSB2" class="galleryMenuRight" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td align="left" valign="middle" width="50%" height="22" nowrap="true"><table class="galleryMenuFill" border="0" cellpadding="0" cellspacing="0">
													<tbody>
														<tr>

<style type="text/css">
#selectviewtype
{
height: 50px;
margin: 5px 0 0;
border:1px solid #CCCCCC;
width:600px;
font-family: "lucida grande","Lucida Sans Unicode",tahoma,verdana,arial,sans-serif;
font-size:14px;
}
</style>

<div id="selectviewtype">
<strong>
<?php echo $lang["lang_listing"]["str_view_as"] ?>
</strong>
<span class="listViewActive">&nbsp;</span>
<a href="<?php echo base_url.$qstring[0].$category_query_string.get_sef_search_listing_url ( $parameters , "gal" , "gal:0" ) ?>/">
<?php echo $lang["lang_listing"]["str_view_as_list"] ?>
</a>
<span class="galleryViewActive">&nbsp;</span>
<a href="<?php echo  base_url.$qstring[0].$category_query_string.get_sef_search_listing_url ( $parameters , "gal" , "gal:1" ) ?>/">
<?php echo $lang["lang_listing"]["str_view_as_gal"] ?>
</a>
</div>


															<td><div class="galleryMenuSeparator"></div></td>
														</tr>
													</tbody>
												</table></td>
											<td align="right" width="50%" nowrap="true">
												<form class="jsonly" name="sort" action="<?php echo base_url ?>search/" method="post">
													
													
													<input type="hidden" name="CatId" value="<?php echo intval ( $exp_send["cat"] ) ?>" >
													<input type="hidden" name="Keyword" value="<?php echo $exp_send["q"] ?>" >
													<input type="hidden" name="minPrice" value="<?php echo $exp_send["p1"] ?>" >
													<input type="hidden" name="maxPrice" value="<?php echo $exp_send["p2"] ?>" >
													
													<span style="color:#FFFFFF;">Sort by&nbsp; </span>
													
													&nbsp;&nbsp;
												</form></td>
										</tr>
									</tbody>
								</table>
								<div class="gallery" style="margin-right: auto;">
								
						<?php
							if ( intval ( $category_id_selected ) > 0 )
							{
								
								$like_array["CategoryStack"] = "z".intval ( $category_id_selected )."Z" ;
								$data->set_like ( $like_array ) ;
								$featured = $data->select ( "Classified" , "*" , array ( "IsFeatured" => 1 ) , 0 , intval ( $app_init_data["SponsoredAdsListingPage"] ), "DateAdded desc" ) ;
								if ( ! empty ( $featured ) )
								{
						?>
								<div style="background-color:#EEEEEE; padding:4px; font-weight:bold; font-size:12px;">
									 <?php echo $lang["lang_listing"]["str_featured"] ?>
								</div>
						<?php
									foreach ( $featured as $classif ) :
						?>
								
								<div class="listing_list_view" >
									<table width="100%">
										<tr><td width="11%" align="center"><img src="<?php echo base_url ?>classified_img.php?clsid=<?php echo $classif["AdID"] ?>" alt="No Image"></td>
										
											<td width="18%"><?php echo (intval ( $classif["IsOffer"] ) == 0 ? "<strong>Wanted:</strong> ":"") ?><a class="listing_link" href="<?php echo base_url.get_sef_url ( $classif["AdID"] , "Classified" ) ; ?>/"><strong ><?php echo $classif["AdTitle"] ?></strong></a>
											<br>
											<?php echo substr ( strip_tags($classif["Description"]) , 0 , 300 ); ?>...
											<br>
											</td>
											<td width="12%" align="center">
												<?php
													if ( intval ( $classif["PriceAlternative"] ) > 1 )
														echo $price_alt[intval ( $classif["PriceAlternative"] )] ;
													else
														 echo $app_init_data["CurrencySymbol"].number_format ( $classif["Price"] , 2 ) ;
												?>
											</td>
											<td width="12%" align="center">
												<?php echo date( "F j, Y" , strtotime ( $classif["DateAdded"] ) ) ?>
											</td>
										</tr>
										
									</table>
									</div>
								
						<?php
									endforeach ;
								
						?>
						<div style="background-color:#EEEEEE; padding:4px; border-bottom:#959595 solid 1px; height:10px;"></div>
						<?php
								}
							}
						?>	
						
						
						<?php
							if ( intval ( $gallery_set ) == 2 ) :
								
						?>
							
							<div id="mapit" style="width:95%; height:800px; margin-left:10px; margin-top:15px;">
								
								</div>
								<script type="text/javascript">
    					
												var map = new GMap2(document.getElementById("mapit"));
												
												var geocoder = new GClientGeocoder();
												map.setUIToDefault();
												map.setCenter(new GLatLng(39.077771, -76.376953), 5);

												function showAddress(address , url)
												{
												  geocoder.getLatLng ( address,	function(point)
												  								{
																				  if (point)
																				  {
																					
																					var marker = new GMarker(point);
																					map.addOverlay(marker);
																					GEvent.addListener ( marker, "click", function()
																															{
																																marker.openInfoWindowHtml(address+"<br>"+"<a href='"+url+"'>View details</a>");
																															}
																										);
																				  }
																				}
												  					);
												}
												
										
									</script>
								
			<?php
						endif ;
				if ( ! empty ( $classified ) )
					foreach ( $classified as $classif ) :
			?>
								<?php
									if ( intval ( $gallery_set ) == 2 ) :
								?>
									<script language="javascript">
									showAddress ( '<?php echo $classif["AddressStreet"].", ".$classif["AddressCity"].", ".$classif["AddressRegion"].", ".$classif["AddressCountry"] ?>' , '<?php echo base_url.get_sef_url ( $classif["AdID"] , "Classified" ) ; ?>/' ) ;
									</script>
								
								<?php
									elseif ( intval ( $gallery_set ) == 1 ) :
								?>
									<div class="adOuterKj">
										<div class="adFrameKj">
											<div class="adInnerKj"> 
											<a class="viewAd" href="<?php echo base_url.get_sef_url ( $classif["AdID"] , "Classified" ) ; ?>/" ></a>
											<div class="imagStack clickable">
		<div class="centerImg">
		 <img src="<?php echo base_url ?>classified_img.php?clsid=<?php echo $classif["AdID"] ?>&gallery=<?php echo intval ( $gallery_set ) ?>" alt="No Image">
		 <?php echo (intval ( $classif["IsOffer"] ) == 0 ? "Wanted: ":"") ?>
		 <a class="clickable" href="<?php echo base_url.get_sef_url ( $classif["AdID"] , "Classified" ) ; ?>/"><?php echo $classif["AdTitle"] ?></a>
		 
		<?php
		if ( intval ( $classif["PriceAlternative"] ) > 1 )
		echo $price_alt[intval ( $classif["PriceAlternative"] )] ;
		else
		echo $app_init_data["CurrencySymbol"].number_format ( $classif["Price"] , 2 ) ;
		?> 
		 
		 <?php if( $classif["IsActive"] == 1) echo "Status: Active";  ?>
		 <a class="clickable" href="<?php echo base_url.get_sef_url ( $classif["AdID"] , "Classified" ) ; ?>/"><?php echo $lang["lang_listing"]["str_view_detail"] ?></a>
		 
		</div>
												</div>
												

		

													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
									else:
								?>
									<div class="listing_list_view" >
									<table width="100%">
										<tr>
										
											<td width="18%"><?php echo (intval ( $classif["IsOffer"] ) == 0 ? "<strong>Wanted:</strong> ":"") ?><a class="listing_link" href="<?php echo base_url.get_sef_url ( $classif["AdID"] , "Classified" ) ; ?>/"><strong ><?php echo $classif["AdTitle"] ?></strong></a>
											<br>
											<?php echo substr ( strip_tags($classif["Description"]) , 0 , 300 ); ?>...
											<br>
											</td>
											<td width="12%" align="center">
												<?php
													if ( intval ( $classif["PriceAlternative"] ) > 1 )
														echo $price_alt[intval ( $classif["PriceAlternative"] )] ;
													else
														 echo $app_init_data["CurrencySymbol"].number_format ( $classif["Price"] , 2 ) ;
												?>
											</td>
											<td width="12%" align="center">
												<?php echo date( "F j, Y" , strtotime ( $classif["DateAdded"] ) ) ?>
											</td>
										</tr>
										
									</table>
									</div>
								<?php
									endif ;
								?>
									<?php
				endforeach ;
			?>
								</div>
								<!-- google_ad_section_end -->
								
								
								
								
								
								
								<table class="paginationBottomBg" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td class="paginationBottomBg_right" align="left" valign="middle">
												<span style="color:#FFFFFF;"> 
												<?php
													
													if ( $total_ads > $page_size )
													{
														echo "<span style='margin:3px; padding:2px; font-size:13px; text-decoration:none; color:#FFFFFF;'>".$lang["land_listing"]["paging_links"]["str_page"]." : </span>&nbsp;" ;
														$total_pages_calculated = ceil ( $total_ads / $page_size ) ;
														$number_of_pages_to_show = $total_pages_calculated ;
														$start_number_of_pages = 0 ;
														if ( $page_number > 2 )
															echo "<a href='".base_url.$qstring[0].$category_query_string.get_sef_search_listing_url ( $parameters , "p" , "p:".($page_number-1 ) )."/' style='margin:3px; padding:1px; font-size:13px;  '>".$lang["land_listing"]["paging_links"]["str_previous"]."</a>" ;
														if ( $total_pages_calculated > ( $page_number + 10 ) )
														{
															$number_of_pages_to_show = $page_number+10 ;
															if ( $page_number > 5 )
																$start_number_of_pages = $page_number - 5 ;
														}
														for ( $i = $start_number_of_pages ; $i < $number_of_pages_to_show ; $i++ )
														{
															if ( $page_number == $i )
																echo "<span style='margin:3px; padding:1px; font-size:18px;'>".($i+1)."</span>" ;
															else
																echo "<a href='".base_url.$qstring[0].$category_query_string.get_sef_search_listing_url ( $parameters , "p" , "p:$i" )."/' style='margin:3px; padding:1px; font-size:13px;  '>".($i+1)."</a>" ;
														}
														if ( $total_pages_calculated > ( $page_number + 10 ) )
															echo "<a href='".base_url.$qstring[0].$category_query_string.get_sef_search_listing_url ( $parameters , "p" , "p:".($page_number+10 ) )."/' style='margin:3px; padding:1px; font-size:13px;  '>".$lang["land_listing"]["paging_links"]["str_next"]."</a>" ;
													}
												
												?>  </span>
											
											</td>
											<td align="right">
												<a href="<?php echo base_url ?>rss/cat:<?php echo $category_id_selected > 0 ? $category_id_selected : ""; ?>|q:<?php echo $exp_send["q"] ?>|typ:<?php echo $exp_send["typ"] ?>/"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/xml.gif" border="0"></a>
											</td>
										</tr>
									</tbody>
								</table>
								
								
							</div>
						</div></td>
				</tr>
			</tbody>
		</table>
</div>		
		
		
</div>		
		
		
</div>
	
	
<?php				
include ( "inc.rightsidebar.php" ) ;
?>
</div>
</div>
</div>	
		
<?php		
include ( "inc.footer.php" ) ;
?>
</div>
</body>
</html>

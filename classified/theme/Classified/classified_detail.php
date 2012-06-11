<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php  include ( "core/inc.meta.php" ) ; ?>
<script language="javascript">
		var selected_image_number = 0 ;
		function zoom_image (  )
		{
			if ( selected_image_number == 0 )
				var img_src = "<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=full" ;
			else
				var img_src = "<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=full&imgnum="+selected_image_number ;

			var zom_img = new Image ;
			zom_img.src = img_src ;
			$("#spn_loading").show();
			zom_img.onload = function ( )
								{
									$("#img_zoom").attr("src", img_src ) ;
									showScreen ( 'div_image_zoom' ) ;
									$("#spn_loading").hide();
								} ;
			
		}
		function select_image ( image_number )
		{
			selected_image_number = image_number ;
			$("#spn_loading").show();
			var img_src = "<?php echo base_url ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=1&thumb=5&imgnum="+image_number ;
			var zom_img = new Image ;
			zom_img.src = img_src ;
			$("#spn_loading").show();
			zom_img.onload = function ( )
								{
									$("#main_image").attr("src", img_src ) ;
									$("#spn_loading").hide();
								} ;
		}
		 
		function next_image ( )
		{
			if ( current_image < total_images )
				select_image ( ++current_image ) ;
		}
		
		function prev_image ( )
		{
			if ( current_image > 1 )
				select_image ( --current_image ) ;
			if ( current_image == 0 )
				select_image ( 0 ) ;
		}
		
	</script>
	
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
</style>	
</head>
<body >
	<div id="container">

			<?php include ( "inc.header.php" ) ;?>
			
	<div id="searchsection" style="overflow:hidden;">
     <div class="leftsection">
			<div class="detailsmain">
          <div class="leftcontainer">
            <div class="smallsearch"> Refine Search
			
			<form action="<?php echo base_url ?>search/" method="post" name="frmSearchAd" id="frmSearchAd" class="searchform">
			<input name="isSearchForm" value="true" type="hidden">
			<input name="isSearchForm" value="true" type="hidden">
			<input name="CatId" id="search_cat_id" value="32" type="hidden">
			<input id="searchAd" value="<?php echo $lang["lang_header"]["search_form"]["str_post_button"] ?>" class="searchButton" type="submit">
			</form>
			
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
            <div class="searchresult"><span>Showing result for:</span>
              <ul class="resultlist">
                <li>Equipment & Instrument <img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/cancel_btn.jpg" alt="" width="15" height="14" align="absmiddle" /></li>
                <li>Music Instruction <img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/cancel_btn.jpg" alt="" width="15" height="14" align="absmiddle" /></li>
                <li>Musician Available/Wanted <img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/cancel_btn.jpg" alt="" width="15" height="14" align="absmiddle" /></li>
              </ul>
              <div class="backbutton"><a href="#" class="purplecolor">Back</a></div>
            </div>
            <div class="addcontainer">
              <div class="add_head"><?php echo (intval ( $classified["IsOffer"] ) == 0 ? "Wanted:":""). $classified["AdTitle"] ?> </div>
              <div class="add_picture">
                <div class="main_picture">
				<img id="main_image" src="<?php echo base_url ; ?>classified_img.php?clsid=<?php echo $classified["AdID"] ?>&gallery=1&thumb=5" border="0" alt="No Image" width="249" height="249" />
				</div>
                <ul class="productlisting">
                  <li>
				  <img src="<?php echo base_url ; ?>media/cls_<?php echo $classified["AdID"] ?>_1_520.jpg" width="74px" height="74px" />
				  </li>
                  <li>
				  <img src="<?php echo base_url ; ?>media/cls_<?php echo $classified["AdID"] ?>_2_520.jpg" width="74px" height="74px" />
				  </li>
                  <li>
				  <img src="<?php echo base_url ; ?>media/cls_<?php echo $classified["AdID"] ?>_3_520.jpg" width="74px" height="74px" />
				  </li>
                  <li>
				  <img src="<?php echo base_url ; ?>media/cls_<?php echo $classified["AdID"] ?>_4_520.jpg" width="74px" height="74px" />
				  </li>
                  <li>
				  <img src="<?php echo base_url ; ?>media/cls_<?php echo $classified["AdID"] ?>_5_520.jpg" width="74px" height="74px" />
				  </li>
                  <li>
				  
				  </li>
                </ul>
              </div>
        <div class="add_details">
		<table width="354" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td align="left" valign="top" class="borderbottom"><table width="354" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="290" align="left" valign="top"><span class="grey12normal">Posted on:</span> <?php echo date ( "F j, Y" , strtotime ( $classified["DateAdded"] ) ) ; ?></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="borderbottom"><table width="354" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="60" align="left" valign="top"><span class="grey12normal">Link URL:</span></td>
                          <td width="223" align="left" valign="top"><a href="#" class="purplecolor">http://OZthink.com/classified/</a> <a href="#" class="purplecolor">Name@Domain.com</a></td>
                          <td width="71" align="right" valign="top" class="add_rate"><img src="images/mail_icon.jpg" width="16" height="12" alt="" /></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="borderbottom"><table width="354" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="58" align="left" valign="top"><span class="grey12normal">Location:</span></td>
                          <td width="296" align="left" valign="top">ABN: 62 092 549 472 <br />
                            PO Box 992 <br />
                            Brookvale NSW 2100</td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="borderbottom"><table width="354" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="64" align="left" valign="top"><span class="grey12normal">Company:</span></td>
                        <td width="290" align="left" valign="top"><p><?php echo $classified["compname"] ?></p>
                          <p>Contact Person <?php echo $classified["name"] ?><br />
                           <?php echo $classified["phone"] ?><br />
                          </p></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="borderbottom"><span class="grey12normal">Share On:</span><a href="#"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/tweet_btn.jpg" alt="" width="54" height="20" align="absmiddle" /></a>&nbsp;&nbsp;<a href="#"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/pinit_button.jpg" alt="" width="43" height="20" align="absmiddle" /></a>&nbsp;&nbsp;<a href="#"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/googleplus_button.jpg" alt="" width="32" height="20" align="absmiddle" /></a>&nbsp;&nbsp;<a href="#"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/facebooklike_button.jpg" alt="" width="54" height="20" align="absmiddle" /></a></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="borderbottom"><table width="354" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="51" align="left" valign="top"><span class="grey12normal">Details:</span></td>
                          <td width="303" align="left" valign="top"><?php echo $classified["Description"] ?></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="borderbottom"><span class="grey12normal"><?php echo $classified["Description"] ?></td>
                  </tr>
                  
                  <tr>
                    <td align="right" valign="top" class="borderbottom_none"><a href="#" class="purplecolor">Report Abuse</a>&nbsp;&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="lightgrey12normal" style="padding-top: 50px;">Avoid scams and fraud by dealing locally. Beware any deal involving Western Union, Moneygram, Wire Transfer, Cashier Check, Money Order or Shipping.</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
		
		<?php
		if ( ! empty ( $category_path_array ) )
		{
		?>
		<?php
		echo "<a href='".base_url."'>".$app_init_data["SiteTitle"]."</a>" ;
		foreach ( $category_path_array as $cat_path )
		?>
		<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/cancel_btn.jpg" alt="" width="15" height="14" align="absmiddle" />  				         <?php
		echo "<a href='".base_url."category/".get_sef_url($cat_path["CategoryID"],"Category")."/'>".$cat_path["CategoryName"]."</a>" ;
		?>
		<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/cancel_btn.jpg" alt="" width="15" height="14" align="absmiddle" />  				                    <?php echo $classified["AdTitle"] ?>
		&nbsp;
		<?php
		}
		?>
								



							




</div>  
<!------left Section--------->	 


			<?php	include ( "inc.rightsidebar.php" ); ?>
    </div>
  </div>
</div>
		<!--/content-->
		<?php include ( "inc.footer.php" ) ?>
	</div>
	
</body>
</html>
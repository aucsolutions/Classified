<?php

$con = mysql_connect("classifiedad1.db.9340884.hostedresource.com","classifiedad1","Class2012#@!");
mysql_select_db("classifiedad1", $con);			
	

/***QUERY FETCHING RESULT FOR "ATTRACTION TICKETS"  *********************/
$type = $_GET['category'];


/******QUERY FOR FETCHING DATA FOR ATTRAVTION TICKETS************/

$query ="SELECT CategoryID, CategoryName FROM Category WHERE HeadCategoryID = $type";
//echo $query;
$result=mysql_query($query);
//print_r($result);
?>



									<select name="subcategory" id="subcategory" >
									<option value="">Sub category List</option>
									<?php while($row=mysql_fetch_array($result)) {
									
									//print_r($row); die;
									
									 ?>
   <option value="<?=$row['CategoryID']?>"><?=$row['CategoryName']?></option>
<? }
mysql_free_result($row);
 ?>
</select>


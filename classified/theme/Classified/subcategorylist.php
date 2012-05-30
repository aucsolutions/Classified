<?php

$con = mysql_connect("localhost","root","");
mysql_select_db("contra", $con);			
	

/***QUERY FETCHING RESULT FOR "ATTRACTION TICKETS"  *********************/
$type = $_GET['category'];


/******QUERY FOR FETCHING DATA FOR ATTRAVTION TICKETS************/

$query ="SELECT CategoryID, CategoryName FROM category WHERE HeadCategoryID = $type";
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


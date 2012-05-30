<?php

$con = mysql_connect("classifiedad1.db.9340884.hostedresource.com","classifiedad1","Class2012#@!");
mysql_select_db("classifiedad1", $con);			
	

/***QUERY FETCHING RESULT FOR "ATTRACTION TICKETS"  *********************/
$type = $_GET['country'];


/******QUERY FOR FETCHING DATA FOR ATTRAVTION TICKETS************/

$query ="SELECT  state_id , state_name FROM awear_vm_state WHERE country_id = $type";
//echo $query;
$result=mysql_query($query);
//print_r($result);
?>
<select>

<?php 

    while($row=mysql_fetch_array($result)) 
    {                         
?>
<option value="<?=$row['state_id']?>" onclick="showCities(this.value);"><?=$row['state_name']?></option>
<?php

    }    
?>

</select>

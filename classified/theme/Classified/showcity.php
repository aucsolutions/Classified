<?php

$con = mysql_connect("classifiedad1.db.9340884.hostedresource.com","classifiedad1","Class2012#@!");
mysql_select_db("classifiedad1", $con);			
	

/***QUERY FETCHING RESULT FOR "ATTRACTION TICKETS"  *********************/
$type = $_GET['state'];


/******QUERY FOR FETCHING DATA FOR ATTRAVTION TICKETS************/

$query ="SELECT  cityid , cityname FROM awear_vm_city WHERE stateid = $type";
//echo $query;
$result=mysql_query($query);
//print_r($result);
?>

<?php 
    $i=1;
    while($row=mysql_fetch_array($result)) 
    {
       if( $i<5 )
        {                           
?>
<div>
<input type="checkbox" id="<?=$row['cityname']?>" name="city[]" value="<?=$row['cityid']?>" class="input_check"/> <label><?=$row['cityname']?></label>
</div>
<?php
        $i++;
        }
       else {
    ?>
    <br />
    <?php
        $i=1;
       }
    }    
?>
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
<?php 
    $i=1;
    while($row=mysql_fetch_array($result)) 
    {
       if( $i<5 )
        {                           
?>
<div>
<input type="checkbox" id="<?=$row['CategoryName']?>" name="subcategory[]" value="<?=$row['CategoryID']?>" class="input_check"/> <label><?=$row['CategoryName']?></label>
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



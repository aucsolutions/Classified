<?php
error_reporting(E_ALL^ E_WARNING);  
$con = mysql_connect("localhost","root","");
mysql_select_db("contra", $con);			
/***QUERY FETCHING RESULT FOR "ATTRACTION TICKETS"  *********************/
$type = $_GET['catid'];
/******QUERY FOR FETCHING DATA FOR ATTRAVTION TICKETS************/
$query ="SELECT * FROM categorydisclaimer WHERE catid = $type";
//echo $query;
$result=mysql_query($query);
//print_r($result);
   
    while($row=mysql_fetch_array($result)) 
    {                         
    echo $row['catdisdesc'];
	}



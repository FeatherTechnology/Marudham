<?php
 $con =mysqli_connect("localhost", "root", "", "marudham") or die("Error in database connection".mysqli_error($mysqli));
 $host = "localhost";  
 $db_user = "root";  
 $db_pass = "";  
 $dbname = "marudham";  

 $connect = new PDO("mysql:host=$host; dbname=$dbname", $db_user, $db_pass); 
 $mysqli=mysqli_connect("localhost","root","","marudham");
?>
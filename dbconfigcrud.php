<?php

$DB_host = "localhost";
$DB_user = "hmsi";
$DB_pass = "JVhOHrdKkKdV9r98";
$DB_name = "hmsi";
$DB_port = "2222";


try
{
 $DB_con = new PDO("mysql:host={$DB_host};port={$DB_port};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}

error_reporting(0);
?>
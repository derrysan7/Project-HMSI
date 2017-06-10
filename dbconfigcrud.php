<?php

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "hmsi2";
$DB_port = "";


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
<?php

$DB_host = "vhost.ti.ukdw.ac.id";
$DB_user = "hmsi";
$DB_pass = "JVhOHrdKkKdV9r98";
$DB_name = "hmsi";


try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}

error_reporting(0);
?>
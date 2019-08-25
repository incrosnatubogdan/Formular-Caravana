<?php
//DB details

// $dbUsername = 'x28crvnc_form';
// $dbPassword = 'nG3_w_vxWR@a';
// $dbName     = 'x28crvnc_formular';

$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'formular';



//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}
<?php
//DB details
$dbHost     = 'localhost';
$dbUsername = 'x28crvnc_form';
// $dbUsername = 'root';
$dbPassword = 'nG3_w_vxWR@a';
// $dbPassword = '';
$dbName     = 'x28crvnc_formular';
// $dbName     = 'formular';

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}
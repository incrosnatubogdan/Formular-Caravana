<?php
$files = glob("./carav_1/*.json");

$newDataArray = [];

foreach($files as $file){
    $thisData = file_get_contents($file);
    $thisDataArray = json_decode($thisData,true);
    
    $newDataArray[] = $thisDataArray;
}

$newDataJSON = json_encode($newDataArray);
file_put_contents("output/all.json",$newDataJSON);
var_dump($newDataJSON);

?>

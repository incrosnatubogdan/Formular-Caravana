<?php

$page = file_get_contents("print.json");
$character = json_decode($page);
$array = json_decode($page,true);

// $diagvechi = "diagvechi";
// $diagvechi = implode("<br>",$array[$diagvechi]);
// $diagvechi = str_replace('_', ' ', $diagvechi);

// 
// $diagnoi = implode("<br>",$array[$diagnoi]);
// $diagnoi = str_replace('_', ' ', $diagnoi);
$diagnoi = "diagnoi";
if ($array[$diagnoi] === NULL) {
    var_dump($array[$diagnoi]);
    var_dump("123");
}


?>

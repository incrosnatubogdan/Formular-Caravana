<?php
$path = "test/";
$files = glob("$path/*.json");
foreach ($files as $csv_file) {
    $filepath = str_replace(" ", "\ ", $csv_file);
    echo $filepath . '<br/>';
    unlink($csv_file);
}
?>
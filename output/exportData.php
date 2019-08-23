<?php
//include database configuration file
include 'dbConfig.php';

//get records from database
$query = $db->query("SELECT * FROM formular ORDER BY id DESC");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "pacienti_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('ID', 'Name', 'Asigurat', 'Varsta', 'Data nasterii', 'status');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $status = ($row['status'] == 'zzseen')?'Consultat':'Neconsultat';
        $lineData = array($row['id'], $row['name'], $row['asigurat'], $row['varsta'], $row['datanasterii'], $status);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>
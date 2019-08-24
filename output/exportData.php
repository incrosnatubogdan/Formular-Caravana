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
    $fields = array('ID', 'Name', 'Asigurat', 'Varsta', 'Data nasterii', 'status', 'phone', 'sex', 'Adresa', 'Localitate', 'Judet', 'Talie', 'Greutate', 'Circumferinta abdominala', 'Circumferinta soldurilor', 'Tensiunea arteriala ortostatism', 'Tensiunea arteriala clinostatism', 'acuze', 'Antecedente heredo colaterale', 'antecedente fiziologice', 'Antecedente personale fiziologice', 'numar nasteri', 'numar sarcini', 'numar avorturi', 'antecedente patologice', 'tip dz', 'grad hta', 'antecedente personale patologice', 'medicatia curenta', 'loc munca', 'fumator', 'alcool', 'pachete an', 'an nefumator', 'mese zi', 'legume', 'fructe', 'lactate', 'fainoase', 'proteine', 'ml alcool', 'alcool zi', 'suplimente', 'tegumente mucoase fanere', 'observatii tegumente', 'tesut conjuctiv adipos', 'observatii tesut', 'sistem ganglionar', 'observatii ganglionar', 'muscular osteo articular', 'observatii muscular', 'aparat respirator', 'observatii aparat respirator', 'aparat cardiovascular', 'observatii cardiovascular', 'abdomen', 'observatii abdomen', 'ficat bila splina', 'observatii ficat', 'aparat genito urinar', 'observatii genito urinar', 'sistem nervos', 'observatii sistem nervos', 'organe de simt', 'observatii organe de simt', 'tiroida', 'observatii tiroida', 'consultari suplimentare', 'alte consulturi', 'diagnostice', 'recomandari', 'doctor', 'status', 'diagnostice vechi', 'diagnostice noi', 'observatii diagnostice noi', 'observatii diagnostice vechi', 'bilant clinic');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $status = ($row['status'] == 'zzseen')?'Consultat':'Neconsultat';
        $lineData = array($row['id'], $row['name'], $row['asigurat'], $row['varsta'], $row['datanasterii'], $status, $row['phone'], $row['sex'], $row['Adresa'], $row['Localitate'], $row['Judet'], $row['Talie'], $row['Greutate'], $row['Circumferinta_abdominala'], $row['Circumferinta_soldurilor'], $row['Tensiunea_arteriala_ortostatism'], $row['Tensiunea_arteriala_clinostatism'], $row['acuze'], $row['Antecedente_heredo_colaterale'], $row['antecedente_fiziologice'], $row['Antecedente_personale_fiziologice'], $row['numar_nasteri'], $row['numar_sarcini'], $row['numar_avorturi'], $row['antecedente_patologice'], $row['tip_dz'], $row['grad_hta'], $row['antecedente_personale_patologice'], $row['medicatia_curenta'], $row['loc_munca'], $row['fumator'], $row['alcool'], $row['pachete_an'], $row['an_nefumator'], $row['mese_zi'], $row['legume'], $row['fructe'], $row['lactate'], $row['fainoase'], $row['proteine'], $row['ml_alcool'], $row['alcool_zi'], $row['suplimente'], $row['tegumente_mucoase_fanere'], $row['observatii_tegumente'], $row['tesut_conjuctiv_adipos'], $row['observatii_tesut'], $row['sistem_ganglionar'], $row['observatii_ganglionar'], $row['muscular_osteo_articular'], $row['observatii_muscular'], $row['aparat_respirator'], $row['observatii_aparat_respirator'], $row['aparat_cardiovascular'], $row['observatii_cardiovascular'], $row['abdomen'], $row['observatii_abdomen'], $row['ficat_bila_splina'], $row['observatii_ficat'], $row['aparat_genito_urinar'], $row['observatii_genito_urinar'], $row['sistem_nervos'], $row['observatii_sistem_nervos'], $row['organe_de_simt'], $row['observatii_organe_de_simt'], $row['tiroida'], $row['observatii_tiroida'], $row['consultari_suplimentare'], $row['alte_consulturi'], $row['diagnostice'], $row['recomandari'], $row['doctor'], $row['diagnostice_vechi'], $row['diagnostice_noi'], $row['observatii_diagnostice_noi'], $row['observatii_diagnostice_vechi'], $row['bilant_clinic']);
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
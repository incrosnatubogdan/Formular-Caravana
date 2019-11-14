<?php  
error_reporting(1);
 $message = '';  
 $error = '';  
 $directory = dir("./carav_1/");
 $dir_to_save = "./carav_1/";
 $dir_to_output = "./carav_1/output/";
 $allowed_ext = array(".json"); 
 
 $do_link = TRUE; 
 $sort_what = 0; //0- by name; 1 - by size; 2 - by date
 $sort_how = 0; //0 - ASCENDING; 1 - DESCENDING
 $file = 'newpage.html';
 // Open the file to get existing content
 $current = file_get_contents($file);
 // Append a new person to the file
 $current .= "<!doctype html><html>
 <head><meta charset='utf-8'>
 <title>new file</title>
 </head><body><h3>New HTML file</h3>
 </body></html>
 ";
 
 # # #
 function dir_list($dir){ 
     $i=0; 
     $dl = array(); 
     if ($hd = opendir($dir))    { 
         while ($sz = readdir($hd)) {  
             if (preg_match("/^\./",$sz)==0) $dl[] = $sz;$i.=1;  
         } 
     closedir($hd); 
     } 
     asort($dl); 
     return $dl; 
 } 
 if ($sort_how == 0) { 
     function compare0($x, $y) {  
         if ( $x[0] == $y[0] ) return 0;  
         else if ( $x[0] < $y[0] ) return -1;  
         else return 1;  
     }  
     function compare1($x, $y) {  
         if ( $x[1] == $y[1] ) return 0;  
         else if ( $x[1] < $y[1] ) return -1;  
         else return 1;  
     }  
     function compare2($x, $y) {  
         if ( $x[2] == $y[2] ) return 0;  
         else if ( $x[2] < $y[2] ) return -1;  
         else return 1;  
     }  
 }else{ 
     function compare0($x, $y) {  
         if ( $x[0] == $y[0] ) return 0;  
         else if ( $x[0] < $y[0] ) return 1;  
         else return -1;  
     }  
     function compare1($x, $y) {  
         if ( $x[1] == $y[1] ) return 0;  
         else if ( $x[1] < $y[1] ) return 1;  
         else return -1;  
     }  
     function compare2($x, $y) {  
         if ( $x[2] == $y[2] ) return 0;  
         else if ( $x[2] < $y[2] ) return 1;  
         else return -1;  
     }  
 
 } 
 
 $i = 0; 
 while($file=$directory->read()) { 
     $ext = strrchr($file, '.');
     if (isset($allowed_ext) && (!in_array($ext,$allowed_ext)))
         {
             // dump 
         }
     else { 
         $temp_info = stat($file); 
         $new_array[$i][0] = $file; 
         $new_array[$i][1] = $temp_info[7]; 
         $new_array[$i][2] = $temp_info[9]; 
         $new_array[$i][3] = date("F d, Y", $new_array[$i][2]); 
         $i = $i + 1; 
         } 
 } 
 $directory->close(); 
 

 
 switch ($sort_what) { 
     case 0: 
             usort($new_array, "compare0"); 
     break; 
     case 1: 
             usort($new_array, "compare1"); 
     break; 
     case 2: 
             usort($new_array, "compare2"); 
     break; 
 } 
 
 $i2 = count($new_array); 
 $i = 0; 
 echo "<div class='analize-table'>"; 
 for ($i=0;$i<$i2;$i++) { 
     if (!$do_link) { 
         $line = "<p class='patient'>" .  
                         $new_array[$i][0] .  
                         "</p>"; 
     }else{ 
         $line = "<div class='list'><p class='patient'>".
                         $new_array[$i][0].
                         "</p><a class='edit'>Editeaza</a><a id='".  
                         $new_array[$i][0].
                         "' class='delete'>Sterge</a></div>"; 
     } 
     echo $line; 
 } 
 echo "</div>"; 

 if(isset($_POST["submit"])) {
      $filename = $dir_to_save.$_POST['status'] . $_POST['name'] . "-" . $_POST['datanasterii'] . ".json";
      fopen($filename, "w"); 
      if(empty($_POST["name"])) {  
           $error = "<label class='text-danger'>Enter Name</label>";    
      } else  {  
           if(file_exists($filename))  {  
                $current_data = file_get_contents($filename);  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'name' => $_POST['name'],
                     'asigurat' => $_POST["asigurat"], 
                     'varsta' => $_POST['varsta'],
                     'datanasterii' => $_POST['datanasterii'],
                     'phone' => $_POST['phone'],
                     'sex' => $_POST['sex'],
                     'Adresa' => $_POST['Adresa'],
                     'Localitate' => $_POST['Localitate'],
                     'Judet' => $_POST['Judet'],
                     'Talie' => $_POST['Talie'],
                     'Greutate' => $_POST['Greutate'],
                     'Circumferinta_abdominala' => $_POST['Circumferinta_abdominala'],
                     'Circumferinta_soldurilor' =>$_POST['Circumferinta_soldurilor'],
                     'Tensiunea_arteriala_ortostatism' => $_POST['Tensiunea_arteriala_ortostatism'],
                     'Tensiunea_arteriala_clinostatism' => $_POST['Tensiunea_arteriala_clinostatism'],
                     'acuze' => $_POST['acuze'],
                     'Antecedente_heredo_colaterale' => $_POST['Antecedente_heredo_colaterale'],
                     'antecedente_fiziologice' => $_POST['antecedente_fiziologice'],
                     'Antecedente_personale_fiziologice' => $_POST['Antecedente_personale_fiziologice'],
                     'numar_nasteri' => $_POST['numar_nasteri'],
                     'numar_sarcini' => $_POST['numar_sarcini'],
                     'numar_avorturi' => $_POST['numar_avorturi'],
                     'antecedente_patologice' => $_POST['antecedente_patologice'],
                     'tip_dz' => $_POST['tip_dz'],
                     'grad_hta' => $_POST['grad_hta'],
                     'antecedente_personale_patologice' => $_POST['antecedente_personale_patologice'],
                     'medicatia_curenta' => $_POST['medicatia_curenta'],
                     'loc_munca' => $_POST['loc_munca'],
                     'fumator' => $_POST['fumator'],
                     'alcool' => $_POST['alcool'],
                     'pachete_an' => $_POST['pachete_an'],
                     'an_nefumator' => $_POST['an_nefumator'],
                     'mese_zi' => $_POST['mese_zi'],
                     'legume' => $_POST['legume'],
                     'fructe' => $_POST['fructe'],
                     'lactate' => $_POST['lactate'],
                     'fainoase' => $_POST['fainoase'],
                     'proteine' => $_POST['proteine'],
                     'ml_alcool' => $_POST['ml_alcool'],
                     'alcool_zi' => $_POST['alcool_zi'],
                     'suplimente' => $_POST['suplimente'],
                     'tegumente_mucoase_fanere' => $_POST['tegumente_mucoase_fanere'],
                     'observatii_tegumente' => $_POST['observatii_tegumente'],
                     'tesut_conjuctiv_adipos' => $_POST['tesut_conjuctiv_adipos'],
                     'observatii_tesut' => $_POST['observatii_tesut'],
                     'sistem_ganglionar' => $_POST['sistem_ganglionar'],
                     'observatii_ganglionar' => $_POST['observatii_ganglionar'],
                     'muscular_osteo_articular' => $_POST['muscular_osteo_articular'],
                     'observatii_muscular' => $_POST['observatii_muscular'],
                     'aparat_respirator' => $_POST['aparat_respirator'],
                     'observatii_aparat_respirator' => $_POST['observatii_aparat_respirator'],
                     'aparat_cardiovascular' => $_POST['aparat_cardiovascular'],
                     'observatii_cardiovascular' => $_POST['observatii_cardiovascular'],
                     'abdomen' => $_POST['abdomen'],
                     'observatii_abdomen' => $_POST['observatii_abdomen'],
                     'ficat_bila_splina' => $_POST['ficat_bila_splina'],
                     'observatii_ficat' => $_POST['observatii_ficat'],
                     'aparat_genito_urinar' => $_POST['aparat_genito_urinar'],
                     'observatii_genito_urinar' => $_POST['observatii_genito_urinar'],
                     'sistem_nervos' => $_POST['sistem_nervos'],
                     'observatii_sistem_nervos' => $_POST['observatii_sistem_nervos'],
                     'organe_de_simt' => $_POST['organe_de_simt'],
                     'observatii_organe_de_simt' => $_POST['observatii_organe_de_simt'],
                     'tiroida' => $_POST['tiroida'],
                     'observatii_tiroida' => $_POST['observatii_tiroida'],
                     'consultari_suplimentare' => $_POST['consultari_suplimentare'],
                     'alte_consulturi' => $_POST['alte_consulturi'],
                     'diagnostice' => $_POST['diagnostice'],
                     'recomandari' => $_POST['recomandari'],
                     'doctor' => $_POST['doctor'],
                     'status' => $_POST['status'],
                     'diagnostice_vechi' => $_POST['diagnostice_vechi'],
                     'diagnostice_noi' => $_POST['diagnostice_noi'],
                     'observatii_diagnostice_noi' => $_POST['observatii_diagnostice_noi'],
                     'observatii_diagnostice_vechi' => $_POST['observatii_diagnostice_vechi'],
                     'bilant_clinic' => $_POST['bilant_clinic']
                );  
                $array_data = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents($filename, $final_data))  
                {  
                     $message = "<div class='text-success'><p>Fisa a fost salvata</p></div>";  
                }  
           }  else  {  
                $error = 'JSON File not exists';  
           }

           $extra = array(  
            'Nume' => $_POST['name'],
            'Asigurat' => $_POST['asigurat'],
            'Varsta' => $_POST['varsta'],
            'Data nasterii' => $_POST['datanasterii'],
            'Talie' => $_POST['Talie'],
            'Greutate' => $_POST['Greutate'],
            'Tensiunea arteriala ortostatism' => $_POST['Tensiunea_arteriala_ortostatism'],
            'Tensiunea arteriala clinostatism' => $_POST['Tensiunea_arteriala_clinostatism'],
            'Fumator' => $_POST['fumator'],
            'Pachere An' => $_POST['pachete_an'],
            'An nefumator' => $_POST['an_nefumator'],
            'Consultari suplimentare' => $_POST['statistica_consultari_suplimentare'],
            'Diagnostice vechi' => $_POST['statistica_diagnostice_vechi'],
            'Diagnostice noi' => $_POST['statistica_diagnostice_noi'],
            'Bilant Clinic' => $_POST['bilant_clinic']
            );  
            $array_data = $extra;  
            $final_data = json_encode($array_data);
            $filename = $dir_to_output. $_POST['name'] . ".json";
            file_put_contents($filename, $current);
            if(file_put_contents($filename, $final_data))  
            {  
                    $message = "<div class='text-success'><p>Fisierul este in curs de printare</p></div>";  
            }
      }  
     
 }
 if(isset($_POST["print"])) {
    $extra = array(  
         'name' => $_POST['name'],
         'current_date' => $_POST['current_date'],
         'datanasterii' => $_POST['datanasterii'],
         'diagvechi' => $_POST['diagnostice_vechi'],
         'diagnoi' => $_POST['diagnostice_noi'],
         'obs_diagvechi' => $_POST['observatii_diagnostice_vechi'],
         'obs_diagnoi' => $_POST['observatii_diagnostice_noi'],
         'recomandari' => $_POST['recomandari']
    );  
    $array_data = $extra;
    $final_data = json_encode($array_data);
    $printfile = "pdf/print.json";
    file_put_contents($printfile, $final_data);
    if(file_put_contents($printfile, $final_data))  
    {  
        print_r("Ceva");  
    }
}    
 ?>
<!DOCTYPE html>
<html>

<head>
    <title>Fisa de urmarire a pacientului CCM</title>
    <html lang="ro">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="assets/css/styles.css?ver=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/select2.css?ver=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/styles_new.css?ver=<?php echo time(); ?>" />
    <link rel="manifest" href="manifest.webmanifest">

    <script src="assets/js/jquery-3.3.1.min.js?ver=<?php echo time(); ?>"></script>
    <script src="assets/js/main.js?ver=<?php echo time(); ?>"></script>
</head>

<body>
    <div class="login_popup">
        <input id="username" type="text" placeholder="Username" class="form-control" />
        <input id="parola" type="password" placeholder="password" class="form-control" />
        <p class="hide" style="color:red">Datele introuse nu sunt corecte</p>
        <button class="signin_btn">Vezi formularul</button>
    </div>
    <iframe name="votar" style="display:none;"></iframe>
    <div class="menu-bar">
        <button class="top_bar pacient_nou"><img src="assets/add.png">Pacient Nou</button>
        <button class="top_bar analize"><img src="assets/search.png">Vezi toti pacientii</button>
        <button class="top_bar pozitie">Schimba-ti pozitia</button>
        <div class="logo_holder">
            <img src="assets/logo.png" class="logo" alt="">
        </div>
        
    </div>
    <div id="toate-analizele" class="overlay">
        <div class="popup">
            <a class="close close-joker">X</a>
            <input type="text" id="search_patient" placeholder="Cauta pacient">
            <h2>Pacientii din caravana:</h2>
            <div class="table">
                <h2>Ultimul tau pacient adaugat:</h2>
                <p class="last_patient">
                    </td>
            </div>
        </div>
    </div>
    <div class="container" style="width:100%;">
        <div class='text-success'>
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
            <p>Fisa a fost salvata</p>
        </div>
        <h3 class="doc_title">Fisa de urmarire a pacientului CCM</h3>
        <a href="#status_check">
            <img class="bottom" src="assets/down.png">
        </a>
        
        <form id="medical_form" method="post" target="votar">
            <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>
            
            <div class="col_half">
                <input name='grad_hta' class='hide' type='text'>
                <input class='today hide' name="current_date" type='text'>
                <input name='tip_dz' class='hide' type='text'>
                    <label>Nume și prenume</label>
                    <input id="name" type="text" name="name" class="form_control important protected_data" />
            </div>
            <div class="col_half">
                <div class="col_half">
                    <label>Status asigurat</label>
                    <select name="asigurat" class="important protected_data">
                        <option value="frontdesk_uitat"></option>
                        <option value="Asigurat">Asigurat</option>
                        <option value="Neasigurat">Neasigurat</option>
                    </select>
                </div>
                <div class="col_half col_third">
                    <label>Sex</label>
                    <select name="sex" class="important protected_data">
                        <option value="frontdesk_uitat"></option>
                        <option value="F">F</option>
                        <option value="M">M</option>
                    </select>
                </div>
            </div>
            <div class="col_half">
                <label>Vârstă (ani)</label>
                <input type="text" name="varsta" class="form_control important protected_data" />
            </div>
            <div class="col_half">
                <label>Data nașterii</label>
                <input type="text" name="datanasterii" class="form_control important protected_data" placeholder="ZZ.LL.AAAA" />
            </div>
            <div class="col_half">
                <label>Număr de telefon</label>
                <input type="text" name="phone" class="form_control protected_data" />
            </div>
            <div class="col_half">
                <label>Localitate</label>
                <input type="text" name="Localitate" class="form_control protected_data" />
            </div>
            <div class="col_half">
                <label>Județ</label>
                <input type="text" name="Judet" class="form_control protected_data" />
            </div>
            <h2>Măsurători</h2>
            <div class="col_half half">
                <label>Talie (cm)</label>
                <input type="text" name="Talie" class="form_control important" />
            </div>
            <div class="col_half half">
                <label>Greutate (kg)</label>
                <input type="text" name="Greutate" class="form_control important" />
            </div>
            <div class="col_half half">
                <label>Circumferința abdominală (cm)</label>
                <input type="text" name="Circumferinta_abdominala" class="form_control" />
            </div>
            <div class="col_half half">
                <label>Circumferința șoldurilor (cm)</label>
                <input type="text" name="Circumferinta_soldurilor" class="form_control" />
            </div>
            <div class="col_half">
                <label>Tensiunea arteriala (mmHg)</label>
                <div class="col_half col_third">
                    <input type="text" name="Tensiunea_arteriala_ortostatism" class="form_control important" />
                </div>
                <span style="font-size: 30px;">
                    /
                </span>
                <div class="col_half col_third">
                    <input type="text" name="Tensiunea_arteriala_clinostatism" class="form_control important" />
                </div>
            </div>
            <h2>Anamneză</h2>
            <div class="col_half">
                <label>Acuze</label>
                <textarea type="text" name="acuze" class="form_control"></textarea>
            </div>
            <div class="col_half">
                <label>Antecedente heredo-colaterale</label>
                <textarea type="text" name="Antecedente_heredo_colaterale" class="form_control"></textarea>
            </div>
            <div class="col_half">
                <label>Antecedente personale fiziologice</label>
                <div class="flex no_left">
                    <label>Nașteri</label>
                    <input type="text" name="numar_nasteri" class="form_control">
                    <label>Sarcini</label>
                    <input type="text" name="numar_sarcini" class="form_control">
                    <label>Avorturi</label>
                    <input type="text" name="numar_avorturi" class="form_control">
                </div>
                <textarea type="text" placeholder="Altele" name="Antecedente_personale_fiziologice"
                    class="form_control"></textarea>
            </div>
            
            <div class="col_half">
                <label>Antecedente personale PATOLOGICE</label>
                <div class="checkbox_holder" id="antecedente_patologice"></div>
                <select name="antecedente_patologice[]" id="antecedente_patologice" multiple="multiple">
                    <option id="hta" value="HTA">HTA</option>
                    <option id="dz" value="DZ">DZ</option>
                    <option value="AVC">AVC</option>
                    <option value="BCI">BCI</option>
                    <option value="FiA">FiA</option>
                    <option value="BAP">BAP</option>
                    <option value="BCR">BCR</option>
                </select>
                <textarea type="text" placeholder="Altele" name="Antecedente_personale_patologice"
                    class="form_control"></textarea>
            </div>
            <div class="col_half">
                <label>Medicația curentă</label>
                <textarea type="text" name="medicatia_curenta" class="form_control"></textarea>
            </div>
            <h2>Condiții de viață și de muncă și comportamente</h2>
            <div class="col_half col_third">
                <label>Loc de munca (toxic/nontoxic)</label>
                <select name="loc_munca">
                    <option value="frontdesk_uitat"></option>
                    <option value="Toxic">Toxic</option>
                    <option value="Non_Toxic">Non-Toxic</option>
                </select>
            </div>
            <div class="col_half col_third">
                <label>Fumător:</label>
                <select name="fumator" class="important">
                    <option value="frontdesk_uitat"></option>
                    <option value="Da_prezent">Da(prezent)</option>
                    <option value="Da_trecut">Da(trecut)</option>
                    <option value="Nu">Nu</option>
                </select>
            </div>
            <div class="col_half hide_alcohol smoker">
                <label>PA (pachete an)</label>
                <input type="text" name="pachete_an" class="form_control important" />
            </div>
            <div class="col_half hide_alcohol smoker">
                <label>Ani de când nu mai fumează</label>
                <input type="text" name="an_nefumator" class="form_control important" />
            </div>
            <div class="col_half col_third">
                    <label>Consuma alcool</label>
                    <select name="alcool">
                        <option value="frontdesk_uitat"></option>
                        <option value="Da">Da</option>
                        <option value="Nu">Nu</option>
                    </select>
                </div>
                <div class="col_half alcohol_info hide_alcohol">
                    <label>Daca da: ml de(tip alcool):</label>
                    <input type="text" name="ml_alcool" class="form_control" />
                    <label>de ori/(zi, sapt)</label>
                    <input type="text" name="alcool_zi" class="form_control" />
            </div>
            <h2>Examen obiectiv</h2>
            <div class="col_sm_12 col_md_6">
                <h3>Tegumente, mucoase și fanere</h3>
                <div class="checkbox_holder" id="tegumente_mucoase_fanere"></div>
                <select name="tegumente_mucoase_fanere[]" id="tegumente_mucoase_fanere" multiple="multiple">
                    <option class="select_all" name="normal" value="normale">NORMALE</option>
                    <option value="facies_normal">Facies normal sau necaracteristic.</option>
                    <option value="tegument_normal">Tegumente de culoare normală, trofice, normal
                        hidratate.</option>
                    <option value="pliu_elastic">Pliu cutanat elastic.</option>
                    <option value="mucoase_normale">Mucoase normal umectate și colorate.</option>
                    <option value="fanere_normale">Fanere normal colorate și normotrofice (în limitele
                        vârstei).</option>
                    <option value="fara_leziuni">Fără leziuni cutanate.</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_tegumente"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Țesut conjunctiv adipos</h3>
                <div class="checkbox_holder" id="tesut_conjuctiv_adipos"></div>
                <select name="tesut_conjuctiv_adipos[]" id="tesut_conjuctiv_adipos" multiple="multiple">
                    <option value="normal_reprezentat">NORMAL REPREZENTAT</option>
                    <option value="exces">În exces (adipozitate androidă/ginoidă)</option>
                    <option value="slab_reprezentat">Slab reprezentat</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_tesut" class="form_control">
            </textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Sistem ganglionar</h3>
                <div class="checkbox_holder" id="sistem_ganglionar"></div>
                <select name="sistem_ganglionar[]" id="sistem_ganglionar" multiple="multiple">
                    <!-- <option class="select_all" value="NORMALE">NORMAL</option> -->
                    <option value="fara_adenopatii_palpabile">Fara adenopatii palpabile</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_ganglionar"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Sistem muscular si osteo-articular</h3>
                <div class="checkbox_holder" id="muscular_osteo_articular"></div>
                <select name="muscular_osteo_articular[]" id="muscular_osteo_articular" multiple="multiple">
                    <option class="select_all" value="normal">NORMAL</option>
                    <option value="facies_normal">Facies normal sau necaracteristic.</option>
                    <option value="muscular_normotrof_normoton">Sistem muscular normotrof, normoton,
                        normokinetic.</option>
                    <option value="osteo_articular_integru">Sistem osteo-articular integru morfofunctional</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_muscular"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Aparat respirator</h3>
                <div class="checkbox_holder" id="aparat_respirator"></div>
                <select name="aparat_respirator[]" id="aparat_respirator" multiple="multiple">
                    <option class="select_all" value="normal">NORMAL</option>
                    <option value="torace_normal">Torace normal conformat, simetric.</option>
                    <option value="tegument_normal">Tegumente de culoare normală, trofice, normal
                        hidratate.</option>
                    <option value="ampliatii_normale">Ampliații respiratorii normale și simetrice bilateral.</option>
                    <option value="sonoritate_normala">Sonoritate normală la percuție.</option>
                    <option value="murmur_vezicular_egal_bilateral">Murmur vezicular egal bilateral, fără raluri.
                    </option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_aparat_respirator"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Aparat cardiovascular</h3>
                <div class="checkbox_holder" id="aparat_cardiovascular"></div>
                <select name="aparat_cardiovascular[]" id="aparat_cardiovascular" multiple="multiple">
                    <option class="select_all" value="normal">NORMAL</option>
                    <option value="soc_apexian">Șoc apexian palpabil în Sp V IC stâng.</option>
                    <option value="zgomote_cardiace_echipotente">Zgomote cardiace echipotente și echidistante, fără
                        zgomote supraadaugate</option>
                    <option value="pulsuri_periferice_palpabile">Pulsuri periferice palpabile egal bilateral. Fără
                        edeme, jugulare neturgescente. Fără vene varicoase</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_cardiovascular"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12">

            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Abdomen</h3>
                <div class="checkbox_holder" id="abdomen"></div>
                <select name="abdomen[]" id="abdomen" multiple="multiple">
                    <option class="select_all" value="normal">NORMAL</option>
                    <option value="abdomen_suplu">Abdomen suplu, mobil cu respirația, sonor la
                        percuție, nedureros spontan sau la palpare.</option>
                    <option value="zgomote_intestinale_prezente">Zgomote intestinale prezente; fără modificări de
                        tranzit.</option>
                    <option value="fara_mase_intraabdominale">Fără mase intraabdominale palpabile.</option>
                    <option value="fara_semne_iritatie">Fără semne de iritație peritoneală</option>
                    <option value="tranzit_intestinal_prezent">Tranzit intestinal prezent</option>
                    <option value="aspect_scaun_normal">Aspect scaun normal</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_abdomen"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Ficat, căi biliare și splină</h3>
                <div class="checkbox_holder" id="ficat_bila_splina"></div>
                <select name="ficat_bila_splina[]" id="ficat_bila_splina" multiple="multiple">
                    <option class="select_all" value="normal">NORMAL</option>
                    <option value="ficat_palbabil_rebordul_costal">Ficat palpabil la rebordul costal drept sau la
                        maxim
                        1 cm de acesta, cu consistență elastică și omogenă,
                        margine inferioară rotunjită și margine superioară în
                        spațiul intercostal IV.</option>
                    <option value="colecist_nepalpabil">Colecist nepalpabil, manevra Murphy negativ.</option>
                    <option value="splina_nepalpabila">Splină nepalpabilă, nepercutabilă.</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_ficat"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Aparat genito-urinar</h3>
                <div class="checkbox_holder" id="aparat_genito_urinar"></div>
                <select name="aparat_genito_urinar[]" id="aparat_genito_urinar" multiple="multiple">
                    <option class="select_all" value="normal">Normal</option>
                    <option value="mitiuni_fiziologice">Mițiuni fiziologice ca aspect, frecvență și cantitate</option>
                    <option value="giordano_negativ">Giordano negativ</option>
                    <option value="rinichi_nepalpabili">Rinichi nepalpabili</option>
                    <option value="vezica_urinara_nepalpabila">Vezica urinară nepalpabilă transabdominal</option>
                    <option value="zone_anexiale_suple">Zone anexiale suple și nedureroase</option>
                    <option value="glande_mamare_normale">Glande mamare de aspect și consistență normală</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_genito_urinar"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Sistem nervos</h3>
                <div class="checkbox_holder" id="sistem_nervos"></div>
                <select name="sistem_nervos[]" id="sistem_nervos" multiple="multiple">
                    <option class="select_all" value="normal">NORMAL</option>
                    <option value="pacient_constient_cooperant">Pacient conștient, cooperant, orientat temporo-spațial.</option>
                    <option value="nervii_cranieni_intacti">Nervii cranieni II-XII intacți, ROT normale și egale
                        bilateral.</option>
                    <option value="fara_semne_neurologice_focar">Fără semne neurologice de focar, fără redoare de
                        ceafă.</option>
                    <option value="fara_tulburari_psihice">Fără tulburari psihice.</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_sistem_nervos"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Organe de simț</h3>
                <div class="checkbox_holder" id="organe_de_simt"></div>
                <select name="organe_de_simt[]" id="organe_de_simt" multiple="multiple">
                    <option class="select_all" value="normal">Normal</option>
                    <option value="acuitate_vizuala_normala">Acuitate vizuală normală.</option>
                    <option value="acuitate_auditiva_normala">Acuitate auditivă pastrată.</option>
                    <option value="fara_tulburari_senzitive_cutanate">Fără tulburari senzitive cutanate, de gust
                        sau de
                        miros.</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_organe_de_simt"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Tiroida</h3>
                <div class="checkbox_holder" id="tiroida"></div>
                <select name="tiroida[]" id="tiroida" multiple="multiple">
                    <option class="select_all" value="normal">Normal</option>
                    <option value="tiroida_palpabila">Tiroida palpabilă pe linia mediană a gâtului.
                        </option>
                    <option value="consistenta_elastica">Consistență elastică și omogenă, de dimensiuni
                        normale, nedureroasă.</option>
                </select>
                <textarea type="text" placeholder="Observații" name="observatii_tiroida"
                    class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Consulturi suplimentare:</h3>
                <input type="text" name="statistica_consultari_suplimentare" class="hide">
                <div class="checkbox_holder" id="consultari_suplimentare"></div>
                <select name="consultari_suplimentare[]" id="consultari_suplimentare" multiple="multiple">
                    <option value="fara_consulturi">fără alte consulturi</option>
                    <option value="ecografie_abdominala">ecografie abdominală</option>
                    <option value="consult_medicina_interna">consult medicină internă/cardiologie</option>
                    <option value="consult_dermatologie">consult dermatologie</option>
                    <option value="consult_oftalmologie">consult oftalmologie</option>
                </select>
                <h3>Alte consulturi</h3>
                <textarea type="text" name="alte_consulturi" class="form_control"></textarea>
            </div>
            <div class="col_sm_12">
                <h3>Recomandari</h3>
                <textarea type="text" name="recomandari" class="form_control"></textarea>
            </div>
            <div class="col_sm_12">
                <input type="text" name="statistica_diagnostice_vechi" class="hide">
                <h3>Diagnostice VECHI:</h3>
                <select name="diagnostice_vechi[]" id="diagnostice_vechi" multiple="multiple" class="select2 important">
                        <optgroup label="IMC">
                            <option value="status_supraponderal">Status supraponderal</option>
                            <option value="obezitate_grad_1">Obezitate grad I</option>
                            <option value="obezitate_grad_2">Obezitate grad II</option>
                            <option value="obezitate_morbida">Obezitate morbida</option>
                        </optgroup>
                        <optgroup label="Cardiologie">
                            <option value="HTA_grad_1_risc_scazut">HTA grad 1 risc aditional scazut</option>
                            <option value="HTA_grad_1_risc_moderat">HTA grad 1 risc aditional moderat</option>
                            <option value="HTA_grad_1_risc_inalt">HTA grad 1 risc aditional inalt</option>
                            <option value="HTA_grad_1_risc_foarte_inalt">HTA grad 1 risc aditional foarte inalt</option>
                            <option value="HTA_grad_2_risc_moderat">HTA grad 2 risc aditional moderat</option>
                            <option value="HTA_grad_2_risc_inalt">HTA grad 2 risc aditional inalt</option>
                            <option value="HTA_grad_2_risc_foarte_inalt">HTA grad 2 risc aditional foarte inalt</option>
                            <option value="HTA_grad_3_risc_inalt">HTA grad 3 risc aditional inalt</option>
                            <option value="HTA_grad_3_risc_foarte_inalt">HTA grad 3 risc aditional foarte inalt</option>
                            <option value="ic_clasa_nyha_1">Insuficiență cardiacă clasa NYHA I</option>
                            <option value="ic_clasa_nyha_2">Insuficiență cardiacă clasa NYHA II</option>
                            <option value="ic_clasa_nyha_3">Insuficiență cardiacă clasa NYHA III</option>
                            <option value="ic_clasa_nyha_4">Insuficiență cardiacă clasa NYHA IV</option>
                            <option value="hipercolesterolemie">Hipercolesterolemie</option>
                            <option value="hipertrigliceridemie">Hipertrigliceridemie</option>
                            <option value="dislipidemie_mixta">Dislipidemie mixtă</option>
                        </optgroup>
                        <optgroup label="Gastroenterologie">
                            <option value="ecografie_abdominala">Hepatită cronică virală B</option>
                            <option value="consult_medicina_interna">Hepatită cronică virală C</option>
                            <option value="consult_dermatologie">Sdr. de hepatocitoliză</option>
                            <option value="consult_oftalmologie">Steatoză hepatică</option>
                        </optgroup>
                        <optgroup label="Nutritie">
                            <option value="dz_tip_1">Diabet zaharat tip 1</option>
                            <option value="dz_tip_2">Diabet zaharat tip 2</option>
                            <option value="dz_tip_1_echilibrat">Diabet zaharat tip 1 echilibrat</option>
                            <option value="dz_tip_1_dezechilibrat">Diabet zaharat tip 1 dezechilibrat</option>
                            <option value="dz_tip_2_echilibrat">Diabet zaharat tip 2 echilibrat</option>
                            <option value="dz_tip_2_dezechilibrat">Diabet zaharat tip 2 dezechilibrat</option>
                        </optgroup>
                        <optgroup label="Reumatologie">
                            <option value="Hiperuricemie_asimptomatica">Hiperuricemie asimptomatică</option>
                            <option value="Hiperuricemie_simptomatica">Hiperuricemie simptomatică</option>
                        </optgroup>
                        <optgroup label="Altele">
                            <option value="itu_joasa">ITU joasa</option>
                            <option value="itu_inalta">ITU inalta</option>
                        </optgroup>
                </select>
                <textarea type="text" placeholder="Altele" name="observatii_diagnostice_vechi" class="form_control"></textarea>
            </div>
            <div class="col_sm_12">
                <h3>Diagnostice NOI:</h3>
                <input type="text" name="statistica_diagnostice_noi" class="hide">
                <select name="diagnostice_noi[]" id="diagnostice_noi" multiple="multiple" class="select2 important">
                        <optgroup label="IMC">
                            <option value="status_supraponderal">Status supraponderal</option>
                            <option value="obezitate_grad_1">Obezitate grad I</option>
                            <option value="obezitate_grad_2">Obezitate grad II</option>
                            <option value="obezitate_morbida">Obezitate morbida</option>
                        </optgroup>
                        <optgroup label="Cardiologie">
                        <option value="HTA_grad_1_risc_scazut">HTA grad 1 risc aditional scazut</option>
                            <option value="HTA_grad_1_risc_moderat">HTA grad 1 risc aditional moderat</option>
                            <option value="HTA_grad_1_risc_inalt">HTA grad 1 risc aditional inalt</option>
                            <option value="HTA_grad_1_risc_foarte_inalt">HTA grad 1 risc aditional foarte inalt</option>
                            <option value="HTA_grad_2_risc_moderat">HTA grad 2 risc aditional moderat</option>
                            <option value="HTA_grad_2_risc_inalt">HTA grad 2 risc aditional inalt</option>
                            <option value="HTA_grad_2_risc_foarte_inalt">HTA grad 2 risc aditional foarte inalt</option>
                            <option value="HTA_grad_3_risc_inalt">HTA grad 3 risc aditional inalt</option>
                            <option value="HTA_grad_3_risc_foarte_inalt">HTA grad 3 risc aditional foarte inalt</option>
                            <option value="ic_clasa_nyha_1">Insuficiență cardiacă clasa NYHA I</option>
                            <option value="ic_clasa_nyha_2">Insuficiență cardiacă clasa NYHA II</option>
                            <option value="ic_clasa_nyha_3">Insuficiență cardiacă clasa NYHA III</option>
                            <option value="ic_clasa_nyha_4">Insuficiență cardiacă clasa NYHA IV</option>
                            <option value="hipercolesterolemie">Hipercolesterolemie</option>
                            <option value="hipertrigliceridemie">Hipertrigliceridemie</option>
                            <option value="dislipidemie_mixta">Dislipidemie mixtă</option>
                        </optgroup>
                        <optgroup label="Gastroenterologie">
                            <option value="ecografie_abdominala">Hepatită cronică virală B</option>
                            <option value="consult_medicina_interna">Hepatită cronică virală C</option>
                            <option value="consult_dermatologie">Sdr. de hepatocitoliză</option>
                            <option value="consult_oftalmologie">Steatoză hepatică</option>
                        </optgroup>
                        <optgroup label="Nutritie">
                            <option value="dz_tip_1">Diabet zaharat tip 1</option>
                            <option value="dz_tip_2">Diabet zaharat tip 2</option>
                            <option value="dz_tip_1_echilibrat">Diabet zaharat tip 1 echilibrat</option>
                            <option value="dz_tip_1_dezechilibrat">Diabet zaharat tip 1 dezechilibrat</option>
                            <option value="dz_tip_2_echilibrat">Diabet zaharat tip 2 echilibrat</option>
                            <option value="dz_tip_2_dezechilibrat">Diabet zaharat tip 2 dezechilibrat</option>
                        </optgroup>
                        <optgroup label="Reumatologie">
                            <option value="Hiperuricemie_asimptomatica">Hiperuricemie asimptomatică</option>
                            <option value="Hiperuricemie_simptomatica">Hiperuricemie simptomatică</option>
                        </optgroup>
                        <optgroup label="Altele">
                            <option value="itu_joasa">ITU joasa</option>
                            <option value="itu_inalta">ITU inalta</option>
                        </optgroup>
                </select>
                <textarea type="text" placeholder="Altele" name="observatii_diagnostice_noi" class="form_control"></textarea>
            </div>
            <div class="col_sm_12 col_md_6">
                <h3>Bilant clinic:</h3>
                <select name="bilant_clinic" id="bilant_clinic" class="important">
                    <option value="clinic_sanatos">Clinic sănătos</option>
                    <option value="recomandare_consult_MF">Recomandare consult MF</option>
                    <option value="recomandare_consult_specialitate">Recomandare consult de specialitate</option>
                    <option value="urgenta_medicala">Urgență medicală</option>
                </select>
            </div>
            <div class="col_half">
                <label>Fișă întocmită de</label>
                <input type="text" name="doctor" class="form_control" />
                <input type="text" name="status" class="status hide" />
                <div class="check_holder">
                    <input type="checkbox" name="status_check" class="fake_box" id="status_check">
                    <label for="scales">Pacient Consultat</label>
                </div>
            </div>
            <input type="submit" name="submit" class="btn btn-info submit-button" />
            <button type="submit" name="print" class="top_bar make_pdf" class="submit-button">
            <img src="assets/print.png">
            Print</button>
            <?php  
            if(isset($message)) {  
                echo $message;  
            }  
            ?>
        </form>
        <footer>
                <img>
                <p class="quote">
                    „Doar o viață trăită pentru alții este o viață care merită trăită" <br>
                    - Albert Einstein
                </p>
                <p class="copyright">Crafted with ❤️ by Tac-Tic Studio © 2019</p>
            </footer>
    </div>
    
</body>


</html>
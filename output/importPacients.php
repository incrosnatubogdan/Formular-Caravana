<?php
    // error_reporting(0);
    $conn = new PDO("mysql:host=localhost;dbname=x28crvnc_formular", 'x28crvnc_form', 'nG3_w_vxWR@a');
    // $conn = new PDO("mysql:host=localhost;dbname=formular", 'root', '');
    // copy($_FILES['jsonFile']['tmp_name'], 'jsonFiles/'.$_FILES['jsonFile']['name']);
    $data = file_get_contents("all.json");
    $patients = json_decode($data);

    foreach ($patients as $patient) {
        $stmt = $conn->prepare('insert into formular(name, asigurat, varsta, datanasterii, phone, sex, Adresa, Localitate, Judet, Talie, Greutate, Circumferinta_abdominala, Circumferinta_soldurilor, Tensiunea_arteriala_ortostatism, Tensiunea_arteriala_clinostatism, acuze, Antecedente_heredo_colaterale, antecedente_fiziologice, Antecedente_personale_fiziologice, numar_nasteri, numar_sarcini, numar_avorturi, antecedente_patologice, tip_dz, grad_hta, antecedente_personale_patologice, medicatia_curenta, loc_munca, fumator, alcool, pachete_an, an_nefumator, mese_zi, legume, fructe, lactate, fainoase, proteine, ml_alcool, alcool_zi, suplimente, tegumente_mucoase_fanere, observatii_tegumente, tesut_conjuctiv_adipos, observatii_tesut, sistem_ganglionar, observatii_ganglionar, muscular_osteo_articular, observatii_muscular, aparat_respirator, observatii_aparat_respirator, aparat_cardiovascular, observatii_cardiovascular, abdomen, observatii_abdomen, ficat_bila_splina, observatii_ficat, aparat_genito_urinar, observatii_genito_urinar, sistem_nervos, observatii_sistem_nervos, organe_de_simt, observatii_organe_de_simt, tiroida, observatii_tiroida, consultari_suplimentare, alte_consulturi, diagnostice, recomandari, doctor, status, diagnostice_vechi, diagnostice_noi, observatii_diagnostice_noi, observatii_diagnostice_vechi, bilant_clinic) 
        values (:name, :asigurat, :varsta, :datanasterii, :phone, :sex, :Adresa, :Localitate, :Judet, :Talie, :Greutate, :Circumferinta_abdominala, :Circumferinta_soldurilor, :Tensiunea_arteriala_ortostatism, :Tensiunea_arteriala_clinostatism, :acuze, :Antecedente_heredo_colaterale, :antecedente_fiziologice, :Antecedente_personale_fiziologice, :numar_nasteri, :numar_sarcini, :numar_avorturi, :antecedente_patologice, :tip_dz, :grad_hta, :antecedente_personale_patologice, :medicatia_curenta, :loc_munca, :fumator, :alcool, :pachete_an, :an_nefumator, :mese_zi, :legume, :fructe, :lactate, :fainoase, :proteine, :ml_alcool, :alcool_zi, :suplimente, :tegumente_mucoase_fanere, :observatii_tegumente, :tesut_conjuctiv_adipos, :observatii_tesut, :sistem_ganglionar, :observatii_ganglionar, :muscular_osteo_articular, :observatii_muscular, :aparat_respirator, :observatii_aparat_respirator, :aparat_cardiovascular, :observatii_cardiovascular, :abdomen, :observatii_abdomen, :ficat_bila_splina, :observatii_ficat, :aparat_genito_urinar, :observatii_genito_urinar, :sistem_nervos, :observatii_sistem_nervos, :organe_de_simt, :observatii_organe_de_simt, :tiroida, :observatii_tiroida, :consultari_suplimentare, :alte_consulturi, :diagnostice, :recomandari, :doctor, :status, :diagnostice_vechi, :diagnostice_noi, :observatii_diagnostice_noi, :observatii_diagnostice_vechi, :bilant_clinic)');
        
        $sql = 'SELECT name FROM formular WHERE name = :name';
        $check = $conn->prepare($sql);
        $check->bindValue(':name',$patient->name);
        $check->execute();

        if($row = $check->fetch(PDO::FETCH_ASSOC)) {
            print_r ($patient->name . " <-Patient introdus deja<br>");
        } elseif (isset($patient->name) & strlen($patient->name) > 3) {
            $fieldsArray = ['name', 'asigurat', 'varsta', 'datanasterii', 'phone', 'sex', 'Adresa', 'Localitate', 'Judet', 'Talie', 'Greutate', 'Circumferinta_abdominala', 'Circumferinta_soldurilor', 'Tensiunea_arteriala_ortostatism', 'Tensiunea_arteriala_clinostatism', 'acuze', 'Antecedente_heredo_colaterale', 'antecedente_fiziologice', 'Antecedente_personale_fiziologice', 'numar_nasteri', 'numar_sarcini', 'numar_avorturi', 'tip_dz', 'grad_hta', 'antecedente_personale_patologice', 'medicatia_curenta', 'loc_munca', 'fumator', 'alcool', 'pachete_an', 'an_nefumator', 'mese_zi', 'legume', 'fructe', 'lactate', 'fainoase', 'proteine', 'ml_alcool', 'alcool_zi', 'suplimente', 'observatii_tegumente', 'observatii_tesut', 'observatii_ganglionar', 'observatii_muscular', 'observatii_aparat_respirator', 'observatii_cardiovascular', 'observatii_abdomen', 'observatii_ficat', 'observatii_genito_urinar', 'observatii_sistem_nervos', 'observatii_organe_de_simt', 'observatii_tiroida', 'alte_consulturi', 'diagnostice', 'recomandari', 'doctor', 'status', 'observatii_diagnostice_noi', 'observatii_diagnostice_vechi', 'bilant_clinic'];
            $implodeArray = ['antecedente_patologice','tegumente_mucoase_fanere','tesut_conjuctiv_adipos','sistem_ganglionar','muscular_osteo_articular','aparat_respirator','aparat_cardiovascular','abdomen','ficat_bila_splina','aparat_genito_urinar','sistem_nervos','organe_de_simt','tiroida','consultari_suplimentare','diagnostice_vechi','diagnostice_noi'];
            $empty = ' ';

            foreach ($fieldsArray as $field) {
                if (isset($field)) {
                    $stmt->bindValue($field, $patient->$field);   
                }
            }

            foreach ($implodeArray as $fieldArr) {
                if (isset($fieldArr) & is_array($patient->$fieldArr)) {
                    $stmt->bindValue($fieldArr, implode(", ",$patient->$fieldArr));
                } else {
                    $stmt->bindValue($fieldArr, $patient->$fieldArr);
                }    
            }
            $stmt->execute();
        }
    }
    // rename("all.json" , "all_seen.json");
?>
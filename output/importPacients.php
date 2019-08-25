<?php
    error_reporting(0);
    $conn = new PDO("mysql:host=localhost;dbname=x28crvnc_formular", 'x28crvnc_form', 'nG3_w_vxWR@a');
    // $conn = new PDO("mysql:host=localhost;dbname=formular", 'root', '');
    // copy($_FILES['jsonFile']['tmp_name'], 'jsonFiles/'.$_FILES['jsonFile']['name']);
    $data = file_get_contents("all.json");
    $patients = json_decode($data);

    foreach ($patients as $patient) {
        $stmt = $conn->prepare('insert into formular(name, asigurat, varsta, datanasterii, phone, sex, Adresa, Localitate, Judet, Talie, Greutate, Circumferinta_abdominala, Circumferinta_soldurilor, Tensiunea_arteriala_ortostatism, Tensiunea_arteriala_clinostatism, acuze, Antecedente_heredo_colaterale, antecedente_fiziologice, Antecedente_personale_fiziologice, numar_nasteri, numar_sarcini, numar_avorturi, antecedente_patologice, tip_dz, grad_hta, antecedente_personale_patologice, medicatia_curenta, loc_munca, fumator, alcool, pachete_an, an_nefumator, mese_zi, legume, fructe, lactate, fainoase, proteine, ml_alcool, alcool_zi, suplimente, tegumente_mucoase_fanere, observatii_tegumente, tesut_conjuctiv_adipos, observatii_tesut, sistem_ganglionar, observatii_ganglionar, muscular_osteo_articular, observatii_muscular, aparat_respirator, observatii_aparat_respirator, aparat_cardiovascular, observatii_cardiovascular, abdomen, observatii_abdomen, ficat_bila_splina, observatii_ficat, aparat_genito_urinar, observatii_genito_urinar, sistem_nervos, observatii_sistem_nervos, organe_de_simt, observatii_organe_de_simt, tiroida, observatii_tiroida, consultari_suplimentare, alte_consulturi, diagnostice, recomandari, doctor, status, diagnostice_vechi, diagnostice_noi, observatii_diagnostice_noi, observatii_diagnostice_vechi, bilant_clinic) 
        values(:name, :asigurat, :varsta, :datanasterii, :phone, :sex, :Adresa, :Localitate, :Judet, :Talie, :Greutate, :Circumferinta_abdominala, :Circumferinta_soldurilor, :Tensiunea_arteriala_ortostatism, :Tensiunea_arteriala_clinostatism, :acuze, :Antecedente_heredo_colaterale, :antecedente_fiziologice, :Antecedente_personale_fiziologice, :numar_nasteri, :numar_sarcini, :numar_avorturi, :antecedente_patologice, :tip_dz, :grad_hta, :antecedente_personale_patologice, :medicatia_curenta, :loc_munca, :fumator, :alcool, :pachete_an, :an_nefumator, :mese_zi, :legume, :fructe, :lactate, :fainoase, :proteine, :ml_alcool, :alcool_zi, :suplimente, :tegumente_mucoase_fanere, :observatii_tegumente, :tesut_conjuctiv_adipos, :observatii_tesut, :sistem_ganglionar, :observatii_ganglionar, :muscular_osteo_articular, :observatii_muscular, :aparat_respirator, :observatii_aparat_respirator, :aparat_cardiovascular, :observatii_cardiovascular, :abdomen, :observatii_abdomen, :ficat_bila_splina, :observatii_ficat, :aparat_genito_urinar, :observatii_genito_urinar, :sistem_nervos, :observatii_sistem_nervos, :organe_de_simt, :observatii_organe_de_simt, :tiroida, :observatii_tiroida, :consultari_suplimentare, :alte_consulturi, :diagnostice, :recomandari, :doctor, :status, :diagnostice_vechi, :diagnostice_noi, :observatii_diagnostice_noi, :observatii_diagnostice_vechi, :bilant_clinic)');
        
        $sql = 'SELECT name FROM formular WHERE name = :name';
        $check = $conn->prepare($sql);
        $check->bindValue(':name',$patient->name);
        $check->execute();

        if($row = $check->fetch(PDO::FETCH_ASSOC)) {
            print_r ($patient->name . " <-Patient introdus deja<br>");
        } elseif (strlen($patient->name) > 3) {
            print_r ($patient->name . "<-Pacient Nou  <br>");
            $stmt->bindValue('name', $patient->name);
            $stmt->bindValue('asigurat', $patient->asigurat);
            $stmt->bindValue('varsta', $patient->varsta);
            $stmt->bindValue('datanasterii', $patient->datanasterii);
            $stmt->bindValue('phone', $patient->phone);
            $stmt->bindValue('sex', $patient->sex);
            $stmt->bindValue('Adresa', $patient->Adresa);
            $stmt->bindValue('Localitate', $patient->Localitate);
            $stmt->bindValue('Judet', $patient->Judet);
            $stmt->bindValue('Talie', $patient->Talie);
            $stmt->bindValue('Greutate', $patient->Greutate);
            $stmt->bindValue('Circumferinta_abdominala', $patient->Circumferinta_abdominala);
            $stmt->bindValue('Circumferinta_soldurilor', $patient->Circumferinta_soldurilor);
            $stmt->bindValue('Tensiunea_arteriala_ortostatism', $patient->Tensiunea_arteriala_ortostatism);
            $stmt->bindValue('Tensiunea_arteriala_clinostatism', $patient->Tensiunea_arteriala_clinostatism);
            $stmt->bindValue('acuze', $patient->acuze);
            $stmt->bindValue('Antecedente_heredo_colaterale', $patient->Antecedente_heredo_colaterale);
            $stmt->bindValue('antecedente_fiziologice', $patient->antecedente_fiziologice);
            $stmt->bindValue('Antecedente_personale_fiziologice', $patient->Antecedente_personale_fiziologice);
            $stmt->bindValue('numar_nasteri', $patient->numar_nasteri);
            $stmt->bindValue('numar_sarcini', $patient->numar_sarcini);
            $stmt->bindValue('numar_avorturi', $patient->numar_avorturi);
            $stmt->bindValue('antecedente_patologice', implode(", ",$patient->antecedente_patologice));
            $stmt->bindValue('tip_dz', $patient->tip_dz);
            $stmt->bindValue('grad_hta', $patient->grad_hta);
            $stmt->bindValue('antecedente_personale_patologice', $patient->antecedente_personale_patologice);
            $stmt->bindValue('medicatia_curenta', $patient->medicatia_curenta);
            $stmt->bindValue('loc_munca', $patient->loc_munca);
            $stmt->bindValue('fumator', $patient->fumator);
            $stmt->bindValue('alcool', $patient->alcool);
            $stmt->bindValue('pachete_an', $patient->pachete_an);
            $stmt->bindValue('an_nefumator', $patient->an_nefumator);
            $stmt->bindValue('mese_zi', $patient->mese_zi);
            $stmt->bindValue('legume', $patient->legume);
            $stmt->bindValue('fructe', $patient->fructe);
            $stmt->bindValue('lactate', $patient->lactate);
            $stmt->bindValue('fainoase', $patient->fainoase);
            $stmt->bindValue('proteine', $patient->proteine);
            $stmt->bindValue('ml_alcool', $patient->ml_alcool);
            $stmt->bindValue('alcool_zi', $patient->alcool_zi);
            $stmt->bindValue('suplimente', $patient->suplimente);
            $stmt->bindValue('tegumente_mucoase_fanere', implode(", ",$patient->tegumente_mucoase_fanere));
            $stmt->bindValue('observatii_tegumente', $patient->observatii_tegumente);
            $stmt->bindValue('tesut_conjuctiv_adipos', implode(", ",$patient->tesut_conjuctiv_adipos));
            $stmt->bindValue('observatii_tesut', $patient->observatii_tesut);
            $stmt->bindValue('sistem_ganglionar', implode(", ",$patient->sistem_ganglionar));
            $stmt->bindValue('observatii_ganglionar', $patient->observatii_ganglionar);
            $stmt->bindValue('muscular_osteo_articular', implode(", ",$patient->muscular_osteo_articular));
            $stmt->bindValue('observatii_muscular', $patient->observatii_muscular);
            $stmt->bindValue('aparat_respirator', implode(", ",$patient->aparat_respirator));
            $stmt->bindValue('observatii_aparat_respirator', $patient->observatii_aparat_respirator);
            $stmt->bindValue('aparat_cardiovascular', implode(", ",$patient->aparat_cardiovascular));
            $stmt->bindValue('observatii_cardiovascular', $patient->observatii_cardiovascular);
            $stmt->bindValue('abdomen', implode(", ",$patient->abdomen));
            $stmt->bindValue('observatii_abdomen', $patient->observatii_abdomen);
            $stmt->bindValue('ficat_bila_splina', implode(", ",$patient->ficat_bila_splina));
            $stmt->bindValue('observatii_ficat', $patient->observatii_ficat);
            $stmt->bindValue('aparat_genito_urinar', implode(", ",$patient->aparat_genito_urinar));
            $stmt->bindValue('observatii_genito_urinar', $patient->observatii_genito_urinar);
            $stmt->bindValue('sistem_nervos', implode(", ",$patient->sistem_nervos));
            $stmt->bindValue('observatii_sistem_nervos', $patient->observatii_sistem_nervos);
            $stmt->bindValue('organe_de_simt', implode(", ",$patient->organe_de_simt));
            $stmt->bindValue('observatii_organe_de_simt', $patient->observatii_organe_de_simt);
            $stmt->bindValue('tiroida', implode(", ",$patient->tiroida));
            $stmt->bindValue('observatii_tiroida', $patient->observatii_tiroida);
            $stmt->bindValue('consultari_suplimentare', implode(", ",$patient->consultari_suplimentare));
            $stmt->bindValue('alte_consulturi', $patient->alte_consulturi);
            $stmt->bindValue('diagnostice', $patient->diagnostice);
            $stmt->bindValue('recomandari', $patient->recomandari);
            $stmt->bindValue('doctor', $patient->doctor);
            $stmt->bindValue('status', $patient->status);
            $stmt->bindValue('diagnostice_vechi', implode(", ",$patient->diagnostice_vechi));
            $stmt->bindValue('diagnostice_noi', implode(", ",$patient->diagnostice_noi));
            $stmt->bindValue('observatii_diagnostice_noi', $patient->observatii_diagnostice_noi);
            $stmt->bindValue('observatii_diagnostice_vechi', $patient->observatii_diagnostice_vechi);
            $stmt->bindValue('bilant_clinic', $patient->bilant_clinic);
            $stmt->execute();
        }
    }
    // rename("all.json" , "all_seen.json");
?>
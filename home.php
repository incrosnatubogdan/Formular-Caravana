<?php
    header("Content-type: text/css; charset: UTF-8");
    $page = file_get_contents("print.json");
    $character = json_decode($page);
    $array = json_decode($page,true);

    $diagvechi = "diagvechi";
    $diagvechi = implode("<br>",$array[$diagvechi]);
    $diagvechi = str_replace('_', ' ', $diagvechi);

    $diagnoi = "diagnoi";
    $diagnoi = implode("<br>",$array[$diagnoi]);
    $diagnoi = str_replace('_', ' ', $diagnoi);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- <link href="styles.php" rel="stylesheet"> -->
<link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet">
<link href="styles.css" rel="stylesheet">
</head>
<img class="logo" src="logo.png">
<h1>Scrisoare Medicala</h1>

<p>Stimate(ă) coleg, vă informăm că $character->name, născut(ă) la data de $character->datanasterii, a fost consultat(ă) la data de $character->current_date  în cadrul proiectului Caravana cu Medici.</p>
<h3>Diagnostice vechi</h3>
$diagvechi
<br>
$character->obs_diagvechi
<h3>Diagnostice noi</h3>
$diagnoi
<br>
$character->obs_diagnoi
<h3>Tratament si recomandari:</h3>
$character->recomandari
<p>Menționăm că:</p>
<ol>
    <li>Nu s-a eliberat prescripție medicală.</li>
    <li>Nu s-a eliberat concediu medical la externare.</li>
    <li>Nu s-a eliberat recomandare pentru îngrijiri medicale la domiciliu/paliative la domiciliu,
    deoarece nu a fost necesar.</li>
    <li>Nu s-a eliberat prescripție medicală pentru dispozitive medicale în ambulatoriu deoarece
    nu a fost necesar.</li>
</ol>
<div class="flex">
    <p class="date">Data: <br> $character->current_date</p>
    <p class="signature">Semnătura și parafa medicului</p>
</div>
<p>Calea de transmitere: prin asigurat</p>
</body>
</html>
<?php
//index.php
//include autoloader

require_once 'autoload.inc.php';

use Dompdf\Dompdf;

//$document->loadHtml($html);
$page = file_get_contents("print.json");
$character = json_decode($page);
$array = json_decode($page,true);

$diagvechi = "diagvechi";
$diagvechi = implode("<br>",$array[$diagvechi]);
$diagvechi = str_replace('_', ' ', $diagvechi);

$diagnoi = "diagnoi";
$diagnoi = implode("<br>",$array[$diagnoi]);
$diagnoi = str_replace('_', ' ', $diagnoi);
$html = <<<STY
<!DOCTYPE html>
<html lang="ro">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<style>
* {
    font-family: 'DejaVu Sans', sans-serif;
}
table {
    border: 2px solid #ed1c40;
    border-radius: .25rem;
    min-width: 100vw;
}
th {
    background: #ed1c40;
    color: white;
}
th,
td {
    margin: 2px 4px;
    text-align: center;
}
tr {
    min-width: 100vw;
}
h1 {
    text-align: center;
}
img.logo {
    position: absolute;
    top: -20px;
    right: 140px;
}
.flex {
    width: 100%;
    display: inline-block;
    vertical-align: top;
}
.flex .date {
    width: 44%;
    text-align: left;
    display: inline-block;
    vertical-align: top;
}
.flex .signature {
    width: 44%;
    text-align: right;
    display: inline-block;
    vertical-align: top;
}
</style>
</head>
<img class="logo" src="logo.png" style="font-family: 'DejaVu Sans', sans-serif;position: absolute;top: -20px;right: 140px;">
<h1 style="font-family: 'DejaVu Sans', sans-serif;text-align: center;">Scrisoare Medicala</h1>

<p style="font-family: 'DejaVu Sans', sans-serif;">Stimate(ă) coleg, vă informăm că $character->name, născut(ă) la data de $character->datanasterii, a fost consultat(ă) la data de $character->current_date  în cadrul proiectului Caravana cu Medici.</p>
<h3 style="font-family: 'DejaVu Sans', sans-serif;">Diagnostice vechi</h3>
$diagvechi
<br style="font-family: 'DejaVu Sans', sans-serif;">
$character->obs_diagvechi
<h3 style="font-family: 'DejaVu Sans', sans-serif;">Diagnostice noi</h3>
$diagnoi
<br style="font-family: 'DejaVu Sans', sans-serif;">
$character->obs_diagnoi
<h3 style="font-family: 'DejaVu Sans', sans-serif;">Tratament si recomandari:</h3>
$character->recomandari
<p style="font-family: 'DejaVu Sans', sans-serif;">Menționăm că:</p>
<ol style="font-family: 'DejaVu Sans', sans-serif;">
    <li style="font-family: 'DejaVu Sans', sans-serif;">Nu s-a eliberat prescripție medicală.</li>
    <li style="font-family: 'DejaVu Sans', sans-serif;">Nu s-a eliberat concediu medical la externare.</li>
    <li style="font-family: 'DejaVu Sans', sans-serif;">Nu s-a eliberat recomandare pentru îngrijiri medicale la domiciliu/paliative la domiciliu,
    deoarece nu a fost necesar.</li>
    <li style="font-family: 'DejaVu Sans', sans-serif;">Nu s-a eliberat prescripție medicală pentru dispozitive medicale în ambulatoriu deoarece
    nu a fost necesar.</li>
</ol>
<div class="flex" style="font-family: 'DejaVu Sans', sans-serif;width: 100%;display: inline-block;vertical-align: top;">
    <p class="date" style="font-family: 'DejaVu Sans', sans-serif;width: 44%;text-align: left;display: inline-block;vertical-align: top;">Data: <br style="font-family: 'DejaVu Sans', sans-serif;"> $character->current_date</p>
    <p class="signature" style="font-family: 'DejaVu Sans', sans-serif;width: 44%;text-align: right;display: inline-block;vertical-align: top;">Semnătura și parafa medicului</p>
</div>
<p style="font-family: 'DejaVu Sans', sans-serif;">Calea de transmitere: prin asigurat</p>

</body>
</html>
STY;
// $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
$document = new Dompdf();
$document->loadHtml($html);
$document->setPaper('A4', 'portrait');

$document->render();

$document->stream("Webslesson", array("Attachment"=>0));
?>

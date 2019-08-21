<?php
//index.php
//include autoloader
require_once 'autoload.inc.php';

use Dompdf\Dompdf;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

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
<title>Scrisoare MedicalaM</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style type="text/css" media="all">
@font-face {
    font-family: Montserrat;
    src: url(fonts/Montserrat.ttf)
}

*:before, *:after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body,
html {
    width: 100%;
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
<body>
<img class="logo" src="logo.png" style="position: absolute;top: -20px;right: 140px;">
<h1 style="font-family: 'DejaVu Sans', sans-serif;text-align: center;">Scrisoare Medicala</h1>

<p style="margin:top:20px;font-family: 'DejaVu Sans', sans-serif;">Stimate(ă) coleg, vă informăm că $character->name, născut(ă) la data de $character->datanasterii, a fost consultat(ă) la data de $character->current_date  în cadrul proiectului Caravana cu Medici.</p>
<h3 style="font-family: 'DejaVu Sans', sans-serif;">Diagnostice vechi</h3>
<p>$diagvechi</p>
<br>
<p>$character->obs_diagvechi</p>
<h3 style="font-family: 'DejaVu Sans', sans-serif;">Diagnostice noi</h3>
<p>$diagnoi</p>
<br>
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
    <p class="date" style="font-family: 'DejaVu Sans', sans-serif;width: 44%;text-align: left;display: inline-block;vertical-align: top;">Data: <br> $character->current_date</p>
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

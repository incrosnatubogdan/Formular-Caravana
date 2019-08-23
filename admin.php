<?php
require_once('protect.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fisa de urmarire a pacientului CCM</title>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css" />
    <script src="assets/js/main.js"></script>
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?p=login" method="post">
<label><input type="text" name="user" id="user" /> Name</label><br />
<label><input type="password" name="keypass" id="keypass" /> Password</label><br />
<input type="submit" id="submit" value="Login" />
</form>
    <br />
    "<div class='text-success'><p>Fisa a fost salvata</p></div>
    <iframe name="votar" style="display:none;"></iframe>
    <div class="menu">
        <a class="analize">Toate analizele</a>
        <img src="assets/logo.png">
    </div>
    <div id="toate-analizele" class="overlay">
        <div class="popup">
            <a class="close close-joker">X</a>
            <div class="table">

            </div>
        </div>
    </div>
    <div class="container" style="width:100%;">
        <h3>Fisa de urmarire a pacientului CCM</h3><br />
        <form id="medical_form" method="post" target="votar">
            <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>
            <br />
            <label>Name</label>
            <input id="name" type="text" name="name" class="form-control" /><br />
            <label>Gender</label>
            <select name="gender">
                <option value="Masculin">M</option>
                <option value="Feminin">F</option>
                <option value="Altele">Altul</option>
            </select><br />
            <select id="antecedente-fiziologice" name="antecedente-fiziologice[]" multiple="multiple">
                <option value="N">N</option>
                <option value="S">S</option>
                <option value="A">A</option>
            </select><br />
            <textarea type="text" placeholder="Altele" name="Antecedente-personale-fiziologice"
                class="form-control"></textarea><br />
            <label>Antecedente personale PATOLOGICE</label>
            <label>Fumător:</label>
            <select name="fumator">
                <option value="Da-prezent">Da(prezent)</option>
                <option value="Da-trecut">Da(trecut)</option>
                <option value="Nu">Nu</option>
            </select><br />
            <h2>Chestionar alimentar:</h2>
            <label>Nr. de mese/zi</label>
            <input type="text" name="mese-zi" class="form-control" /><br />
            <div class="col-sm-12 col-md-6 equal-height">
                <label>Porții de legume (bifati)</label><br />
                <input type="radio" name="legume" value=3/zi>3/zi <br>
                <input type="radio" name="legume" value="1/zi">1/zi<br>
                <input type="radio" name="legume" value="3/sapt">3/sapt<br>
                <input type="radio" name="legume" value="<3/sapt">
                < 3/sapt <br />
                <label>Porții de fructe (bifati)</label><br />
                <input type="radio" name="fructe" value=3/zi>3/zi <br>
                <input type="radio" name="fructe" value="1/zi">1/zi<br>
                <input type="radio" name="fructe" value="3/sapt">3/sapt<br>
                <input type="radio" name="fructe" value="<3/sapt">
                < 3/sapt <br />
            </div>
            <input type="submit" name="submit" class="btn btn-info submit-button" /><br />
            <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                     ?>
        </form>
    </div>
    <br />
</body>
</html>
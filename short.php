<?php  
error_reporting(0);
 $message = '';  
 $error = '';  
 $directory = dir("./");

 $allowed_ext = array(".json"); 
 
 $do_link = TRUE; 
 $sort_what = 0; //0- by name; 1 - by size; 2 - by date
 $sort_how = 0; //0 - ASCENDING; 1 - DESCENDING
 
 
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
 echo "<table class='analize-table' border=1>"; 
 for ($i=0;$i<$i2;$i++) { 
     if (!$do_link) { 
         $line = "<tr><td align=left>" .  
                         $new_array[$i][0] .  
                         "</td></tr>"; 
     }else{ 
         $line = '<tr><td class="pacient" align=left>' .  
                         $new_array[$i][0] .  
                         "</td></tr>"; 
     } 
     echo $line; 
 } 
 echo "</table>"; 

 if(isset($_POST["submit"]) || isset($_POST["fakeSubmit"]))  
 {
      fopen($_POST['name'] . ".json", "w"); 
      if(empty($_POST["name"]))  
      {  
           $error = "<label class='text-danger'>Enter Name</label>";    
      }  
      else if(empty($_POST["gender"]))  
      {  
           $error = "<label class='text-danger'>Enter Gender</label>";  
      }   
      else  
      {  
          
           if(file_exists($_POST['name'] . ".json"))  
           {  
                $current_data = file_get_contents($_POST['name'] . ".json");  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'name' => $_POST['name'],  
                     'gender' => $_POST["gender"],
                     'antecedente-fiziologice' => $_POST['antecedente-fiziologice'],
                     'Antecedente-personale-fiziologice' => $_POST['Antecedente-personale-fiziologice'],
                     'fumator' => $_POST['fumator'],
                     'mese-zi' => $_POST['mese-zi'],
                     'legume' => $_POST['legume'],
                     'fructe' => $_POST['fructe']
                );  
                $array_data = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents($_POST['name'] . ".json", $final_data))  
                {  
                     $message = "<div class='text-success'><p>Fisa a fost salvata</p></div>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exists';  
           }  
      }  
 }  
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
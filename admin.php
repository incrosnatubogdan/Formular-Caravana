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
 ?>
<!DOCTYPE html>
<html>

<head>
    <title>Fisa de urmarire a pacientului CCM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="assets/css/styles.css?v=2.2" />
    <link rel="stylesheet" href="assets/css/select2.css" />

    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/main.js"></script>
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
        <h3 class="doc_title">Zona de administrare</h3>
        <img class="bottom" src="assets/down.png">
    </div>
    
</body>


</html>
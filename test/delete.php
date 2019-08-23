<?php
    $fileid = $_GET['fileid'];
    //HERE IS THE LOGIC TO FIND THE PATH OF YOUR FILE
    unlink($fileid); //You can add more validations or full paths
?>
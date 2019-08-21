<?php

    if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
        $params = array('firstname' => $_POST['firstname'], 'lastname' => $_POST['lastname']);
        $jsonInitial = json_encode($params);
        $json = file_get_contents('my_json_data.json');
        if(empty($json)){
            $jsonObject = json_encode(array('username' => $jsonObject));
            file_put_contents('my_json_data.json', $jsonObject);
        }else{
            $json = json_decode($json, true);
            $newJson = $json['username'][0] . "," . $jsonInitial;
            $jsonObject = json_encode(array('username' => $newJson));
            file_put_contents('my_json_data.json', $jsonObject);
        }
    }
    else {
        echo "Noooooooob";
    }

?>
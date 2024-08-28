<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../../config/config.php";


$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];


    $res = $config->insertDepartment($name);

    if ($res) {
        $arr['data'] = "Department Inserted Successfully...";
        http_response_code(201);
    } else {
        $arr['data'] = "Department Insertion Failed...";
    }
} else {
    $arr['err'] = "Only for POST HTTP Request Method is allowed....";
}

echo json_encode($arr);


?>
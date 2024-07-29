<?php


header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../config/config.php";


$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];


    $res = $config->insertStudent($name, $age, $course);

    if ($res) {
        $arr['data'] = "Record Inserted Successfully...";
        http_response_code(201);
    } else {
        $arr['data'] = "Record Insertion Failed...";
    }
} else {
    $arr['err'] = "Only for POST HTTP Request Method is allowed....";
}

echo json_encode($arr);


?>
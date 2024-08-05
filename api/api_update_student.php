<?php

header("Access-Control-Allow-Methods: PUT,PATCH");
header("Content-Type: application/json");

include "../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'PATCH') {

    $result = file_get_contents("php://input");
    parse_str($result, $_UPDATE);

    $name = $_UPDATE['name'];
    $age = $_UPDATE['age'];
    $course = $_UPDATE['course'];
    $id = $_UPDATE['id'];

    $res = $config->updateStudent($name, $age, $course, $id);

    if ($res) {
        $arr['data'] = "Record Updated Successfully...";
    } else {
        $arr['data'] = "Record Updation Failed...";
    }

} else {
    $arr['err'] = "Only for PUT or PATCH HTTP Request Methods are allowed...";
}

echo json_encode($arr);
?>
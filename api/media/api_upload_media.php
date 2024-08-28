<?php


header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../../config/config.php";


$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $file_name = $_FILES['fname']['name'];
    $tmp_path = $_FILES['fname']['tmp_name'];

    $id = uniqid("rnw");

    $uniq_file_name = $id . $file_name;

    $des = "../../upload/" . $uniq_file_name;

    $isUplodedFile = move_uploaded_file($tmp_path, $des);

    if ($isUplodedFile) {
        $res = $config->insertMedia($uniq_file_name);

        if ($res) {
            $arr['data'] = "File Inserted Successfully...";
            http_response_code(201);
        } else {
            $arr['data'] = "File Insertion Failed...";
        }
    } else {
        $arr['data'] = "File Insertion Failed...";
    }
} else {
    $arr['err'] = "Only for POST HTTP Request Method is allowed....";
}

echo json_encode($arr);


?>
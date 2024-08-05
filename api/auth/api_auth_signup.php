<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $res = $config->singUp($name, $email, $password);

    if ($res) {
        $arr['data'] = "User Registered Successfully...";
    } else {
        $arr['data'] = "User Registation Failed...";
    }

} else {
    $arr['err'] = "Only for POST HTTP Request method is allow...";
}

echo json_encode($arr);
?>
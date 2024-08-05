<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $res = $config->signIn($email, $password);

    if ($res) {
        $arr['data'] = "User Sign In Successfully...";
    } else {
        $arr['data'] = "User Sign In Failed...";
    }

} else {
    $arr['err'] = "Only for POST HTTP Request method is allow...";
}

echo json_encode($arr);
?>
<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST['id'];
    $result = $config->fetchSingleStudent($id);

    $data = mysqli_fetch_assoc($result);

    $array['data'] = $data;

} else {
    $array['err'] = "Only for POST HTTP Method is allowed...";
}

echo json_encode($array);

?>
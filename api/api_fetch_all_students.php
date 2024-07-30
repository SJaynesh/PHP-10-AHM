<?php

header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include "../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $res = $config->fetchAllStudents();

    $all_result = [];

    while ($result = mysqli_fetch_assoc($res)) {

        // array_push(array, element);
        array_push($all_result, $result);
    }

    $array['data'] = $all_result;

} else {
    $array['err'] = "Only for GET HTTP Method is allowed...";
}

echo json_encode($array);

?>
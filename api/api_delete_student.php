<?php

header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json");

include "../config/config.php";

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {

    $result = file_get_contents('php://input');  // return String  "id : 18"

    parse_str($result, $_DELETE);

    $id = $_DELETE['id'];

    $res = $config->deleteStudent($id);

    if ($res) {
        $array['data'] = "Record deleted successfully...";

    } else {
        $array['data'] = "Record deletion faield...";
    }

} else {
    $array['err'] = "Only for DELETE HTTP Request Method is allowed...";
}


echo json_encode($array);
?>
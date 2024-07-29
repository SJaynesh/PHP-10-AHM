<?php

// Assoiative Array
// $array = ["name" => "Karan", "age" => 25, "course" => "PHP"];


// $array['id'] = 101;
// $array['name'] = "Raj";
// $array['age'] = 22;
// $array['course'] = "Flutter";

// $array = array("id" => 560, "name" => "Param", "course" => "Flutter");

// print_r($array);

// echo "<hr>";

// var_dump($array);

echo "<h4> 1D Array </h4>";
$arr = [10, 20, 30, 40, 50];

foreach ($arr as $n) {
    echo $n . " ";
}
echo "<h4> Assoiative Array </h4>";

$array = array("id" => 101, "name" => "Jaynesh", "age" => 19, "course" => "Flutter");

$array['location'] = "surat";

foreach ($array as $key => $val) {
    echo $key . " : " . $val . "<br/>";
}

?>
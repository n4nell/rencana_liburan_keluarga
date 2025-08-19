<?php

header('Content-Type: application/json');

include('helper.php');  

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    include("../../connect.php");

    $read = $connect->query("SELECT * FROM liburan");
    $result = $read->fetch_all(MYSQLI_ASSOC);

    $array_api = response_json(200, 'berhasil mengambil data liburan', $result);
}
else {
    $array_api = response_json(405, 'metode tidak diizinkan.');
} 

echo json_encode($array_api);

?>
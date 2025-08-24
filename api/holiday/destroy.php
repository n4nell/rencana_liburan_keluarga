<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include('helper.php');
include("../../connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];

        $search_id = $connect->query("SELECT * FROM liburan WHERE id='$id'");
        $user = $search_id->fetch_assoc();

        if ($user != NULL) {
            $delete = $connect->query("DELETE FROM liburan WHERE id='$id'");
            $array_api = response_json(200, 'Berhasil menghapus data liburan');
        } else {
            $array_api = response_json(404, 'Gagal menghapus data liburan, liburan tidak ditemukan.');
        }
    } else {
        $array_api = response_json(400, 'Gagal menghapus data liburan, id tidak boleh kosong.');
    }
} else {
    $array_api = response_json(405, 'Metode tidak diizinkan.');
}

echo json_encode($array_api);
?>
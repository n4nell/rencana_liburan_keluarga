<?php

header('Content-Type: application/json');

include('helper.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    include("../../connect.php");

    if (isset($_GET['id'])) {

        if ($_GET['id'] != "") {
            $id = $_GET['id'];

            $search_id = $connect->query("SELECT * FROM liburan WHERE id='$id'");
            $user = $search_id->fetch_assoc();

            if ($user != NULL) {
                $delete = $connect->query("DELETE FROM liburan WHERE id='$id'");

                $array_api = response_json(200, 'berhasil menghapus data liburan');
            } else {
                $array_api = response_json(404, 'gagal menghapus data liburan, liburan tidak ditemukan.');
            }
        } else {
            $array_api = response_json(400, 'gagal menghapus data liburan, id tidak boleh kosong.');
        }
    } else {
        $array_api = response_json(400, 'gagal menghapus data liburan, id belum dimasukkan.');
    }
} else {
    $array_api = response_json(405, 'metode tidak diizinkan.');
}

echo json_encode($array_api);

?>
<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

include('helper.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include("../../connect.php");

    if (isset($_GET['id'])) {

        if ($_GET['id'] != "") {
            $id = $_GET['id'];

            $search_id = $connect->query("SELECT * FROM liburan WHERE id='$id'");
            $user = $search_id->fetch_assoc();

            if ($user != NULL) {
                $form_data = json_decode(file_get_contents("php://input"));
        
                if ($form_data->keluarga != "" && $form_data->tujuan != "" && $form_data->kota != "" && $form_data->transportasi != "") {
                    $keluarga = $form_data->keluarga;
                    $tujuan = $form_data->tujuan;
                    $kota = $form_data->kota;
                    $transportasi = $form_data->transportasi;

                    $update = $connect->query("UPDATE liburan SET keluarga = '$keluarga', tujuan = '$tujuan', kota = '$kota', transportasi = '$transportasi' WHERE id = '$id'");

                    $array_api = response_json(200, 'berhasil mengupdate data liburan');
                }
                else {
                    $array_api = response_json(400, 'gagal mengupdate data liburan, formulir tidak lengkap.');
                }
            } else {
                $array_api = response_json(404, 'gagal mengupdate data liburan, liburan tidak ditemukan.');
            }
        } else {
            $array_api = response_json(400, 'gagal mengupdate data liburan, id tidak boleh kosong.');
        }
    } else {
        $array_api = response_json(400, 'gagal mengupdate data liburan, id belum dimasukkan.');
    }
} else {
    $array_api = response_json(405, 'metode tidak diizinkan.');
}

echo json_encode($array_api);

?>
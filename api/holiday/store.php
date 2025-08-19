<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include('helper.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../../connect.php");

    $form_data = json_decode(file_get_contents("php://input"));
    if ($form_data != NULL) {
        if ($form_data->keluarga != "" && $form_data->tujuan != "" && $form_data->kota != "" && $form_data->transportasi != "") {
            $keluarga = $form_data->keluarga;
            $tujuan = $form_data->tujuan;
            $kota = $form_data->kota;            
            $transportasi = $form_data->transportasi;

            $store = $connect->query("INSERT INTO liburan (keluarga, tujuan, kota, transportasi) VALUES ('$keluarga', '$tujuan', '$kota', '$transportasi')");

            $array_api = response_json(200, 'berhasil menambah data liburan');
        } else {
            $array_api = response_json(400, 'gagal menambah data liburan, data tidak lengkap.');
        }
    } else {
        $array_api = response_json(400, 'gagal menambah data liburan, data tidak boleh kosong.');
    }
} else {
    $array_api = response_json(405, 'metode tidak diizinkan.');
}

echo json_encode($array_api);
?>
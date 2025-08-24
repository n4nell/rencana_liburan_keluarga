<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include('helper.php'); 
include("../../connect.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $form_data = json_decode(file_get_contents("php://input"));
    
    if ($form_data != NULL) {
        if (!empty($form_data->keluarga) && !empty($form_data->tujuan) && !empty($form_data->kota) && !empty($form_data->transportasi)) {
            
            $keluarga = $form_data->keluarga;
            $tujuan = $form_data->tujuan;
            $kota = $form_data->kota;            
            $transportasi = $form_data->transportasi;

            $store = $connect->query("INSERT INTO liburan (keluarga, tujuan, kota, transportasi) VALUES ('$keluarga', '$tujuan', '$kota', '$transportasi')");

            if($store){
                $array_api = response_json(200, 'Berhasil menambah data holiday');
            } else {
                $array_api = response_json(500, 'Gagal menambah data holiday: ' . $connect->error);
            }

        } else {
            $array_api = response_json(400, 'Gagal menambah data holiday, data tidak lengkap.');
        }

    } else {
        $array_api = response_json(400, 'Gagal menambah data holiday, data tidak boleh kosong.');
    }

} else {
    $array_api = response_json(405, 'Metode tidak diizinkan.');
}

echo json_encode($array_api);
?>
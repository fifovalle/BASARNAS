<?php
include 'databases.php';

$garjasSitUp2WanitaModel = new GarjasWanitaSitUp2($koneksi);
$garjasWanitaSitUp2ID = isset($_GET['garjas_wanita_situp2_id']) ? $_GET['garjas_wanita_situp2_id'] : null;

if ($garjasWanitaSitUp2ID) {
    $dataGarjasWanitaSitUp2 = $garjasSitUp2WanitaModel->tampilkanDataGarjasWanitaSitUp2();

    if ($dataGarjasWanitaSitUp2) {
        $dataFound = false;
        foreach ($dataGarjasWanitaSitUp2 as $data) {
            if ($data['ID_Wanita_Sit_Up_Kaki_Di_Tekuk'] == $garjasWanitaSitUp2ID) {
                $dataFound = true;
                echo json_encode($data);
                break;
            }
        }
        // Jika data tidak ditemukan
        if (!$dataFound) {
            echo json_encode(array("success" => false, "message" => "Garjas Wanita Sit Up Kaki Di Tekuk dengan ID tersebut tidak ditemukan."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Data Garjas Wanita Sit Up Kaki Di Tekuk tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Garjas Wanita Sit Up Kaki Di Tekuk tidak diberikan."));
}

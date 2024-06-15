<?php
include 'databases.php';

$garjasSitUp1WanitaModel = new GarjasWanitaSitUp1($koneksi);
$garjasWanitaSitUpID = isset($_GET['garjas_wanita_situp1_id']) ? $_GET['garjas_wanita_situp1_id'] : null;

if ($garjasWanitaSitUpID) {
    $dataGarjasWanitaSitUp1 = $garjasSitUp1WanitaModel->tampilkanDataGarjasWanitaSitUp1();

    if ($dataGarjasWanitaSitUp1) {
        $dataFound = false;
        foreach ($dataGarjasWanitaSitUp1 as $data) {
            if ($data['ID_Wanita_Sit_Up_Kaki_Lurus'] == $garjasWanitaSitUpID) {
                $dataFound = true;
                echo json_encode($data);
                break;
            }
        }
        // Jika data tidak ditemukan
        if (!$dataFound) {
            echo json_encode(array("success" => false, "message" => "Garjas Wanita Sit Up Kaki Lurus dengan ID tersebut tidak ditemukan."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Data Garjas Wanita Sit Up Kaki Lurus tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Garjas Wanita Sit Up Kaki Lurus tidak diberikan."));
}

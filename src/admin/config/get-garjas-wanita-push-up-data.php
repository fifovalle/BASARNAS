<?php
include 'databases.php';

$garjasPushUpWanitaModel = new GarjasWanitaSitUp1($koneksi);
$garjasWanitaPushUpID = isset($_GET['garjas_wanita_situp1_id']) ? $_GET['garjas_wanita_situp1_id'] : null;

if ($garjasWanitaPushUpID) {
    $dataGarjasWanitaPushUp = $garjasPushUpWanitaModel->tampilkanDataGarjasWanitaSitUp1();

    if ($dataGarjasWanitaPushUp) {
        $dataFound = false;
        foreach ($dataGarjasWanitaPushUp as $data) {
            if ($data['ID_Wanita_Push_Up'] == $garjasWanitaPushUpID) {
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

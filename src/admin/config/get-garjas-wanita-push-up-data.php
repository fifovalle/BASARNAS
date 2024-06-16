<?php
include 'databases.php';

$garjasPushUpWanitaModel = new GarjasWanitaPushUp($koneksi);
$garjasWanitaPushUpID = isset($_GET['garjas_wanita_push_up_id']) ? $_GET['garjas_wanita_push_up_id'] : null;

if ($garjasWanitaPushUpID) {
    $dataGarjasWanitaPushUp = $garjasPushUpWanitaModel->tampilkanDataGarjasWanitaPushUp();

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
            echo json_encode(array("success" => false, "message" => "Garjas Wanita Push Up dengan ID tersebut tidak ditemukan."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Data Garjas Wanita Push Up tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Garjas Wanita Push Up tidak diberikan."));
}

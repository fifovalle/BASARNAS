<?php
include 'databases.php';

$garjasChinUpWanitaModel = new GarjasWanitaChinUp($koneksi);
$garjasWanitaChinUpID = isset($_GET['garjas_wanita_chinup_id']) ? $_GET['garjas_wanita_chinup_id'] : null;

if ($garjasWanitaChinUpID) {
    $dataGarjasWanitaChinUp = $garjasChinUpWanitaModel->tampilkanDataGarjasWanitaChinUp();

    if ($dataGarjasWanitaChinUp) {
        $dataFound = false;
        foreach ($dataGarjasWanitaChinUp as $data) {
            if ($data['ID_Wanita_Chin_Up'] == $garjasWanitaChinUpID) {
                $dataFound = true;
                echo json_encode($data);
                break;
            }
        }
        // Jika data tidak ditemukan
        if (!$dataFound) {
            echo json_encode(array("success" => false, "message" => "Garjas Wanita Chin Up dengan ID tersebut tidak ditemukan."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Data Garjas Wanita Chin Up tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Garjas Wanita Chin Up tidak diberikan."));
}

<?php
include 'databases.php';

$garjasShuttleRunWanitaModel = new GarjasWanitaShuttleRun($koneksi);
$garjasWanitaShuttleRunID = isset($_GET['garjas_wanita_shuttlerun_id']) ? $_GET['garjas_wanita_shuttlerun_id'] : null;

if ($garjasWanitaShuttleRunID) {
    $dataGarjasWanitaShuttleRun = $garjasShuttleRunWanitaModel->tampilkanDataGarjasWanitaShuttleRun();

    if ($dataGarjasWanitaShuttleRun) {
        $dataFound = false;
        foreach ($dataGarjasWanitaShuttleRun as $data) {
            if ($data['ID_Wanita_Shuttle_Run'] == $garjasWanitaShuttleRunID) {
                $dataFound = true;
                echo json_encode($data);
                break;
            }
        }
        // Jika data tidak ditemukan
        if (!$dataFound) {
            echo json_encode(array("success" => false, "message" => "Garjas Wanita Shuttle Run dengan ID tersebut tidak ditemukan."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Data Garjas Wanita Shuttle Run tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Garjas Wanita Shuttle Run tidak diberikan."));
}

<?php
include 'databases.php';

$garjasPushUpPriaModel = new GarjasPushUpPria($koneksi);
$garjasPriaPushUpID = isset($_GET['garjas_pria_pushup_id']) ? $_GET['garjas_pria_pushup_id'] : null;

if ($garjasPriaPushUpID) {
    $dataGarjasPriaPushUp = $garjasPushUpPriaModel->tampilkanDataGarjasPriaPushUp();

    if ($dataGarjasPriaPushUp) {
        $dataFound = false;
        foreach ($dataGarjasPriaPushUp as $data) {
            if ($data['ID_Push_Up_Pria'] == $garjasPriaPushUpID) {
                $dataFound = true;
                echo json_encode($data);
                break;
            }
        }
        // Jika data tidak ditemukan
        if (!$dataFound) {
            echo json_encode(array("success" => false, "message" => "Garjas Pria Push Up dengan ID tersebut tidak ditemukan."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Data Garjas Pria Push Up tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Garjas Pria Push Up tidak diberikan."));
}

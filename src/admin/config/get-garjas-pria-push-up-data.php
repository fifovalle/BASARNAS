<?php
include 'databases.php';

$garjasPushUpPriaModel = new GarjasPushUpPria($koneksi);
$garjasPriaPushUpID = isset($_GET['garjas_pria_pushup_id']) ? $_GET['garjas_pria_pushup_id'] : null;

if ($garjasPriaPushUpID) {
    $dataGarjasPriaPushUp = $garjasPushUpPriaModel->tampilkanGarjasPriaPushUp($garjasPriaPushUpID);

    if ($dataGarjasPriaPushUp) {
        echo json_encode($dataGarjasPriaPushUp);
    } else {
        echo json_encode(array("success" => false, "message" => "Garjas Pria Push Up dengan ID tersebut tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Garjas Pria Push Up tidak diberikan."));
}
?>

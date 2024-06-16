<?php
include 'databases.php';

$garjasPushUpPriaModel = new GarjasPushUpPria($koneksi);

$garjasPriaPushUpID = isset($_GET['garjas_pria_pushup_id']) ? $_GET['garjas_pria_pushup_id'] : null;
$dataGarjasPriaPushUp = $garjasPushUpPriaModel->tampilkanDataGarjasPriaPushUp($garjasPriaPushUpID);

$garjasPushUpPriaDitemukan = null;

foreach ($dataGarjasPriaPushUp as $garjasPushUpPria) {
    $garjasPushUpPriaDitemukan = $garjasPushUpPria['ID_Push_Up_Pria'] == $garjasPriaPushUpID ? $garjasPushUpPria : null;
    if ($garjasPushUpPriaDitemukan) {
        break;
    }
}

echo json_encode($garjasPushUpPriaDitemukan);


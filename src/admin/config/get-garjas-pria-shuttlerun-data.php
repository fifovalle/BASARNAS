<?php
include 'databases.php';

$garjasPriaShuttleRunModel = new GarjasPriaShuttleRun($koneksi);

$garjasPriaShuttleRunID = isset($_GET['garjas_pria_shuttlerun_id']) ? $_GET['garjas_pria_shuttlerun_id'] : null;
$dataGarjasPriaShuttleRun = $garjasPriaShuttleRunModel->tampilkanDataGarjasPriaShuttleRun($garjasPriaShuttleRunID);

$garjasPriaShuttleRunDitemukan = null;

foreach ($dataGarjasPriaShuttleRun as $garjasPriaShuttleRun) {
    $garjasPriaShuttleRunDitemukan = $garjasPriaShuttleRun['ID_Shuttle_Run_Pria'] == $garjasPriaShuttleRunID ? $garjasPriaShuttleRun : null;
    if ($garjasPriaShuttleRunDitemukan) {
        break;
    }
}

echo json_encode($garjasPriaShuttleRunDitemukan);




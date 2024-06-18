<?php
include 'databases.php';

$garjasShuttleRunWanitaModel = new GarjasWanitaShuttleRun($koneksi);

$garjasWanitaShuttleRunID = isset($_GET['garjas_wanita_shuttlerun_id']) ? $_GET['garjas_wanita_shuttlerun_id'] : null;
$dataGarjasWanitaShuttleRun = $garjasShuttleRunWanitaModel->tampilkanDataGarjasWanitaShuttleRun($garjasWanitaShuttleRunID);

$garjasWanitaShuttleRunDitemukan = null;

foreach ($dataGarjasWanitaShuttleRun as $garjasWanitaShuttleRun) {
    $garjasWanitaShuttleRunDitemukan = $garjasWanitaShuttleRun['ID_Wanita_Shuttle_Run'] == $garjasWanitaShuttleRunID ? $garjasWanitaShuttleRun : null;
    if ($garjasWanitaShuttleRunDitemukan) {
        break;
    }
}

echo json_encode($garjasWanitaShuttleRunDitemukan);


<?php
include 'databases.php';

$garjasChinUpWanitaModel = new GarjasWanitaChinUp($koneksi);

$garjasWanitaChinUpID = isset($_GET['garjas_wanita_chinup_id']) ? $_GET['garjas_wanita_chinup_id'] : null;
$dataGarjasWanitaChinUp = $garjasChinUpWanitaModel->tampilkanDataGarjasWanitaChinUp($garjasWanitaChinUpID);

$garjasWanitaChinUpDitemukan = null;

foreach ($dataGarjasWanitaChinUp as $garjasWanitaChinUp) {
    $garjasWanitaChinUpDitemukan = $garjasWanitaChinUp['ID_Wanita_Chin_Up'] == $garjasWanitaChinUpID ? $garjasWanitaChinUp : null;
    if ($garjasWanitaChinUpDitemukan) {
        break;
    }
}

echo json_encode($garjasWanitaChinUpDitemukan);



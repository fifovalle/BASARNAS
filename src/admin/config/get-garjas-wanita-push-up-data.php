<?php
include 'databases.php';

$garjasPushUpWanitaModel = new GarjasWanitaPushUp($koneksi);

$garjasWanitaPushUpID = isset($_GET['garjas_wanita_push_up_id']) ? $_GET['garjas_wanita_push_up_id'] : null;
$dataGarjasWanitaPushUp = $garjasPushUpWanitaModel->tampilkanDataGarjasWanitaPushUp($garjasWanitaPushUpID);

$garjasPushUpWanitaDitemukan = null;

foreach ($dataGarjasWanitaPushUp as $garjasPushUpWanita) {
    $garjasPushUpWanitaDitemukan = $garjasPushUpWanita['ID_Wanita_Push_Up'] == $garjasWanitaPushUpID ? $garjasPushUpWanita : null;
    if ($garjasPushUpWanitaDitemukan) {
        break;
    }
}

echo json_encode($garjasPushUpWanitaDitemukan);

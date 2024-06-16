<?php
include 'databases.php';

$garjasSitUp2WanitaModel = new GarjasWanitaSitUp2($koneksi);

$garjasWanitaSitUp2ID = isset($_GET['garjas_wanita_situp2_id']) ? $_GET['garjas_wanita_situp2_id'] : null;
$dataGarjasWanitaSitUp2 = $garjasSitUp2WanitaModel->tampilkanDataGarjasWanitaSitUp2($garjasWanitaSitUp2ID);

$garjasWanitaSitUp2Ditemukan = null;

foreach ($dataGarjasWanitaSitUp2 as $garjasWanitaSitUp2) {
    $garjasWanitaSitUp2Ditemukan = $garjasWanitaSitUp2['ID_Wanita_Sit_Up_Kaki_Di_Tekuk'] == $garjasWanitaSitUp2ID ? $garjasWanitaSitUp2 : null;
    if ($garjasWanitaSitUp2Ditemukan) {
        break;
    }
}

echo json_encode($garjasWanitaSitUp2Ditemukan);


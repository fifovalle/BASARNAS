<?php
include 'databases.php';

$garjasSitUp1WanitaModel = new GarjasWanitaSitUp1($koneksi);

$garjasWanitaSitUp1ID = isset($_GET['garjas_wanita_situp1_id']) ? $_GET['garjas_wanita_situp1_id'] : null;
$dataGarjasWanitaSitUp1 = $garjasSitUp1WanitaModel->tampilkanDataGarjasWanitaSitUp1($garjasWanitaSitUp1ID);

$garjasWanitaSitUp1Ditemukan = null;

foreach ($dataGarjasWanitaSitUp1 as $garjasWanitaSitUp1) {
    $garjasWanitaSitUp1Ditemukan = $garjasWanitaSitUp1['ID_Wanita_Sit_Up_Kaki_Lurus'] == $garjasWanitaSitUp1ID ? $garjasWanitaSitUp1 : null;
    if ($garjasWanitaSitUp1Ditemukan) {
        break;
    }
}

echo json_encode($garjasWanitaSitUp1Ditemukan);


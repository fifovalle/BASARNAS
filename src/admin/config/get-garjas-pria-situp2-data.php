<?php
include 'databases.php';

$garjasSitUp2PriaModel = new GarjasPriaSitUpKakiDitekuk($koneksi);

$garjasPriaSitUp2ID = isset($_GET['garjas_pria_situp2_id']) ? $_GET['garjas_pria_situp2_id'] : null;
$dataGarjasPriaSitUp2 = $garjasSitUp2PriaModel->tampilkanDataGarjasPriaSitUp2($garjasPriaSitUp2ID);

$garjasPriaSitUp2Ditemukan = null;

foreach ($dataGarjasPriaSitUp2 as $garjasPriaSitUp2) {
    $garjasPriaSitUp2Ditemukan = $garjasPriaSitUp2['ID_Sit_Up_Kaki_Di_Tekuk_Pria'] == $garjasPriaSitUp2ID ? $garjasPriaSitUp2 : null;
    if ($garjasPriaSitUp2Ditemukan) {
        break;
    }
}

echo json_encode($garjasPriaSitUp2Ditemukan);




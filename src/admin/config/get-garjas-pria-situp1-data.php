<?php
include 'databases.php';

$garjasSitUp1PriaModel = new GarjasPriaSitUpKakiLurus($koneksi);

$garjasPriaSitUp1ID = isset($_GET['garjas_pria_situp1_id']) ? $_GET['garjas_pria_situp1_id'] : null;
$dataGarjasPriaSitUp1 = $garjasSitUp1PriaModel->tampilkanDataGarjasPriaSitUp1($garjasPriaSitUp1ID);

$garjasPriaSitUp1Ditemukan = null;

foreach ($dataGarjasPriaSitUp1 as $garjasPriaSitUp1) {
    $garjasPriaSitUp1Ditemukan = $garjasPriaSitUp1['ID_Sit_Up_Kaki_Lurus_Pria'] == $garjasPriaSitUp1ID ? $garjasPriaSitUp1 : null;
    if ($garjasPriaSitUp1Ditemukan) {
        break;
    }
}

echo json_encode($garjasPriaSitUp1Ditemukan);




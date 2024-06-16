<?php
include 'databases.php';

$garjasSitUp1PriaModel = new GarjasPriaSitUpKakiLurus($koneksi);

$garjasPriaSitUp1ID = isset($_GET['garjas_pria_situp1_id']) ? $_GET['garjas_pria_situp1_id'] : null;
$dataGarjasPriaSitUp1 = $garjasSitUp1PriaModel->tampilkanDataGarjasPriaPushUp($garjasPriaSitUp1ID);

$garjasPriaSitUpKakiLurusDitemukan = null;

foreach ($dataGarjasPriaSitUp1 as $garjasPriaSitUpKakiLurus) {
    $garjasPriaSitUpKakiLurusDitemukan = $garjasPriaSitUpKakiLurus['ID_Push_Up_Pria'] == $garjasPriaSitUp1ID ? $garjasPriaSitUpKakiLurus : null;
    if ($garjasPriaSitUpKakiLurusDitemukan) {
        break;
    }
}

echo json_encode($garjasPriaSitUpKakiLurusDitemukan);


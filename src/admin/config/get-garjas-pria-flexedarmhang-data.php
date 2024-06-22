<?php
include 'databases.php';

$garjasPriaFlexedArmHangModel = new GarjasPriaFlexedArmHang($koneksi);

$garjasPriaFlexedArmHangID = isset($_GET['garjas_pria_flexedarmhang_id']) ? $_GET['garjas_pria_flexedarmhang_id'] : null;
$dataGarjasPriaFlexedArmHang = $garjasPriaFlexedArmHangModel->tampilkanDataGarjasPriaFlexedArmHang($garjasPriaFlexedArmHangID);

$garjasPriaFlexedArmHangDitemukan = null;

foreach ($dataGarjasPriaFlexedArmHang as $garjasPriaFlexedArmHang) {
    $garjasPriaFlexedArmHangDitemukan = $garjasPriaFlexedArmHang['ID_Menggantung_Pria'] == $garjasPriaFlexedArmHangID ? $garjasPriaFlexedArmHang : null;
    if ($garjasPriaFlexedArmHangDitemukan) {
        break;
    }
}

echo json_encode($garjasPriaFlexedArmHangDitemukan);




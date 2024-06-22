<?php
include 'databases.php';

$garjasTestLariPriaModel = new TesLariPria($koneksi);

$garjasTestLariPriaID = isset($_GET['test_pria_lari_id']) ? $_GET['test_pria_lari_id'] : null;
$dataGarjasTestLariPria = $garjasTestLariPriaModel->tampilkanDataTesLariPria($garjasTestLariPriaID);

$garjasTestLariPriaDitemukan = null;

foreach ($dataGarjasTestLariPria as $garjasTestLariPria) {
    $garjasTestLariPriaDitemukan = $garjasTestLariPria['ID_Lari_Pria'] == $garjasTestLariPriaID ? $garjasTestLariPria : null;
    if ($garjasTestLariPriaDitemukan) {
        break;
    }
}

echo json_encode($garjasTestLariPriaDitemukan);

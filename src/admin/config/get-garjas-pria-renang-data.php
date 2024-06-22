<?php
include 'databases.php';

$garjasTestRenangPriaModel = new TesRenangPria($koneksi);

$garjasTestRenangPriaID = isset($_GET['test_pria_renang_id']) ? $_GET['test_pria_renang_id'] : null;
$dataGarjasTestRenangPria = $garjasTestRenangPriaModel->tampilkanDataTesRenangPria($garjasTestRenangPriaID);

$garjasTestRenangPriaDitemukan = null;

foreach ($dataGarjasTestRenangPria as $garjasTestRenangPria) {
    $garjasTestRenangPriaDitemukan = $garjasTestRenangPria['ID_Renang_Pria'] == $garjasTestRenangPriaID ? $garjasTestRenangPria : null;
    if ($garjasTestRenangPriaDitemukan) {
        break;
    }
}

echo json_encode($garjasTestRenangPriaDitemukan);


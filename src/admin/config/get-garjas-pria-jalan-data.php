<?php
include 'databases.php';

$garjasTestJalanPriaModel = new TesJalanKaki5KMPria($koneksi);

$garjasTestJalanPriaID = isset($_GET['test_pria_jalan_id']) ? $_GET['test_pria_jalan_id'] : null;
$dataGarjasTestJalanPria = $garjasTestJalanPriaModel->tampilkanDataTesJalanKaki5KMPria($garjasTestJalanPriaID);

$garjasTestJalanPriaDitemukan = null;

foreach ($dataGarjasTestJalanPria as $garjasTestJalanPria) {
    $garjasTestJalanPriaDitemukan = $garjasTestJalanPria['ID_Jalan_Pria'] == $garjasTestJalanPriaID ? $garjasTestJalanPria : null;
    if ($garjasTestJalanPriaDitemukan) {
        break;
    }
}

echo json_encode($garjasTestJalanPriaDitemukan);

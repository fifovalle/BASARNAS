<?php
include 'databases.php';

$garjasChinUpPriaModel = new GarjasChinUpPria($koneksi);

$garjasChinUpPriaID = isset($_GET['garjas_pria_chinup_id']) ? $_GET['garjas_pria_chinup_id'] : null;
$dataGarjasChinUpPria = $garjasChinUpPriaModel->tampilkanDataGarjasPriaChinUp($garjasChinUpPriaID);

$garjasChinUpPriaDitemukan = null;

foreach ($dataGarjasChinUpPria as $garjasChinUpPria) {
    $garjasChinUpPriaDitemukan = $garjasChinUpPria['ID_Pria_Chin_Up'] == $garjasChinUpPriaID ? $garjasChinUpPria : null;
    if ($garjasChinUpPriaDitemukan) {
        break;
    }
}

echo json_encode($garjasChinUpPriaDitemukan);


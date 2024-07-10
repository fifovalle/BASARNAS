<?php
include 'databases.php';

$totalGarjasPriaModel = new TotalGarjasPria($koneksi);

$totalGarjasPriaID = isset($_GET['total_garjas_pria_id']) ? $_GET['total_garjas_pria_id'] : null;
$dataTotalGarjasPria = $totalGarjasPriaModel->tampilkanDataTotalGarjasPria($totalGarjasPriaID);

$totalGarjasPriaDitemukan = null;

foreach ($dataTotalGarjasPria as $totalGarjasPria) {
    $totalGarjasPriaDitemukan = $totalGarjasPria['NIP_Pengguna'] == $totalGarjasPriaID ? $totalGarjasPria : null;
    if ($totalGarjasPriaDitemukan) {
        break;
    }
}

echo json_encode($totalGarjasPriaDitemukan);

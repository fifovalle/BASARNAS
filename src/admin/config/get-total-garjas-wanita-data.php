<?php
include 'databases.php';

$totalGarjasWanitaModel = new TotalGarjasWanita($koneksi);

$totalGarjasWanitaID = isset($_GET['total_garjas_wanita_id']) ? $_GET['total_garjas_wanita_id'] : null;
$dataTotalGarjasWanita = $totalGarjasWanitaModel->tampilkanDataTotalGarjasWanita($totalGarjasWanitaID);

$totalGarjasWanitaDitemukan = null;

foreach ($dataTotalGarjasWanita as $totalGarjasWanita) {
    $totalGarjasWanitaDitemukan = $totalGarjasWanita['NIP_Pengguna'] == $totalGarjasWanitaID ? $totalGarjasWanita : null;
    if ($totalGarjasWanitaDitemukan) {
        break;
    }
}

echo json_encode($totalGarjasWanitaDitemukan);

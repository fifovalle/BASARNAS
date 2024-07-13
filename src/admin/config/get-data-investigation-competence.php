<?php
include 'databases.php';

$kompetensiPenyeliaModel = new Kompetensi($koneksi);

$kompetensiPenyelia = isset($_GET['kompetensi_penyelia_id']) ? $_GET['kompetensi_penyelia_id'] : null;
$dataKompetensiPenyelia = $kompetensiPenyeliaModel->tampilkanKompetensiPenyelia($kompetensiPenyelia);

$penyeliaDitemukan = null;

foreach ($dataKompetensiPenyelia as $penyelia) {
    $penyeliaDitemukan = $penyelia['ID_Kompetensi'] == $kompetensiPenyelia ? $penyelia : null;
    if ($penyeliaDitemukan) {
        break;
    }
}

echo json_encode($penyeliaDitemukan);

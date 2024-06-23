<?php
include 'databases.php';

$kompetensiModel = new Pengguna($koneksi);

$kompetensi = isset($_GET['kompetensi_id']) ? $_GET['kompetensi_id'] : null;
$dataKompetensi = $kompetensiModel->tampilkanKompetensi($kompetensi);

$dataDitemukan = null;

foreach ($dataKompetensi as $terampil) {
    $dataDitemukan = $terampil['ID_Kompetensi'] == $kompetensi ? $terampil : null;
    if ($dataDitemukan) {
        break;
    }
}

echo json_encode($dataDitemukan);

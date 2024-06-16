<?php
include 'databases.php';

$kompetensiTerampilModel = new Kompetensi($koneksi);

$kompetensiTerampil = isset($_GET['kompetensi_terampil_id']) ? $_GET['kompetensi_terampil_id'] : null;
$dataKompetensiTerampil = $kompetensiTerampilModel->tampilkanKompetensiTerampil($kompetensiTerampil);

$terampilDitemukan = null;

foreach ($dataKompetensiTerampil as $terampil) {
    $terampilDitemukan = $terampil['ID_Kompetensi'] == $kompetensiTerampil ? $terampil : null;
    if ($terampilDitemukan) {
        break;
    }
}

echo json_encode($terampilDitemukan);

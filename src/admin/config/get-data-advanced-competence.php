<?php
include 'databases.php';

$kompetensiMahirModel = new Kompetensi($koneksi);

$kompetensiMahir = isset($_GET['kompetensi_mahir_id']) ? $_GET['kompetensi_mahir_id'] : null;
$dataKompetensiMahir = $kompetensiMahirModel->tampilkanKompetensiMahir($kompetensiMahir);

$mahirDitemukan = null;

foreach ($dataKompetensiMahir as $mahir) {
    $mahirDitemukan = $mahir['ID_Kompetensi'] == $kompetensiMahir ? $mahir : null;
    if ($mahirDitemukan) {
        break;
    }
}

echo json_encode($mahirDitemukan);

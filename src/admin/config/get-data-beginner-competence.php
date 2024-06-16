<?php
include 'databases.php';

$kompetensiPemulaModel = new Kompetensi($koneksi);

$kompetensiPemula = isset($_GET['kompetensi_pemula_id']) ? $_GET['kompetensi_pemula_id'] : null;
$dataKompetensiPemula = $kompetensiPemulaModel->tampilkanKompetensiPemula($kompetensiPemula);

$pemulaDitemukan = null;

foreach ($dataKompetensiPemula as $pemula) {
    $pemulaDitemukan = $pemula['ID_Kompetensi'] == $kompetensiPemula ? $pemula : null;
    if ($pemulaDitemukan) {
        break;
    }
}

echo json_encode($pemulaDitemukan);

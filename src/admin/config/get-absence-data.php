<?php
include 'databases.php';

$absensiModel = new Absensi($koneksi);

$absensiID = isset($_GET['absensi_id']) ? $_GET['absensi_id'] : null;
$dataAbsensi = $absensiModel->tampilkanDataAbsensi($absensiID);

$absensiDitemukan = null;

foreach ($dataAbsensi as $absen) {
    $absensiDitemukan = $absen['ID_Absensi'] == $absensiID ? $absen : null;
    if ($absensiDitemukan) {
        break;
    }
}

echo json_encode($absensiDitemukan);

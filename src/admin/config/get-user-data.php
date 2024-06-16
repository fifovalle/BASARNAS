<?php
include 'databases.php';

$penggunaModel = new Pengguna($koneksi);

$penggunaNIP = isset($_GET['pengguna_nip']) ? $_GET['pengguna_nip'] : null;
$dataPengguna = $penggunaModel->tampilkanDataPengguna($penggunaNIP);

$penggunaDitemukan = null;

foreach ($dataPengguna as $pengguna) {
    $penggunaDitemukan = $pengguna['NIP_Pengguna'] == $penggunaNIP ? $pengguna : null;
    if ($penggunaDitemukan) {
        break;
    }
}

echo json_encode($penggunaDitemukan);
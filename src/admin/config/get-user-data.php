<?php
include 'databases.php';

$penggunaModel = new Pengguna($koneksi);
$penggunaNIP = isset($_GET['pengguna_nip']) ? $_GET['pengguna_nip'] : null;

if ($penggunaNIP) {
    $dataPengguna = $penggunaModel->tampilkanPengguna($penggunaNIP);

    if ($dataPengguna) {
        echo json_encode($dataPengguna);
    } else {
        echo json_encode(array("success" => false, "message" => "Pengguna tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "NIP Pengguna tidak diberikan."));
}
?>

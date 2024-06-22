<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idModul = $_POST['ID_Modul'] ?? '';
    $namaModul = $_POST['Nama_Modul'] ?? '';
    $judulModul = $_POST['Judul_Modul'] ?? '';
    $deskripsiModul = $_POST['Deskripsi_Modul'] ?? '';

    $pesanKesalahan = '';

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $modulModel = new Modul($koneksi);

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $dataModul = array(
        'Nama_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($namaModul)),
        'Judul_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($judulModul)),
        'Deskripsi_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($deskripsiModul)),
    );

    $updateDataModul = $modulModel->perbaruiModul($idModul, $dataModul);

    if ($updateDataModul) {
        echo json_encode(array("success" => true, "message" => "Data modul berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data modul."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

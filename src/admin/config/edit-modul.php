<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idModul = $_POST['ID_Modul'] ?? '';
    $namaModul = $_POST['Nama_Modul'] ?? '';
    $judulModul = $_POST['Judul_Modul'] ?? '';
    $tanggalModul = $_POST['Tanggal_Terbit_Modul'] ?? '';
    $deskripsiModul = $_POST['Deskripsi_Modul'] ?? '';

    $pesanKesalahan = '';

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $modulModel = new Modul($koneksi);

    if (!empty($_FILES['File_Modul']['name'])) {
        $fileModul = $_FILES['File_Modul'];
        $namaFotoAsli = $fileModul['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fileModul['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFileLama = $modulModel->getFileModulOlehID($idModul);
        if (!empty($namaFileLama)) {
            $lokasiFileLama = "../uploads/" . $namaFileLama;
            if (file_exists($lokasiFileLama)) {
                unlink($lokasiFileLama);
            }
        }
    } else {
        $namaFotoBaru = $modulModel->getFileModulOlehID($idModul);
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $dataModul = array(
        'File_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($namaFotoBaru)),
        'Nama_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($namaModul)),
        'Judul_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($judulModul)),
        'Tanggal_Terbit_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($tanggalModul)),
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

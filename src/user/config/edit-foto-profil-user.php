<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fotoPengguna = $_FILES['Foto_Pengguna'] ?? null;
    $namaFotoPengguna = $fotoPengguna ? mysqli_real_escape_string($koneksi, htmlspecialchars($fotoPengguna['name'])) : '';
    $ukuranFotoPengguna = $fotoPengguna ? $fotoPengguna['size'] : 0;
    $pesanKesalahan = '';

    $ukuranMaksimal = 2 * 1024 * 1024;

    if ($fotoPengguna && $ukuranFotoPengguna > $ukuranMaksimal) {
        $pesanKesalahan .= "Ukuran file foto pengguna melebihi batas maksimal (2MB). ";
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $nipPengguna = $_SESSION['NIP_Pengguna'];
    $namaFotoBaru = '';

    $penggunaModel = new Pengguna($koneksi);

    if (!empty($fotoPengguna['name'])) {
        $namaFotoAsli = $fotoPengguna['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../../admin/uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoPengguna['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFotoLama = $penggunaModel->getFotoPenggunaById($nipPengguna);
        if (!empty($namaFotoLama)) {
            $pathFotoLama = "../../admin/uploads/" . $namaFotoLama;
            if (file_exists($pathFotoLama)) {
                unlink($pathFotoLama);
            }
        }
    } else {
        $namaFotoBaru = $penggunaModel->getFotoPenggunaById($nipPengguna);
    }

    $updateDataPengguna = $penggunaModel->perbaruiFotoPengguna($nipPengguna, $namaFotoBaru);

    if ($updateDataPengguna) {
        setPesanKeberhasilan("Berhasil, Foto pengguna berhasil diperbarui.");
    } else {
        setPesanKesalahan("Gagal memperbarui Foto pengguna.");
    }

    header("Location: " . $akarUrl . "src/user/pages/profile.php");
    exit;
} else {
    header("Location: " . $akarUrl . "src/user/pages/profile.php");
    exit;
}

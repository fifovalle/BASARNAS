<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fotoAdmin = $_FILES['Foto_Admin'] ?? null;
    $namaFotoAdmin = $fotoAdmin ? mysqli_real_escape_string($koneksi, htmlspecialchars($fotoAdmin['name'])) : '';
    $ukuranFotoAdmin = $fotoAdmin ? $fotoAdmin['size'] : 0;
    $pesanKesalahan = '';

    $ukuranMaksimal = 2 * 1024 * 1024;

    if ($fotoAdmin && $ukuranFotoAdmin > $ukuranMaksimal) {
        $pesanKesalahan .= "Ukuran file foto admin melebihi batas maksimal (2MB). ";
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $nipAdmin = $_SESSION['NIP_Admin'];
    $namaFotoBaru = '';

    $adminModel = new Admin($koneksi);

    if (!empty($fotoAdmin['name'])) {
        $namaFotoAsli = $fotoAdmin['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoAdmin['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFotoLama = $adminModel->getFotoAdminById($nipAdmin);
        if (!empty($namaFotoLama)) {
            $pathFotoLama = "../uploads/" . $namaFotoLama;
            if (file_exists($pathFotoLama)) {
                unlink($pathFotoLama);
            }
        }
    } else {
        $namaFotoBaru = $adminModel->getFotoAdminById($nipAdmin);
    }

    $updateDataAdmin = $adminModel->perbaruiFotoAdmin($nipAdmin, $namaFotoBaru);

    if ($updateDataAdmin) {
        $_SESSION['Foto_Admin'] = $namaFotoBaru;
        echo json_encode(array("success" => true, "message" => "Berhasil memperbarui foto admin.", "newImage" => $namaFotoBaru));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui foto admin."));
    }
    exit;
} else {
    header("Location: " . $akarUrl . "src/admin/pages/profile.php");
    exit;
}

<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idKompetensi = $_POST['ID_Kompetensi'] ?? '';
    $namaSertifikat = $_POST['Nama_Sertifikat'] ?? '';
    $tanggalPenerbitan = $_POST['Tanggal_Penerbitan_Sertifikat'] ?? '';
    $tanggalBerakhir = $_POST['Tanggal_Berakhir_Sertifikat'] ?? '';
    $kategoriKompetensi = $_POST['Kategori_Kompetensi'] ?? '';
    $status = $_POST['Status'] ?? '';

    $pesanKesalahan = '';

    $fileSertifikat = $_FILES['File_Sertifikat'] ?? null;
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $namafileSertifikat = $fileSertifikat ? mysqli_real_escape_string($koneksi, htmlspecialchars($fileSertifikat['name'])) : '';
    $fileSertifikatTemp = $fileSertifikat ? $fileSertifikat['tmp_name'] : '';
    $ukuranfileSertifikat = $fileSertifikat ? $fileSertifikat['size'] : 0;
    $errorfileSertifikat = $fileSertifikat ? $fileSertifikat['error'] : 0;
    $ukuranMaksimal = 2 * 1024 * 1024;

    $fileExtension = pathinfo($namafileSertifikat, PATHINFO_EXTENSION);

    if ($fileSertifikat && $ukuranfileSertifikat > $ukuranMaksimal) {
        $pesanKesalahan .= "Ukuran file sertifikat melebihi batas maksimal (2MB). ";
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $kompetensiPemulaModel = new Kompetensi($koneksi);
    $dataLamaSertifikat = $kompetensiPemulaModel->tampilkanKompetensiPemulaOlehID($idKompetensi);

    if ($fileSertifikat && $errorfileSertifikat === UPLOAD_ERR_OK) {
        $namafileSertifikatBaru = uniqid() . '.' . $fileExtension;
        $tujuanfileSertifikat = '../uploads/' . $namafileSertifikatBaru;
        $apakahBerhasilDipindahkan = move_uploaded_file($fileSertifikatTemp, $tujuanfileSertifikat);

        if ($apakahBerhasilDipindahkan) {
            if (isset($dataLamaSertifikat['File_Sertifikat']) && !empty($dataLamaSertifikat['File_Sertifikat'])) {
                $pathFotoLama = '../uploads/' . $dataLamaSertifikat['File_Sertifikat'];
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama);
                }
            }
        } else {
            $pesanKesalahan .= "Gagal mengupload sertifikat. ";
        }
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $dataKompetensi = array(
        'Nama_Sertifikat' => mysqli_real_escape_string($koneksi, htmlspecialchars($namaSertifikat)),
        'Tanggal_Penerbitan_Sertifikat' => mysqli_real_escape_string($koneksi, htmlspecialchars($tanggalPenerbitan)),
        'Tanggal_Berakhir_Sertifikat' => mysqli_real_escape_string($koneksi, htmlspecialchars($tanggalBerakhir)),
        'Kategori_Kompetensi' => mysqli_real_escape_string($koneksi, htmlspecialchars($kategoriKompetensi)),
        'Status' => mysqli_real_escape_string($koneksi, htmlspecialchars($status)),
    );

    if ($fileSertifikat && $errorfileSertifikat === UPLOAD_ERR_OK && $apakahBerhasilDipindahkan) {
        $dataKompetensi['File_Sertifikat'] = $namafileSertifikatBaru;
    } else {
        $dataKompetensi['File_Sertifikat'] = $dataLamaSertifikat['File_Sertifikat'];
    }

    $updateDataKompetensi = $kompetensiPemulaModel->perbaruiKompetensi($idKompetensi, $dataKompetensi);

    if ($updateDataKompetensi) {
        echo json_encode(array("success" => true, "message" => "Data pengguna berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengguna."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

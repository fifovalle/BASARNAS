<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $namaLengkapPengguna = $_POST['Nama_Lengkap_Pengguna'] ?? '';
    $tanggalLahirPengguna = $_POST['Tanggal_Lahir_Pengguna'] ?? '';
    $jabatanPengguna = $_POST['Jabatan_Pengguna'] ?? '';
    $jenisKelaminPengguna = $_POST['Jenis_Kelamin_Pengguna'] ?? '';
    $noTeleponPengguna = $_POST['No_Telepon_Pengguna'] ?? '';

    $pesanKesalahan = '';

    $tanggal_lahir_format = DateTime::createFromFormat('Y-m-d', $tanggalLahirPengguna);
    if ($tanggal_lahir_format === false) {
        $pesanKesalahan .= "Format tanggal lahir tidak valid. ";
    } else {
        $tanggalLahirPengguna = $tanggal_lahir_format->format('Y-m-d');

        $tgl_lahir = new DateTime($tanggalLahirPengguna);
        $tgl_today = new DateTime('now');
        $umurPengguna = $tgl_today->diff($tgl_lahir)->y;
    }

    $nomorTeleponFormatted = preg_replace('/\D/', '', $noTeleponPengguna);

    if (strpos($nomorTeleponFormatted, '62') === 0) {
        $nomorTeleponFormatted = '+' . $nomorTeleponFormatted;
    } elseif (strpos($nomorTeleponFormatted, '0') === 0) {
        $nomorTeleponFormatted = '+62' . substr($nomorTeleponFormatted, 1);
    }

    $nomorTeleponFormatted = '' . substr($nomorTeleponFormatted, 0, 3) . ' ' . substr($nomorTeleponFormatted, 3, 3) . '-' . substr($nomorTeleponFormatted, 6, 4) . '-' . substr($nomorTeleponFormatted, 10);

    $fotoPengguna = $_FILES['Foto_Pengguna'] ?? null;
    $namaFotoPengguna = $fotoPengguna ? mysqli_real_escape_string($koneksi, htmlspecialchars($fotoPengguna['name'])) : '';
    $fotoPenggunaTemp = $fotoPengguna ? $fotoPengguna['tmp_name'] : '';
    $ukuranFotoPengguna = $fotoPengguna ? $fotoPengguna['size'] : 0;
    $errorFotoPengguna = $fotoPengguna ? $fotoPengguna['error'] : 0;
    $tujuanFotoPengguna = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    if ($fotoPengguna && $ukuranFotoPengguna > $ukuranMaksimal) {
        $pesanKesalahan .= "Ukuran file foto pengguna melebihi batas maksimal (2MB). ";
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $penggunaModel = new Pengguna($koneksi);

    $dataLamaPengguna = $penggunaModel->tampilkanDataPengguna($nipPengguna);

    if (!empty($_FILES['Foto_Pengguna']['name'])) {
        $fotoPengguna = $_FILES['Foto_Pengguna'];
        $namaFotoAsli = $fotoPengguna['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoPengguna['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFotoLama = $penggunaModel->getFotoPenggunaById($nipPengguna);
        if (!empty($namaFotoLama)) {
            $pathFotoLama = "../uploads/" . $namaFotoLama;
            if (file_exists($pathFotoLama)) {
                unlink($pathFotoLama);
            }
        }
    } else {
        $namaFotoBaru = $penggunaModel->getFotoPenggunaById($nipPengguna);
    }

    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Nama_Lengkap_Pengguna' => $namaLengkapPengguna,
        'Tanggal_Lahir_Pengguna' => $tanggalLahirPengguna,
        'Jabatan_Pengguna' => $jabatanPengguna,
        'Jenis_Kelamin_Pengguna' => $jenisKelaminPengguna,
        'No_Telepon_Pengguna' => $nomorTeleponFormatted,
        'Umur_Pengguna' => $umurPengguna,
        'Foto_Pengguna' => $namaFotoBaru
    );

    $updateDataPengguna = $penggunaModel->perbaruiPengguna($nipPengguna, $dataPengguna);

    if ($updateDataPengguna) {
        echo json_encode(array("success" => true, "message" => "Data pengguna berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengguna."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

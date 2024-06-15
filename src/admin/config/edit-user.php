<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $namaLengkapPengguna = $_POST['Nama_Lengkap_Pengguna'] ?? '';
    $tanggalLahirPengguna = $_POST['Tanggal_Lahir_Pengguna'] ?? '';
    $alamatPengguna = $_POST['Alamat_Pengguna'] ?? '';
    $jabatanPengguna = $_POST['Jabatan_Pengguna'] ?? '';
    $jenisKelaminPengguna = $_POST['Jenis_Kelamin_Pengguna'] ?? '';
    $nomorTeleponPengguna = $_POST['No_Telepon_Pengguna'] ?? '';

    $pesanKesalahan = '';

    // Validasi dan format tanggal lahir
    $tanggal_lahir_format = DateTime::createFromFormat('Y-m-d', $tanggalLahirPengguna);
    if ($tanggal_lahir_format === false) {
        $pesanKesalahan .= "Format tanggal lahir tidak valid. ";
    } else {
        $tanggalLahirPengguna = $tanggal_lahir_format->format('Y-m-d');

        // Hitung umur berdasarkan tanggal lahir
        $tgl_lahir = new DateTime($tanggalLahirPengguna);
        $tgl_today = new DateTime('now');
        $umurPengguna = $tgl_today->diff($tgl_lahir)->y;
    }

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
    $dataLamaPengguna = $penggunaModel->tampilkanPengguna($nipPengguna);

    if ($fotoPengguna && $errorFotoPengguna === UPLOAD_ERR_OK) {
        $namaFotoPenggunaBaru = time() . '_' . $namaFotoPengguna;
        $tujuanFotoPengguna = '../uploads/' . $namaFotoPenggunaBaru;
        $apakahBerhasilDipindahkan = move_uploaded_file($fotoPenggunaTemp, $tujuanFotoPengguna);

        if ($apakahBerhasilDipindahkan) {
            if (isset($dataLamaPengguna['Foto_Pengguna']) && !empty($dataLamaPengguna['Foto_Pengguna'])) {
                $pathFotoLama = '../uploads/' . $dataLamaPengguna['Foto_Pengguna'];
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama);
                }
            }
        } else {
            $pesanKesalahan .= "Gagal mengupload foto pengguna. ";
        }
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Nama_Lengkap_Pengguna' => $namaLengkapPengguna,
        'Tanggal_Lahir_Pengguna' => $tanggalLahirPengguna,
        'Alamat_Pengguna' => $alamatPengguna,
        'Jabatan_Pengguna' => $jabatanPengguna,
        'Jenis_Kelamin_Pengguna' => $jenisKelaminPengguna,
        'No_Telepon_Pengguna' => $nomorTeleponPengguna,
        'Umur_Pengguna' => $umurPengguna
    );

    if ($fotoPengguna && $errorFotoPengguna === UPLOAD_ERR_OK && $apakahBerhasilDipindahkan) {
        $dataPengguna['Foto_Pengguna'] = $namaFotoPenggunaBaru;
    } else {
        $dataPengguna['Foto_Pengguna'] = $dataLamaPengguna['Foto_Pengguna'];
    }

    $updateDataPengguna = $penggunaModel->perbaruiPengguna($nipPengguna, $dataPengguna);

    if ($updateDataPengguna) {
        echo json_encode(array("success" => true, "message" => "Data pengguna berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengguna."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

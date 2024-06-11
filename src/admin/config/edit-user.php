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

    $fotoPengguna = $_FILES['Foto_Pengguna'] ?? null;
    $namaFotoPengguna = $fotoPengguna ? mysqli_real_escape_string($koneksi, htmlspecialchars($fotoPengguna['name'])) : '';
    $fotoPenggunaTemp = $fotoPengguna ? $fotoPengguna['tmp_name'] : '';
    $ukuranFotoPengguna = $fotoPengguna ? $fotoPengguna['size'] : 0;
    $errorFotoPengguna = $fotoPengguna ? $fotoPengguna['error'] : 0;
    $tujuanFotoPengguna = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    $pesanKesalahan = '';

    if ($fotoPengguna && $ukuranFotoPengguna > $ukuranMaksimal) {
        $pesanKesalahan .= "Ukuran file foto pengguna melebihi batas maksimal (2MB). ";
    }

    if ($fotoPengguna && empty($pesanKesalahan)) {
        $namaFotoPenggunaBaru = time() . '_' . $namaFotoPengguna;
        $tujuanFotoPengguna = '../uploads/' . $namaFotoPenggunaBaru;
        $apakahBerhasilDipindahkan = move_uploaded_file($fotoPenggunaTemp, $tujuanFotoPengguna);

        if (!$apakahBerhasilDipindahkan) {
            $pesanKesalahan .= "Gagal mengupload foto pengguna. ";
        }
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data-user.php");
        exit;
    }

    $penggunaModel = new Pengguna($koneksi);

    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Nama_Lengkap_Pengguna' => $namaLengkapPengguna,
        'Tanggal_Lahir_Pengguna' => $tanggalLahirPengguna,
        'Alamat_Pengguna' => $alamatPengguna,
        'Jabatan_Pengguna' => $jabatanPengguna,
        'Jenis_Kelamin_Pengguna' => $jenisKelaminPengguna,
        'No_Telepon_Pengguna' => $nomorTeleponPengguna
    );

    if ($fotoPengguna && empty($pesanKesalahan)) {
        $dataPengguna['Foto_Pengguna'] = $namaFotoPenggunaBaru;
    } else {
        $dataLamaPengguna = $penggunaModel->tampilkanDataPengguna($nipPengguna);
        $dataPengguna['Foto_Pengguna'] = $dataLamaPengguna['Foto_Pengguna'];
    }

    $updateDataPengguna = $penggunaModel->perbaruiPengguna($nipPengguna, $dataPengguna);

    if ($updateDataPengguna) {
        echo json_encode(array("success" => true, "message" => "Data pengguna berhasil diperbarui."));
        exit;
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data pengguna."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
    exit;
}

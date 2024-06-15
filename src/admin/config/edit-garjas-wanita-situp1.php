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

    $penggunaModel = new Pengguna($koneksi);
    $dataLamaPengguna = $penggunaModel->tampilkanPengguna($nipPengguna);


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

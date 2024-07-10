<?php
include 'databases.php';

if (isset($_POST['Simpan'])) {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $namaLengkapPengguna = $_POST['Nama_Lengkap_Pengguna'] ?? '';
    $tanggalLahirPengguna = $_POST['Tanggal_Lahir_Pengguna'] ?? '';
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

        if ($umurPengguna < 17) {
            $pesanKesalahan .= "Umur pengguna harus 17 tahun atau lebih untuk memperbarui data. ";
            setPesanKesalahan($pesanKesalahan);
            header("Location: " . $akarUrl . "src/user/pages/profile.php");
            exit;
        }
    }

    $nomorTeleponFormatted = preg_replace('/\D/', '', $noTeleponPengguna);

    if (strpos($nomorTeleponFormatted, '62') === 0) {
        $nomorTeleponFormatted = '+' . $nomorTeleponFormatted;
    } elseif (strpos($nomorTeleponFormatted, '0') === 0) {
        $nomorTeleponFormatted = '+62' . substr($nomorTeleponFormatted, 1);
    }

    $nomorTeleponFormatted = '' . substr($nomorTeleponFormatted, 0, 3) . ' ' . substr($nomorTeleponFormatted, 3, 3) . '-' . substr($nomorTeleponFormatted, 6, 4) . '-' . substr($nomorTeleponFormatted, 10);

    $penggunaModel = new Pengguna($koneksi);

    $dataPengguna = array(
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
        setPesanKeberhasilan("Berhasil, data pengguna berhasil diperbarui.");
    } else {
        setPesanKesalahan("Gagal memperbarui data pengguna.");
    }
    header("Location: " . $akarUrl . "src/user/pages/profile.php");
    exit;
} else {
    header("Location: " . $akarUrl . "src/user/pages/profile.php");
    exit;
}

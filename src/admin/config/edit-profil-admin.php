<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipAdmin = $_SESSION['NIP_Admin'];
    $namaLengkapAdmin = $_POST['Nama_Lengkap_Admin'] ?? '';
    $noTeleponAdmin = $_POST['No_Telepon_Admin'] ?? '';
    $jenisKelaminAdmin = $_POST['Jenis_Kelamin_Admin'] ?? '';
    $peranAdmin = $_POST['Peran_Admin'] ?? '';
    $pesanKesalahan = '';

    $nomorTeleponFormatted = preg_replace('/\D/', '', $noTeleponAdmin);
    if (strpos($nomorTeleponFormatted, '62') === 0) {
        $nomorTeleponFormatted = '+' . $nomorTeleponFormatted;
    } elseif (strpos($nomorTeleponFormatted, '0') === 0) {
        $nomorTeleponFormatted = '+62' . substr($nomorTeleponFormatted, 1);
    }
    $nomorTeleponFormatted = '' . substr($nomorTeleponFormatted, 0, 3) . ' ' . substr($nomorTeleponFormatted, 3, 3) . '-' . substr($nomorTeleponFormatted, 6, 4) . '-' . substr($nomorTeleponFormatted, 10);

    $tanggalLahirAdmin = $_SESSION['Tanggal_Lahir_Admin'] ?? '';
    $jabatanAdmin = $_SESSION['Jabatan_Admin'] ?? '';
    $umurAdmin = $_SESSION['Umur_Admin'] ?? '';

    $dataAdmin = array(
        'NIP_Admin' => $nipAdmin,
        'Nama_Lengkap_Admin' => $namaLengkapAdmin,
        'Tanggal_Lahir_Admin' => $tanggalLahirAdmin,
        'Peran_Admin' => $peranAdmin,
        'Jabatan_Admin' => $jabatanAdmin,
        'Jenis_Kelamin_Admin' => $jenisKelaminAdmin,
        'No_Telepon_Admin' => $nomorTeleponFormatted,
        'Umur_Admin' => $umurAdmin
    );

    $adminModel = new Admin($koneksi);
    $updateDataAdmin = $adminModel->perbaruiProfilAdmin($nipAdmin, $dataAdmin);

    if ($updateDataAdmin) {
        setPesanKeberhasilan("Berhasil, data admin berhasil diperbarui.");
    } else {
        setPesanKesalahan("Gagal memperbarui data admin.");
    }

    header("Location: " . $akarUrl . "src/admin/pages/profile.php");
    exit;
} else {
    header("Location: " . $akarUrl . "src/admin/pages/profile.php");
    exit;
}

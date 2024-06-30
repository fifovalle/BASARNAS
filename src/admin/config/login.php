<?php
include 'databases.php';

$adminDatabase = new Admin($koneksi);

if (isset($_POST['Masuk'])) {
    $nipAdmin = $_POST['NIP_Admin'];
    $kataSandiAdmin = $_POST['Kata_Sandi_Admin'];

    if (empty($nipAdmin) || empty($kataSandiAdmin)) {
        setPesanKesalahan("Semua field harus diisi.");
        header("Location: $akarUrl" . "src/admin/pages/login.php");
        exit();
    }

    $admin = $adminDatabase->autentikasiAdmin($nipAdmin, $kataSandiAdmin);

    if ($admin === null) {
        setPesanKesalahan("Maaf, NIP Admin atau kata sandi yang Anda masukkan tidak ditemukan.");
        header("Location: $akarUrl" . "src/admin/pages/login.php");
        exit();
    }

    $_SESSION['NIP_Admin'] = htmlspecialchars($admin['NIP_Admin']);
    $_SESSION['Peran_Admin'] = htmlspecialchars($admin['Peran_Admin']);
    $_SESSION['Foto_Admin'] = htmlspecialchars($admin['Foto_Admin']);
    $_SESSION['Nama_Lengkap_Admin'] = htmlspecialchars($admin['Nama_Lengkap_Admin']);
    $_SESSION['No_Telepon_Admin'] = htmlspecialchars($admin['No_Telepon_Admin']);
    $_SESSION['Jenis_Kelamin_Admin'] = htmlspecialchars($admin['Jenis_Kelamin_Admin']);
    $_SESSION['Alamat_Admin'] = htmlspecialchars($admin['Alamat_Admin']);

    setPesanKeberhasilan("Selamat datang, " . $_SESSION['Nama_Lengkap_Admin'] . "!");
    header("Location: $akarUrl" . "src/admin/index.php");
    exit();
}

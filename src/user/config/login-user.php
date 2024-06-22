<?php
include 'databases.php';

$penggunaDatabase = new Pengguna($koneksi);

if (isset($_POST['Masuk'])) {
    $nipPengguna = $_POST['NIP_Pengguna'];
    $kataSandiPengguna = $_POST['Kata_Sandi_Pengguna'];

    if (empty($nipPengguna) || empty($kataSandiPengguna)) {
        setPesanKesalahan("Semua field harus diisi.");
        header("Location: $akarUrl" . "src/user/pages/login.php");
        exit();
    }

    $pengguna = $penggunaDatabase->autentikasiPengguna($nipPengguna, $kataSandiPengguna);

    if ($pengguna === null) {
        setPesanKesalahan("Maaf, NIP Pengguna atau kata sandi yang Anda masukkan tidak ditemukan.");
        header("Location: $akarUrl" . "src/user/pages/login.php");
        exit();
    }

    $_SESSION['NIP_Pengguna'] = htmlspecialchars($pengguna['NIP_Pengguna']);
    $_SESSION['Foto_Pengguna'] = htmlspecialchars($pengguna['Foto_Pengguna']);
    $_SESSION['Nama_Lengkap_Pengguna'] = htmlspecialchars($pengguna['Nama_Lengkap_Pengguna']);
    $_SESSION['No_Telepon_Pengguna'] = htmlspecialchars($pengguna['No_Telepon_Pengguna']);
    $_SESSION['Jenis_Kelamin_Pengguna'] = htmlspecialchars($pengguna['Jenis_Kelamin_Pengguna']);
    $_SESSION['Alamat_Pengguna'] = htmlspecialchars($pengguna['Alamat_Pengguna']);

    setPesanKeberhasilan("Selamat datang, " . $_SESSION['Nama_Lengkap_Pengguna'] . "!");
    header("Location: $akarUrl" . "src/user/pages/index.php");
    exit();
}

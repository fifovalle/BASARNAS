<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $garjasWanitaSitUp2Model = new GarjasWanitaSitUp2($koneksi);
    $hapusData = $garjasWanitaSitUp2Model->hapusDataGarjasWanitaSitUp2($id);

    $successMessage = htmlspecialchars("Data Garjas Sit Up Kaki Di Tekuk Wanita berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus Sit Up Kaki Di Tekuk Wanita.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-situp2.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-situp2.php");
    exit();
}

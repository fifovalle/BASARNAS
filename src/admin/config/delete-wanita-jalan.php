<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $wanitaJalanModel = new TesJalanKaki5KMWanita($koneksi);
    $hapusData = $wanitaJalanModel->hapusTesJalanKaki5KMWanita($id);

    $successMessage = htmlspecialchars("Data Wanita Jalan berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus data Wanita Jalan.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-jalan.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-jalan.php");
    exit();
}

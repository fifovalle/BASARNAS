<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $garjasWanitaChinUpModel = new GarjasWanitaChinUp($koneksi);
    $hapusData = $garjasWanitaChinUpModel->hapusDataGarjasWanitaChinUp($id);

    $successMessage = htmlspecialchars("Data Garjas Chin Up Wanita berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus data Garjas Chin Up Wanita.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-chinup.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-chinup.php");
    exit();
}

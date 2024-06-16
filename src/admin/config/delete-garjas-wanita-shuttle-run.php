<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $garjasWanitaShuttleRunModel = new GarjasWanitaShuttleRun($koneksi);
    $hapusData = $garjasWanitaShuttleRunModel->hapusDataGarjasWanitaShuttleRun($id);

    $successMessage = htmlspecialchars("Data Garjas Shuttle Run Wanita berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus data Garjas Shuttle Run Wanita.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-shuttlerun.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-shuttlerun.php");
    exit();
}

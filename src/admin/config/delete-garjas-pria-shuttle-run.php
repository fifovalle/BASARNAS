<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $garjasPriaShuttleRunModel = new GarjasPriaShuttleRun($koneksi);
    $hapusData = $garjasPriaShuttleRunModel->hapusDataGarjasPriaShuttleRun($id);
    $successMessage = htmlspecialchars("Data Garjas pria Shuttle Run berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus pria Shuttle Run.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-shuttlerun.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-shuttlerun.php");
    exit();
}

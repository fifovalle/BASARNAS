<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $garjasChinUpPriaModel = new GarjasChinUpPria($koneksi);
    $hapusData = $garjasChinUpPriaModel->hapusDataGarjasPriaChinUp($id);
    $successMessage = htmlspecialchars("Data Garjas pria Shuttle Run berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus pria Shuttle Run.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-chinup.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-chinup.php");
    exit();
}

<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $garjasPriaSitUp1Model = new GarjasPriaSitUpKakiLurus($koneksi);
    $hapusData = $garjasPriaSitUp1Model->hapusDataGarjasPriaSitUp1($id);

    $successMessage = htmlspecialchars("Data Garjas Sit Up kaki lurus Pria berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus data Garjas Sit Up kaki lurus Pria.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-situp1.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-situp1.php");
    exit();
}

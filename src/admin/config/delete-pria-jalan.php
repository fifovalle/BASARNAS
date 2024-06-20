<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $priaJalanModel = new TesJalanKaki5KMPria($koneksi);
    $hapusData = $priaJalanModel->hapusTesJalanKaki5KMPria($id);

    $successMessage = htmlspecialchars("Data Pria Jalan berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus data Pria Jalan.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-jalan.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-jalan.php");
    exit();
}

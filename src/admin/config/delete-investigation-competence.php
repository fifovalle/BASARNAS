<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $kompetensiPenyeliaModel = new Kompetensi($koneksi);
    $hapusData = $kompetensiPenyeliaModel->hapusKompetensi($id);

    $successMessage = htmlspecialchars("Data sertifikat penyelia berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus data sertifikat penyelia.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-investigation-competence.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-investigation-competence.php");
    exit();
}

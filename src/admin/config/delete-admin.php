<?php
session_start();

include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $nipAdminAktif = $_SESSION['NIP_Admin'] ?? '';
    $nipAdminDefault = '12345';

    $adminModel = new Admin($koneksi);
    $nipAdminYangAkanDihapus = $adminModel->getNIPAdminById($id);

    if ($nipAdminAktif === $nipAdminDefault && $nipAdminAktif == $nipAdminYangAkanDihapus) {
        setPesanKesalahan("Anda tidak dapat menghapus diri sendiri.");
        header("Location: " . $akarUrl . "src/admin/pages/data-admin.php");
        exit();
    }

    if ($nipAdminAktif !== $nipAdminDefault && $nipAdminYangAkanDihapus === $nipAdminDefault) {
        setPesanKesalahan("Anda tidak dapat menghapus admin default.");
        header("Location: " . $akarUrl . "src/admin/pages/data-admin.php");
        exit();
    }

    $hapusData = $adminModel->hapusAdmin($id);
    $successMessage = htmlspecialchars("Data admin berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus data admin.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-admin.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-admin.php");
    exit();
}

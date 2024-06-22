<?php
include 'databases.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $id = intval($id);

    $garjasPriaFlexedArmHangModel = new GarjasPriaFlexedArmHang($koneksi);
    $hapusData = $garjasPriaFlexedArmHangModel->hapusDataGarjasPriaFlexedArmHang($id);
    $successMessage = htmlspecialchars("Data Garjas pria Flexed Arm Hang berhasil dihapus.");
    $failureMessage = htmlspecialchars("Gagal menghapus pria Flexed Arm Hang.");
    $errorMessage = htmlspecialchars("Halaman tidak dapat diakses.");

    $responseMessage = $hapusData ? $successMessage : $failureMessage;
    $sessionKey = $hapusData ? 'berhasil' : 'gagal';

    setPesanKeberhasilan($hapusData ? $successMessage : '');
    setPesanKesalahan(!$hapusData ? $failureMessage : '');

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-flexedarmhang.php");
    exit();
} else {
    $errorMessage = "Halaman tidak dapat diakses.";
    setPesanKesalahan($errorMessage);

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-flexedarmhang.php");
    exit();
}

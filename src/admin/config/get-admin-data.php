<?php
include 'databases.php';

$adminModel = new Admin($koneksi);
$nipAdmin = isset($_GET['admin_nip']) ? $_GET['admin_nip'] : null;

if ($nipAdmin) {
    $dataAdmin = $adminModel->tampilkanAdmin($nipAdmin);

    if ($dataAdmin) {
        echo json_encode($dataAdmin);
    } else {
        echo json_encode(array("success" => false, "message" => "Admin tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "NIP Admin tidak diberikan."));
}

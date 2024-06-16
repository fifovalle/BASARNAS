<?php
include 'databases.php';

$adminModel = new Admin($koneksi);

$adminNIP = isset($_GET['admin_nip']) ? $_GET['admin_nip'] : null;
$dataAdmin = $adminModel->tampilkanDataAdmin($adminNIP);

$adminDitemukan = null;

foreach ($dataAdmin as $admin) {
    $adminDitemukan = $admin['NIP_Admin'] == $adminNIP ? $admin : null;
    if ($adminDitemukan) {
        break;
    }
}

echo json_encode($adminDitemukan);
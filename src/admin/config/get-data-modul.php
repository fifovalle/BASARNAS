<?php
include 'databases.php';

$modulModel = new Modul($koneksi);

$modul = isset($_GET['modul_id']) ? $_GET['modul_id'] : null;
$dataModul = $modulModel->tampilkanDataModul($modul);

$modulDitemukan = null;

foreach ($dataModul as $modulSaja) {
    $modulDitemukan = $modulSaja['ID_Modul'] == $modul ? $modulSaja : null;
    if ($modulDitemukan) {
        break;
    }
}

echo json_encode($modulDitemukan);

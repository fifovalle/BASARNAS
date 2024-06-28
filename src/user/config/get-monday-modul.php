<?php
require 'databases.php';

$tanggalSenin = $_POST['Tanggal'];
$modulModel = new Pengguna($koneksi);

$modulInfo = $modulModel->tampilkanModulSesuaiNIPHariSenin($tanggalSenin);

$response = [
    'modul_tersedia' => false,
    'html' => ''
];

if ($modulInfo) {
    $response['modul_tersedia'] = true;
    foreach ($modulInfo as $modul) {
        $file_path = '../../admin/uploads/' . $modul['File_Modul'];
        if (file_exists($file_path)) {
            $response['html'] .= '<embed src="' . $file_path . '" type="application/pdf" width="730px" height="600px" />';
        } else {
            $response['html'] .= '<p>File tidak ditemukan untuk modul dengan nama: ' . htmlspecialchars($modul['Nama_Modul']) . '</p>';
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);

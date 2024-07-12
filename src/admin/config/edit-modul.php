<?php
include 'databases.php';

function containsXSS($input)
{
    $xssPatterns = [
        "/<script\b[^>]*>(.*?)<\/script>/is",
        "/<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:/i",
        "/<iframe\b[^>]*>(.*?)<\/iframe>/is",
        "/<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:/i",
        "/<object\b[^>]*>(.*?)<\/object>/is",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/<script\b[^>]*>[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i",
        "/<a\b[^>]*href\s*=\s*(?:\"|')(?:javascript:|.*?\"javascript:).*?(?:\"|')/i",
        "/<embed\b[^>]*>(.*?)<\/embed>/is",
        "/<applet\b[^>]*>(.*?)<\/applet>/is",
        "/<!--.*?-->/",
        "/(<script\b[^>]*>(.*?)<\/script>|<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:|<iframe\b[^>]*>(.*?)<\/iframe>|<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:|<object\b[^>]*>(.*?)<\/object>|on[a-zA-Z]+\s*=\s*\"[^\"]*\"|<[^>]*(>|$)(?:<|>)+|<[^>]*script\s*.*?(?:>|$)|<![^>]*-->|eval\s*\((.*?)\)|setTimeout\s*\((.*?)\)|<[^>]*\bstyle\s*=\s*[\"'][^\"']*[;{][^\"']*['\"]|<meta[^>]*http-equiv=[\"']?refresh[\"']?[^>]*url=|<[^>]*src\s*=\s*\"[^>]*\"[^>]*>|expression\s*\((.*?)\))/i"
    ];

    foreach ($xssPatterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $idModul = $_POST['ID_Modul'] ?? '';
    $namaModul = $_POST['Nama_Modul'] ?? '';
    $judulModul = $_POST['Judul_Modul'] ?? '';
    $tanggalModul = $_POST['Tanggal_Terbit_Modul'] ?? '';
    $deskripsiModul = $_POST['Deskripsi_Modul'] ?? '';

    $pesanKesalahan = '';

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $modulModel = new Modul($koneksi);

    if (!empty($_FILES['File_Modul']['name'])) {
        $fileModul = $_FILES['File_Modul'];
        $namaFotoAsli = $fileModul['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fileModul['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFileLama = $modulModel->getFileModulOlehID($idModul);
        if (!empty($namaFileLama)) {
            $lokasiFileLama = "../uploads/" . $namaFileLama;
            if (file_exists($lokasiFileLama)) {
                unlink($lokasiFileLama);
            }
        }
    } else {
        $namaFotoBaru = $modulModel->getFileModulOlehID($idModul);
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $dataModul = array(
        'File_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($namaFotoBaru)),
        'Nama_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($namaModul)),
        'Judul_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($judulModul)),
        'Tanggal_Terbit_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($tanggalModul)),
        'Deskripsi_Modul' => mysqli_real_escape_string($koneksi, htmlspecialchars($deskripsiModul)),
    );

    $updateDataModul = $modulModel->perbaruiModul($idModul, $dataModul);

    if ($updateDataModul) {
        echo json_encode(array("success" => true, "message" => "Data modul berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data modul."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

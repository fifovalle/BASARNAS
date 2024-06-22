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

if (isset($_POST['tambah_nilai'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    $obyekPenggunaWanita = new TesLariWanita($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $waktuTestLariWanita = mysqli_real_escape_string($koneksi, $_POST['Waktu_Lari_Wanita']);
    $umurPengguna = $obyekPenggunaWanita->ambilUmurTesLariWanitaOlehNIP($nipPengguna);
    if ($obyekPenggunaWanita->cekNipAnggotaTesLariWanitaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-Wanita-lari.php");
        exit;
    }

    $nilaiTesLari = [
        38 => 100, 37 => 98, 36 => 96, 35 => 94, 34 => 92,
        33 => 89, 32 => 87, 31 => 85, 30 => 83, 29 => 81,
        28 => 79, 27 => 77, 26 => 75, 25 => 73, 24 => 70,
        23 => 68, 22 => 66, 21 => 64, 20 => 62, 19 => 60,
        18 => 58, 17 => 56, 16 => 54, 14 => 49, 13 => 47,
        12 => 45, 11 => 43, 10 => 41, 9 => 37, 8 => 32,
        7 => 27, 6 => 23, 5 => 19, 4 => 14, 3 => 10, 2 => 5, 1 => 1
    ];

    $nilaiAkhir = ($umurPengguna < 25 && isset($nilaiTesLari[$waktuTestLariWanita])) ? $nilaiTesLari[$waktuTestLariWanita] : 0;

    $dataPenggunaWanita = array(
        'NIP_Pengguna' => $nipPengguna,
        'Waktu_Lari_Wanita' => $waktuTestLariWanita,
        'Nilai_Lari_Wanita' => $nilaiAkhir,
    );

    $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahTesLariWanita($dataPenggunaWanita);

    if ($simpanDataPenggunaWanita) {
        setPesanKeberhasilan("Berhasil, data pengguna wanita baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna wanita.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-lari.php");
    exit;
}
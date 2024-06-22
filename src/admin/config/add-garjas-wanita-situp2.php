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
    $obyekPenggunaWanita = new GarjasWanitaSitUp2($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $jumlahSitUp2Wanita = mysqli_real_escape_string($koneksi, $_POST['Jumlah_Sit_Up_2_Wanita']);
    $umurPengguna = $obyekPenggunaWanita->ambilUmurGarjasWanitaSitUp2OlehNIP($nipPengguna);
    if ($obyekPenggunaWanita->cekNipAnggotaSitUp2WanitaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-situp2.php");
        exit;
    }

    $nilaiSitUp2 = [
        44 => 100, 43 => 96, 42 => 91, 41 => 87, 40 => 83,
        39 => 78, 38 => 74, 37 => 70, 36 => 65, 35 => 61,
        34 => 59, 33 => 57, 32 => 56, 31 => 54, 30 => 52,
        29 => 50, 28 => 49, 27 => 47, 26 => 45, 25 => 43,
        24 => 42, 23 => 40, 22 => 38, 21 => 36, 20 => 35,
        19 => 33, 18 => 31, 17 => 29, 16 => 27, 15 => 26,
        14 => 24, 13 => 22, 12 => 20, 11 => 19, 10 => 17,
        9 => 15, 8 => 13, 7 => 12, 6 => 10, 5 => 8,
        4 => 6, 3 => 5, 2 => 3, 1 => 1
    ];

    $nilaiAkhir = ($umurPengguna < 25 && isset($nilaiSitUp2[$jumlahSitUp2Wanita])) ? $nilaiSitUp2[$jumlahSitUp2Wanita] : 0;



    $dataPenggunaWanita = array(
        'NIP_Pengguna' => $nipPengguna,
        'Jumlah_Sit_Up_2_Wanita' => $jumlahSitUp2Wanita,
        'Nilai_Sit_Up_2_Wanita' => $nilaiAkhir,
    );

    $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahGarjasWanitaSitUp2($dataPenggunaWanita);

    if ($simpanDataPenggunaWanita) {
        setPesanKeberhasilan("Berhasil, data pengguna baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-situp2.php");
    exit;
}

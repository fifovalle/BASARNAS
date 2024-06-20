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

    $obyekPenggunaWanita = new GarjasWanitaShuttleRun($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $jumlahShuttleRunWanita = mysqli_real_escape_string($koneksi, $_POST['Jumlah_Shuttle_Run_Wanita']);
    $umurPengguna = $obyekPenggunaWanita->ambilUmurGarjasWanitaShuttlerunOlehNIP($nipPengguna);

    $nilaiShuttleRun = [
        38 => 100, 37 => 98, 36 => 96, 35 => 94, 34 => 92,
        33 => 89, 32 => 87, 31 => 85, 30 => 83, 29 => 81,
        28 => 79, 27 => 77, 26 => 75, 25 => 73, 24 => 70,
        23 => 68, 22 => 66, 21 => 64, 20 => 62, 19 => 60,
        18 => 58, 17 => 56, 16 => 54, 14 => 49, 13 => 47,
        12 => 45, 11 => 43, 10 => 41, 9 => 37, 8 => 32,
        7 => 27, 6 => 23, 5 => 19, 4 => 14, 3 => 10, 2 => 5, 1 => 1
    ];

    $nilaiAkhir = ($umurPengguna < 25 && isset($nilaiShuttleRun[$jumlahShuttleRunWanita])) ? $nilaiShuttleRun[$jumlahShuttleRunWanita] : 0;

    $dataPenggunaWanita = array(
        'NIP_Pengguna' => $nipPengguna,
        'Jumlah_Shuttle_Run_Wanita' => $jumlahShuttleRunWanita,
        'Nilai_Shuttle_Run_Wanita' => $nilaiAkhir,
    );

    $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahGarjasWanitaShuttleRun($dataPenggunaWanita);

    if ($simpanDataPenggunaWanita) {
        setPesanKeberhasilan("Berhasil, data pengguna wanita baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna wanita.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-shuttlerun.php");
    exit;
}

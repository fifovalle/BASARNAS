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
    $obyekWanitaJalan = new TesJalanKaki5KMWanita($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $waktuJalan = mysqli_real_escape_string($koneksi, $_POST['Waktu_Jalan']);
    $umurPengguna = $obyekWanitaJalan->ambilUmurTesJalanKaki5KMWanitaOlehNIP($nipPengguna);
    if ($obyekWanitaJalan->cekNipAnggotaTesJalanKaki5KMWanitaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-jalan.php");
        exit;
    }

    if (empty($waktuJalan) || $nipPengguna == '') {
        setPesanKesalahan("Semua data harus diisi.");
        header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-jalan.php");
        exit;
    }

    $nilaiJalanKaki = [
        'di_bawah_25' => [
            17.0 => 100,
        ],
        '25-34' => [
            19.0 => 100,
        ],
        '35-44' => [
            21.0 => 100,
        ],
        '45-54' => [
            23.0 => 100
        ],
        '55-59' => [
            25.0 => 100
        ]
    ];

    $nilaiAkhir = 0;
    if ($umurPengguna < 25) {
        $nilaiAkhir = isset($nilaiJalanKaki['di_bawah_25'][$waktuJalan]) ? $nilaiJalanKaki['di_bawah_25'][$waktuJalan] : 0;
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $nilaiAkhir = isset($nilaiJalanKaki['25-34'][$waktuJalan]) ? $nilaiJalanKaki['25-34'][$waktuJalan] : 0;
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $nilaiAkhir = isset($nilaiJalanKaki['35-44'][$waktuJalan]) ? $nilaiJalanKaki['35-44'][$waktuJalan] : 0;
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $nilaiAkhir = isset($nilaiJalanKaki['45-54'][$waktuJalan]) ? $nilaiJalanKaki['45-54'][$waktuJalan] : 0;
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $nilaiAkhir = isset($nilaiJalanKaki['55-59'][$waktuJalan]) ? $nilaiJalanKaki['55-59'][$waktuJalan] : 0;
    }

    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Waktu_Jalan_Wanita' => $waktuJalan,
        'Nilai_Jalan_Wanita' => $nilaiAkhir,
    );

    $simpanDataPengguna = $obyekWanitaJalan->tambahTesJalanKaki5KMWanita($dataPengguna);

    if ($simpanDataPengguna) {
        setPesanKeberhasilan("Berhasil, data wanita jalan baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data wanita jalan.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-jalan.php");
    exit;
}

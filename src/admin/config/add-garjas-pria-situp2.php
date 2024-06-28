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

if (isset($_POST['Simpan'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $obyekGarjasPriaSitUpKakiDitekuk = new GarjasPriaSitUpKakiDitekuk($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $jumlahSitUpKakiDitekukPria = mysqli_real_escape_string($koneksi, $_POST['Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria']);
    $tanggalPelaksanaanSitUp2Pria = $_POST['Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk'];
    $tanggal_pelaksanaan_situp2_pria = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanSitUp2Pria);

    if ($tanggal_pelaksanaan_situp2_pria === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_situp2_pria->format('Y-m-d');
    }

    $umurPengguna = $obyekGarjasPriaSitUpKakiDitekuk->ambilUmurGarjasSitUp2PriaOlehNIP($nipPengguna);

    if ($obyekGarjasPriaSitUpKakiDitekuk->cekNipAnggotaSitUp2PriaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-situp2.php");
        exit;
    }

    if ($jumlahSitUpKakiDitekukPria == 0) {
        setPesanKesalahan("Jumlah Sit Up Kaki Ditekuk tidak boleh 0.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-situp2.php");
        exit;
    }

    $nilaiSitUpKakiDitekuk = [
        'under_25' => [
            '>48' => 100,
            84 => 100, 83 => 98, 82 => 96, 81 => 94, 80 => 92,
            79 => 90, 78 => 88, 77 => 86, 76 => 84, 75 => 82,
            74 => 79, 73 => 77, 72 => 75, 71 => 73, 70 => 71,
            69 => 69, 68 => 67, 67 => 65, 66 => 63, 65 => 61,
            64 => 60, 63 => 59, 62 => 58, 61 => 57, 60 => 56,
            59 => 55, 58 => 54, 57 => 54, 56 => 53, 55 => 52,
            54 => 51, 53 => 50, 52 => 49, 51 => 48, 50 => 47,
            49 => 46, 48 => 45, 47 => 44, 46 => 43, 45 => 42,
            44 => 41, 43 => 40, 42 => 39, 41 => 39, 40 => 38,
            39 => 37, 38 => 36, 37 => 35, 36 => 34, 35 => 33,
            34 => 32, 33 => 31, 32 => 30, 31 => 29, 30 => 28,
            29 => 27, 28 => 26, 27 => 25, 26 => 24, 25 => 24,
            24 => 23, 23 => 22, 22 => 21, 21 => 20, 20 => 19,
            19 => 18, 18 => 17, 17 => 16, 16 => 15, 15 => 14,
            14 => 13, 13 => 12, 12 => 11, 11 => 10, 10 => 9,
            9 => 9, 8 => 8, 7 => 7, 6 => 6, 5 => 5,
            4 => 4, 3 => 3, 2 => 2, 1 => 1
        ],

        '25-34' => [
            '>74' => 100,
            74 => 100, 73 => 98, 72 => 96, 71 => 94, 70 => 92,
            69 => 90, 68 => 88, 67 => 86, 66 => 84, 65 => 82,
            64 => 79, 63 => 77, 62 => 75, 61 => 73, 60 => 71,
            59 => 69, 58 => 67, 57 => 65, 56 => 63, 55 => 61,
            54 => 60, 53 => 59, 52 => 58, 51 => 57, 50 => 56,
            49 => 54, 48 => 53, 47 => 52, 46 => 51, 45 => 50,
            44 => 49, 43 => 48, 42 => 47, 41 => 45, 40 => 44,
            39 => 43, 38 => 42, 37 => 41, 36 => 40, 35 => 39, 34 => 38,
            33 => 37, 32 => 35, 31 => 34, 30 => 33, 29 => 32, 28 => 31,
            27 => 30, 26 => 29, 25 => 28, 24 => 27, 23 => 25, 22 => 24,
            21 => 23, 20 => 22, 19 => 21, 18 => 20, 17 => 19, 16 => 18,
            15 => 17, 14 => 15, 13 => 14, 12 => 13, 11 => 12, 10 => 11,
            9 => 10, 8 => 9, 7 => 8, 6 => 7, 5 => 6, 4 => 5, 3 => 4,
            2 => 3, 1 => 2
        ],

        '35-44' => [
            '>64' => 100,
            64 => 100, 63 => 98, 62 => 96, 61 => 94, 60 => 92,
            59 => 90, 58 => 88, 57 => 86, 56 => 84, 55 => 82,
            54 => 79, 53 => 77, 52 => 75, 51 => 73, 50 => 71,
            49 => 69, 48 => 67, 47 => 65, 46 => 63, 45 => 61,
            44 => 60, 43 => 58, 42 => 57, 41 => 56, 40 => 54,
            39 => 53, 38 => 51, 37 => 50, 36 => 49, 35 => 47,
            34 => 46, 33 => 45, 32 => 43, 31 => 42, 30 => 41, 29 => 39,
            28 => 38, 27 => 36, 26 => 35, 25 => 34, 24 => 32, 23 => 31,
            22 => 30, 21 => 28, 20 => 27, 19 => 26, 18 => 24, 17 => 23,
            16 => 21, 15 => 20, 14 => 19, 13 => 17, 12 => 16, 11 => 15,
            10 => 13, 9 => 12, 8 => 11, 7 => 9, 6 => 8, 5 => 7, 4 => 6,
            3 => 5, 2 => 4, 1 => 3
        ],

        '45-54' => [
            '>54' => 100,
            54 => 100, 53 => 98, 52 => 96, 51 => 94, 50 => 92,
            49 => 90, 48 => 88, 47 => 86, 46 => 84, 45 => 82,
            44 => 79, 43 => 77, 42 => 75, 41 => 73, 40 => 71,
            39 => 69, 38 => 67, 37 => 65, 36 => 63, 35 => 61,
            34 => 59, 33 => 57, 32 => 56, 31 => 54, 30 => 52,
            29 => 51, 28 => 49, 27 => 47, 26 => 45, 25 => 43,
            24 => 41, 23 => 40, 22 => 38, 21 => 36, 20 => 35, 19 => 33,
            18 => 31, 17 => 29, 16 => 27, 15 => 26, 14 => 24, 13 => 22,
            12 => 20, 11 => 19, 10 => 17, 9 => 15, 8 => 13, 7 => 12,
            6 => 10, 5 => 9, 4 => 7, 3 => 6, 2 => 5, 1 => 4
        ],

        '55-59' => [
            '>44' => 100,
            44 => 100, 43 => 98, 42 => 96, 41 => 94, 40 => 92,
            39 => 90, 38 => 88, 37 => 86, 36 => 84, 35 => 82,
            34 => 79, 33 => 77, 32 => 75, 31 => 73, 30 => 71,
            29 => 69, 28 => 67, 27 => 65, 26 => 63, 25 => 61,
            24 => 59, 23 => 56, 22 => 54, 21 => 51, 20 => 49,
            19 => 46, 18 => 44, 17 => 41, 16 => 39, 15 => 36,
            14 => 34, 13 => 31, 12 => 29, 11 => 26, 10 => 24,
            9 => 21, 8 => 19, 7 => 17, 6 => 15, 5 => 13,
            4 => 11, 3 => 9, 2 => 7, 1 => 5
        ],
    ];

    $nilaiAkhirSitUpKakiDitekuk = 0;
    if ($umurPengguna < 25) {
        if ($jumlahSitUpKakiDitekukPria > 48 && isset($nilaiSitUpKakiDitekuk['under_25']['>48'])) {
            $nilaiAkhirSitUpKakiDitekuk = $nilaiSitUpKakiDitekuk['under_25']['>48'];
        } else {
            $nilaiAkhirSitUpKakiDitekuk = isset($nilaiSitUpKakiDitekuk['under_25'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['under_25'][$jumlahSitUpKakiDitekukPria] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($jumlahSitUpKakiDitekukPria > 74 && isset($nilaiSitUpKakiDitekuk['25-34']['>74'])) {
            $nilaiAkhirSitUpKakiDitekuk = $nilaiSitUpKakiDitekuk['25-34']['>74'];
        } else {
            $nilaiAkhirSitUpKakiDitekuk = isset($nilaiSitUpKakiDitekuk['25-34'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['25-34'][$jumlahSitUpKakiDitekukPria] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($jumlahSitUpKakiDitekukPria > 64 && isset($nilaiSitUpKakiDitekuk['35-44']['>64'])) {
            $nilaiAkhirSitUpKakiDitekuk = $nilaiSitUpKakiDitekuk['35-44']['>64'];
        } else {
            $nilaiAkhirSitUpKakiDitekuk = isset($nilaiSitUpKakiDitekuk['35-44'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['35-44'][$jumlahSitUpKakiDitekukPria] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($jumlahSitUpKakiDitekukPria > 54 && isset($nilaiSitUpKakiDitekuk['45-54']['>54'])) {
            $nilaiAkhirSitUpKakiDitekuk = $nilaiSitUpKakiDitekuk['45-54']['>54'];
        } else {
            $nilaiAkhirSitUpKakiDitekuk = isset($nilaiSitUpKakiDitekuk['45-54'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['45-54'][$jumlahSitUpKakiDitekukPria] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($jumlahSitUpKakiDitekukPria > 44 && isset($nilaiSitUpKakiDitekuk['55-59']['>44'])) {
            $nilaiAkhirSitUpKakiDitekuk = $nilaiSitUpKakiDitekuk['55-59']['>44'];
        } else {
            $nilaiAkhirSitUpKakiDitekuk = isset($nilaiSitUpKakiDitekuk['55-59'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['55-59'][$jumlahSitUpKakiDitekukPria] : 0;
        }
    }

    $dataGarjasPriaSitUpKakiDitekuk = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk' => $tanggalPelaksanaanSitUp2Pria,
        'Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria' => $jumlahSitUpKakiDitekukPria,
        'Nilai_Sit_Up_Kaki_Di_Tekuk_Pria' => $nilaiAkhirSitUpKakiDitekuk,
    );

    $simpanDataGarjasPriaSitUpKakiDitekuk = $obyekGarjasPriaSitUpKakiDitekuk->tambahGarjasPriaSitUp2($dataGarjasPriaSitUpKakiDitekuk);

    if ($simpanDataGarjasPriaSitUpKakiDitekuk) {
        setPesanKeberhasilan("Berhasil, data Anggota baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data anggota.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-situp2.php");
    exit;
}

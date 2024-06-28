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
    $obyekGarjasPriaFlexedArmHang = new GarjasPriaFlexedArmHang($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $waktuFlexedArmHang = mysqli_real_escape_string($koneksi, $_POST['Waktu_Menggantung_Pria']);
    $tanggalPelaksanaanPriaMenggantung = $_POST['Tanggal_Pelaksanaan_Pria_Menggantung'];
    $tanggal_pelaksanaan_pria_menggantung = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanPriaMenggantung);

    if ($tanggal_pelaksanaan_pria_menggantung === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_pria_menggantung->format('Y-m-d');
    }
    $umurPengguna = $obyekGarjasPriaFlexedArmHang->ambilUmurGarjasFlexedArmHangPriaOlehNIP($nipPengguna);

    if ($obyekGarjasPriaFlexedArmHang->cekNipAnggotaFlexedArmHangPriaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-flexedarmhang.php");
        exit;
    }

    if ($waktuFlexedArmHang == 0) {
        echo json_encode(["success" => false, "message" => "Waktu Flexed Arm Hang tidak boleh 0."]);
        exit;
    }

    $nilaiFlexedArmHang = [
        'under_25' => [
            '>50' => 100,
            50 => 100, 49 => 99, 48 => 97, 47 => 95, 46 => 93,
            45 => 91, 44 => 89, 43 => 87, 42 => 85, 41 => 83,
            40 => 81, 39 => 79, 38 => 77, 37 => 75, 36 => 73,
            35 => 71, 34 => 69, 33 => 67, 32 => 65, 31 => 63,
            30 => 61, 29 => 59, 28 => 57, 27 => 55, 26 => 53,
            25 => 51, 24 => 49, 23 => 47, 22 => 45, 21 => 43,
            20 => 41, 39 => 22, 18 => 37, 17 => 35, 16 => 33,
            15 => 31, 14 => 29, 13 => 26, 12 => 24, 11 => 22,
            10 => 20, 9 => 18, 8 => 16, 7 => 14, 6 => 12,
            5 => 10, 4 => 8, 3 => 6, 2 => 4, 1 => 2
        ],

        '25-34' => [
            '>41' => 100,
            41 => 100, 40 => 98, 39 => 95, 38 => 93, 37 => 90,
            36 => 88, 35 => 85, 34 => 83, 33 => 81, 32 => 78,
            31 => 76, 30 => 73, 29 => 71, 28 => 68, 27 => 66,
            26 => 63, 25 => 61, 24 => 59, 23 => 56, 22 => 54,
            21 => 51, 20 => 49, 19 => 47, 18 => 44, 17 => 42,
            16 => 39, 15 => 37, 14 => 35, 13 => 32, 12 => 30,
            11 => 28, 10 => 25, 9 => 23, 8 => 20, 7 => 18,
            6 => 16, 5 => 13, 4 => 11, 3 => 9, 2 => 6,
            1 => 4
        ],

        '35-44' => [
            '>33' => 100,
            33 => 100, 32 => 98, 31 => 95, 30 => 92, 29 => 88,
            28 => 85, 27 => 82, 26 => 79, 25 => 76, 24 => 73,
            23 => 70, 22 => 67, 21 => 64, 20 => 61, 19 => 58,
            18 => 55, 17 => 52, 16 => 49, 15 => 46, 14 => 43,
            13 => 40, 12 => 37, 11 => 34, 10 => 31, 9 => 29,
            8 => 27, 7 => 24, 6 => 21, 5 => 18, 4 => 15,
            3 => 12, 2 => 9, 1 => 6
        ],

        '45-54' => [
            '>25' => 100,
            25 => 100, 24 => 97, 23 => 93, 22 => 89, 21 => 85,
            20 => 81, 19 => 77, 18 => 73, 17 => 69, 16 => 65,
            15 => 61, 14 => 57, 13 => 53, 12 => 49, 11 => 45,
            10 => 41, 9 => 37, 8 => 33, 7 => 29, 6 => 24,
            5 => 20, 4 => 17, 3 => 14, 2 => 11, 1 => 8
        ],

        '55-59' => [
            '>17' => 100,
            17 => 100, 16 => 96, 15 => 91, 14 => 85, 13 => 79,
            12 => 73, 11 => 67, 10 => 61, 9 => 54, 8 => 48,
            7 => 42, 6 => 36, 5 => 30, 4 => 24, 3 => 18,
            2 => 14, 1 => 10
        ]

    ];

    $nilaiAkhir = 0;

    if ($umurPengguna < 25) {
        $nilaiAkhir = isset($nilaiFlexedArmHang['under_25'][$waktuFlexedArmHang]) ? $nilaiFlexedArmHang['under_25'][$waktuFlexedArmHang] : 0;
        if ($waktuFlexedArmHang > 50 && isset($nilaiFlexedArmHang['under_25']['>50'])) {
            $nilaiAkhir = $nilaiFlexedArmHang['under_25']['>50'];
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $nilaiAkhir = isset($nilaiFlexedArmHang['25-34'][$waktuFlexedArmHang]) ? $nilaiFlexedArmHang['25-34'][$waktuFlexedArmHang] : 0;
        if ($waktuFlexedArmHang > 41 && isset($nilaiFlexedArmHang['25-34']['>41'])) {
            $nilaiAkhir = $nilaiFlexedArmHang['25-34']['>41'];
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $nilaiAkhir = isset($nilaiFlexedArmHang['35-44'][$waktuFlexedArmHang]) ? $nilaiFlexedArmHang['35-44'][$waktuFlexedArmHang] : 0;
        if ($waktuFlexedArmHang > 33 && isset($nilaiFlexedArmHang['35-44']['>33'])) {
            $nilaiAkhir = $nilaiFlexedArmHang['35-44']['>33'];
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $nilaiAkhir = isset($nilaiFlexedArmHang['45-54'][$waktuFlexedArmHang]) ? $nilaiFlexedArmHang['45-54'][$waktuFlexedArmHang] : 0;
        if ($waktuFlexedArmHang > 25 && isset($nilaiFlexedArmHang['45-54']['>25'])) {
            $nilaiAkhir = $nilaiFlexedArmHang['45-54']['>25'];
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $nilaiAkhir = isset($nilaiFlexedArmHang['55-59'][$waktuFlexedArmHang]) ? $nilaiFlexedArmHang['55-59'][$waktuFlexedArmHang] : 0;
        if ($waktuFlexedArmHang > 17 && isset($nilaiFlexedArmHang['55-59']['>17'])) {
            $nilaiAkhir = $nilaiFlexedArmHang['55-59']['>17'];
        }
    }


    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Pria_Menggantung' => $tanggalPelaksanaanPriaMenggantung,
        'Waktu_Menggantung_Pria' => $waktuFlexedArmHang,
        'Nilai_Menggantung_Pria' => $nilaiAkhir,
    );

    $simpanDataPengguna = $obyekGarjasPriaFlexedArmHang->tambahGarjasPriaFlexedArmHang($dataPengguna);

    if ($simpanDataPengguna) {
        setPesanKeberhasilan("Berhasil, data pengguna baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-flexedarmhang.php");
    exit;
}

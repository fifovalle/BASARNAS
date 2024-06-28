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
    $obyekGarjasPriaChinUp = new GarjasChinUpPria($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $jumlahChinUpPria = mysqli_real_escape_string($koneksi, $_POST['Jumlah_Chin_Up_Pria']);
    $tanggalPelaksanaanChinUpPria = mysqli_real_escape_string($koneksi, $_POST['Tanggal_Pelaksanaan_Chin_Up_Pria']);
    $umurPengguna = $obyekGarjasPriaChinUp->ambilUmurGarjasChinUpPriaOlehNIP($nipPengguna);

    if ($obyekGarjasPriaChinUp->cekNipAnggotaChinUpPriaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-chinup.php");
        exit;
    }

    if ($jumlahChinUpPria == 0) {
        echo json_encode(["success" => false, "message" => "Jumlah Chin Up tidak boleh 0."]);
        exit;
    }

    $nilaiChinUp = [
        'under_25' => [
            '>20' => 100,
            20 => 100, 19 => 96, 18 => 92, 17 => 87, 16 => 83,
            15 => 79, 14 => 75, 13 => 70, 12 => 66, 11 => 62,
            10 => 58, 9 => 54, 8 => 49, 7 => 45, 6 => 41,
            5 => 37, 4 => 33, 3 => 28, 2 => 24, 1 => 20
        ],

        '25-34' => [
            '>18' => 100,
            18 => 100, 17 => 96, 16 => 92, 15 => 88, 14 => 84,
            13 => 81, 12 => 77, 11 => 73, 10 => 69, 9 => 65,
            8 => 58, 7 => 52, 6 => 47, 5 => 41, 4 => 37,
            3 => 33, 2 => 28, 1 => 24
        ],

        '35-44' => [
            '>16' => 100,
            16 => 100, 15 => 96, 14 => 92, 13 => 88, 12 => 84,
            11 => 81, 10 => 77, 9 => 73, 8 => 69, 7 => 65,
            6 => 58, 5 => 49, 4 => 41, 3 => 37, 2 => 33,
            1 => 28
        ],

        '45-54' => [
            '>14' => 100,
            14 => 100, 13 => 96, 12 => 91, 11 => 87, 10 => 83,
            9 => 78, 8 => 74, 7 => 70, 6 => 65, 5 => 58,
            4 => 50, 3 => 41, 2 => 37, 1 => 33
        ],

        '55-59' => [
            '>11' => 100,
            11 => 100, 10 => 96, 9 => 91, 8 => 82, 7 => 77,
            6 => 72, 5 => 65, 4 => 58, 3 => 51, 2 => 41,
            1 => 37
        ]

    ];

    $nilaiAkhir = 0;

    if ($umurPengguna < 25) {
        $nilaiAkhir = isset($nilaiChinUp['under_25'][$jumlahChinUpPria]) ? $nilaiChinUp['under_25'][$jumlahChinUpPria] : 0;
        if ($jumlahChinUpPria > 20 && isset($nilaiChinUp['under_25']['>20'])) {
            $nilaiAkhir = $nilaiChinUp['under_25']['>20'];
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $nilaiAkhir = isset($nilaiChinUp['25-34'][$jumlahChinUpPria]) ? $nilaiChinUp['25-34'][$jumlahChinUpPria] : 0;
        if ($jumlahChinUpPria > 18 && isset($nilaiChinUp['25-34']['>18'])) {
            $nilaiAkhir = $nilaiChinUp['25-34']['>18'];
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $nilaiAkhir = isset($nilaiChinUp['35-44'][$jumlahChinUpPria]) ? $nilaiChinUp['35-44'][$jumlahChinUpPria] : 0;
        if ($jumlahChinUpPria > 16 && isset($nilaiChinUp['35-44']['>16'])) {
            $nilaiAkhir = $nilaiChinUp['35-44']['>16'];
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $nilaiAkhir = isset($nilaiChinUp['45-54'][$jumlahChinUpPria]) ? $nilaiChinUp['45-54'][$jumlahChinUpPria] : 0;
        if ($jumlahChinUpPria > 14 && isset($nilaiChinUp['45-54']['>14'])) {
            $nilaiAkhir = $nilaiChinUp['45-54']['>14'];
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $nilaiAkhir = isset($nilaiChinUp['55-59'][$jumlahChinUpPria]) ? $nilaiChinUp['55-59'][$jumlahChinUpPria] : 0;
        if ($jumlahChinUpPria > 11 && isset($nilaiChinUp['55-59']['>11'])) {
            $nilaiAkhir = $nilaiChinUp['55-59']['>11'];
        }
    }


    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Chin_Up_Pria' => $tanggalPelaksanaanChinUpPria,
        'Jumlah_Chin_Up_Pria' => $jumlahChinUpPria,
        'Nilai_Chin_Up_Pria' => $nilaiAkhir,
    );

    $simpanDataPengguna = $obyekGarjasPriaChinUp->tambahGarjasPriaChinUp($dataPengguna);

    if ($simpanDataPengguna) {
        setPesanKeberhasilan("Berhasil, data pengguna baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-chinup.php");
    exit;
}

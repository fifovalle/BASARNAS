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
    $obyekPenggunaWanita = new GarjasWanitaChinUp($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $jumlahChinUpWanita = mysqli_real_escape_string($koneksi, $_POST['Jumlah_Chin_Up_Wanita']);
    $tanggalPelaksanaanChinUpWanita = $_POST['Tanggal_Pelaksanaan_Chin_Up_Wanita'];
    $tanggal_pelaksanaan_chinup_wanita = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanChinUpWanita);

    if ($tanggal_pelaksanaan_chinup_wanita === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_chinup_wanita->format('Y-m-d');
    }

    $umurPengguna = $obyekPenggunaWanita->ambilUmurGarjasWanitaChinUpOlehNIP($nipPengguna);
    if ($obyekPenggunaWanita->cekNipAnggotaChinUpWanitaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-chinup.php");
        exit;
    }

    if ($jumlahChinUpWanita == 0) {
        setPesanKesalahan("Nilai Chin Up tidak boleh 0.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-pushup.php");
        exit;
    }

    if (empty($nipPengguna) && empty($tanggalPelaksanaanChinUpWanita) && empty($jumlahChinUpWanita)) {
        $pesanKesalahan = "Semua bidang harus diisi. ";
    } elseif (empty($nipPengguna)) {
        $pesanKesalahan = "NIP Pengguna harus diisi. ";
    } elseif (empty($tanggalPelaksanaanChinUpWanita)) {
        $pesanKesalahan = "Tanggal pelaksanaan Chin Up harus diisi. ";
    } elseif (empty($jumlahChinUpWanita)) {
        $pesanKesalahan = "Jumlah Chin Up harus diisi. ";
    }
    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-chinup.php");
        exit;
    }

    $nilaiChinUp = [
        'under_25' => [
            63 => 100, 62 => 98, 61 => 95, 60 => 93, 59 => 90,
            58 => 88, 57 => 85, 56 => 83, 55 => 80, 54 => 78,
            53 => 75, 52 => 73, 51 => 70, 50 => 68, 49 => 66,
            48 => 63, 47 => 61, 46 => 58, 45 => 56, 44 => 53,
            43 => 51, 42 => 48, 41 => 46, 40 => 43, 39 => 41,
            38 => 40, 37 => 39, 36 => 38, 35 => 37, 34 => 36,
            33 => 35, 32 => 34, 31 => 33, 30 => 32, 29 => 30,
            28 => 29, 27 => 28, 26 => 27, 25 => 26, 24 => 25,
            23 => 24, 22 => 23, 21 => 22, 20 => 21, 19 => 20,
            18 => 19, 17 => 18, 16 => 17, 15 => 16, 14 => 15,
            13 => 14, 12 => 13, 11 => 12, 10 => 10, 9 => 9,
            8 => 8, 7 => 7, 6 => 6, 5 => 5, 4 => 4, 3 => 3,
            2 => 2, 1 => 1
        ],
        '25-34' => [
            60 => 100, 59 => 98, 58 => 96, 57 => 93, 56 => 90,
            55 => 88, 54 => 85, 53 => 83, 52 => 80, 51 => 78,
            50 => 75, 49 => 73, 48 => 70, 47 => 68, 46 => 66,
            45 => 63, 44 => 61, 43 => 58, 42 => 56, 41 => 53,
            40 => 51, 39 => 48, 38 => 46, 37 => 43, 36 => 41,
            35 => 40, 34 => 39, 33 => 38, 32 => 37, 31 => 36,
            30 => 35, 29 => 34, 28 => 33, 27 => 32, 26 => 30,
            25 => 29, 24 => 27, 23 => 26, 22 => 25, 21 => 24,
            20 => 23, 19 => 22, 18 => 21, 17 => 20, 16 => 19,
            15 => 18, 14 => 17, 13 => 16, 12 => 15, 11 => 14,
            10 => 13, 9 => 12, 8 => 10, 7 => 9, 6 => 8, 5 => 7,
            4 => 6, 3 => 5, 2 => 4, 1 => 3
        ],
        '35-44' => [
            55 => 100, 54 => 98, 53 => 95, 52 => 93, 51 => 90,
            50 => 88, 49 => 85, 48 => 83, 47 => 80, 46 => 78,
            45 => 75, 44 => 73, 43 => 70, 42 => 68, 41 => 66,
            40 => 63, 39 => 61, 38 => 58, 37 => 56, 36 => 53,
            35 => 51, 34 => 48, 33 => 46, 32 => 43, 31 => 41,
            30 => 40, 29 => 39, 28 => 38, 27 => 37, 26 => 36,
            25 => 35, 24 => 34, 23 => 33, 22 => 32, 21 => 30,
            20 => 29, 19 => 27, 18 => 26, 17 => 25, 16 => 24,
            15 => 23, 14 => 22, 13 => 21, 12 => 20, 11 => 19,
            10 => 18, 9 => 17, 8 => 16, 7 => 15, 6 => 14, 5 => 13,
            4 => 12, 3 => 10, 2 => 9, 1 => 8
        ],
        '45-54' => [
            46 => 100, 45 => 98, 44 => 95, 43 => 93, 42 => 90,
            41 => 88, 40 => 85, 39 => 83, 38 => 80, 37 => 78,
            36 => 75, 35 => 73, 34 => 70, 33 => 68, 32 => 66,
            31 => 63, 30 => 61, 29 => 58, 28 => 56, 27 => 53,
            26 => 51, 25 => 48, 24 => 46, 23 => 43, 22 => 41,
            21 => 40, 20 => 39, 19 => 38, 18 => 37, 17 => 36,
            16 => 35, 15 => 34, 14 => 33, 13 => 32, 12 => 30,
            11 => 29, 10 => 27, 9 => 26, 8 => 25, 7 => 24, 6 => 23,
            5 => 22, 4 => 21, 3 => 20, 2 => 19, 1 => 18,
        ],
        '55-59' => [
            40 => 100, 39 => 98, 38 => 95, 37 => 93, 36 => 90,
            35 => 88, 34 => 85, 33 => 83, 32 => 80, 31 => 78,
            30 => 75, 29 => 73, 28 => 70, 27 => 68, 26 => 66,
            25 => 63, 24 => 61, 23 => 58, 22 => 56, 21 => 53,
            20 => 51, 19 => 48, 18 => 46, 17 => 43, 16 => 41,
            15 => 40, 14 => 39, 13 => 38, 12 => 37, 11 => 36,
            10 => 35, 9 => 34, 8 => 33, 7 => 32, 6 => 30, 5 => 29,
            4 => 27, 3 => 26, 2 => 25, 1 => 24,
        ]
    ];

    $nilaiAkhir = 0;
    $maksimalChinUp = 0;

    if ($umurPengguna < 25) {
        $maksimalChinUp = max(array_keys($nilaiChinUp['under_25']));
        $nilaiAkhir = $jumlahChinUpWanita > $maksimalChinUp ? 100 : (isset($nilaiChinUp['under_25'][$jumlahChinUpWanita]) ? $nilaiChinUp['under_25'][$jumlahChinUpWanita] : 0);
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $maksimalChinUp = max(array_keys($nilaiChinUp['25-34']));
        $nilaiAkhir = $jumlahChinUpWanita > $maksimalChinUp ? 100 : (isset($nilaiChinUp['25-34'][$jumlahChinUpWanita]) ? $nilaiChinUp['25-34'][$jumlahChinUpWanita] : 0);
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $maksimalChinUp = max(array_keys($nilaiChinUp['35-44']));
        $nilaiAkhir = $jumlahChinUpWanita > $maksimalChinUp ? 100 : (isset($nilaiChinUp['35-44'][$jumlahChinUpWanita]) ? $nilaiChinUp['35-44'][$jumlahChinUpWanita] : 0);
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $maksimalChinUp = max(array_keys($nilaiChinUp['45-54']));
        $nilaiAkhir = $jumlahChinUpWanita > $maksimalChinUp ? 100 : (isset($nilaiChinUp['45-54'][$jumlahChinUpWanita]) ? $nilaiChinUp['45-54'][$jumlahChinUpWanita] : 0);
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $maksimalChinUp = max(array_keys($nilaiChinUp['55-59']));
        $nilaiAkhir = $jumlahChinUpWanita > $maksimalChinUp ? 100 : (isset($nilaiChinUp['55-59'][$jumlahChinUpWanita]) ? $nilaiChinUp['55-59'][$jumlahChinUpWanita] : 0);
    }

    $dataPenggunaWanita = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Chin_Up_Wanita' => $tanggalPelaksanaanChinUpWanita,
        'Jumlah_Chin_Up_Wanita' => $jumlahChinUpWanita,
        'Nilai_Chin_Up_Wanita' => $nilaiAkhir,
    );

    $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahGarjasWanitaChinUp($dataPenggunaWanita);

    if ($simpanDataPenggunaWanita) {
        setPesanKeberhasilan("Berhasil, data pengguna baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-chinup.php");
    exit;
}

<?php
include 'databases.php';
ob_start();

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
    $tanggalPelaksanaanSitUp2Wanita = $_POST['Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita'];
    $tanggal_pelaksanaan_situp2_wanita = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanSitUp2Wanita);

    if ($tanggal_pelaksanaan_situp2_wanita === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_situp2_wanita->format('Y-m-d');
    }

    $umurPengguna = $obyekPenggunaWanita->ambilUmurGarjasWanitaSitUp2OlehNIP($nipPengguna);
    if ($obyekPenggunaWanita->cekNipAnggotaSitUp2WanitaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-situp2.php");
        exit;
    }

    if ($jumlahSitUp2Wanita == 0) {
        setPesanKesalahan("Nilai Sit Up Kaki Di Tekuk tidak boleh 0.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-situp2.php");
        exit;
    }

    if (empty($nipPengguna) && empty($tanggalPelaksanaanSitUp2Wanita) && empty($jumlahSitUp2Wanita)) {
        $pesanKesalahan = "Semua bidang harus diisi. ";
    } elseif (empty($nipPengguna)) {
        $pesanKesalahan = "NIP Pengguna harus diisi. ";
    } elseif (empty($tanggalPelaksanaanSitUp2Wanita)) {
        $pesanKesalahan = "Tanggal pelaksanaan Sit Up kaki di tekuk harus diisi. ";
    } elseif (empty($jumlahSitUp2Wanita)) {
        $pesanKesalahan = "Jumlah Sit Up kaki di tekuk harus diisi. ";
    }
    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-situp2.php");
        exit;
    }

    $nilaiSitUp2 = [
        'under_25' => [
            84 => 100, 83 => 98, 82 => 94, 81 => 91, 80 => 88,
            79 => 84, 78 => 81, 77 => 79, 76 => 75, 75 => 72,
            74 => 69, 73 => 66, 72 => 63, 71 => 60, 70 => 57,
            69 => 53, 68 => 50, 67 => 47, 66 => 44, 65 => 41,
            64 => 40, 63 => 40, 62 => 39, 61 => 39, 60 => 38,
            59 => 37, 58 => 37, 57 => 36, 56 => 35, 55 => 35,
            54 => 34, 53 => 34, 52 => 33, 51 => 32, 50 => 32,
            49 => 31, 48 => 30, 47 => 30, 46 => 29, 45 => 29,
            44 => 28, 43 => 27, 42 => 27, 41 => 26, 40 => 25,
            39 => 25, 38 => 24, 37 => 24, 36 => 23, 35 => 22,
            34 => 22, 33 => 21, 32 => 20, 31 => 20, 30 => 19,
            29 => 19, 28 => 18, 27 => 17, 26 => 17, 25 => 16,
            24 => 15, 23 => 15, 22 => 14, 21 => 14, 20 => 13,
            19 => 12, 18 => 12, 17 => 11, 16 => 10, 15 => 10,
            14 => 9, 13 => 9, 12 => 8, 11 => 7, 10 => 7,
            9 => 6, 8 => 5, 7 => 5, 6 => 4, 5 => 4, 4 => 3,
            3 => 2, 2 => 2, 1 => 1
        ],
        '25-34' => [
            74 => 100, 73 => 98, 72 => 94, 71 => 91, 70 => 88,
            69 => 84, 68 => 81, 67 => 79, 66 => 75, 65 => 72,
            64 => 69, 63 => 66, 62 => 63, 61 => 60, 60 => 57,
            59 => 53, 58 => 50, 57 => 47, 56 => 44, 55 => 41,
            54 => 40, 53 => 40, 52 => 39, 51 => 39, 50 => 38,
            49 => 37, 48 => 37, 47 => 36, 46 => 35, 45 => 35,
            44 => 34, 43 => 34, 42 => 33, 41 => 32, 40 => 32,
            39 => 31, 38 => 30, 37 => 30, 36 => 29, 35 => 29,
            34 => 28, 33 => 27, 32 => 27, 31 => 26, 30 => 25,
            29 => 25, 28 => 24, 27 => 24, 26 => 23, 25 => 22,
            24 => 22, 23 => 21, 22 => 20, 21 => 20, 20 => 19,
            19 => 19, 18 => 18, 17 => 17, 16 => 16, 15 => 15,
            14 => 15, 13 => 15, 12 => 14, 11 => 14, 10 => 13,
            9 => 12, 8 => 12, 7 => 11, 6 => 10, 5 => 10,
            4 => 9, 3 => 9, 2 => 8, 1 => 7
        ],
        '35-44' => [
            64 => 100, 63 => 98, 62 => 94, 61 => 91, 60 => 88,
            59 => 84, 58 => 81, 57 => 79, 56 => 75, 55 => 72,
            54 => 69, 53 => 66, 52 => 63, 51 => 60, 50 => 57,
            49 => 53, 48 => 50, 47 => 47, 46 => 44, 45 => 41,
            44 => 40, 43 => 40, 42 => 39, 41 => 39, 40 => 38,
            39 => 37, 38 => 37, 37 => 36, 36 => 35, 35 => 35,
            34 => 34, 33 => 34, 32 => 33, 31 => 32, 30 => 32,
            29 => 31, 28 => 30, 27 => 30, 26 => 29, 25 => 29,
            24 => 28, 23 => 27, 22 => 27, 21 => 26, 20 => 25,
            19 => 25, 18 => 24, 17 => 24, 16 => 23, 15 => 22,
            14 => 22, 13 => 21, 12 => 20, 11 => 20, 10 => 19,
            9 => 19, 8 => 18, 7 => 17, 6 => 17, 5 => 16, 1 => 13
        ],
        '45-54' => [
            54 => 100, 53 => 98, 52 => 94, 51 => 91, 50 => 88,
            49 => 84, 48 => 81, 47 => 79, 46 => 75, 45 => 72,
            44 => 69, 43 => 66, 42 => 63, 41 => 60, 40 => 57,
            39 => 53, 38 => 50, 37 => 47, 36 => 44, 35 => 41,
            34 => 40, 33 => 40, 32 => 39, 31 => 39, 30 => 38,
            29 => 37, 28 => 37, 27 => 36, 26 => 35, 25 => 35,
            24 => 34, 23 => 34, 22 => 33, 21 => 32, 20 => 32,
            19 => 31, 18 => 30, 17 => 30, 16 => 29, 15 => 29,
            14 => 28, 13 => 27, 12 => 27, 11 => 26, 10 => 25,
            9 => 25, 8 => 24, 7 => 24, 6 => 23, 5 => 22,
            4 => 22, 3 => 21, 2 => 20, 1 => 19
        ],
        '55-59' => [
            44 => 100, 43 => 98, 42 => 94, 41 => 91, 40 => 88,
            39 => 84, 38 => 81, 37 => 79, 36 => 75, 35 => 72,
            34 => 69, 33 => 66, 32 => 63, 31 => 60, 30 => 57,
            29 => 53, 28 => 50, 27 => 47, 26 => 44, 25 => 41,
            24 => 40, 23 => 40, 22 => 39, 21 => 39, 20 => 38,
            19 => 37, 18 => 37, 17 => 36, 16 => 35, 15 => 35,
            14 => 34, 13 => 34, 12 => 33, 11 => 32, 10 => 32,
            9 => 31, 8 => 30, 7 => 30, 6 => 29, 5 => 29,
            4 => 28, 3 => 27, 2 => 27, 1 => 26
        ]
    ];

    $nilaiAkhir = 0;
    $maksimalSitUp1 = 0;

    if ($umurPengguna < 25) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp2['under_25']));
        $nilaiAkhir = $jumlahSitUp2Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp2['under_25'][$jumlahSitUp2Wanita]) ? $nilaiSitUp2['under_25'][$jumlahSitUp2Wanita] : 0);
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp2['25-34']));
        $nilaiAkhir = $jumlahSitUp2Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp2['25-34'][$jumlahSitUp2Wanita]) ? $nilaiSitUp2['25-34'][$jumlahSitUp2Wanita] : 0);
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp2['35-44']));
        $nilaiAkhir = $jumlahSitUp2Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp2['35-44'][$jumlahSitUp2Wanita]) ? $nilaiSitUp2['35-44'][$jumlahSitUp2Wanita] : 0);
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp2['45-54']));
        $nilaiAkhir = $jumlahSitUp2Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp2['45-54'][$jumlahSitUp2Wanita]) ? $nilaiSitUp2['45-54'][$jumlahSitUp2Wanita] : 0);
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp2['55-59']));
        $nilaiAkhir = $jumlahSitUp2Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp2['55-59'][$jumlahSitUp2Wanita]) ? $nilaiSitUp2['55-59'][$jumlahSitUp2Wanita] : 0);
    }



    $dataPenggunaWanita = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita' => $tanggalPelaksanaanSitUp2Wanita,
        'Jumlah_Sit_Up_2_Wanita' => $jumlahSitUp2Wanita,
        'Nilai_Sit_Up_2_Wanita' => $nilaiAkhir,
        "Status_Wanita_Sit_Up_Kaki_Ditekuk" => "Diterima"
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
ob_end_flush();

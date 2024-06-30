<?php
include 'databases.php';

function containsXSS($input)
{
    $xssPatterns = [
        "/<script\b[^>]>(.?)<\/script>/is",
        "/<img\b[^>]src[\s]=[\s]*[\"]*javascript:/i",
        "/<iframe\b[^>]>(.?)<\/iframe>/is",
        "/<link\b[^>]href[\s]=[\s]*[\"]*javascript:/i",
        "/<object\b[^>]>(.?)<\/object>/is",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/<script\b[^>]>[^<](?:(?!<\/script>)<[^<])<\/script>/i",
        "/<a\b[^>]href\s=\s*(?:\"|')(?:javascript:|.?\"javascript:).?(?:\"|')/i",
        "/<embed\b[^>]>(.?)<\/embed>/is",
        "/<applet\b[^>]>(.?)<\/applet>/is",
        "/<!--.*?-->/",
        "/(<script\b[^>]>(.?)<\/script>|<img\b[^>]src[\s]=[\s][\"]*javascript:|<iframe\b[^>]>(.?)<\/iframe>|<link\b[^>]*href[\s]=[\s][\"]*javascript:|<object\b[^>]>(.?)<\/object>|on[a-zA-Z]+\s=\s*\"[^\"]\"|<[^>](>|$)(?:<|>)+|<[^>]script\s.?(?:>|$)|<![^>]-->|eval\s*\((.?)\)|setTimeout\s\((.?)\)|<[^>]\bstyle\s*=\s*[\"'][^\"'][;{][^\"']['\"]|<meta[^>]http-equiv=[\"']?refresh[\"']?[^>]*url=|<[^>]*src\s=\s*\"[^>]\"[^>]>|expression\s*\((.*?)\))/i"
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

    $obyekPenggunaPria = new TesLariPria($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $waktuTestLariPria = mysqli_real_escape_string($koneksi, $_POST['Waktu_Lari_Pria']);
    $tanggalPelaksanaanLariPria = $_POST['Tanggal_Pelaksanaan_Tes_Lari_Pria'];
    $tanggal_pelaksanaan_lari_pria = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanLariPria);

    if ($tanggal_pelaksanaan_lari_pria === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_lari_pria->format('Y-m-d');
    }

    $umurPengguna = $obyekPenggunaPria->ambilUmurTesLariPriaOlehNIP($nipPengguna);
    if ($obyekPenggunaPria->cekNipAnggotaTesLariPriaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-lari.php");
        exit;
    }

    if ($waktuTestLariPria == 0) {
        setPesanKesalahan("Nilai lari pria tidak boleh 0.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-lari.php");
        exit;
    }

    if (empty($nipPengguna) && empty($tanggalPelaksanaanLariPria) && empty($waktuTestLariPria)) {
        $pesanKesalahan = "Semua bidang harus diisi. ";
    } elseif (empty($nipPengguna)) {
        $pesanKesalahan = "NIP Pengguna harus diisi. ";
    } elseif (empty($tanggalPelaksanaanLariPria)) {
        $pesanKesalahan = "Tanggal pelaksanaan Tes Lari Pria harus diisi. ";
    } elseif (empty($waktuTestLariPria)) {
        $pesanKesalahan = "Jumlah Tes Lari Pria harus diisi. ";
    }
    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-lari.php");
        exit;
    }

    $nilaiLari = [
        'under_25' => [
            '9' => 100, '9.1' => 98, '9.2' => 96, '9.3' => 93, '9.4' => 91,
            '9.5' => 89, '10' => 87, '10.1' => 85, '10.2' => 83, '10.3' => 80,
            '10.4' => 78, '10.5' => 76, '11' => 74, '11.1' => 72, '11.2' => 70,
            '11.3' => 67, '11.4' => 65, '11.5' => 63, '12' => 61, '12.1' => 60,
            '12.2' => 59, '12.3' => 58, '12.4' => 58, '12.5' => 57, '13' => 56,
            '13.1' => 55, '13.2' => 54, '13.3' => 53, '13.4' => 53, '13.5' => 52,
            '14' => 51, '14.1' => 50, '14.2' => 49, '14.3' => 48, '14.4' => 47,
            '14.5' => 47, '15' => 46, '15.1' => 45, '15.2' => 44, '15.3' => 43,
            '15.4' => 42, '15.5' => 42, '16' => 41, '16.1' => 40, '16.2' => 39,
            '16.3' => 38, '16.4' => 37, '16.5' => 36, '17' => 36, '17.1' => 35,
            '17.2' => 34, '17.3' => 33, '17.4' => 32, '17.5' => 31, '18' => 31,
            '18.1' => 30, '18.2' => 29, '18.3' => 28, '18.4' => 27, '18.5' => 26,
            '19' => 26, '19.1' => 25, '19.2' => 24, '19.3' => 23, '19.4' => 22,
            '19.5' => 21, '20' => 21, '20.1' => 21, '20.2' => 19, '20.3' => 18,
            '20.4' => 17, '20.5' => 16, '21' => 15, '21.1' => 15, '21.2' => 14,
            '21.3' => 13, '21.4' => 12, '21.5' => 11, '22' => 10, '22.1' => 9,
            '22.2' => 9, '22.3' => 8, '22.4' => 7, '22.5' => 6, '23' => 5,
            '23.1' => 4, '23.2' => 4, '23.3' => 3, '23.4' => 2, '23.5' => 1
        ],
        '25-34' => [
            '10' => 100, '10.1' => 98, '10.2' => 96, '10.3' => 93, '10.4' => 91,
            '10.5' => 89, '11' => 87, '11.1' => 85, '11.2' => 83, '11.3' => 80,
            '11.4' => 78, '11.8' => 76, '12' => 74, '12.1' => 72, '12.2' => 70,
            '12.3' => 67, '12.4' => 65, '12.5' => 63, '13' => 61, '13.1' => 60,
            '13.2' => 59, '13.3' => 58, '13.4' => 58, '13.5' => 57, '14' => 56,
            '14.1' => 55, '14.2' => 54, '14.3' => 53, '14.4' => 53, '14.5' => 52,
            '15' => 51, '15.1' => 50, '15.2' => 49, '15.3' => 48, '15.4' => 47,
            '15.5' => 47, '16' => 46, '16.1' => 45, '16.2' => 44, '16.3' => 43,
            '16.4' => 42, '16.5' => 42, '17' => 41, '17.1' => 40, '17.2' => 39,
            '17.3' => 38, '17.4' => 37, '17.5' => 36, '18' => 36, '18.1' => 35,
            '18.2' => 34, '18.3' => 33, '18.4' => 32, '18.5' => 31, '19' => 31,
            '19.1' => 30, '19.2' => 29, '19.3' => 28, '19.4' => 27, '19.5' => 26,
            '20' => 26, '20.1' => 25, '20.2' => 24, '20.3' => 23, '20.4' => 22,
            '20.5' => 21, '21' => 20, '21.1' => 20, '21.2' => 19, '21.3' => 18,
            '21.4' => 17, '21.5' => 16, '22' => 15, '22.1' => 15, '22.2' => 14,
            '22.3' => 13, '22.4' => 12, '22.5' => 11, '23' => 10, '23.1' => 9,
            '23.2' => 9, '23.3' => 8, '23.4' => 7, '23.5' => 6, '24' => 5,
            '24.1' => 4, '24.2' => 4, '24.3' => 3, '24.4' => 2, '24.5' => 1
        ],
        '35-44' => [
            '11' => 100, '11.1' => 98, '11.2' => 96, '11.3' => 93, '11.4' => 91,
            '11.5' => 89, '12' => 87, '12.1' => 85, '12.2' => 83, '12.3' => 80,
            '12.4' => 78, '12.8' => 76, '13' => 74, '13.1' => 72, '13.2' => 70,
            '13.3' => 67, '13.4' => 65, '13.5' => 63, '14' => 61, '14.1' => 60,
            '14.2' => 59, '14.3' => 58, '14.4' => 58, '14.5' => 57, '15' => 56,
            '15.1' => 55, '15.2' => 54, '15.3' => 53, '15.4' => 53, '15.5' => 52,
            '16' => 51, '16.1' => 50, '16.2' => 49, '16.3' => 48, '16.4' => 47,
            '16.5' => 47, '17' => 46, '17.1' => 45, '17.2' => 44, '17.3' => 43,
            '17.4' => 42, '17.5' => 42, '18' => 41, '18.1' => 40, '18.2' => 39,
            '18.3' => 38, '18.4' => 37, '18.5' => 36, '19' => 36, '19.1' => 35,
            '19.2' => 34, '19.3' => 33, '19.4' => 32, '19.5' => 31, '20' => 31,
            '20.1' => 30, '20.2' => 29, '20.3' => 28, '20.4' => 27, '20.5' => 26,
            '21' => 26, '21.1' => 25, '21.2' => 24, '21.3' => 23, '21.4' => 22,
            '21.5' => 21, '22' => 20, '22.1' => 20, '22.2' => 19, '22.3' => 18,
            '22.4' => 17, '22.5' => 16, '23' => 15, '23.1' => 15, '23.2' => 14,
            '23.3' => 13, '23.4' => 12, '23.5' => 11, '24' => 10, '24.1' => 9,
            '24.2' => 9, '24.3' => 8, '24.4' => 7, '24.5' => 6, '25' => 5,
            '25.1' => 4, '25.2' => 4, '25.3' => 3, '25.4' => 2, '25.5' => 1
        ],
        '45-54' => [
            '12' => 100, '12.1' => 98, '12.2' => 96, '12.3' => 93, '12.4' => 91,
            '12.5' => 89, '13' => 87, '13.1' => 85, '13.2' => 83, '13.3' => 80,
            '13.4' => 78, '13.5' => 76, '14' => 74, '14.1' => 72, '14.2' => 70,
            '14.3' => 67, '14.4' => 65, '14.5' => 63, '15' => 61, '15.1' => 60,
            '15.2' => 59, '15.3' => 58, '15.4' => 58, '15.5' => 57, '16' => 56,
            '16.1' => 55, '16.2' => 54, '16.3' => 53, '16.4' => 52, '16.5' => 52,
            '17' => 51, '17.1' => 50, '17.2' => 49, '17.3' => 48, '17.4' => 47,
            '17.5' => 47, '18' => 46, '18.1' => 45, '18.2' => 44, '18.3' => 43,
            '18.4' => 42, '18.5' => 41, '19' => 41, '19.1' => 40, '19.2' => 39,
            '19.3' => 38, '19.4' => 37, '19.5' => 36, '20' => 36, '20.1' => 35,
            '20.2' => 34, '20.3' => 33, '20.4' => 32, '20.5' => 31, '21' => 31,
            '21.1' => 30, '21.2' => 29, '21.3' => 28, '21.4' => 27, '21.5' => 26,
            '22' => 26, '22.1' => 25, '22.2' => 24, '22.3' => 23, '22.4' => 22,
            '22.5' => 21, '23' => 20, '23.1' => 20, '23.2' => 19, '23.3' => 18,
            '23.4' => 17, '23.5' => 16, '24' => 15, '24.1' => 15, '24.2' => 14,
            '24.3' => 13, '24.4' => 12, '24.5' => 11, '25' => 10, '25.1' => 9,
            '25.2' => 9, '25.3' => 8, '25.4' => 7, '25.5' => 6, '26' => 5,
            '26.1' => 4, '26.2' => 4, '26.3' => 3, '26.4' => 2, '26.5' => 1
        ],
        '55-59' => [
            '13' => 100, '13.1' => 98, '13.2' => 96, '13.3' => 93, '13.4' => 91,
            '13.5' => 89, '14' => 87, '14.1' => 85, '14.2' => 83, '14.3' => 80,
            '14.4' => 78, '14.5' => 76, '15' => 74, '15.1' => 72, '15.2' => 70,
            '15.3' => 67, '15.4' => 65, '15.5' => 63, '16' => 61, '16.1' => 60,
            '16.2' => 59, '16.3' => 58, '16.4' => 58, '16.5' => 57, '17' => 56,
            '17.1' => 55, '17.2' => 54, '17.3' => 53, '17.4' => 52, '17.5' => 52,
            '18' => 51, '18.1' => 50, '18.2' => 49, '18.3' => 48, '18.4' => 47,
            '18.5' => 47, '19' => 46, '19.1' => 45, '19.2' => 44, '19.3' => 43,
            '19.4' => 42, '19.5' => 41, '20' => 41, '20.1' => 40, '20.2' => 39,
            '20.3' => 38, '20.4' => 37, '20.5' => 36, '21' => 36, '21.1' => 35,
            '21.2' => 34, '21.3' => 33, '21.4' => 32, '21.5' => 31, '22' => 31,
            '22.1' => 30, '22.2' => 29, '22.3' => 28, '22.4' => 27, '22.5' => 26,
            '23' => 26, '23.1' => 25, '23.2' => 24, '23.3' => 23, '23.4' => 22,
            '23.5' => 21, '24' => 20, '24.1' => 20, '24.2' => 19, '24.3' => 18,
            '24.4' => 17, '24.5' => 16, '25' => 15, '25.1' => 15, '25.2' => 14,
            '25.3' => 13, '25.4' => 12, '25.5' => 11, '26' => 10, '26.1' => 9,
            '26.2' => 9, '26.3' => 8, '26.4' => 7, '26.5' => 6, '27' => 5,
            '27.1' => 4, '27.2' => 4, '27.3' => 3, '27.4' => 2, '27.5' => 1
        ]
    ];

    $nilaiAkhir = 0;

    if ($umurPengguna < 25) {
        if ($waktuTestLariPria < 9.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariPria > 23.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['under_25'][(string)$waktuTestLariPria]) ? $nilaiLari['under_25'][(string)$waktuTestLariPria] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($waktuTestLariPria < 10.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariPria > 24.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['25-34'][(string)$waktuTestLariPria]) ? $nilaiLari['25-34'][(string)$waktuTestLariPria] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($waktuTestLariPria < 11.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariPria > 25.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['35-44'][(string)$waktuTestLariPria]) ? $nilaiLari['35-44'][(string)$waktuTestLariPria] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($waktuTestLariPria < 12.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariPria > 26.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['45-54'][(string)$waktuTestLariPria]) ? $nilaiLari['45-54'][(string)$waktuTestLariPria] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($waktuTestLariPria < 13.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariPria > 27.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['55-59'][(string)$waktuTestLariPria]) ? $nilaiLari['55-59'][(string)$waktuTestLariPria] : 0;
        }
    }

    if (!$nilaiAkhir) {
        setPesanKesalahan("Input waktu tidak valid untuk usia pengguna ini.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-lari.php");
        exit;
    }

    $dataPenggunaPria = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Tes_Lari_Pria' => $tanggalPelaksanaanLariPria,
        'Waktu_Lari_Pria' => $waktuTestLariPria,
        'Nilai_Lari_Pria' => $nilaiAkhir,
    );

    $simpanDataPenggunaPria = $obyekPenggunaPria->tambahTesLariPria($dataPenggunaPria);

    if ($simpanDataPenggunaPria) {
        setPesanKeberhasilan("Berhasil, data pengguna pria baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna pria.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-lari.php");
    exit;
}

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
    $obyekPriaJalan = new TesJalanKaki5KMPria($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $waktuJalanPria = mysqli_real_escape_string($koneksi, $_POST['Waktu_Jalan_Pria']);
    $tanggalPelaksanaanTestJalanPria = $_POST['Tanggal_Pelaksanaan_Tes_Jalan_Pria'];
    $tanggal_pelaksanaan_test_jalan_pria = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanTestJalanPria);

    if ($tanggal_pelaksanaan_test_jalan_pria === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_test_jalan_pria->format('Y-m-d');
    }

    $umurPengguna = $obyekPriaJalan->ambilUmurTesJalanKaki5KMPriaOlehNIP($nipPengguna);
    if ($obyekPriaJalan->cekNipAnggotaTesJalanKaki5KMPriaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-jalan.php");
        exit;
    }

    if ($waktuJalanPria == 0) {
        setPesanKesalahan("Nilai Pria Jalan tidak boleh 0.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-jalan.php");
        exit;
    }

    if (empty($nipPengguna) && empty($tanggalPelaksanaanTestJalanPria) && empty($waktuJalanPria)) {
        $pesanKesalahan = "Semua bidang harus diisi. ";
    } elseif (empty($nipPengguna)) {
        $pesanKesalahan = "NIP Pengguna harus diisi. ";
    } elseif (empty($tanggalPelaksanaanTestJalanPria)) {
        $pesanKesalahan = "Tanggal pelaksanaan Jalan Pria Wanita harus diisi. ";
    } elseif (empty($waktuJalanPria)) {
        $pesanKesalahan = "Jumlah Jalan Pria Wanita harus diisi. ";
    }
    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-jalan.php");
        exit;
    }

    $nilaiJalan = [
        'under_25' => [
            '17' => 100, '17.1' => 99, '17.2' => 99, '17.3' => 99, '17.4' => 98,
            '17.5' => 98, '17.6' => 98, '17.7' => 98, '17.8' => 98, '17.9' => 98,
            '18' => 98, '18.1' => 98, '18.2' => 97, '18.3' => 97, '18.4' => 97,
            '18.5' => 96, '18.6' => 96, '18.7' => 96, '18.8' => 96, '18.9' => 96,
            '19' => 96, '19.1' => 96, '19.2' => 95, '19.3' => 95, '19.4' => 95,
            '19.5' => 94, '19.6' => 94, '19.7' => 94, '19.8' => 94, '19.9' => 94,
            '20' => 94, '20.1' => 94, '20.2' => 93, '20.3' => 93, '20.4' => 93,
            '20.5' => 93, '21' => 92, '21.1' => 92, '21.2' => 92, '21.3' => 92, '21.4' => 91,
            '21.5' => 91, '21.6' => 91, '21.7' => 91, '21.8' => 91, '21.9' => 91,
            '22' => 91, '22.1' => 90, '22.2' => 90, '22.3' => 90, '22.4' => 89,
            '22.5' => 89, '22.6' => 89, '22.7' => 89, '22.8' => 89, '22.9' => 89,
            '23' => 89, '23.1' => 89, '23.2' => 88, '23.3' => 88, '23.4' => 88,
            '23.5' => 87, '23.6' => 87, '23.7' => 87, '23.8' => 87, '23.9' => 87,
            '24' => 87, '24.1' => 87, '24.2' => 86, '24.3' => 86, '24.4' => 86,
            '24.5' => 85, '24.6' => 85, '24.7' => 85, '24.8' => 85, '24.9' => 85,
            '25' => 85, '25.1' => 85, '25.2' => 85, '25.3' => 84, '25.4' => 84,
            '25.5' => 84, '26' => 83, '26.1' => 83, '26.2' => 83, '26.3' => 82,
            '26.4' => 82, '26.5' => 82, '27' => 81, '27.1' => 81, '27.2' => 81,
            '27.3' => 80, '27.4' => 80, '27.5' => 80, '28' => 80, '28.1' => 79,
            '28.2' => 79, '28.3' => 79, '28.4' => 79, '28.5' => 78, '29' => 78,
            '29.1' => 77, '29.2' => 77, '29.3' => 77, '29.4' => 76, '29.5' => 76,
            '30' => 76, '30.1' => 76, '30.2' => 75, '30.3' => 75, '30.4' => 75,
            '30.5' => 74, '30.6' => 74, '30.7' => 74, '30.8' => 74, '30.9' => 74,
            '31' => 74, '31.1' => 74, '31.2' => 73, '31.3' => 73, '31.4' => 73,
            '31.5' => 72, '31.6' => 72, '31.7' => 72, '31.8' => 72, '31.9' => 72,
            '32' => 72, '32.1' => 72, '32.2' => 72, '32.3' => 71, '32.4' => 71,
            '32.5' => 71, '33' => 70, '33.1' => 70, '33.2' => 70, '33.3' => 69,
            '33.4' => 69, '33.5' => 69, '34' => 68, '34.1' => 68, '34.2' => 68,
            '34.3' => 67, '34.4' => 67, '34.5' => 67, '35' => 67, '35.1' => 66,

        ],
        '25-34' => [],
        '35-44' => [],
        '45-54' => [],
        '55-59' => []
    ];

    $nilaiAkhir = 0;

    if ($umurPengguna < 25) {
        if ($waktuJalanPria < 17.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuJalanPria > 51.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['under_25'][(string)$waktuJalanPria]) ? $nilaiJalan['under_25'][(string)$waktuJalanPria] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($waktuJalanPria < 10.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuJalanPria > 24.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['25-34'][(string)$waktuJalanPria]) ? $nilaiJalan['25-34'][(string)$waktuJalanPria] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($waktuJalanPria < 11.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuJalanPria > 25.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['35-44'][(string)$waktuJalanPria]) ? $nilaiJalan['35-44'][(string)$waktuJalanPria] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($waktuJalanPria < 12.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuJalanPria > 27.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['45-54'][(string)$waktuJalanPria]) ? $nilaiJalan['45-54'][(string)$waktuJalanPria] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($waktuJalanPria < 13.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuJalanPria > 26.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['55-59'][(string)$waktuJalanPria]) ? $nilaiJalan['55-59'][(string)$waktuJalanPria] : 0;
        }
    }

    if (!$nilaiJalan) {
        setPesanKesalahan("Input waktu tidak valid untuk usia pengguna ini.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-jalan.php");
        exit;
    }

    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Tes_Jalan_Pria' => $tanggalPelaksanaanTestJalanPria,
        'Waktu_Jalan_Pria' => $waktuJalanPria,
        'Nilai_Jalan_Pria' => $nilaiAkhir,
    );

    $simpanDataPengguna = $obyekPriaJalan->tambahTesJalanKaki5KMPria($dataPengguna);

    if ($simpanDataPengguna) {
        setPesanKeberhasilan("Berhasil, data pria jalan baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pria jalan.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-jalan.php");
    exit;
}
ob_end_flush();

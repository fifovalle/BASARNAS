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

    $obyekPenggunaWanita = new TesLariWanita($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $waktuTestLariWanita = mysqli_real_escape_string($koneksi, $_POST['Waktu_Lari_Wanita']);
    $tanggalPelaksanaanLariWanita = $_POST['Tanggal_Pelaksanaan_Tes_Lari_Wanita'];
    $tanggal_pelaksanaan_lari_wanita = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanLariWanita);

    if ($tanggal_pelaksanaan_lari_wanita === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_lari_wanita->format('Y-m-d');
    }

    $umurPengguna = $obyekPenggunaWanita->ambilUmurTesLariWanitaOlehNIP($nipPengguna);
    if ($obyekPenggunaWanita->cekNipAnggotaTesLariWanitaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-lari.php");
        exit;
    }

    $waktuTestLariWanita = str_replace(',', '.', $waktuTestLariWanita);
    $waktuTestLariWanita = (float) $waktuTestLariWanita;

    if ($waktuTestLariWanita == 0) {
        setPesanKesalahan("Nilai lari wanita tidak boleh 0.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-lari.php");
        exit;
    }

    $nilaiLari = [
        'under_25' => [
            '10.0' => 100,
            '10.1' => 98,
            '10.2' => 96,
            '10.3' => 93,
            '10.4' => 91,
            '10.5' => 89,
            '11.0' => 87,
            '11.1' => 85,
            '11.2' => 83,
            '11.3' => 80,
            '11.4' => 78,
            '12.0' => 74,
            '12.1' => 72,
            '12.2' => 70,
            '12.3' => 67,
            '12.4' => 65,
            '12.5' => 63,
            '13.0' => 61,
            '13.1' => 60,
            '13.2' => 59,
            '13.3' => 59,
            '13.4' => 58,
            '13.5' => 57,
            '14.0' => 56,
            '14.1' => 56,
            '14.2' => 59,
            '14.3' => 54,
            '14.4' => 53,
            '14.5' => 52,
            '15.0' => 52,
            '15.1' => 51,
            '15.2' => 50,
            '15.3' => 49,
            '15.4' => 49,
            '16.0' => 47,
            '16.1' => 46,
            '16.2' => 45,
            '16.3' => 45,
            '16.4' => 44,
            '16.5' => 43,
            '17.0' => 42,
            '17.1' => 42,
            '17.2' => 41,
            '17.3' => 40,
            '17.4' => 39,
            '17.5' => 38,
            '18.0' => 38,
            '18.1' => 37,
            '18.2' => 36,
            '18.3' => 35,
            '18.4' => 35,
            '18.5' => 34,
            '19.0' => 33,
            '19.1' => 32,
            '19.2' => 31,
            '19.3' => 31,
            '19.4' => 30,
            '19.5' => 29,
            '20.0' => 28,
            '20.1' => 27,
            '20.2' => 27,
            '20.3' => 26,
            '20.4' => 25,
            '20.5' => 24,
            '21.0' => 24,
            '21.1' => 23,
            '21.2' => 22,
            '21.3' => 21,
            '21.4' => 20,
            '21.5' => 20,
            '22.0' => 19,
            '22.1' => 18,
            '22.2' => 17,
            '22.3' => 17,
            '22.4' => 16,
            '22.5' => 15,
            '23.0' => 14,
            '23.1' => 13,
            '23.2' => 13,
            '23.3' => 12,
            '23.4' => 11,
            '23.5' => 10,
            '24.0' => 10,
            '24.1' => 9,
            '24.2' => 8,
            '24.3' => 7,
            '24.4' => 6,
            '24.5' => 6,
            '25.0' => 5,
            '25.1' => 4,
            '25.2' => 3,
            '25.3' => 3,
            '25.4' => 2,
            '25.5' => 1,
        ],
        '25-34' => [
            '11.0' => 100,
            '11.1' => 98,
            '11.2' => 96,
            '11.3' => 93,
            '11.4' => 91,
            '11.5' => 89,
            '12.0' => 87,
            '12.1' => 85,
            '12.2' => 83,
            '12.3' => 80,
            '12.4' => 76,
            '13.0' => 76,
            '13.1' => 74,
            '13.2' => 72,
            '13.3' => 70,
            '13.4' => 69,
            '14.0' => 67,
            '14.1' => 66,
            '14.2' => 65,
            '14.3' => 64,
            '14.4' => 63,
            '15.0' => 61,
            '15.1' => 60,
            '15.2' => 59,
            '15.3' => 58,
            '15.4' => 57,
            '16.0' => 56,
            '16.1' => 55,
            '16.2' => 54,
            '16.3' => 53,
            '16.4' => 52,
            '17.0' => 51,
            '17.1' => 50,
            '17.2' => 49,
            '17.3' => 48,
            '17.4' => 47,
            '18.0' => 46,
            '18.1' => 45,
            '18.2' => 44,
            '18.3' => 43,
            '18.4' => 42,
            '19.0' => 41,
            '19.1' => 40,
            '19.2' => 39,
            '19.3' => 38,
            '19.4' => 37,
            '20.0' => 36,
            '20.1' => 35,
            '20.2' => 34,
            '20.3' => 33,
            '20.4' => 32,
            '21.0' => 31,
            '21.1' => 30,
            '21.2' => 29,
            '21.3' => 28,
            '21.4' => 27,
            '22.0' => 26,
            '22.1' => 25,
            '22.2' => 24,
            '22.3' => 23,
            '22.4' => 22,
            '23.0' => 21,
            '23.1' => 20,
            '23.2' => 19,
            '23.3' => 18,
            '23.4' => 17,
            '24.0' => 16,
            '24.1' => 15,
            '24.2' => 14,
            '24.3' => 13,
            '24.4' => 12,
            '25.0' => 11,
            '25.1' => 10,
            '25.2' => 9,
            '25.3' => 8,
            '25.4' => 7,
            '25.5' => 6,
        ],
        '35-44' => [
            '12.0' => 100,
            '12.1' => 98,
            '12.2' => 96,
            '12.3' => 93,
            '12.4' => 91,
            '12.5' => 89,
            '13.0' => 87,
            '13.1' => 85,
            '13.2' => 83,
            '13.3' => 80,
            '13.4' => 78,
            '14.0' => 76,
            '14.1' => 74,
            '14.2' => 72,
            '14.3' => 70,
            '14.4' => 69,
            '15.0' => 67,
            '15.1' => 66,
            '15.2' => 65,
            '15.3' => 64,
            '15.4' => 63,
            '16.0' => 61,
            '16.1' => 60,
            '16.2' => 59,
            '16.3' => 58,
            '16.4' => 57,
            '17.0' => 56,
            '17.1' => 55,
            '17.2' => 54,
            '17.3' => 53,
            '17.4' => 52,
            '18.0' => 51,
            '18.1' => 50,
            '18.2' => 49,
            '18.3' => 48,
            '18.4' => 47,
            '19.0' => 46,
            '19.1' => 45,
            '19.2' => 44,
            '19.3' => 43,
            '19.4' => 42,
            '20.0' => 41,
            '20.1' => 40,
            '20.2' => 39,
            '20.3' => 38,
            '20.4' => 37,
            '21.0' => 36,
            '21.1' => 35,
            '21.2' => 34,
            '21.3' => 33,
            '21.4' => 32,
            '22.0' => 31,
            '22.1' => 30,
            '22.2' => 29,
            '22.3' => 28,
            '22.4' => 27,
            '23.0' => 26,
            '23.1' => 25,
            '23.2' => 24,
            '23.3' => 23,
            '23.4' => 22,
            '24.0' => 21,
            '24.1' => 20,
            '24.2' => 19,
            '24.3' => 18,
            '24.4' => 17,
            '25.0' => 16,
            '25.1' => 15,
            '25.2' => 14,
            '25.3' => 13,
            '25.4' => 12,
            '25.5' => 11,
        ],
        '45-54' => [
            '13.0' => 100,
            '13.1' => 98,
            '13.2' => 96,
            '13.3' => 93,
            '13.4' => 91,
            '13.5' => 89,
            '14.0' => 87,
            '14.1' => 85,
            '14.2' => 83,
            '14.3' => 80,
            '14.4' => 78,
            '15.0' => 76,
            '15.1' => 74,
            '15.2' => 72,
            '15.3' => 70,
            '15.4' => 69,
            '16.0' => 67,
            '16.1' => 66,
            '16.2' => 65,
            '16.3' => 64,
            '16.4' => 63,
            '17.0' => 61,
            '17.1' => 60,
            '17.2' => 59,
            '17.3' => 58,
            '17.4' => 57,
            '18.0' => 56,
            '18.1' => 55,
            '18.2' => 54,
            '18.3' => 53,
            '18.4' => 52,
            '19.0' => 51,
            '19.1' => 50,
            '19.2' => 49,
            '19.3' => 48,
            '19.4' => 47,
            '20.0' => 46,
            '20.1' => 45,
            '20.2' => 44,
            '20.3' => 43,
            '20.4' => 42,
            '21.0' => 41,
            '21.1' => 40,
            '21.2' => 39,
            '21.3' => 38,
            '21.4' => 37,
            '22.0' => 36,
            '22.1' => 35,
            '22.2' => 34,
            '22.3' => 33,
            '22.4' => 32,
            '23.0' => 31,
            '23.1' => 30,
            '23.2' => 29,
            '23.3' => 28,
            '23.4' => 27,
            '24.0' => 26,
            '24.1' => 25,
            '24.2' => 24,
            '24.3' => 23,
            '24.4' => 22,
            '25.0' => 21,
            '25.1' => 20,
            '25.2' => 19,
            '25.3' => 18,
            '25.4' => 17,
            '25.5' => 16,
        ],
        '55-59' => [
            '14.0' => 100,
            '14.1' => 98,
            '14.2' => 96,
            '14.3' => 93,
            '14.4' => 91,
            '14.5' => 89,
            '15.0' => 87,
            '15.1' => 85,
            '15.2' => 83,
            '15.3' => 80,
            '15.4' => 78,
            '16.0' => 76,
            '16.1' => 74,
            '16.2' => 72,
            '16.3' => 70,
            '16.4' => 69,
            '17.0' => 67,
            '17.1' => 66,
            '17.2' => 65,
            '17.3' => 64,
            '17.4' => 63,
            '18.0' => 61,
            '18.1' => 60,
            '18.2' => 59,
            '18.3' => 58,
            '18.4' => 57,
            '19.0' => 56,
            '19.1' => 55,
            '19.2' => 54,
            '19.3' => 53,
            '19.4' => 52,
            '20.0' => 51,
            '20.1' => 50,
            '20.2' => 49,
            '20.3' => 48,
            '20.4' => 47,
            '21.0' => 46,
            '21.1' => 45,
            '21.2' => 44,
            '21.3' => 43,
            '21.4' => 42,
            '22.0' => 41,
            '22.1' => 40,
            '22.2' => 39,
            '22.3' => 38,
            '22.4' => 37,
            '23.0' => 36,
            '23.1' => 35,
            '23.2' => 34,
            '23.3' => 33,
            '23.4' => 32,
            '24.0' => 31,
            '24.1' => 30,
            '24.2' => 29,
            '24.3' => 28,
            '24.4' => 27,
            '25.0' => 26,
            '25.1' => 25,
            '25.2' => 24,
            '25.3' => 23,
            '25.4' => 22,
            '25.5' => 21,
        ],
    ];


    $nilaiAkhir = 0;

    if ($umurPengguna < 25) {
        if ($waktuTestLariWanita < 9.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariWanita > 23.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['under_25'][(string)$waktuTestLariWanita]) ? $nilaiLari['under_25'][(string)$waktuTestLariWanita] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($waktuTestLariWanita < 10.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariWanita > 24.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['25-34'][(string)$waktuTestLariWanita]) ? $nilaiLari['25-34'][(string)$waktuTestLariWanita] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($waktuTestLariWanita < 11.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariWanita > 25.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['35-44'][(string)$waktuTestLariWanita]) ? $nilaiLari['35-44'][(string)$waktuTestLariWanita] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($waktuTestLariWanita < 12.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariWanita > 27.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['45-54'][(string)$waktuTestLariWanita]) ? $nilaiLari['45-54'][(string)$waktuTestLariWanita] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($waktuTestLariWanita < 13.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestLariWanita > 26.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiLari['55-59'][(string)$waktuTestLariWanita]) ? $nilaiLari['55-59'][(string)$waktuTestLariWanita] : 0;
        }
    }

    if (!$nilaiAkhir) {
        setPesanKesalahan("Input waktu tidak valid untuk usia pengguna ini.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-lari.php");
        exit;
    }

    $dataPenggunaWanita = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Tes_Lari_Wanita' => $tanggalPelaksanaanLariWanita,
        'Waktu_Lari_Wanita' => $waktuTestLariWanita,
        'Nilai_Lari_Wanita' => $nilaiAkhir,
    );

    $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahTesLariWanita($dataPenggunaWanita);

    if ($simpanDataPenggunaWanita) {
        setPesanKeberhasilan("Berhasil, data pengguna wanita baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna wanita.");
    }

    header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-lari.php");
    exit;
}

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
    $tanggalPelaksanaanShuttleRunWanita = $_POST['Tanggal_Pelaksanaan_Shuttle_Run_Wanita'];
    $tanggal_pelaksanaan_shuttlerun_wanita = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanShuttleRunWanita);

    if ($tanggal_pelaksanaan_shuttlerun_wanita === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_shuttlerun_wanita->format('Y-m-d');
    }

    $umurPengguna = $obyekPenggunaWanita->ambilUmurGarjasWanitaShuttlerunOlehNIP($nipPengguna);

    if ($obyekPenggunaWanita->cekNipAnggotaShuttleRunWanitaSudahAda($nipPengguna)) {
        setPesanKesalahan("NIP telah digunakan. Silakan gunakan NIP yang lain");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-shuttlerun.php");
        exit;
    }

    if ($jumlahShuttleRunWanita == 0) {
        setPesanKesalahan("Nilai Shuttle Run tidak boleh 0.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-shuttlerun.php");
        exit;
    }

    if (empty($nipPengguna) && empty($tanggalPelaksanaanShuttleRunWanita) && empty($jumlahShuttleRunWanita)) {
        $pesanKesalahan = "Semua bidang harus diisi. ";
    } elseif (empty($nipPengguna)) {
        $pesanKesalahan = "NIP Pengguna harus diisi. ";
    } elseif (empty($tanggalPelaksanaanShuttleRunWanita)) {
        $pesanKesalahan = "Tanggal pelaksanaan Shutle Run harus diisi. ";
    } elseif (empty($jumlahShuttleRunWanita)) {
        $pesanKesalahan = "Jumlah Shutle Run harus diisi. ";
    }
    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: " . $akarUrl . "src/admin/pages/data-garjas-wanita-shuttlerun.php");
        exit;
    }

    $nilaiShuttleRun = [
        'under_25' => [
            '17.2' => 100, '17.3' => 99, '17.4' => 98, '17.5' => 97, '17.6' => 96,
            '17.7' => 95, '17.8' => 94, '17.9' => 93, '18' => 92, '18.1' => 91,
            '18.2' => 90, '18.3' => 89, '18.4' => 88, '18.5' => 87, '18.6' => 86,
            '18.7' => 85, '18.8' => 84, '18.9' => 83, '19' => 82, '19.1' => 81,
            '19.2' => 80, '19.3' => 79, '19.4' => 78, '19.5' => 77, '19.6' => 76,
            '19.7' => 75, '19.8' => 74, '19.9' => 73, '20' => 72, '20.1' => 71,
            '20.2' => 70, '20.3' => 69, '20.4' => 68, '20.5' => 67, ' 20.6' => 66,
            '20.7' => 65, '20.8' => 64, '20.9' => 63, '21' => 62, '21.1' => 61,
            '21.2' => 60, '21.3' => 59, '21.4' => 58, '21.5' => 57, '21.6' => 56,
            '21.7' => 55, '21.8' => 54, '21.9' => 53, '22' => 52, '22.1' => 51,
            '22.2' => 50, '22.3' => 49, '22.4' => 48, '22.5' => 47, '22.6' => 46,
            '22.7' => 45, '22.8' => 44, '22.9' => 43, '23' => 42, '23.1' => 41,
            '23.2' => 40, '23.3' => 39, '23.4' => 38, '23.5' => 37, '23.6' => 36,
            '23.7' => 35, '23.8' => 34, '23.9' => 33, '24' => 32, '24.1' => 31,
            '24.2' => 30, '24.3' => 29, '24.4' => 28, '24.5' => 27, '24.6' => 26,
            '24.7' => 25, '24.8' => 24, '24.9' => 23, '25' => 22, '25.1' => 21,
            '25.2' => 20, '25.3' => 19, '25.4' => 18, '25.5' => 17, '25.6' => 16,
            '25.7' => 15, '25.8' => 14, '25.9' => 13, '26' => 12, '26.1' => 11,
            '26.2' => 10, '26.3' => 9, '26.4' => 8, '26.5' => 7, '26.6' => 6,
            '26.7' => 5, '26.8' => 4, '26.9' => 3, '27' => 2, '27.1' => 1
        ],
        '25-34' => [
            '17.7' => 100, '17.8' => 99, '17.9' => 98, '18' => 97, '18.1' => 96,
            '18.2' => 95, '18.3' => 94, '18.4' => 93, '18.5' => 92, '18.6' => 91,
            '18.7' => 90, '18.8' => 89, '18.9' => 88, '19' => 87, '19.1' => 86,
            '19.2' => 85, '19.3' => 84, '19.4' => 83, '19.5' => 82, '19.6' => 81,
            '19.7' => 80, '19.8' => 79, '19.9' => 78, '20' => 77, '20.1' => 76,
            '20.2' => 75, '20.3' => 74, '20.4' => 73, '20.5' => 72, '20.6' => 71,
            '20.7' => 70, '20.8' => 69, '20.9' => 68, '21' => 67, '21.1' => 66,
            '21.2' => 65, '21.3' => 64, '21.4' => 63, '21.5' => 62, '21.6' => 61,
            '21.7' => 60, '21.8' => 59, '21.9' => 58, '22' => 57, '22.1' => 56,
            '22.2' => 55, '22.3' => 54, '22.4' => 53, '22.5' => 52, '22.6' => 51,
            '22.7' => 50, '22.8' => 49, '22.9' => 48, '23' => 47, '23.1' => 46,
            '23.2' => 45, '23.3' => 44, '23.4' => 43, '23.5' => 42, '23.6' => 41,
            '23.7' => 40, '23.8' => 39, '23.9' => 38, '24' => 37, '24.1' => 36,
            '24.2' => 35, '24.3' => 34, '24.4' => 33, '24.5' => 32, '24.6' => 31,
            '24.7' => 30, '24.8' => 29, '24.9' => 28, '25' => 27, '25.1' => 26,
            '25.2' => 25, '25.3' => 24, '25.4' => 23, '25.5' => 22, '25.6' => 21,
            '25.7' => 20, '25.8' => 19, '25.9' => 18, '26' => 17, '26.1' => 16,
            '26.2' => 15, '26.3' => 14, '26.4' => 13, '26.5' => 12, '26.6' => 11,
            '26.7' => 10, '26.8' => 9, '26.9' => 8, '27' => 7, '27.1' => 6,
            '27.2' => 5, '27.3' => 4, '27.4' => 3, '27.5' => 2, '27.6' => 1
        ],
        '35-44' => [
            '18.7' => 100, '18.8' => 99, '18.9' => 98, '19' => 97, '19.1' => 96,
            '19.2' => 95, '19.3' => 94, '19.4' => 93, '19.5' => 92, '19.6' => 91,
            '19.7' => 90, '19.8' => 89, '19.9' => 88, '20' => 87, '20.1' => 86,
            '20.2' => 85, '20.3' => 84, '20.4' => 83, '20.5' => 82, '20.6' => 81,
            '20.7' => 80, '20.8' => 79, '20.9' => 78, '21' => 77, '21.1' => 76,
            '21.2' => 75, '21.3' => 74, '21.4' => 73, '21.5' => 72, '21.6' => 71,
            '21.7' => 70, '21.8' => 69, '21.9' => 68, '22' => 67, '22.1' => 66,
            '22.2' => 65, '22.3' => 64, '22.4' => 63, '22.5' => 62, '22.6' => 61,
            '22.7' => 60, '22.8' => 59, '22.9' => 58, '23' => 57, '23.1' => 56,
            '23.2' => 55, '23.3' => 54, '23.4' => 53, '23.5' => 52, '23.6' => 51,
            '23.7' => 50, '23.8' => 49, '23.9' => 48, '24' => 47, '24.1' => 46,
            '24.2' => 45, '24.3' => 44, '24.4' => 43, '24.5' => 42, '24.6' => 41,
            '24.7' => 40, '24.8' => 39, '24.9' => 38, '25' => 37, '25.1' => 36,
            '25.2' => 35, '25.3' => 34, '25.4' => 33, '25.5' => 32, '25.6' => 31,
            '25.7' => 30, '25.8' => 29, '25.9' => 28, '26' => 27, '26.1' => 26,
            '26.2' => 25, '26.3' => 24, '26.4' => 23, '26.5' => 22, '26.6' => 21,
            '26.7' => 20, '26.8' => 19, '26.9' => 18, '27' => 17, '27.1' => 16,
            '27.2' => 15, '27.3' => 14, '27.4' => 13, '27.5' => 12, '27.6' => 11,
            '27.7' => 10, '27.8' => 9, '27.9' => 8, '28' => 7, '28.1' => 6,
            '28.2' => 5, '28.3' => 4, '28.4' => 3, '28.5' => 2, '28.6' => 1
        ],
        '45-54' => [
            '20.2' => 100, '20.3' => 99, '20.4' => 98, '20.5' => 97, '20.6' => 96,
            '20.7' => 95, '20.8' => 94, '20.9' => 93, '21' => 92, '21.1' => 91,
            '21.2' => 90, '21.3' => 89, '21.4' => 88, '21.5' => 87, '21.6' => 86,
            '21.7' => 85, '21.8' => 84, '21.9' => 83, '22' => 82, '22.1' => 81,
            '22.2' => 80, '22.3' => 79, '22.4' => 78, '22.5' => 77, '22.6' => 76,
            '22.7' => 75, '22.8' => 74, '22.9' => 73, '23' => 72, '23.1' => 71,
            '23.2' => 70, '23.3' => 69, '23.4' => 68, '23.5' => 67, '23.6' => 66,
            '23.7' => 65, '23.8' => 64, '23.9' => 63, '24' => 62, '24.1' => 61,
            '24.2' => 60, '24.3' => 59, '24.4' => 58, '24.5' => 57, '24.6' => 56,
            '24.7' => 55, '24.8' => 54, '24.9' => 53, '25' => 52, '25.1' => 51,
            '25.2' => 50, '25.3' => 49, '25.4' => 48, '25.5' => 47, '25.6' => 46,
            '25.7' => 45, '25.8' => 44, '25.9' => 43, '26' => 42, '26.1' => 41,
            '26.2' => 40, '26.3' => 39, '26.4' => 38, '26.5' => 37, '26.6' => 36,
            '26.7' => 35, '26.8' => 34, '26.9' => 33, '27' => 32, '27.1' => 31,
            '27.2' => 30, '27.3' => 29, '27.4' => 28, '27.5' => 27, '27.6' => 26,
            '27.7' => 25, '27.8' => 24, '27.9' => 23, '28' => 22, '28.1' => 21,
            '28.2' => 20, '28.3' => 19, '28.4' => 18, '28.5' => 17, '28.6' => 16,
            '28.7' => 15, '28.8' => 14, '28.9' => 13, '29' => 12, '29.1' => 11,
            '29.2' => 10, '29.3' => 9, '29.4' => 8, '29.5' => 7, '29.6' => 6,
            '29.7' => 5, '29.8' => 4, '29.9' => 3, '30' => 2, '30.1' => 1
        ],
        '55-59' => [
            '21.7' => 100, '21.8' => 99, '21.9' => 98, '22' => 97, '22.1' => 96,
            '22.2' => 95, '22.3' => 94, '22.4' => 93, '22.5' => 92, '22.6' => 91,
            '22.7' => 90, '22.8' => 89, '22.9' => 88, '23' => 87, '23.1' => 86,
            '23.2' => 85, '23.3' => 84, '23.4' => 83, '23.5' => 82, '23.6' => 81,
            '23.7' => 80, '23.8' => 79, '23.9' => 78, '24' => 77, '24.1' => 76,
            '24.2' => 75, '24.3' => 74, '24.4' => 73, '24.5' => 72, '24.6' => 71,
            '24.7' => 70, '24.8' => 69, '24.9' => 68, '25' => 67, '25.1' => 66,
            '25.2' => 65, '25.3' => 64, '25.4' => 63, '25.5' => 62, '25.6' => 61,
            '25.7' => 60, '25.8' => 59, '25.9' => 58, '26' => 57, '26.1' => 56,
            '26.2' => 55, '26.3' => 54, '26.4' => 53, '26.5' => 52, '26.6' => 51,
            '26.7' => 50, '26.8' => 49, '26.9' => 48, '27' => 47, '27.1' => 46,
            '27.2' => 45, '27.3' => 44, '27.4' => 43, '27.5' => 42, '27.6' => 41,
            '27.7' => 40, '27.8' => 39, '27.9' => 38, '28' => 37, '28.1' => 36,
            '28.2' => 35, '28.3' => 34, '28.4' => 33, '28.5' => 32, '28.6' => 31,
            '28.7' => 30, '28.8' => 29, '28.9' => 28, '29' => 27, '29.1' => 26,
            '29.2' => 25, '29.3' => 24, '29.4' => 23, '29.5' => 22, '29.6' => 21,
            '29.7' => 20, '29.8' => 19, '29.9' => 18, '30' => 17, '30.1' => 16,
            '30.2' => 15, '30.3' => 14, '30.4' => 13, '30.5' => 12, '30.6' => 11,
            '30.7' => 10, '30.8' => 9, '30.9' => 8, '31' => 7, '31.1' => 6,
            '31.2' => 5, '31.3' => 4, '31.4' => 3, '31.5' => 2, '31.6' => 1
        ]
    ];

    $nilaiAkhir = 0;

    if ($umurPengguna < 25) {
        if ($jumlahShuttleRunWanita < 17.2) {
            $nilaiAkhir = 100;
        } elseif ($jumlahShuttleRunWanita > 27.1) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiShuttleRun['under_25'][(string)$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['under_25'][(string)$jumlahShuttleRunWanita] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($jumlahShuttleRunWanita < 17.7) {
            $nilaiAkhir = 100;
        } elseif ($jumlahShuttleRunWanita > 27.6) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiShuttleRun['25-34'][(string)$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['25-34'][(string)$jumlahShuttleRunWanita] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($jumlahShuttleRunWanita < 18.7) {
            $nilaiAkhir = 100;
        } elseif ($jumlahShuttleRunWanita > 28.6) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiShuttleRun['35-44'][(string)$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['35-44'][(string)$jumlahShuttleRunWanita] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($jumlahShuttleRunWanita < 20.2) {
            $nilaiAkhir = 100;
        } elseif ($jumlahShuttleRunWanita > 30.1) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiShuttleRun['45-54'][(string)$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['45-54'][(string)$jumlahShuttleRunWanita] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($jumlahShuttleRunWanita < 21.7) {
            $nilaiAkhir = 100;
        } elseif ($jumlahShuttleRunWanita > 31.6) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiShuttleRun['55-59'][(string)$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['55-59'][(string)$jumlahShuttleRunWanita] : 0;
        }
    }

    if (!$nilaiAkhir) {
        setPesanKesalahan("Input waktu tidak valid untuk usia pengguna ini.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-wanita-shuttlerun.php");
        exit;
    }

    $dataPenggunaWanita = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Shuttle_Run_Wanita' => $tanggalPelaksanaanShuttleRunWanita,
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

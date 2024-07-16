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

if (isset($_POST['Simpan'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    $obyekPengguna = new Pengguna($koneksi);
    $obyekGarjasPriaShuttleRun = new GarjasPriaShuttleRun($koneksi);
    $obyekPenggunaWanita = new GarjasWanitaShuttleRun($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $tanggalPelaksanaanShuttleRun = $_POST['Tanggal_Pelaksanaan_Shuttle_Run'];
    $tanggal_pelaksanaan_shuttlerun = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanShuttleRun);

    if ($tanggal_pelaksanaan_shuttlerun === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_shuttlerun->format('Y-m-d');
    }

    $waktuShuttleRun = mysqli_real_escape_string($koneksi, $_POST['Waktu_Shuttle_Run']);
    $umurPengguna = $obyekGarjasPriaShuttleRun->ambilUmurGarjasShuttleRunPriaOlehNIP($nipPengguna);
    $cekKelaminPengguna = $obyekPengguna->cekKelaminPenggunaSesuaiNIP($nipPengguna);

    $waktuShuttleRun = str_replace(',', '.', $waktuShuttleRun);
    $waktuShuttleRun = (float) $waktuShuttleRun;

    if ($cekKelaminPengguna == "Pria") {
        if (empty($nipPengguna) && empty($waktuShuttleRun) && empty($tanggalPelaksanaanShuttleRun)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($waktuShuttleRun)) {
            $pesanKesalahan = "Waktu Shuttle Run harus diisi ";
        } elseif (empty($tanggalPelaksanaanShuttleRun)) {
            $pesanKesalahan = "Tanggal Pelaksanaan Shuttle Run harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: $akarUrl" . "src/user/pages/shuttlerun.php");
            exit;
        }

        if ($waktuShuttleRun == 0) {
            setPesanKesalahan("Waktu Shuttle Run tidak boleh 0.");
            header("Location: $akarUrl" . "src/user/pages/shuttlerun.php");
            exit;
        }
        if ($waktuShuttleRun < 0) {
            setPesanKesalahan("Waktu Shuttle Run tidak boleh negatif.");
            header("Location: $akarUrl" . "src/user/pages/shuttlerun.php");
            exit;
        }

        $nilaiShuttleRunPria = [
            'under_25' => [
                '<15.9' => 100,
                '>25.8' => 1,
                15.9 => 100, 16 => 99, 16.1 => 98, 16.2 => 97, 16.3 => 96,
                16.4 => 95, 16.5 => 94, 16.6 => 93, 16.7 => 92, 16.8 => 91,
                16.9 => 90, 17 => 89, 17.1 => 88, 17.2 => 87, 17.3 => 86,
                17.4 => 85, 17.5 => 84, 17.6 => 83, 17.7 => 82, 17.8 => 81,
                17.9 => 80, 18 => 79, 18.1 => 78, 18.2 => 77, 18.3 => 76,
                18.4 => 75, 18.5 => 74, 18.6 => 73, 18.7 => 72, 18.8 => 71,
                18.9 => 70, 19 => 69, 19.1 => 68, 19.2 => 67, 19.3 => 66,
                19.4 => 65, 19.5 => 64, 19.6 => 63, 19.7 => 62, 19.8 => 61,
                19.9 => 60, 20 => 59, 20.1 => 58, 20.2 => 57, 20.3 => 56,
                20.4 => 55, 20.5 => 54, 20.6 => 53, 20.7 => 52, 20.8 => 51,
                20.9 => 50, 21 => 49, 21.1 => 48, 21.2 => 47, 21.3 => 46,
                21.4 => 45, 21.5 => 44, 21.6 => 43, 21.7 => 42, 21.8 => 41,
                21.9 => 40, 22 => 39, 22.1 => 38, 22.2 => 37, 22.3 => 36,
                22.4 => 35, 22.5 => 34, 22.6 => 33, 22.7 => 32, 22.8 => 31,
                22.9 => 30, 23 => 29, 23.1 => 28, 23.2 => 27, 23.3 => 26,
                23.4 => 25, 23.5 => 24, 23.6 => 23, 23.7 => 22, 23.8 => 21,
                23.9 => 20, 24 => 19, 24.1 => 18, 24.2 => 17, 24.3 => 16,
                24.4 => 15, 24.5 => 14, 24.6 => 13, 24.7 => 12, 24.8 => 11,
                24.9 => 10, 25 => 9, 25.1 => 8, 25.2 => 7, 25.3 => 6,
                25.4 => 5, 25.5 => 4, 25.6 => 3, 25.7 => 2, 25.8 => 1,
            ],



            '25-34' => [
                '<16.9' => 100,
                '>26.8' => 1,
                16.9 => 100, 17 => 99, 17.1 => 98, 17.2 => 97, 17.3 => 96,
                17.4 => 95, 17.5 => 94, 17.6 => 93, 17.7 => 92, 17.8 => 91,
                17.9 => 90, 18 => 89, 18.1 => 88, 18.2 => 87, 18.3 => 86,
                18.4 => 85, 18.5 => 84, 18.6 => 83, 18.7 => 82, 18.8 => 81,
                18.9 => 80, 19 => 79, 19.1 => 78, 19.2 => 77, 19.3 => 76,
                19.4 => 75, 19.5 => 74, 19.6 => 73, 19.7 => 72, 19.8 => 71,
                19.9 => 70, 20 => 69, 20.1 => 68, 20.2 => 67, 20.3 => 66,
                20.4 => 65, 20.5 => 64, 20.6 => 63, 20.7 => 62, 20.8 => 61,
                20.9 => 60, 21 => 59, 21.1 => 58, 21.2 => 57, 21.3 => 56,
                21.4 => 55, 21.5 => 54, 21.6 => 53, 21.7 => 52, 21.8 => 51,
                21.9 => 50, 22 => 49, 22.1 => 48, 22.2 => 47, 22.3 => 46,
                22.4 => 45, 22.5 => 44, 22.6 => 43, 22.7 => 42, 22.8 => 41,
                22.9 => 40, 23 => 39, 23.1 => 38, 23.2 => 37, 23.3 => 36,
                23.4 => 35, 23.5 => 34, 23.6 => 33, 23.7 => 32, 23.8 => 31,
                23.9 => 30, 24 => 29, 24.1 => 28, 24.2 => 27, 24.3 => 26,
                24.4 => 25, 24.5 => 24, 24.6 => 23, 24.7 => 22, 24.8 => 21,
                24.9 => 20, 25 => 19, 25.1 => 18, 25.2 => 17, 25.3 => 16,
                25.4 => 15, 25.5 => 14, 25.6 => 13, 25.7 => 12, 25.8 => 11,
                25.9 => 10, 26 => 9, 26.1 => 8, 26.2 => 7, 26.3 => 6,
                26.4 => 5, 26.5 => 4, 26.6 => 3, 26.7 => 2, 26.8 => 1,
            ],

            '35-44' => [
                '<17.4' => 100,
                '>27.3' => 1,
                17.4 => 100, 17.5 => 99, 17.6 => 98, 17.7 => 97, 17.8 => 96,
                17.9 => 95, 18 => 94, 18.1 => 93, 18.2 => 92, 18.3 => 91,
                18.4 => 90, 18.5 => 89, 18.6 => 88, 18.7 => 87, 18.8 => 86,
                18.9 => 85, 19 => 84, 19.1 => 83, 19.2 => 82, 19.3 => 81,
                19.4 => 80, 19.5 => 79, 19.6 => 78, 19.7 => 77, 19.8 => 76,
                19.9 => 75, 20 => 74, 20.1 => 73, 20.2 => 72, 20.3 => 71,
                20.4 => 70, 20.5 => 69, 20.6 => 68, 20.7 => 67, 20.8 => 66,
                20.9 => 65, 21 => 64, 21.1 => 63, 21.2 => 62, 21.3 => 61,
                21.4 => 60, 21.5 => 59, 21.6 => 58, 21.7 => 57, 21.8 => 56,
                21.9 => 55, 22 => 54, 22.1 => 53, 22.2 => 52, 22.3 => 51,
                22.4 => 50, 22.5 => 49, 22.6 => 48, 22.7 => 47, 22.8 => 46,
                22.9 => 45, 23 => 44, 23.1 => 43, 23.2 => 42, 23.3 => 41,
                23.4 => 40, 23.5 => 39, 23.6 => 38, 23.7 => 37, 23.8 => 36,
                23.9 => 35, 24 => 34, 24.1 => 33, 24.2 => 32, 24.3 => 31,
                24.4 => 30, 24.5 => 29, 24.6 => 28, 24.7 => 27, 24.8 => 26,
                24.9 => 25, 25 => 24, 25.1 => 23, 25.2 => 22, 25.3 => 21,
                25.4 => 20, 25.5 => 19, 25.6 => 18, 25.7 => 17, 25.8 => 16,
                25.9 => 15, 26 => 14, 26.1 => 13, 26.2 => 12, 26.3 => 11,
                26.4 => 10, 26.5 => 9, 26.6 => 8, 26.7 => 7, 26.8 => 6,
                26.9 => 5, 27 => 4, 27.1 => 3, 27.2 => 2, 27.3 => 1,
            ],

            '45-54' => [
                '<18.9' => 100,
                '>28.8' => 1,
                18.9 => 100, 19 => 99, 19.1 => 98, 19.2 => 97, 19.3 => 96,
                19.4 => 95, 19.5 => 94, 19.6 => 93, 19.7 => 92, 19.8 => 91,
                19.9 => 90, 20 => 89, 20.1 => 88, 20.2 => 87, 20.3 => 86,
                20.4 => 85, 20.5 => 84, 20.6 => 83, 20.7 => 82, 20.8 => 81,
                20.9 => 80, 21 => 79, 21.1 => 78, 21.2 => 77, 21.3 => 76,
                21.4 => 75, 21.5 => 74, 21.6 => 73, 21.7 => 72, 21.8 => 71,
                21.9 => 70, 22 => 69, 22.1 => 68, 22.2 => 67, 22.3 => 66,
                22.4 => 65, 22.5 => 64, 22.6 => 63, 22.7 => 62, 22.8 => 61,
                22.9 => 60, 23 => 59, 23.1 => 58, 23.2 => 57, 23.3 => 56,
                23.4 => 55, 23.5 => 54, 23.6 => 53, 23.7 => 52, 23.8 => 51,
                23.9 => 50, 24 => 49, 24.1 => 48, 24.2 => 47, 24.3 => 46,
                24.4 => 45, 24.5 => 44, 24.6 => 43, 24.7 => 42, 24.8 => 41,
                24.9 => 40, 25 => 39, 25.1 => 38, 25.2 => 37, 25.3 => 36,
                25.4 => 35, 25.5 => 34, 25.6 => 33, 25.7 => 32, 25.8 => 31,
                25.9 => 30, 26 => 29, 26.1 => 28, 26.2 => 27, 26.3 => 26,
                26.4 => 25, 26.5 => 24, 26.6 => 23, 26.7 => 22, 26.8 => 21,
                26.9 => 20, 27 => 19, 27.1 => 18, 27.2 => 17, 27.3 => 16,
                27.4 => 15, 27.5 => 14, 27.6 => 13, 27.7 => 12, 27.8 => 11,
                27.9 => 10, 28 => 9, 28.1 => 8, 28.2 => 7, 28.3 => 6,
                28.4 => 5, 28.5 => 4, 28.6 => 3, 28.7 => 2, 28.8 => 1,
            ],

            '55-59' => [
                '<20.4' => 100,
                '>30.3' => 1,
                20.4 => 100, 20.5 => 99, 20.6 => 98, 20.7 => 97, 20.8 => 96,
                20.9 => 95, 21 => 94, 21.1 => 93, 21.2 => 92, 21.3 => 91,
                21.4 => 90, 21.5 => 89, 21.6 => 88, 21.7 => 87, 21.8 => 86,
                21.9 => 85, 22 => 84, 22.1 => 83, 22.2 => 82, 22.3 => 81,
                22.4 => 80, 22.5 => 79, 22.6 => 78, 22.7 => 77, 22.8 => 76,
                22.9 => 75, 23 => 74, 23.1 => 73, 23.2 => 72, 23.3 => 71,
                23.4 => 70, 23.5 => 69, 23.6 => 68, 23.7 => 67, 23.8 => 66,
                23.9 => 65, 24 => 64, 24.1 => 63, 24.2 => 62, 24.3 => 61,
                24.4 => 60, 24.5 => 59, 24.6 => 58, 24.7 => 57, 24.8 => 56,
                24.9 => 55, 25 => 54, 25.1 => 53, 25.2 => 52, 25.3 => 51,
                25.4 => 50, 25.5 => 49, 25.6 => 48, 25.7 => 47, 25.8 => 46,
                25.9 => 45, 26 => 44, 26.1 => 43, 26.2 => 42, 26.3 => 41,
                26.4 => 40, 26.5 => 39, 26.6 => 38, 26.7 => 37, 26.8 => 36,
                26.9 => 35, 27 => 34, 27.1 => 33, 27.2 => 32, 27.3 => 31,
                27.4 => 30, 27.5 => 29, 27.6 => 28, 27.7 => 27, 27.8 => 26,
                27.9 => 25, 28 => 24, 28.1 => 23, 28.2 => 22, 28.3 => 21,
                28.4 => 20, 28.5 => 19, 28.6 => 18, 28.7 => 17, 28.8 => 16,
                28.9 => 15, 29 => 14, 29.1 => 13, 29.2 => 12, 29.3 => 11,
                29.4 => 10, 29.5 => 9, 29.6 => 8, 29.7 => 7, 29.8 => 6,
                29.9 => 5, 30 => 4, 30.1 => 3, 30.2 => 2, 30.3 => 1,
            ]
        ];

        $nilaiAkhir = 0;

        if ($umurPengguna < 25) {
            if ($waktuShuttleRun < 15.9 && isset($nilaiShuttleRunPria['under_25']['<15.9'])) {
                $nilaiAkhir = $nilaiShuttleRunPria['under_25']['<15.9'];
            } elseif ($waktuShuttleRun > 25.8) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRunPria['under_25'][$waktuShuttleRun]) ? $nilaiShuttleRunPria['under_25'][$waktuShuttleRun] : 0;
            }
        } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
            if ($waktuShuttleRun < 16.9 && isset($nilaiShuttleRunPria['25-34']['<16.9'])) {
                $nilaiAkhir = $nilaiShuttleRunPria['25-34']['<16.9'];
            } elseif ($waktuShuttleRun > 26.8) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRunPria['25-34'][$waktuShuttleRun]) ? $nilaiShuttleRunPria['25-34'][$waktuShuttleRun] : 0;
            }
        } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
            if ($waktuShuttleRun < 17.4 && isset($nilaiShuttleRunPria['35-44']['<17.4'])) {
                $nilaiAkhir = $nilaiShuttleRunPria['35-44']['<17.4'];
            } elseif ($waktuShuttleRun > 27.3) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRunPria['35-44'][$waktuShuttleRun]) ? $nilaiShuttleRunPria['35-44'][$waktuShuttleRun] : 0;
            }
        } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
            if ($waktuShuttleRun < 18.9 && isset($nilaiShuttleRunPria['45-54']['<18.9'])) {
                $nilaiAkhir = $nilaiShuttleRunPria['45-54']['<18.9'];
            } elseif ($waktuShuttleRun > 28.8) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRunPria['45-54'][$waktuShuttleRun]) ? $nilaiShuttleRunPria['45-54'][$waktuShuttleRun] : 0;
            }
        } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
            if ($waktuShuttleRun < 20.4 && isset($nilaiShuttleRunPria['55-59']['<20.4'])) {
                $nilaiAkhir = $nilaiShuttleRunPria['55-59']['<20.4'];
            } elseif ($waktuShuttleRun > 30.3) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRunPria['55-59'][$waktuShuttleRun]) ? $nilaiShuttleRunPria['55-59'][$waktuShuttleRun] : 0;
            }
        }

        $dataGarjasPriaShuttleRun = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Shuttle_Run_Pria' => $tanggal_pelaksanaan_shuttlerun,
            'Waktu_Shuttle_Run_Pria' => $waktuShuttleRun,
            'Nilai_Shuttle_Run_Pria' => $nilaiAkhir,
            "Status_Pria_Shuttle_Run" => "Ditinjau"
        );

        if ($obyekGarjasPriaShuttleRun->cekNipAnggotaShuttleRunPriaSudahAda($nipPengguna)) {
            $updateGarjasPriaShuttleRun = $obyekGarjasPriaShuttleRun->perbaruiGarjasPriaShuttleRunJikaDitolak($nipPengguna, $dataGarjasPriaShuttleRun);
        } else {
            $simpanDataGarjasPriaShhuttleRun = $obyekGarjasPriaShuttleRun->tambahGarjasPriaShuttleRun($dataGarjasPriaShuttleRun);
        }
    } else {

        if ($waktuShuttleRun == 0) {
            setPesanKesalahan("Nilai Shuttle Run tidak boleh 0.");
            header("Location: $akarUrl" . "src/user/pages/shuttlerun.php");
            exit;
        }

        if (empty($nipPengguna) && empty($tanggalPelaksanaanShuttleRun) && empty($waktuShuttleRun)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($tanggalPelaksanaanShuttleRun)) {
            $pesanKesalahan = "Tanggal pelaksanaan Shutle Run harus diisi. ";
        } elseif (empty($waktuShuttleRun)) {
            $pesanKesalahan = "Jumlah Shutle Run harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: " . $akarUrl . "src/user/pages/shuttlerun.php");
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
            if ($waktuShuttleRun < 17.2) {
                $nilaiAkhir = 100;
            } elseif ($waktuShuttleRun > 27.1) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRun['under_25'][(string)$waktuShuttleRun]) ? $nilaiShuttleRun['under_25'][(string)$waktuShuttleRun] : 0;
            }
        } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
            if ($waktuShuttleRun < 17.7) {
                $nilaiAkhir = 100;
            } elseif ($waktuShuttleRun > 27.6) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRun['25-34'][(string)$waktuShuttleRun]) ? $nilaiShuttleRun['25-34'][(string)$waktuShuttleRun] : 0;
            }
        } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
            if ($waktuShuttleRun < 18.7) {
                $nilaiAkhir = 100;
            } elseif ($waktuShuttleRun > 28.6) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRun['35-44'][(string)$waktuShuttleRun]) ? $nilaiShuttleRun['35-44'][(string)$waktuShuttleRun] : 0;
            }
        } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
            if ($waktuShuttleRun < 20.2) {
                $nilaiAkhir = 100;
            } elseif ($waktuShuttleRun > 30.1) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRun['45-54'][(string)$waktuShuttleRun]) ? $nilaiShuttleRun['45-54'][(string)$waktuShuttleRun] : 0;
            }
        } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
            if ($waktuShuttleRun < 21.7) {
                $nilaiAkhir = 100;
            } elseif ($waktuShuttleRun > 31.6) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiShuttleRun['55-59'][(string)$waktuShuttleRun]) ? $nilaiShuttleRun['55-59'][(string)$waktuShuttleRun] : 0;
            }
        }

        if (!$nilaiAkhir) {
            setPesanKesalahan("Input waktu tidak valid untuk usia pengguna ini.");
            header("Location: $akarUrl" . "src/user/pages/shuttlerun.php");
            exit;
        }

        $dataPenggunaWanita = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Shuttle_Run_Wanita' => $tanggalPelaksanaanShuttleRun,
            'Jumlah_Shuttle_Run_Wanita' => $waktuShuttleRun,
            'Nilai_Shuttle_Run_Wanita' => $nilaiAkhir,
            'Status_Wanita_Shuttle_Run' => "Ditinjau"
        );

        if ($obyekPenggunaWanita->cekNipAnggotaShuttleRunWanitaSudahAda($nipPengguna)) {
            $updateGarjasWanitaShuttleRun = $obyekPenggunaWanita->perbaruiGarjasWanitaShuttleRunJikaDitolak($nipPengguna, $dataPenggunaWanita);
        } else {
            $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahGarjasWanitaShuttleRun($dataPenggunaWanita);
        }
    }

    if ($simpanDataGarjasPriaShhuttleRun || $updateGarjasPriaShuttleRun || $simpanDataPenggunaWanita || $updateGarjasWanitaShuttleRun) {
        setPesanKeberhasilan("Berhasil, data anda berhasil disimpan mohon menunggu verifikasi admin.");
    } else {
        setPesanKesalahan("Gagal menyimpan data anggota.");
    }

    header("Location: $akarUrl" . "src/user/pages/shuttlerun.php");
    exit;
}
ob_end_flush();

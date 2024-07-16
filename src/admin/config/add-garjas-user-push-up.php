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
    $obyekPenggunaPria = new GarjasPushUpPria($koneksi);
    $obyekPenggunaWanita = new GarjasWanitaPushUp($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $jumlahPushUp = mysqli_real_escape_string($koneksi, $_POST['Jumlah_Push_Up']);
    $tanggalPelaksanaanPushUp = $_POST['Tanggal_Pelaksanaan_Push_Up'];
    $tanggal_pelaksanaan_pushup = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanPushUp);

    if ($tanggal_pelaksanaan_pushup === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_pushup->format('Y-m-d');
    }

    $umurPengguna = $obyekPenggunaPria->ambilUmurGarjasPushUpPriaOlehNIP($nipPengguna);
    $cekKelaminPengguna = $obyekPengguna->cekKelaminPenggunaSesuaiNIP($nipPengguna);

    if ($cekKelaminPengguna == "Pria") {
        if (empty($nipPengguna) && empty($jumlahPushUp) && empty($tanggalPelaksanaanPushUp)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($jumlahPushUp)) {
            $pesanKesalahan = "Jumlah Push Up harus diisi ";
        } elseif (empty($tanggalPelaksanaanPushUp)) {
            $pesanKesalahan = "Tanggal Pelaksanaan Push Up harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: $akarUrl" . "src/user/pages/pushup.php");
            exit;
        }

        if ($jumlahPushUp == 0) {
            setPesanKesalahan("Nilai push-up tidak boleh 0.");
            header("Location: $akarUrl" . "src/user/pages/pushup.php");
            exit;
        }

        if ($jumlahPushUp < 0) {
            setPesanKesalahan("Nilai push-up tidak boleh negatif.");
            header("Location: $akarUrl" . "src/user/pages/pushup.php");
            exit;
        }

        $nilaiPushUp = [
            'under_25' => [
                '>44' => 100,
                44 => 100, 43 => 96, 42 => 91, 41 => 87, 40 => 83,
                39 => 78, 38 => 74, 37 => 70, 36 => 65, 35 => 61,
                34 => 59, 33 => 57, 32 => 56, 31 => 54, 30 => 52,
                29 => 50, 28 => 49, 27 => 47, 26 => 45, 25 => 43,
                24 => 42, 23 => 40, 22 => 38, 21 => 36, 20 => 35,
                19 => 33, 18 => 31, 17 => 29, 16 => 27, 15 => 26,
                14 => 24, 13 => 22, 12 => 20, 11 => 19, 10 => 17,
                9 => 15, 8 => 13, 7 => 12, 6 => 10, 5 => 8,
                4 => 6, 3 => 5, 2 => 3, 1 => 1, 0 => 0,
            ],
            '25-34' => [
                '>42' => 100,
                42 => 100, 41 => 96, 40 => 91, 39 => 87, 38 => 83,
                37 => 78, 36 => 74, 35 => 70, 34 => 65, 33 => 61,
                32 => 59, 31 => 57, 30 => 56, 29 => 54, 28 => 52,
                27 => 50, 26 => 48, 25 => 46, 24 => 44, 23 => 42,
                22 => 40, 21 => 39, 20 => 37, 19 => 35, 18 => 33,
                17 => 31, 16 => 29, 15 => 27, 14 => 25, 13 => 24,
                12 => 22, 11 => 20, 10 => 18, 9 => 16, 8 => 14,
                7 => 13, 6 => 11, 5 => 9, 4 => 7, 3 => 6,
                2 => 4, 1 => 2, 0 => 0,
            ],
            '35-44' => [
                '>39' => 100,
                39 => 100, 38 => 96, 37 => 91, 36 => 87, 35 => 83,
                34 => 78, 33 => 74, 32 => 70, 31 => 65, 30 => 61,
                29 => 60, 28 => 58, 27 => 56, 26 => 53, 25 => 51,
                24 => 49, 23 => 47, 22 => 44, 21 => 42, 20 => 40,
                19 => 38, 18 => 36, 17 => 34, 16 => 32, 15 => 30,
                14 => 28, 13 => 26, 12 => 24, 11 => 22, 10 => 20,
                9 => 18, 8 => 16, 7 => 14, 6 => 12, 5 => 10,
                4 => 8, 3 => 7, 2 => 5, 1 => 3, 0 => 0,
            ],
            '45-54' => [
                '>33' => 100,
                33 => 100, 32 => 97, 31 => 94, 30 => 91, 29 => 88,
                28 => 85, 27 => 82, 26 => 79, 25 => 76, 24 => 73,
                23 => 70, 22 => 67, 21 => 64, 20 => 61, 19 => 58,
                18 => 55, 17 => 52, 16 => 48, 15 => 45, 14 => 42,
                13 => 39, 12 => 36, 11 => 33, 10 => 29, 9 => 26,
                8 => 23, 7 => 20, 6 => 17, 5 => 14, 4 => 11,
                3 => 9, 2 => 6, 1 => 4, 0 => 0,
            ],
            '55-59' => [
                '>22' => 100,
                22 => 100, 21 => 97, 20 => 94, 19 => 91, 18 => 88,
                17 => 85, 16 => 82, 15 => 79, 14 => 76, 13 => 73,
                12 => 70, 11 => 67, 10 => 64, 9 => 61, 8 => 54,
                7 => 46, 6 => 39, 5 => 31, 4 => 24, 3 => 16,
                2 => 10, 1 => 6, 0 => 0,
            ]
        ];

        $nilaiAkhir = 0;
        if ($umurPengguna < 25) {
            if ($jumlahPushUp > 44 && isset($nilaiPushUp['under_25']['>44'])) {
                $nilaiAkhir = $nilaiPushUp['under_25']['>44'];
            } else {
                $nilaiAkhir = isset($nilaiPushUp['under_25'][$jumlahPushUp]) ? $nilaiPushUp['under_25'][$jumlahPushUp] : 0;
            }
        } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
            if ($jumlahPushUp > 42 && isset($nilaiPushUp['25-34']['>42'])) {
                $nilaiAkhir = $nilaiPushUp['25-34']['>42'];
            } else {
                $nilaiAkhir = isset($nilaiPushUp['25-34'][$jumlahPushUp]) ? $nilaiPushUp['25-34'][$jumlahPushUp] : 0;
            }
        } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
            if ($jumlahPushUp > 39 && isset($nilaiPushUp['35-44']['>39'])) {
                $nilaiAkhir = $nilaiPushUp['35-44']['>39'];
            } else {
                $nilaiAkhir = isset($nilaiPushUp['35-44'][$jumlahPushUp]) ? $nilaiPushUp['35-44'][$jumlahPushUp] : 0;
            }
        } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
            if ($jumlahPushUp > 33 && isset($nilaiPushUp['45-54']['>33'])) {
                $nilaiAkhir = $nilaiPushUp['45-54']['>33'];
            } else {
                $nilaiAkhir = isset($nilaiPushUp['45-54'][$jumlahPushUp]) ? $nilaiPushUp['45-54'][$jumlahPushUp] : 0;
            }
        } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
            if ($jumlahPushUp > 22 && isset($nilaiPushUp['55-59']['>22'])) {
                $nilaiAkhir = $nilaiPushUp['55-59']['>22'];
            } else {
                $nilaiAkhir = isset($nilaiPushUp['55-59'][$jumlahPushUp]) ? $nilaiPushUp['55-59'][$jumlahPushUp] : 0;
            }
        }

        $dataPengguna = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Push_Up_Pria' => $tanggalPelaksanaanPushUp,
            'Jumlah_Push_Up_Pria' => $jumlahPushUp,
            'Nilai_Push_Up_Pria' => $nilaiAkhir,
            "Status_Pria_Push_Up" => "Ditinjau"
        );

        if ($obyekPenggunaPria->cekNipAnggotaPushUpPriaSudahAda($nipPengguna)) {
            $updateGarjasPriaPushUp = $obyekPenggunaPria->perbaruiGarjasPriaPushUpJikaDitolak($nipPengguna, $dataPengguna);
        } else {
            $simpanDataPengguna = $obyekPenggunaPria->tambahGarjasPushUpPria($dataPengguna);
        }
    } else {

        if ($jumlahPushUp == 0) {
            setPesanKesalahan("Nilai push-up tidak boleh 0.");
            header("Location: $akarUrl" . "src/user/pages/pushup.php");
            exit;
        }

        if (empty($nipPengguna) && empty($tanggalPelaksanaanPushUp) && empty($jumlahPushUp)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($tanggalPelaksanaanPushUp)) {
            $pesanKesalahan = "Tanggal pelaksanaan push-up harus diisi. ";
        } elseif (empty($jumlahPushUp)) {
            $pesanKesalahan = "Jumlah push-up harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: " . $akarUrl . "src/user/pages/pushup.php");
            exit;
        }

        $nilaiPushUp = [
            'under_25' => [
                38 => 100, 37 => 98, 36 => 96, 35 => 94, 34 => 92,
                33 => 89, 32 => 87, 31 => 85, 30 => 83, 29 => 81,
                28 => 79, 27 => 77, 26 => 75, 25 => 73, 24 => 70,
                23 => 68, 22 => 66, 21 => 64, 20 => 62, 19 => 60,
                18 => 58, 17 => 56, 16 => 54, 14 => 49, 13 => 47,
                12 => 45, 11 => 43, 10 => 41, 9 => 37, 8 => 32,
                7 => 27, 6 => 23, 5 => 19, 4 => 14, 3 => 10, 2 => 5, 1 => 1
            ],
            '25-34' => [
                36 => 100, 35 => 98, 34 => 96, 33 => 94, 32 => 92,
                31 => 89, 30 => 87, 29 => 85, 28 => 83, 27 => 81,
                26 => 79, 25 => 77, 24 => 75, 23 => 73, 22 => 70,
                21 => 68, 20 => 66, 19 => 64, 18 => 62, 17 => 60,
                16 => 58, 15 => 56, 14 => 54, 13 => 52, 12 => 49,
                11 => 47, 10 => 45, 9 => 43, 8 => 41, 7 => 37,
                6 => 32, 5 => 27, 4 => 23, 3 => 19, 2 => 14, 1 => 10
            ],
            '35-44' => [
                34 => 100, 33 => 98, 32 => 96, 31 => 94, 30 => 92,
                29 => 89, 28 => 87, 27 => 85, 26 => 83, 25 => 81,
                24 => 79, 23 => 77, 22 => 75, 21 => 73, 20 => 70,
                19 => 68, 18 => 66, 17 => 64, 16 => 62, 15 => 60,
                14 => 58, 13 => 56, 12 => 54, 11 => 52, 10 => 49,
                9 => 47, 8 => 45, 7 => 43, 6 => 41, 5 => 37, 4 => 32,
                3 => 27, 2 => 23, 1 => 19
            ],
            '45-54' => [
                32 => 100, 31 => 98, 30 => 96, 29 => 94, 28 => 92,
                27 => 89, 26 => 87, 25 => 85, 24 => 83, 23 => 81,
                22 => 79, 21 => 77, 20 => 75, 19 => 73, 18 => 70,
                17 => 68, 16 => 66, 15 => 64, 14 => 62, 13 => 60,
                12 => 58, 11 => 56, 10 => 54, 9 => 52, 8 => 49,
                7 => 47, 6 => 45, 5 => 43, 4 => 41, 3 => 37,
                2 => 34, 1 => 32
            ],
            '55-59' => [
                31 => 100, 30 => 98, 29 => 96, 28 => 94, 27 => 92,
                26 => 89, 25 => 88, 24 => 87, 23 => 85, 22 => 83,
                21 => 81, 20 => 79, 19 => 77, 18 => 75, 17 => 73,
                16 => 70, 15 => 68, 14 => 66, 13 => 64, 12 => 62,
                11 => 60, 10 => 58, 9 => 56, 8 => 54, 7 => 52,
                6 => 49, 5 => 47, 4 => 45, 3 => 43, 2 => 41, 1 => 37
            ]
        ];

        $nilaiAkhir = 0;
        $maksimalPushUp = 0;

        if ($umurPengguna < 25) {
            $maksimalPushUp = max(array_keys($nilaiPushUp['under_25']));
            $nilaiAkhir = $jumlahPushUp > $maksimalPushUp ? 100 : (isset($nilaiPushUp['under_25'][$jumlahPushUp]) ? $nilaiPushUp['under_25'][$jumlahPushUp] : 0);
        } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
            $maksimalPushUp = max(array_keys($nilaiPushUp['25-34']));
            $nilaiAkhir = $jumlahPushUp > $maksimalPushUp ? 100 : (isset($nilaiPushUp['25-34'][$jumlahPushUp]) ? $nilaiPushUp['25-34'][$jumlahPushUp] : 0);
        } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
            $maksimalPushUp = max(array_keys($nilaiPushUp['35-44']));
            $nilaiAkhir = $jumlahPushUp > $maksimalPushUp ? 100 : (isset($nilaiPushUp['35-44'][$jumlahPushUp]) ? $nilaiPushUp['35-44'][$jumlahPushUp] : 0);
        } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
            $maksimalPushUp = max(array_keys($nilaiPushUp['45-54']));
            $nilaiAkhir = $jumlahPushUp > $maksimalPushUp ? 100 : (isset($nilaiPushUp['45-54'][$jumlahPushUp]) ? $nilaiPushUp['45-54'][$jumlahPushUp] : 0);
        } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
            $maksimalPushUp = max(array_keys($nilaiPushUp['55-59']));
            $nilaiAkhir = $jumlahPushUp > $maksimalPushUp ? 100 : (isset($nilaiPushUp['55-59'][$jumlahPushUp]) ? $nilaiPushUp['55-59'][$jumlahPushUp] : 0);
        }

        $dataPenggunaWanita = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Push_Up_Wanita' => $tanggalPelaksanaanPushUp,
            'Jumlah_Push_Up_Wanita' => $jumlahPushUp,
            'Nilai_Push_Up_Wanita' => $nilaiAkhir,
            "Status_Wanita_Push_Up" => "Ditinjau"
        );

        if ($obyekPenggunaWanita->cekNipAnggotaPushUpWanitaSudahAda($nipPengguna)) {
            $updateGarjasWanitaPushUp = $obyekPenggunaWanita->perbaruiGarjasWanitaPushUpJikaDitolak($nipPengguna, $dataPenggunaWanita);
        } else {
            $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahGarjasWanitaPushUp($dataPenggunaWanita);
        }
    }

    if ($simpanDataPengguna || $updateGarjasPriaPushUp || $updateGarjasWanitaPushUp || $simpanDataPenggunaWanita) {
        setPesanKeberhasilan("Berhasil, data anda berhasil disimpan mohon menunggu verifikasi admin.");
    } else {
        setPesanKesalahan("Gagal menyimpan data anda.");
    }

    header("Location: $akarUrl" . "src/user/pages/pushup.php");
    exit;
}
ob_end_flush();

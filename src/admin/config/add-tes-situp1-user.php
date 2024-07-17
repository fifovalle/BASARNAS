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
    $obyekGarjasPriaSitUpKakiLurus = new GarjasPriaSitUpKakiLurus($koneksi);
    $obyekPenggunaWanita = new GarjasWanitaSitUp1($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $jumlahSitUpKakiLurus = mysqli_real_escape_string($koneksi, $_POST['Jumlah_Sit_Up_Kaki_Lurus']);
    $tanggalPelaksanaanSitUp1 = $_POST['Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus'];
    $tanggal_pelaksanaan_situp1 = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanSitUp1);

    if ($tanggal_pelaksanaan_situp1 === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_situp1->format('Y-m-d');
    }

    $umurPengguna = $obyekGarjasPriaSitUpKakiLurus->ambilUmurGarjasSitUpKakiLurusPriaOlehNIP($nipPengguna);
    $cekKelaminPengguna = $obyekPengguna->cekKelaminPenggunaSesuaiNIP($nipPengguna);

    if ($cekKelaminPengguna == "Pria") {


        if (empty($nipPengguna) && empty($jumlahSitUpKakiLurus) && empty($tanggalPelaksanaanSitUp1)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($jumlahSitUpKakiLurus)) {
            $pesanKesalahan = "Waktu Sit Up Kaki Lurus harus diisi ";
        } elseif (empty($tanggalPelaksanaanSitUp1)) {
            $pesanKesalahan = "Tanggal Pelaksanaan Sit Up Kaki Lurus harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: $akarUrl" . "src/user/pages/situp1.php");
            exit;
        }

        if ($jumlahSitUpKakiLurus == 0) {
            setPesanKesalahan("Nilai Sit Up Kaki Lurus tidak boleh 0.");
            header("Location: $akarUrl" . "src/user/pages/situp1.php");
            exit;
        }

        if ($jumlahSitUpKakiLurus < 0) {
            setPesanKesalahan("Nilai Sit Up Kaki Lurus tidak boleh negatif.");
            header("Location: $akarUrl" . "src/user/pages/situp1.php");
            exit;
        }

        $nilaiSitUpKakiLurus = [
            'under_25' => [
                '>46' => 100,
                46 => 100, 45 => 96, 44 => 93, 43 => 89, 42 => 85,
                41 => 82, 40 => 78, 39 => 74, 38 => 71, 37 => 67,
                36 => 63, 35 => 59, 34 => 56, 33 => 52, 32 => 48,
                31 => 45, 30 => 41, 29 => 39, 28 => 38, 27 => 37,
                26 => 36, 25 => 34, 24 => 33, 23 => 32, 22 => 30,
                21 => 29, 20 => 28, 19 => 26, 18 => 25, 17 => 24,
                16 => 22, 15 => 21, 14 => 20, 13 => 18, 12 => 17,
                11 => 16, 10 => 14, 9 => 13, 8 => 12, 7 => 10,
                6 => 9, 5 => 8, 4 => 6, 3 => 4, 2 => 3, 1 => 1
            ],
            '25-34' => [
                '>41' => 100,
                41 => 100, 40 => 96, 39 => 93, 38 => 89, 37 => 85,
                36 => 82, 35 => 78, 34 => 74, 33 => 71, 32 => 67,
                31 => 63, 30 => 59, 29 => 56, 28 => 52, 27 => 48,
                26 => 45, 25 => 41, 24 => 39, 23 => 38, 22 => 36,
                21 => 34, 20 => 33, 19 => 31, 18 => 29, 17 => 28,
                16 => 26, 15 => 24, 14 => 23, 13 => 21, 12 => 19,
                11 => 18, 10 => 16, 9 => 14, 8 => 13, 7 => 11,
                6 => 9, 5 => 8, 4 => 6, 3 => 4, 2 => 3, 1 => 2
            ],
            '35-44' => [
                '>36' => 100,
                36 => 100, 35 => 96, 34 => 93, 33 => 89, 32 => 85,
                31 => 82, 30 => 78, 29 => 74, 28 => 71, 27 => 67,
                26 => 63, 25 => 59, 24 => 56, 23 => 52, 22 => 48,
                21 => 45, 20 => 41, 19 => 39, 18 => 37, 17 => 35,
                16 => 33, 15 => 30, 14 => 28, 13 => 26, 12 => 24,
                11 => 22, 10 => 20, 9 => 18, 8 => 16, 7 => 14,
                6 => 12, 5 => 10, 4 => 8, 3 => 6, 2 => 4, 1 => 3
            ],
            '45-54' => [
                '>31' => 100,
                31 => 100, 30 => 96, 29 => 93, 28 => 89, 27 => 85,
                26 => 82, 25 => 78, 24 => 74, 23 => 71, 22 => 67,
                21 => 63, 20 => 59, 19 => 56, 18 => 52, 17 => 48,
                16 => 45, 15 => 41, 14 => 38, 13 => 35, 12 => 32,
                11 => 30, 10 => 27, 9 => 24, 8 => 21, 7 => 18,
                6 => 16, 5 => 14, 4 => 11, 3 => 9, 2 => 7, 1 => 5
            ],
            '55-59' => [
                '>26' => 100,
                26 => 100, 25 => 96, 24 => 93, 23 => 89, 22 => 85,
                21 => 82, 20 => 78, 19 => 74, 18 => 71, 17 => 67,
                16 => 63, 15 => 59, 14 => 56, 13 => 52, 12 => 48,
                11 => 45, 10 => 41, 9 => 37, 8 => 32, 7 => 28,
                6 => 23, 5 => 19, 4 => 14, 3 => 11, 2 => 9, 1 => 7
            ]
        ];

        $nilaiAkhirSitUpKakiLurus = 0;

        if ($umurPengguna < 25) {
            if ($jumlahSitUpKakiLurus > 46 && isset($nilaiSitUpKakiLurus['under_25']['>46'])) {
                $nilaiAkhirSitUpKakiLurus = $nilaiSitUpKakiLurus['under_25']['>46'];
            } else {
                $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUpKakiLurus['under_25'][$jumlahSitUpKakiLurus]) ? $nilaiSitUpKakiLurus['under_25'][$jumlahSitUpKakiLurus] : 0;
            }
        } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
            if ($jumlahSitUpKakiLurus >= 41 && isset($nilaiSitUpKakiLurus['25-34']['>41'])) {
                $nilaiAkhirSitUpKakiLurus = $nilaiSitUpKakiLurus['25-34']['>41'];
            } else {
                $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUpKakiLurus['25-34'][$jumlahSitUpKakiLurus]) ? $nilaiSitUpKakiLurus['25-34'][$jumlahSitUpKakiLurus] : 0;
            }
        } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
            if ($jumlahSitUpKakiLurus >= 36 && isset($nilaiSitUpKakiLurus['35-44']['>36'])) {
                $nilaiAkhirSitUpKakiLurus = $nilaiSitUpKakiLurus['35-44']['>36'];
            } else {
                $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUpKakiLurus['35-44'][$jumlahSitUpKakiLurus]) ? $nilaiSitUpKakiLurus['35-44'][$jumlahSitUpKakiLurus] : 0;
            }
        } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
            if ($jumlahSitUpKakiLurus >= 31 && isset($nilaiSitUpKakiLurus['45-54']['>31'])) {
                $nilaiAkhirSitUpKakiLurus = $nilaiSitUpKakiLurus['45-54']['>31'];
            } else {
                $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUpKakiLurus['45-54'][$jumlahSitUpKakiLurus]) ? $nilaiSitUpKakiLurus['45-54'][$jumlahSitUpKakiLurus] : 0;
            }
        } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
            if ($jumlahSitUpKakiLurus >= 26 && isset($nilaiSitUpKakiLurus['55-59']['>26'])) {
                $nilaiAkhirSitUpKakiLurus = $nilaiSitUpKakiLurus['55-59']['>26'];
            } else {
                $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUpKakiLurus['55-59'][$jumlahSitUpKakiLurus]) ? $nilaiSitUpKakiLurus['55-59'][$jumlahSitUpKakiLurus] : 0;
            }
        }

        $dataGarjasPriaSitUpKakiLurus = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria' => $tanggalPelaksanaanSitUp1,
            'Jumlah_Sit_Up_Kaki_Lurus_Pria' => $jumlahSitUpKakiLurus,
            'Nilai_Sit_Up_Kaki_Lurus_Pria' => $nilaiAkhirSitUpKakiLurus,
            "Status_Pria_Sit_Up_Kaki_Lurus" => "Ditinjau"
        );

        if ($obyekGarjasPriaSitUpKakiLurus->cekNipAnggotaSitUp1PriaSudahAda($nipPengguna)) {
            $updateGarjasPriaTesKakiLurus = $obyekGarjasPriaSitUpKakiLurus->perbaruiGarjasPriaSitUp1JikaDitolak($nipPengguna, $dataGarjasPriaSitUpKakiLurus);
        } else {
            $simpanDataGarjasPriaSitUpKakiLurus = $obyekGarjasPriaSitUpKakiLurus->tambahGarjasPriaSitUp1($dataGarjasPriaSitUpKakiLurus);
        }
    } else {

        if ($jumlahSitUpKakiLurus == 0) {
            setPesanKesalahan("Nilai Sit Up Kaki Lurus tidak boleh 0.");
            header("Location: $akarUrl" . "src/user/pages/situp1.php");
            exit;
        }

        if (empty($nipPengguna) && empty($tanggalPelaksanaanSitUp1) && empty($jumlahSitUpKakiLurus)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($tanggalPelaksanaanSitUp1)) {
            $pesanKesalahan = "Tanggal pelaksanaan sit up kaki lurus harus diisi. ";
        } elseif (empty($jumlahSitUpKakiLurus)) {
            $pesanKesalahan = "Jumlah sit up kaki lurus harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: " . $akarUrl . "src/user/pages/situp1.php");
            exit;
        }

        $nilaiSitUp1 = [
            'under_25' => [
                46 => 100, 45 => 96, 44 => 93, 43 => 89, 42 => 85,
                41 => 82, 40 => 78, 39 => 74, 38 => 71, 37 => 67,
                36 => 63, 35 => 59, 34 => 56, 33 => 52, 32 => 48,
                31 => 45, 30 => 41, 29 => 40, 28 => 38, 27 => 37,
                26 => 36, 25 => 34, 24 => 33, 23 => 32, 22 => 30,
                21 => 29, 20 => 28, 19 => 26, 18 => 25, 17 => 24,
                16 => 22, 15 => 21, 14 => 20, 13 => 18, 12 => 17,
                11 => 16, 10 => 14, 9 => 13, 8 => 12, 7 => 10,
                6 => 9, 5 => 8, 4 => 6, 3 => 4, 2 => 3, 1 => 1
            ],
            '25-34' => [
                41 => 100, 40 => 96, 39 => 93, 38 => 89, 37 => 85,
                36 => 82, 35 => 78, 34 => 74, 33 => 71, 32 => 67,
                31 => 63, 30 => 59, 29 => 56, 28 => 52, 27 => 48,
                26 => 45, 25 => 41, 24 => 40, 23 => 38, 22 => 37,
                21 => 36, 20 => 34, 19 => 33, 18 => 32, 17 => 30,
                16 => 29, 15 => 28, 14 => 26, 13 => 25, 12 => 24,
                11 => 22, 10 => 21, 9 => 20, 8 => 18, 7 => 17,
                6 => 16, 5 => 14, 4 => 13, 3 => 12, 2 => 10,
                1 => 9
            ],
            '35-44' => [
                36 => 100, 35 => 96, 34 => 93, 33 => 89, 32 => 85,
                31 => 82, 30 => 78, 29 => 74, 28 => 71, 27 => 67,
                26 => 63, 25 => 59, 24 => 56, 23 => 52, 22 => 48,
                21 => 45, 20 => 41, 19 => 40, 18 => 38, 17 => 37,
                16 => 36, 15 => 34, 14 => 33, 13 => 32, 12 => 30,
                11 => 29, 10 => 28, 9 => 26, 8 => 25, 7 => 24,
                6 => 22, 5 => 21, 4 => 20, 3 => 18, 2 => 17,
                1 => 16
            ],
            '45-54' => [
                31 => 100, 30 => 96, 29 => 93, 28 => 89, 27 => 85,
                26 => 82, 25 => 78, 24 => 74, 23 => 71, 22 => 67,
                21 => 63, 20 => 59, 19 => 56, 18 => 52, 17 => 48,
                16 => 45, 15 => 41, 14 => 40, 13 => 38, 12 => 37,
                11 => 36, 10 => 34, 9 => 33, 8 => 32, 7 => 30,
                6 => 29, 5 => 28, 4 => 26, 3 => 25, 2 => 24,
                1 => 22
            ],
            '55-59' => [
                26 => 100, 25 => 96, 24 => 93, 23 => 89, 22 => 85,
                21 => 82, 20 => 78, 19 => 74, 18 => 71, 17 => 67,
                16 => 63, 15 => 59, 14 => 56, 13 => 52, 12 => 48,
                11 => 45, 10 => 41, 9 => 40, 8 => 38, 7 => 37,
                6 => 36, 5 => 34, 4 => 33, 3 => 32, 2 => 30,
                1 => 29
            ]
        ];

        $nilaiAkhir = 0;
        $maksimalSitUp1 = 0;

        if ($umurPengguna < 25) {
            $maksimalSitUp1 = max(array_keys($nilaiSitUp1['under_25']));
            $nilaiAkhir = $jumlahSitUpKakiLurus > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['under_25'][$jumlahSitUpKakiLurus]) ? $nilaiSitUp1['under_25'][$jumlahSitUpKakiLurus] : 0);
        } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
            $maksimalSitUp1 = max(array_keys($nilaiSitUp1['25-34']));
            $nilaiAkhir = $jumlahSitUpKakiLurus > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['25-34'][$jumlahSitUpKakiLurus]) ? $nilaiSitUp1['25-34'][$jumlahSitUpKakiLurus] : 0);
        } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
            $maksimalSitUp1 = max(array_keys($nilaiSitUp1['35-44']));
            $nilaiAkhir = $jumlahSitUpKakiLurus > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['35-44'][$jumlahSitUpKakiLurus]) ? $nilaiSitUp1['35-44'][$jumlahSitUpKakiLurus] : 0);
        } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
            $maksimalSitUp1 = max(array_keys($nilaiSitUp1['45-54']));
            $nilaiAkhir = $jumlahSitUpKakiLurus > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['45-54'][$jumlahSitUpKakiLurus]) ? $nilaiSitUp1['45-54'][$jumlahSitUpKakiLurus] : 0);
        } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
            $maksimalSitUp1 = max(array_keys($nilaiSitUp1['55-59']));
            $nilaiAkhir = $jumlahSitUpKakiLurus > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['55-59'][$jumlahSitUpKakiLurus]) ? $nilaiSitUp1['55-59'][$jumlahSitUpKakiLurus] : 0);
        }

        $dataPenggunaWanita = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita' => $tanggalPelaksanaanSitUp1,
            'Jumlah_Sit_Up_1_Wanita' => $jumlahSitUpKakiLurus,
            'Nilai_Sit_Up_1_Wanita' => $nilaiAkhir,
            "Status_Wanita_Sit_Up_Kaki_Lurus" => "Ditinjau"
        );

        if ($obyekPenggunaWanita->cekNipAnggotaSitUp1WanitaSudahAda($nipPengguna)) {
            $updateGarjasWanitaTesKakiLurus = $obyekPenggunaWanita->perbaruiGarjasWanitaSitUp1JikaDitolak($nipPengguna, $dataPenggunaWanita);
        } else {
            $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahGarjasWanitaSitUp1($dataPenggunaWanita);
        }
    }

    if ($simpanDataGarjasPriaSitUpKakiLurus || $updateGarjasPriaTesKakiLurus || $simpanDataPenggunaWanita || $updateGarjasWanitaTesKakiLurus) {
        setPesanKeberhasilan("Berhasil, data anda berhasil disimpan mohon menunggu verifikasi admin.");
    } else {
        setPesanKesalahan("Gagal menyimpan data anggota.");
    }

    header("Location: $akarUrl" . "src/user/pages/situp1.php");
    exit;
}
ob_end_flush();

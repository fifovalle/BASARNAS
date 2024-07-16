<?php
include 'databases.php';
ob_start();

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

    $obyekPengguna = new Pengguna($koneksi);
    $obyekPenggunaPria = new TesLariPria($koneksi);
    $obyekPenggunaWanita = new TesLariWanita($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $waktuTestLari = mysqli_real_escape_string($koneksi, $_POST['Waktu_Lari']);
    $tanggalPelaksanaanLari = $_POST['Tanggal_Pelaksanaan_Tes_Lari'];
    $tanggal_pelaksanaan_lari = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanLari);

    if ($tanggal_pelaksanaan_lari === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_lari->format('Y-m-d');
    }

    $umurPengguna = $obyekPenggunaPria->ambilUmurTesLariPriaOlehNIP($nipPengguna);
    $cekKelaminPengguna = $obyekPengguna->cekKelaminPenggunaSesuaiNIP($nipPengguna);

    if ($cekKelaminPengguna == "Pria") {

        if ($waktuTestLari == 0) {
            setPesanKesalahan("Nilai lari anda tidak boleh 0.");
            header("Location: $akarUrl" . "src/user/pages/lari.php");
            exit;
        }

        if (empty($nipPengguna) && empty($tanggalPelaksanaanLari) && empty($waktuTestLari)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($tanggalPelaksanaanLari)) {
            $pesanKesalahan = "Tanggal pelaksanaan Tes Lari Anda harus diisi. ";
        } elseif (empty($waktuTestLari)) {
            $pesanKesalahan = "Jumlah Tes Lari Anda harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: " . $akarUrl . "src/user/pages/lari.php");
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
            if ($waktuTestLari < 9.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 23.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['under_25'][(string)$waktuTestLari]) ? $nilaiLari['under_25'][(string)$waktuTestLari] : 0;
            }
        } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
            if ($waktuTestLari < 10.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 24.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['25-34'][(string)$waktuTestLari]) ? $nilaiLari['25-34'][(string)$waktuTestLari] : 0;
            }
        } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
            if ($waktuTestLari < 11.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 25.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['35-44'][(string)$waktuTestLari]) ? $nilaiLari['35-44'][(string)$waktuTestLari] : 0;
            }
        } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
            if ($waktuTestLari < 12.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 26.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['45-54'][(string)$waktuTestLari]) ? $nilaiLari['45-54'][(string)$waktuTestLari] : 0;
            }
        } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
            if ($waktuTestLari < 13.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 27.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['55-59'][(string)$waktuTestLari]) ? $nilaiLari['55-59'][(string)$waktuTestLari] : 0;
            }
        }

        if (!$nilaiAkhir) {
            setPesanKesalahan("Input waktu tidak valid untuk usia pengguna ini.");
            header("Location: $akarUrl" . "src/user/pages/lari.php");
            exit;
        }

        $dataPenggunaPria = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Tes_Lari_Pria' => $tanggalPelaksanaanLari,
            'Waktu_Lari_Pria' => $waktuTestLari,
            'Nilai_Lari_Pria' => $nilaiAkhir,
            "Status_Lari_Pria" => "Ditinjau"
        );

        if ($obyekPenggunaPria->cekNipAnggotaTesLariPriaSudahAda($nipPengguna)) {
            $updateGarjasPriaTesLari = $obyekPenggunaPria->perbaruiTesLariPriaJikaDiTolak($nipPengguna, $dataPenggunaPria);
        } else {
            $simpanDataPenggunaPria = $obyekPenggunaPria->tambahTesLariPria($dataPenggunaPria);
        }
    } else {
        if ($waktuTestLari == 0) {
            setPesanKesalahan("Nilai lari anda tidak boleh 0.");
            header("Location: $akarUrl" . "src/user/pages/lari.php");
            exit;
        }

        if (empty($nipPengguna) && empty($tanggalPelaksanaanLari) && empty($waktuTestLari)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($tanggalPelaksanaanLari)) {
            $pesanKesalahan = "Tanggal pelaksanaan Tes Lari Anda harus diisi. ";
        } elseif (empty($waktuTestLari)) {
            $pesanKesalahan = "Jumlah Tes Lari Anda harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: " . $akarUrl . "src/user/pages/lari.php");
            exit;
        }

        $nilaiLari = [
            'under_25' => [
                '10' => 100,
                '10.1' => 98,
                '10.2' => 96,
                '10.3' => 93,
                '10.4' => 91,
                '10.5' => 89,
                '11' => 87,
                '11.1' => 85,
                '11.2' => 83,
                '11.3' => 80,
                '11.4' => 78,
                '12' => 74,
                '12.1' => 72,
                '12.2' => 70,
                '12.3' => 67,
                '12.4' => 65,
                '12.5' => 63,
                '13' => 61,
                '13.1' => 60,
                '13.2' => 59,
                '13.3' => 59,
                '13.4' => 58,
                '13.5' => 57,
                '14' => 56,
                '14.1' => 56,
                '14.2' => 59,
                '14.3' => 54,
                '14.4' => 53,
                '14.5' => 52,
                '15' => 52,
                '15.1' => 51,
                '15.2' => 50,
                '15.3' => 49,
                '15.4' => 49,
                '16' => 47,
                '16.1' => 46,
                '16.2' => 45,
                '16.3' => 45,
                '16.4' => 44,
                '16.5' => 43,
                '17' => 42,
                '17.1' => 42,
                '17.2' => 41,
                '17.3' => 40,
                '17.4' => 39,
                '17.5' => 38,
                '18' => 38,
                '18.1' => 37,
                '18.2' => 36,
                '18.3' => 35,
                '18.4' => 35,
                '18.5' => 34,
                '19' => 33,
                '19.1' => 32,
                '19.2' => 31,
                '19.3' => 31,
                '19.4' => 30,
                '19.5' => 29,
                '20' => 28,
                '20.1' => 27,
                '20.2' => 27,
                '20.3' => 26,
                '20.4' => 25,
                '20.5' => 24,
                '21' => 24,
                '21.1' => 23,
                '21.2' => 22,
                '21.3' => 21,
                '21.4' => 20,
                '21.5' => 20,
                '22' => 19,
                '22.1' => 18,
                '22.2' => 17,
                '22.3' => 17,
                '22.4' => 16,
                '22.5' => 15,
                '23' => 14,
                '23.1' => 13,
                '23.2' => 13,
                '23.3' => 12,
                '23.4' => 11,
                '23.5' => 10,
                '24' => 10,
                '24.1' => 9,
                '24.2' => 8,
                '24.3' => 7,
                '24.4' => 6,
                '24.5' => 6,
                '25' => 5,
                '25.1' => 4,
                '25.2' => 3,
                '25.3' => 3,
                '25.4' => 2,
                '25.5' => 1,
            ],
            '25-34' => [
                '11' => 100,
                '11.1' => 98,
                '11.2' => 96,
                '11.3' => 93,
                '11.4' => 91,
                '11.5' => 89,
                '12' => 87,
                '12.1' => 85,
                '12.2' => 83,
                '12.3' => 80,
                '12.4' => 76,
                '12.8' => 76,
                '13' => 74,
                '13.1' => 72,
                '13.2' => 70,
                '13.3' => 67,
                '13.4' => 65,
                '13.5' => 63,
                '14' => 61,
                '14.1' => 60,
                '14.2' => 59,
                '14.3' => 59,
                '14.4' => 58,
                '14.5' => 57,
                '15' => 56,
                '15.1' => 56,
                '15.2' => 55,
                '15.3' => 54,
                '15.4' => 53,
                '15.5' => 52,
                '16' => 52,
                '16.1' => 51,
                '16.2' => 50,
                '16.3' => 49,
                '16.4' => 49,
                '16.5' => 48,
                '17' => 47,
                '17.1' => 46,
                '17.2' => 45,
                '17.3' => 45,
                '17.4' => 44,
                '17.5' => 43,
                '18' => 42,
                '18.1' => 42,
                '18.2' => 41,
                '18.3' => 40,
                '18.4' => 39,
                '18.5' => 38,
                '19' => 38,
                '19.1' => 37,
                '19.2' => 36,
                '19.3' => 35,
                '19.4' => 35,
                '20' => 33,
                '20.1' => 32,
                '20.2' => 31,
                '20.3' => 31,
                '20.4' => 30,
                '21' => 28,
                '21.1' => 27,
                '21.2' => 27,
                '21.3' => 26,
                '21.4' => 25,
                '21.5' => 24,
                '22' => 24,
                '22.1' => 23,
                '22.2' => 22,
                '22.3' => 21,
                '22.4' => 20,
                '22.5' => 20,
                '23' => 19,
                '23.1' => 18,
                '23.2' => 17,
                '23.3' => 17,
                '23.4' => 16,
                '23.5' => 15,
                '24' => 14,
                '24.1' => 13,
                '24.2' => 13,
                '24.3' => 12,
                '24.4' => 11,
                '24.5' => 10,
                '25' => 10,
                '25.1' => 9,
                '25.2' => 8,
                '25.3' => 7,
                '25.4' => 6,
                '25.5' => 6,
                '26.0' => 5,
                '26.1' => 4,
                '26.2' => 3,
                '26.3' => 3,
                '26.4' => 2,
                '26.5' => 1,
            ],
            '35-44' => [
                '12' => 100,
                '12.1' => 98,
                '12.2' => 96,
                '12.3' => 93,
                '12.4' => 91,
                '12.5' => 89,
                '13' => 87,
                '13.1' => 85,
                '13.2' => 83,
                '13.3' => 80,
                '13.4' => 78,
                '13.5' => 76,
                '14' => 74,
                '14.1' => 72,
                '14.2' => 70,
                '14.3' => 67,
                '14.4' => 65,
                '14.5' => 63,
                '15' => 61,
                '15.1' => 60,
                '15.2' => 59,
                '15.3' => 59,
                '15.4' => 58,
                '15.5' => 57,
                '16' => 56,
                '16.1' => 56,
                '16.2' => 55,
                '16.3' => 54,
                '16.4' => 53,
                '16.5' => 52,
                '16.6' => 52,
                '16.7' => 52,
                '16.8' => 52,
                '16.9' => 52,
                '17' => 52,
                '17.1' => 51,
                '17.2' => 50,
                '17.3' => 49,
                '17.4' => 49,
                '17.5' => 48,
                '18' => 47,
                '18.1' => 46,
                '18.2' => 45,
                '18.3' => 45,
                '18.4' => 44,
                '18.5' => 43,
                '19' => 42,
                '19.1' => 42,
                '19.2' => 41,
                '19.3' => 40,
                '19.4' => 39,
                '19.5' => 38,
                '19.6' => 38,
                '19.7' => 38,
                '19.8' => 38,
                '19.9' => 38,
                '20' => 38,
                '20.1' => 37,
                '20.2' => 36,
                '20.3' => 35,
                '20.4' => 35,
                '20.5' => 34,
                '21' => 33,
                '21.1' => 32,
                '21.2' => 31,
                '21.3' => 31,
                '21.4' => 30,
                '21.5' => 29,
                '22' => 28,
                '22.1' => 27,
                '22.2' => 27,
                '22.3' => 26,
                '22.4' => 25,
                '22.5' => 24,
                '22.6' => 24,
                '22.7' => 24,
                '22.8' => 24,
                '22.9' => 24,
                '23' => 24,
                '23.1' => 23,
                '23.2' => 22,
                '23.3' => 21,
                '23.4' => 20,
                '23.5' => 20,
                '24' => 19,
                '24.1' => 18,
                '24.2' => 17,
                '24.3' => 17,
                '24.4' => 16,
                '24.5' => 15,
                '25' => 14,
                '25.1' => 13,
                '25.2' => 13,
                '25.3' => 12,
                '25.4' => 11,
                '25.5' => 10,
                '25.6' => 10,
                '25.7' => 10,
                '25.8' => 10,
                '25.9' => 10,
                '26' => 10,
                '26.1' => 9,
                '26.2' => 8,
                '26.3' => 7,
                '26.4' => 6,
                '26.5' => 6,
                '27' => 5,
                '27.1' => 4,
                '27.2' => 3,
                '27.3' => 3,
                '27.4' => 2,
                '27.5' => 1,
            ],
            '45-54' => [
                '13' => 100,
                '13.1' => 98,
                '13.2' => 96,
                '13.3' => 93,
                '13.4' => 91,
                '13.5' => 89,
                '14' => 87,
                '14.1' => 85,
                '14.2' => 83,
                '14.3' => 80,
                '14.4' => 78,
                '14.5' => 76,
                '15' => 74,
                '15.1' => 72,
                '15.2' => 70,
                '15.3' => 67,
                '15.4' => 65,
                '15.5' => 63,
                '16' => 61,
                '16.1' => 59,
                '16.2' => 57,
                '16.3' => 59,
                '16.4' => 58,
                '16.5' => 57,
                '17' => 56,
                '17.1' => 56,
                '17.2' => 55,
                '17.3' => 54,
                '17.4' => 53,
                '17.5' => 52,
                '17.6' => 52,
                '17.7' => 52,
                '17.8' => 52,
                '17.9' => 52,
                '18' => 52,
                '18.1' => 51,
                '18.2' => 50,
                '18.3' => 49,
                '18.4' => 49,
                '18.5' => 48,
                '19' => 47,
                '19.1' => 46,
                '19.2' => 45,
                '19.3' => 45,
                '19.4' => 44,
                '19.5' => 43,
                '20' => 42,
                '20.1' => 42,
                '20.2' => 41,
                '20.3' => 40,
                '20.4' => 39,
                '20.5' => 38,
                '20.6' => 38,
                '20.7' => 38,
                '20.8' => 38,
                '20.9' => 38,
                '21' => 38,
                '21.1' => 37,
                '21.2' => 36,
                '21.3' => 35,
                '21.4' => 35,
                '21.5' => 34,
                '22' => 33,
                '22.1' => 32,
                '22.2' => 31,
                '22.3' => 31,
                '22.4' => 30,
                '22.5' => 29,
                '23' => 28,
                '23.1' => 27,
                '23.2' => 27,
                '23.3' => 26,
                '23.4' => 25,
                '23.5' => 24,
                '23.6' => 24,
                '23.7' => 24,
                '23.8' => 24,
                '23.9' => 24,
                '24' => 24,
                '24.1' => 23,
                '24.2' => 22,
                '24.3' => 21,
                '24.4' => 20,
                '24.5' => 20,
                '25' => 19,
                '25.1' => 18,
                '25.2' => 17,
                '25.3' => 16,
                '25.4' => 16,
                '25.5' => 15,
                '26' => 14,
                '26.1' => 13,
                '26.2' => 13,
                '26.3' => 12,
                '26.4' => 11,
                '26.5' => 10,
                '26.6' => 10,
                '26.7' => 10,
                '26.8' => 10,
                '26.9' => 10,
                '27' => 10,
                '27.1' => 9,
                '27.2' => 8,
                '27.3' => 7,
                '27.4' => 6,
                '27.5' => 6,
                '28' => 5,
                '28.1' => 4,
                '28.2' => 3,
                '28.3' => 3,
                '28.4' => 2,
                '28.5' => 1
            ],
            '55-59' => [
                '14' => 100,
                '14.1' => 98,
                '14.2' => 96,
                '14.3' => 93,
                '14.4' => 91,
                '14.5' => 89,
                '15' => 87,
                '15.1' => 85,
                '15.2' => 83,
                '15.3' => 80,
                '15.4' => 78,
                '15.5' => 76,
                '16' => 74,
                '16.1' => 72,
                '16.2' => 70,
                '16.3' => 67,
                '16.4' => 65,
                '16.5' => 63,
                '17' => 61,
                '17.1' => 60,
                '17.2' => 59,
                '17.3' => 59,
                '17.4' => 58,
                '17.5' => 57,
                '18' => 56,
                '18.1' => 56,
                '18.2' => 55,
                '18.3' => 54,
                '18.4' => 53,
                '18.5' => 52,
                '18.6' => 52,
                '18.7' => 52,
                '18.8' => 52,
                '18.9' => 52,
                '19' => 52,
                '19.1' => 51,
                '19.2' => 50,
                '19.3' => 49,
                '19.4' => 49,
                '19.5' => 48,
                '20' => 47,
                '20.1' => 46,
                '20.2' => 45,
                '20.3' => 45,
                '20.4' => 44,
                '20.5' => 43,
                '21' => 42,
                '21.1' => 42,
                '21.2' => 41,
                '21.3' => 40,
                '21.4' => 39,
                '21.5' => 38,
                '21.6' => 38,
                '21.7' => 38,
                '21.8' => 38,
                '21.9' => 38,
                '22' => 38,
                '22.1' => 37,
                '22.2' => 36,
                '22.3' => 35,
                '22.4' => 35,
                '22.5' => 34,
                '23' => 33,
                '23.1' => 32,
                '23.2' => 31,
                '23.3' => 31,
                '23.4' => 30,
                '23.5' => 29,
                '24' => 28,
                '24.1' => 27,
                '24.2' => 27,
                '24.3' => 26,
                '24.4' => 25,
                '24.5' => 24,
                '24.6' => 24,
                '24.7' => 24,
                '24.8' => 24,
                '24.9' => 24,
                '25' => 24,
                '25.1' => 23,
                '25.2' => 22,
                '25.3' => 21,
                '25.4' => 20,
                '25.5' => 20,
                '26' => 19,
                '26.1' => 18,
                '26.2' => 17,
                '26.3' => 17,
                '26.4' => 16,
                '26.5' => 15,
                '27' => 14,
                '27.1' => 13,
                '27.2' => 13,
                '27.3' => 12,
                '27.4' => 11,
                '27.5' => 10,
                '27.6' => 10,
                '27.7' => 10,
                '27.8' => 10,
                '27.9' => 10,
                '28' => 10,
                '28.1' => 9,
                '28.2' => 8,
                '28.3' => 7,
                '28.4' => 6,
                '28.5' => 6,
                '29' => 5,
                '29.1' => 4,
                '29.2' => 3,
                '29.3' => 3,
                '29.4' => 2,
                '29.5' => 1
            ],
        ];

        $nilaiAkhir = 0;

        if ($umurPengguna < 25) {
            if ($waktuTestLari < 10.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 25.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['under_25'][(string)$waktuTestLari]) ? $nilaiLari['under_25'][(string)$waktuTestLari] : 0;
            }
        } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
            if ($waktuTestLari < 11.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 26.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['25-34'][(string)$waktuTestLari]) ? $nilaiLari['25-34'][(string)$waktuTestLari] : 0;
            }
        } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
            if ($waktuTestLari < 12.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 27.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['35-44'][(string)$waktuTestLari]) ? $nilaiLari['35-44'][(string)$waktuTestLari] : 0;
            }
        } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
            if ($waktuTestLari < 13.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 28.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['45-54'][(string)$waktuTestLari]) ? $nilaiLari['45-54'][(string)$waktuTestLari] : 0;
            }
        } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
            if ($waktuTestLari < 14.0) {
                $nilaiAkhir = 100;
            } elseif ($waktuTestLari > 29.5) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = isset($nilaiLari['55-59'][(string)$waktuTestLari]) ? $nilaiLari['55-59'][(string)$waktuTestLari] : 0;
            }
        }

        if (!$nilaiAkhir) {
            setPesanKesalahan("Input waktu tidak valid untuk usia pengguna ini.");
            header("Location: $akarUrl" . "src/user/pages/lari.php");
            exit;
        }

        $dataPenggunaWanita = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Tes_Lari_Wanita' => $tanggalPelaksanaanLari,
            'Waktu_Lari_Wanita' => $waktuTestLari,
            'Nilai_Lari_Wanita' => $nilaiAkhir,
            "Status_Lari_Wanita" => "Ditinjau"
        );

        if ($obyekPenggunaWanita->cekNipAnggotaTesLariWanitaSudahAda($nipPengguna)) {
            $updateGarjasWanitaTesLari = $obyekPenggunaWanita->perbaruiTesLariWanitaJikaDiTolak($nipPengguna, $dataPenggunaWanita);
        } else {
            $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahTesLariWanita($dataPenggunaWanita);
        }
    }

    if ($simpanDataPenggunaPria || $simpanDataPenggunaWanita || $updateGarjasWanitaTesLari || $updateGarjasPriaTesLari) {
        setPesanKeberhasilan("Berhasil, data anda berhasil disimpan mohon menunggu verifikasi admin.");
    } else {
        setPesanKesalahan("Gagal menyimpan data anda.");
    }

    header("Location: $akarUrl" . "src/user/pages/lari.php");
    exit;
}

ob_end_flush();
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
    $obyekPenggunaPria = new TesRenangPria($koneksi);
    $obyekPenggunaWanita = new TesRenangWanita($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $tanggalPelaksanaanRenang = $_POST['Tanggal_Pelaksanaan_Tes_Renang'];
    $tanggal_pelaksanaan_renang = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanRenang);

    if ($tanggal_pelaksanaan_renang === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_renang->format('Y-m-d');
    }

    if (strpos($waktuRenang, ':') !== false) {
        list($menit, $detik) = explode(':', $waktuRenang);
        $waktuRenang = ($menit * 60) + $detik;
    } else {
        $waktuRenang = (int)$waktuRenang;
    }

    $gayaRenang = mysqli_real_escape_string($koneksi, $_POST['Gaya_Renang']);

    $waktuRenang = '';

    if (isset($_POST['Waktu_Renang'])) {
        $waktuRenang = $_POST['Waktu_Renang'];

        if (strpos($waktuRenang, ':') !== false) {
            list($menit, $detik) = explode(':', $waktuRenang);
            $waktuRenang = ($menit * 60) + $detik;
        } else {
            $waktuRenang = (int)$waktuRenang;
        }
    }


    $umurPengguna = $obyekPenggunaPria->ambilUmurTesRenangPriaOlehNIP($nipPengguna);
    $cekKelaminPengguna = $obyekPengguna->cekKelaminPenggunaSesuaiNIP($nipPengguna);

    if ($cekKelaminPengguna == "Pria") {

        if (empty($nipPengguna) && empty($waktuRenang) && empty($tanggalPelaksanaanRenang)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($waktuRenang)) {
            $pesanKesalahan = "Waktu Renang harus diisi ";
        } elseif (empty($tanggalPelaksanaanRenang)) {
            $pesanKesalahan = "Tanggal Pelaksanaan Renang harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: " . $akarUrl . "src/user/pages/renang.php");
            exit;
        }

        if ($obyekPenggunaPria->sudahAdaNilaiRenangPria($nipPengguna)) {
            setPesanKesalahan("Nilai renang untuk pengguna ini sudah ada.");
            header("Location: " . $akarUrl . "src/user/pages/renang.php");
            exit;
        }

        $nilaiRenang = [
            'Dada' => [
                '18-25' => ['0:43', '2:23'],
                '26-30' => ['0:46', '2:26'],
                '31-35' => ['0:49', '2:29'],
                '36-40' => ['0:52', '2:32'],
                '41-43' => ['0:55', '2:35'],
                '44-46' => ['0:58', '2:38'],
                '47-49' => ['1:01', '2:41'],
                '50-52' => ['1:04', '2:44'],
                '53-55' => ['1:07', '2:47'],
                '56-58' => ['1:10', '2:50']
            ],
            'Bebas' => [
                '18-25' => ['0:39', '2:22'],
                '26-30' => ['0:42', '2:26'],
                '31-35' => ['0:45', '2:25'],
                '36-40' => ['0:48', '2:28'],
                '41-43' => ['0:51', '2:31'],
                '44-46' => ['0:54', '2:34'],
                '47-49' => ['0:57', '2:37'],
                '50-52' => ['1:01', '2:40'],
                '53-55' => ['1:04', '2:43'],
                '56-58' => ['1:07', '2:46']
            ],
            'Lainnya' => [
                '18-25' => ['0:38', '2:18'],
                '26-30' => ['0:41', '2:21'],
                '31-35' => ['0:44', '2:24'],
                '36-40' => ['0:47', '2:27'],
                '41-43' => ['0:50', '2:30'],
                '44-46' => ['0:53', '2:33'],
                '47-49' => ['0:56', '2:36'],
                '50-52' => ['0:59', '2:39'],
                '53-55' => ['1:03', '2:42'],
                '56-58' => ['1:06', '2:45']
            ]
        ];

        $umurKategori = '';
        if ($umurPengguna >= 18 && $umurPengguna <= 25) {
            $umurKategori = '18-25';
        } elseif ($umurPengguna >= 26 && $umurPengguna <= 30) {
            $umurKategori = '26-30';
        } elseif ($umurPengguna >= 31 && $umurPengguna <= 35) {
            $umurKategori = '31-35';
        } elseif ($umurPengguna >= 36 && $umurPengguna <= 40) {
            $umurKategori = '36-40';
        } elseif ($umurPengguna >= 41 && $umurPengguna <= 43) {
            $umurKategori = '41-43';
        } elseif ($umurPengguna >= 44 && $umurPengguna <= 46) {
            $umurKategori = '44-46';
        } elseif ($umurPengguna >= 47 && $umurPengguna <= 49) {
            $umurKategori = '47-49';
        } elseif ($umurPengguna >= 50 && $umurPengguna <= 52) {
            $umurKategori = '50-52';
        } elseif ($umurPengguna >= 53 && $umurPengguna <= 55) {
            $umurKategori = '53-55';
        } elseif ($umurPengguna >= 56 && $umurPengguna <= 58) {
            $umurKategori = '56-58';
        }

        if ($umurKategori && isset($nilaiRenang[$gayaRenang][$umurKategori])) {
            list($maxMenit, $maxDetik) = explode(':', $nilaiRenang[$gayaRenang][$umurKategori][0]);
            $waktuMax100 = ($maxMenit * 60) + $maxDetik;
            list($minMenit, $minDetik) = explode(':', $nilaiRenang[$gayaRenang][$umurKategori][1]);
            $waktuMin1 = ($minMenit * 60) + $minDetik;

            if ($waktuRenang <= $waktuMax100) {
                $nilaiAkhir = 100;
            } elseif ($waktuRenang > $waktuMin1) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = 100 - (($waktuRenang - $waktuMax100) / ($waktuMin1 - $waktuMax100)) * 99;
            }
        } else {
            $nilaiAkhir = 1;
        }

        $waktuRenangFormatted = gmdate('i:s', $waktuRenang);

        $dataPenggunaPria = [
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Tes_Renang_Pria' => $tanggalPelaksanaanRenang,
            'Waktu_Renang_Pria' => $waktuRenangFormatted,
            'Nama_Gaya_Renang_Pria' => $gayaRenang,
            'Nilai_Renang_Pria' => $nilaiAkhir,
            'Status_Renang_Pria' => 'Ditinjau'
        ];

        if ($obyekPenggunaPria->cekNipAnggotaTesRenangPriaSudahAda($nipPengguna)) {
            $updateGarjasPriaTesRenang = $obyekPenggunaPria->perbaruiTesRenangPriaJikaDiTolak($nipPengguna, $dataPenggunaPria);
        } else {
            $simpanDataPenggunaPria = $obyekPenggunaPria->tambahTesRenangPria($dataPenggunaPria);
        }
    } else {
        if (empty($nipPengguna) && empty($waktuRenang) && empty($tanggalPelaksanaanRenang)) {
            $pesanKesalahan = "Semua bidang harus diisi. ";
        } elseif (empty($nipPengguna)) {
            $pesanKesalahan = "NIP Pengguna harus diisi. ";
        } elseif (empty($waktuRenang)) {
            $pesanKesalahan = "Waktu Renang harus diisi ";
        } elseif (empty($tanggalPelaksanaanRenang)) {
            $pesanKesalahan = "Tanggal Pelaksanaan Renang harus diisi. ";
        }
        if (!empty($pesanKesalahan)) {
            setPesanKesalahan($pesanKesalahan);
            header("Location: " . $akarUrl . "src/user/pages/renang.php");
            exit;
        }

        if ($tesRenangWanitaModel->sudahAdaNilaiRenangWanita($nipPengguna)) {
            setPesanKesalahan("Nilai renang untuk pengguna ini sudah ada.");
            header("Location: " . $akarUrl . "src/user/pages/renang.php");
            exit;
        }

        $nilaiRenang = [
            'Dada' => [
                '18-25' => ['0:43', '2:23'],
                '26-30' => ['0:46', '2:26'],
                '31-35' => ['0:49', '2:29'],
                '36-40' => ['0:52', '2:32'],
                '41-43' => ['0:55', '2:35'],
                '44-46' => ['0:58', '2:38'],
                '47-49' => ['1:01', '2:41'],
                '50-52' => ['1:04', '2:44'],
                '53-55' => ['1:07', '2:47'],
                '56-58' => ['1:10', '2:50']
            ],
            'Bebas' => [
                '18-25' => ['0:39', '2:22'],
                '26-30' => ['0:42', '2:26'],
                '31-35' => ['0:45', '2:25'],
                '36-40' => ['0:48', '2:28'],
                '41-43' => ['0:51', '2:31'],
                '44-46' => ['0:54', '2:34'],
                '47-49' => ['0:57', '2:37'],
                '50-52' => ['1:01', '2:40'],
                '53-55' => ['1:04', '2:43'],
                '56-58' => ['1:07', '2:46']
            ],
            'Lainnya' => [
                '18-25' => ['0:38', '2:18'],
                '26-30' => ['0:41', '2:21'],
                '31-35' => ['0:44', '2:24'],
                '36-40' => ['0:47', '2:27'],
                '41-43' => ['0:50', '2:30'],
                '44-46' => ['0:53', '2:33'],
                '47-49' => ['0:56', '2:36'],
                '50-52' => ['0:59', '2:39'],
                '53-55' => ['1:03', '2:42'],
                '56-58' => ['1:06', '2:45']
            ]
        ];

        $umurKategori = '';
        if ($umurPengguna >= 18 && $umurPengguna <= 25) {
            $umurKategori = '18-25';
        } elseif ($umurPengguna >= 26 && $umurPengguna <= 30) {
            $umurKategori = '26-30';
        } elseif ($umurPengguna >= 31 && $umurPengguna <= 35) {
            $umurKategori = '31-35';
        } elseif ($umurPengguna >= 36 && $umurPengguna <= 40) {
            $umurKategori = '36-40';
        } elseif ($umurPengguna >= 41 && $umurPengguna <= 43) {
            $umurKategori = '41-43';
        } elseif ($umurPengguna >= 44 && $umurPengguna <= 46) {
            $umurKategori = '44-46';
        } elseif ($umurPengguna >= 47 && $umurPengguna <= 49) {
            $umurKategori = '47-49';
        } elseif ($umurPengguna >= 50 && $umurPengguna <= 52) {
            $umurKategori = '50-52';
        } elseif ($umurPengguna >= 53 && $umurPengguna <= 55) {
            $umurKategori = '53-55';
        } elseif ($umurPengguna >= 56 && $umurPengguna <= 58) {
            $umurKategori = '56-58';
        }

        if ($umurKategori && isset($nilaiRenang[$gayaRenang][$umurKategori])) {
            list($maxMenit, $maxDetik) = explode(':', $nilaiRenang[$gayaRenang][$umurKategori][0]);
            $waktuMax100 = ($maxMenit * 60) + $maxDetik;
            list($minMenit, $minDetik) = explode(':', $nilaiRenang[$gayaRenang][$umurKategori][1]);
            $waktuMin1 = ($minMenit * 60) + $minDetik;

            if ($waktuRenang <= $waktuMax100) {
                $nilaiAkhir = 100;
            } elseif ($waktuRenang > $waktuMin1) {
                $nilaiAkhir = 1;
            } else {
                $nilaiAkhir = 100 - (($waktuRenang - $waktuMax100) / ($waktuMin1 - $waktuMax100)) * 99;
            }
        } else {
            $nilaiAkhir = 1;
        }

        $waktuRenangFormatted = gmdate('i:s', $waktuRenang);

        $dataPenggunaWanita = [
            'NIP_Pengguna' => $nipPengguna,
            'Tanggal_Pelaksanaan_Tes_Renang_Wanita' => $tanggalPelaksanaanRenang,
            'Waktu_Renang_Wanita' => $waktuRenangFormatted,
            'Nama_Gaya_Renang_Wanita' => $gayaRenang,
            'Nilai_Renang_Wanita' => $nilaiAkhir,
            'Status_Renang_Wanita' => 'Ditinjau'
        ];

        if ($obyekPenggunaWanita->cekNipAnggotaTesRenangWanitaSudahAda($nipPengguna)) {
            $updateGarjasWanitaTesRenang = $obyekPenggunaWanita->perbaruiTesRenangWanitaJikaDiTolak($nipPengguna, $dataPenggunaWanita);
        } else {
            $simpanDataPenggunaWanita = $obyekPenggunaWanita->tambahTesRenangWanita($dataPenggunaWanita);
        }
    }

    if ($simpanDataPenggunaPria || $simpanDataPenggunaWanita || $updateGarjasWanitaTesRenang || $updateGarjasPriaTesRenang) {
        setPesanKeberhasilan("Berhasil, data anda berhasil disimpan mohon menunggu verifikasi admin.");
    } else {
        setPesanKesalahan("Gagal menyimpan data anda.");
    }

    header("Location: $akarUrl" . "src/user/pages/renang.php");
    exit;
}

ob_end_flush();

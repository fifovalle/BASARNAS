<?php
include 'databases.php';

if (isset($_POST['tambah_nilai'])) {
    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $tanggalPelaksanaanTesRenangPria = $_POST['Tanggal_Pelaksanaan_Tes_Renang_Pria'];
    $tanggal_pelaksanaan_renang_pria = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanTesRenangPria);

    if ($tanggal_pelaksanaan_renang_pria === false) {
        $pesanKesalahan .= "Format tanggal pelaksanaan tidak valid. ";
    } else {
        $tanggal_pelaksanaan_database = $tanggal_pelaksanaan_renang_pria->format('Y-m-d');
    }

    $gayaRenang = mysqli_real_escape_string($koneksi, $_POST['Gaya_Renang']);
    $waktuRenang = mysqli_real_escape_string($koneksi, $_POST['Waktu_Renang']);

    if (strpos($waktuRenang, ':') !== false) {
        list($menit, $detik) = explode(':', $waktuRenang);
        $waktuRenang = ($menit * 60) + $detik;
    } else {
        $waktuRenang = (int)$waktuRenang;
    }

    $obyekPenggunaPria = new Pengguna($koneksi);
    $umurPengguna = $obyekPenggunaPria->ambilUmurPengguna($nipPengguna);

    $tesRenangPriaModel = new TesRenangPria($koneksi);
    if ($tesRenangPriaModel->sudahAdaNilaiRenangPria($nipPengguna)) {
        setPesanKesalahan("Nilai renang untuk pengguna ini sudah ada.");
        header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-renang.php");
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

    $dataPengguna = [
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Tes_Renang_Pria' => $tanggalPelaksanaanTesRenangPria,
        'Waktu_Renang_Pria' => $waktuRenangFormatted,
        'Nama_Gaya_Renang_Pria' => $gayaRenang,
        'Nilai_Renang_Pria' => $nilaiAkhir
    ];

    $simpanDataPengguna = $tesRenangPriaModel->tambahTesRenangPria($dataPengguna);

    if ($simpanDataPengguna) {
        setPesanKeberhasilan("Data Tes Renang Pria Berhasil Ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data tes renang pria.");
    }

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-renang.php");
    exit;
}

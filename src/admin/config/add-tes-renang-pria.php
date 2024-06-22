<?php
include 'databases.php';

if (isset($_POST['tambah_nilai'])) {
    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
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
            '18-25' => [43, 143],
            '26-30' => [46, 146],
            '31-35' => [49, 149],
            '36-40' => [52, 152],
            '41-43' => [55, 155],
            '44-46' => [58, 158],
            '47-49' => [61, 161],
            '50-52' => [64, 164],
            '53-55' => [67, 167],
            '56-58' => [70, 170]
        ],
        'Bebas' => [
            '18-25' => [39, 223],
            '26-30' => [42, 226],
            '31-35' => [45, 229],
            '36-40' => [48, 232],
            '41-43' => [51, 235],
            '44-46' => [54, 238],
            '47-49' => [57, 241],
            '50-52' => [101, 244],
            '53-55' => [104, 247],
            '56-58' => [107, 250]
        ],
        'Lainnya' => [
            '18-25' => [38, 223],
            '26-30' => [41, 226],
            '31-35' => [44, 229],
            '36-40' => [47, 232],
            '41-43' => [50, 235],
            '44-46' => [53, 238],
            '47-49' => [56, 241],
            '50-52' => [59, 244],
            '53-55' => [103, 247],
            '56-58' => [106, 250]
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
        $waktuMax100 = $nilaiRenang[$gayaRenang][$umurKategori][0];
        $waktuMin1 = $nilaiRenang[$gayaRenang][$umurKategori][1];

        if ($waktuRenang <= $waktuMax100) {
            $nilaiAkhir = 100;
        } elseif ($waktuRenang > $waktuMin1) {
            $nilaiAkhir = 0;
        } else {
            $nilaiAkhir = 100 - (($waktuRenang - $waktuMax100) / ($waktuMin1 - $waktuMax100)) * 100;
        }
    } else {
        $nilaiAkhir = 0;
    }

    $waktuRenangFormatted = gmdate('i:s', $waktuRenang);

    $dataPengguna = [
        'NIP_Pengguna' => $nipPengguna,
        'Waktu_Renang_Pria' => $waktuRenangFormatted,
        'Nama_Gaya_Renang_Pria' => $gayaRenang,
        'Nilai_Renang_Pria' => $nilaiAkhir
    ];

    $tesRenangPriaModel = new TesRenangPria($koneksi);
    $simpanDataPengguna = $tesRenangPriaModel->tambahTesRenangPria($dataPengguna);

    if ($simpanDataPengguna) {
        setPesanKeberhasilan("Data Tes Renang Pria Berhasil Ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data tes renang pria.");
    }

    header("Location: " . $akarUrl . "src/admin/pages/data-garjas-pria-renang.php");
    exit;
}

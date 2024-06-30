<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idRenangPria = $_POST['ID_Renang_Pria'] ?? '';
    $waktuRenangPria = $_POST['Waktu_Renang_Pria'] ?? '';
    $namaRenangPria = $_POST['Nama_Gaya_Renang_Pria'] ?? '';
    $tanggalPelaksanaanRenangPria = $_POST['Tanggal_Pelaksanaan_Tes_Renang_Pria'] ?? '';

    $tanggalPelaksanaanRenangPriaObj = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanRenangPria);
    if ($tanggalPelaksanaanRenangPriaObj === false) {
        echo json_encode(["success" => false, "message" => "Format tanggal pelaksanaan tidak valid."]);
        exit;
    }
    $tanggalPelaksanaanRenangPriaFormatted = $tanggalPelaksanaanRenangPriaObj->format('Y-m-d');

    if (strpos($waktuRenangPria, ':') !== false) {
        list($menit, $detik) = explode(':', $waktuRenangPria);
        $waktuRenangPriaDetik = ($menit * 60) + $detik;
    } else {
        $waktuRenangPriaDetik = (int)$waktuRenangPria;
    }

    $garjasRenangPriaModel = new TesRenangPria($koneksi);
    $umurPengguna = $garjasRenangPriaModel->ambilUmurGarjasRenangPriaOlehNIP($nipPengguna);

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

    // Hitung nilai akhir berdasarkan waktu dan kategori umur
    if ($umurKategori && isset($nilaiRenang[$namaRenangPria][$umurKategori])) {
        list($maxMenit, $maxDetik) = explode(':', $nilaiRenang[$namaRenangPria][$umurKategori][0]);
        $waktuMax100 = ($maxMenit * 60) + $maxDetik;
        list($minMenit, $minDetik) = explode(':', $nilaiRenang[$namaRenangPria][$umurKategori][1]);
        $waktuMin1 = ($minMenit * 60) + $minDetik;

        $waktuRenangPriaFormatted = gmdate('i:s', $waktuRenangPriaDetik);

        if ($waktuRenangPriaDetik <= $waktuMax100) {
            $nilaiAkhir = 100;
        } elseif ($waktuRenangPriaDetik > $waktuMin1) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = 100 - (($waktuRenangPriaDetik - $waktuMax100) / ($waktuMin1 - $waktuMax100)) * 100;
        }
    } else {
        $nilaiAkhir = 1;
    }

    $dataLamaGarjasRenangPria = $garjasRenangPriaModel->getTesRenangPriaById($idRenangPria);

    if ($dataLamaGarjasRenangPria) {
        $dataGarjasRenangPria = [
            'Tanggal_Pelaksanaan_Tes_Renang_Pria' => $tanggalPelaksanaanRenangPriaFormatted,
            'Waktu_Renang_Pria' => $waktuRenangPriaFormatted,
            'Nama_Gaya_Renang_Pria' => $namaRenangPria,
            'Nilai_Renang_Pria' => $nilaiAkhir
        ];

        $updateDataGarjasRenangPria = $garjasRenangPriaModel->perbaruiTesRenangPria($idRenangPria, $dataGarjasRenangPria);

        if ($updateDataGarjasRenangPria) {
            echo json_encode(["success" => true, "message" => "Data Garjas Pria Renang berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data Garjas Pria Renang."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data Garjas Pria Renang tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

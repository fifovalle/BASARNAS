<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idRenangWanita = $_POST['ID_Renang_Wanita'] ?? '';
    $waktuRenangWanita = $_POST['Waktu_Renang_Wanita'] ?? '';
    $namaRenangWanita = $_POST['Nama_Gaya_Renang_Wanita'] ?? '';
    $tanggalPelaksanaanRenangWanita = $_POST['Tanggal_Pelaksanaan_Tes_Renang_Wanita'] ?? '';

    $tanggalPelaksanaanRenangWanitaObj = DateTime::createFromFormat('Y-m-d', $tanggalPelaksanaanRenangWanita);
    if ($tanggalPelaksanaanRenangWanitaObj === false) {
        echo json_encode(["success" => false, "message" => "Format tanggal pelaksanaan tidak valid."]);
        exit;
    }

    $tanggalPelaksanaanRenangWanitaFormatted = $tanggalPelaksanaanRenangWanitaObj->format('Y-m-d');

    if (strpos($waktuRenangWanita, ':') !== false) {
        list($menit, $detik) = explode(':', $waktuRenangWanita);
        $waktuRenangWanitaDetik = ($menit * 60) + $detik;
    } else {
        $waktuRenangWanitaDetik = (int)$waktuRenangWanita;
    }

    $garjasRenangWanitaModel = new TesRenangWanita($koneksi);
    $umurPengguna = $garjasRenangWanitaModel->ambilUmurGarjasRenangWanitaOlehNIP($nipPengguna);

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

    if ($umurKategori && isset($nilaiRenang[$namaRenangWanita][$umurKategori])) {
        list($maxMenit, $maxDetik) = explode(':', $nilaiRenang[$namaRenangWanita][$umurKategori][0]);
        $waktuMax100 = ($maxMenit * 60) + $maxDetik;
        list($minMenit, $minDetik) = explode(':', $nilaiRenang[$namaRenangWanita][$umurKategori][1]);
        $waktuMin1 = ($minMenit * 60) + $minDetik;

        $waktuRenangWanitaFormatted = gmdate('i:s', $waktuRenangWanitaDetik);

        if ($waktuRenangWanitaDetik <= $waktuMax100) {
            $nilaiAkhir = 100;
        } elseif ($waktuRenangWanitaDetik > $waktuMin1) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = 100 - (($waktuRenangWanitaDetik - $waktuMax100) / ($waktuMin1 - $waktuMax100)) * 100;
        }
    } else {
        $nilaiAkhir = 1;
    }

    $dataLamaGarjasRenangWanita = $garjasRenangWanitaModel->getTesRenangWanitaById($idRenangWanita);

    if ($dataLamaGarjasRenangWanita) {
        $dataGarjasRenangWanita = [
            'Tanggal_Pelaksanaan_Tes_Renang_Wanita' => $tanggalPelaksanaanRenangWanitaFormatted,
            'Waktu_Renang_Wanita' => $waktuRenangWanitaFormatted,
            'Nama_Gaya_Renang_Wanita' => $namaRenangWanita,
            'Nilai_Renang_Wanita' => $nilaiAkhir
        ];

        $updateDataGarjasRenangWanita = $garjasRenangWanitaModel->perbaruiTesRenangWanita($idRenangWanita, $dataGarjasRenangWanita);

        if ($updateDataGarjasRenangWanita) {
            echo json_encode(["success" => true, "message" => "Data Garjas Wanita Renang berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data Garjas Wanita Renang."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data Garjas Wanita Renang tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idRenangPria = $_POST['ID_Renang_Pria'] ?? '';
    $waktuRenangPria = $_POST['Waktu_Renang_Pria'] ?? '';
    $namaRenangPria = $_POST['Nama_Gaya_Renang_Pria'] ?? '';
    $nilaiRenangPria = $_POST['Nilai_Renang_Pria'] ?? '';
    $tanggalPelaksanaanRenangPria = $_POST['Tanggal_Pelaksanaan_Tes_Renang_Pria'] ?? '';

    $garjasRenangPriaModel = new TesRenangPria($koneksi);

    $umurPengguna = $garjasRenangPriaModel->ambilUmurGarjasRenangPriaOlehNIP($nipPengguna);

    $nilaiRenangPria = [
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

    if ($umurKategori && isset($nilaiRenangPria[$namaRenangPria][$umurKategori])) {
        $waktuMax100 = $nilaiRenangPria[$namaRenangPria][$umurKategori][0];
        $waktuMin1 = $nilaiRenangPria[$namaRenangPria][$umurKategori][1];

        list($menit, $detik) = explode(':', $waktuRenangPria);
        $waktuRenangPriaDetik = ($menit * 60) + $detik;

        $waktuRenangPriaFormatted = gmdate('i:s', $waktuRenangPriaDetik);

        if ($waktuRenangPria <= $waktuMax100) {
            $nilaiAkhir = 100;
        } elseif ($waktuRenangPria > $waktuMin1) {
            $nilaiAkhir = 0;
        } else {
            $nilaiAkhir = 100 - (($waktuRenangPria - $waktuMax100) / ($waktuMin1 - $waktuMax100)) * 100;
        }
    } else {
        $nilaiAkhir = 0;
    }

    $dataLamaGarjasRenangPria = $garjasRenangPriaModel->getTesRenangPriaById($idRenangPria);

    if ($dataLamaGarjasRenangPria) {
        $dataGarjasRenangPria = [
            'Tanggal_Pelaksanaan_Tes_Renang_Pria' => $tanggalPelaksanaanRenangPria,
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

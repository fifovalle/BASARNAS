<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idGarjasPriaSitUp1 = $_POST['ID_Sit_Up_Kaki_Lurus_Pria'] ?? '';
    $jumlahSitUp1Pria = $_POST['Jumlah_Sit_Up_Kaki_Lurus_Pria'] ?? '';
    $nilaiSitUp1Pria = $_POST['Nilai_Sit_Up_Kaki_Lurus_Pria'] ?? '';
    $tanggalPelaksanaanSitUp1Pria = $_POST['Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria'] ?? '';


    $garjasSitUp1PriaModel = new GarjasPriaSitUpKakiLurus($koneksi);

    $umurPengguna = $garjasSitUp1PriaModel->ambilUmurGarjasSitUp1PriaOlehNIP($nipPengguna);

    if ($jumlahSitUp1Pria == 0) {
        echo json_encode(["success" => false, "message" => "Nilai Sit Up Kaki Lurus tidak boleh 0."]);
        exit;
    }

    $nilaiSitUp1Pria = [
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
        if ($jumlahSitUp1Pria > 46 && isset($nilaiSitUp1Pria['under_25']['>46'])) {
            $nilaiAkhirSitUpKakiLurus = $nilaiSitUp1Pria['under_25']['>46'];
        } else {
            $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUp1Pria['under_25'][$jumlahSitUp1Pria]) ? $nilaiSitUp1Pria['under_25'][$jumlahSitUp1Pria] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($jumlahSitUp1Pria >= 41 && isset($nilaiSitUp1Pria['25-34']['>41'])) {
            $nilaiAkhirSitUpKakiLurus = $nilaiSitUp1Pria['25-34']['>41'];
        } else {
            $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUp1Pria['25-34'][$jumlahSitUp1Pria]) ? $nilaiSitUp1Pria['25-34'][$jumlahSitUp1Pria] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($jumlahSitUp1Pria >= 36 && isset($nilaiSitUp1Pria['35-44']['>36'])) {
            $nilaiAkhirSitUpKakiLurus = $nilaiSitUp1Pria['35-44']['>36'];
        } else {
            $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUp1Pria['35-44'][$jumlahSitUp1Pria]) ? $nilaiSitUp1Pria['35-44'][$jumlahSitUp1Pria] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($jumlahSitUp1Pria >= 31 && isset($nilaiSitUp1Pria['45-54']['>31'])) {
            $nilaiAkhirSitUpKakiLurus = $nilaiSitUp1Pria['45-54']['>31'];
        } else {
            $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUp1Pria['45-54'][$jumlahSitUp1Pria]) ? $nilaiSitUp1Pria['45-54'][$jumlahSitUp1Pria] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($jumlahSitUp1Pria >= 26 && isset($nilaiSitUp1Pria['55-59']['>26'])) {
            $nilaiAkhirSitUpKakiLurus = $nilaiSitUp1Pria['55-59']['>26'];
        } else {
            $nilaiAkhirSitUpKakiLurus = isset($nilaiSitUp1Pria['55-59'][$jumlahSitUp1Pria]) ? $nilaiSitUp1Pria['55-59'][$jumlahSitUp1Pria] : 0;
        }
    }

    $dataLamaGarjasPriaSitUp1 = $garjasSitUp1PriaModel->ambilDataGarjasSitUp1OlehId($idGarjasPriaSitUp1);

    if ($dataLamaGarjasPriaSitUp1) {
        $dataGarjasPriaSitUp1 = [
            'Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria' => $tanggalPelaksanaanSitUp1Pria,
            'Jumlah_Sit_Up_Kaki_Lurus_Pria' => $jumlahSitUp1Pria,
            'Nilai_Sit_Up_Kaki_Lurus_Pria' => $nilaiAkhirSitUpKakiLurus
        ];

        $updateDataGarjasPriaSitUp1 = $garjasSitUp1PriaModel->perbaruiGarjasPriaSitUp1($idGarjasPriaSitUp1, $dataGarjasPriaSitUp1);

        if ($updateDataGarjasPriaSitUp1) {
            echo json_encode(["success" => true, "message" => "Data Garjas Pria Sit Up Kaki Lurus berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data Garjas Pria Sit Up Kaki Lurus."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data Garjas Pria Sit Up Kaki Lurus tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idGarjasPriaSitUp2 = $_POST['ID_Sit_Up_Kaki_Di_Tekuk_Pria'] ?? '';
    $jumlahSitUpKakiDitekukPria = $_POST['Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria'] ?? '';
    $nilaiSitUpKakiDitekuk = $_POST['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria'] ?? '';

    $garjasSitUp2PriaModel = new GarjasPriaSitUpKakiDitekuk($koneksi);

    $umurPengguna = $garjasSitUp2PriaModel->ambilUmurGarjasSitUp2PriaOlehNIP($nipPengguna);

    $nilaiSitUpKakiDitekuk = [
        'under_25' => [
            84 => 100, 83 => 98, 82 => 96, 81 => 94, 80 => 92,
            79 => 90, 78 => 88, 77 => 86, 76 => 84, 75 => 82,
            74 => 79, 73 => 77, 72 => 75, 71 => 73, 70 => 86,
            69 => 85, 68 => 84, 67 => 83, 66 => 82, 65 => 81,
            64 => 80, 63 => 79, 62 => 78, 61 => 77, 60 => 76,
            59 => 75, 58 => 74, 57 => 73, 56 => 72, 55 => 71,
            54 => 70, 53 => 69, 52 => 68, 51 => 67, 50 => 66,
            49 => 65, 48 => 64, 47 => 63, 46 => 62, 45 => 61,
            44 => 60, 43 => 59, 42 => 58, 41 => 57, 40 => 56,
            39 => 55, 38 => 54, 37 => 53, 36 => 52, 35 => 51,
            34 => 50, 33 => 49, 32 => 48, 31 => 47, 30 => 46,
            29 => 45, 28 => 44, 27 => 43, 26 => 42, 25 => 41,
            24 => 40, 23 => 39, 22 => 38, 21 => 37, 20 => 36,
            19 => 35, 18 => 34, 17 => 33, 16 => 32, 15 => 31,
            14 => 30, 13 => 29, 12 => 28, 11 => 27, 10 => 26,
            9 => 25, 8 => 24, 7 => 23, 6 => 22, 5 => 21,
            4 => 20, 3 => 19, 2 => 18, 1 => 17
        ],

        '25-34' => [
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
            36 => 100, 35 => 96, 34 => 93, 33 => 89, 32 => 85,
            31 => 82, 30 => 78, 29 => 74, 28 => 71, 27 => 67,
            26 => 63, 25 => 59, 24 => 56, 23 => 52, 22 => 48,
            21 => 45, 20 => 41, 19 => 39, 18 => 37, 17 => 35,
            16 => 33, 15 => 30, 14 => 28, 13 => 26, 12 => 24,
            11 => 22, 10 => 20, 9 => 18, 8 => 16, 7 => 14,
            6 => 12, 5 => 10, 4 => 8, 3 => 6, 2 => 4, 1 => 3
        ],
        '45-54' => [
            31 => 100, 30 => 96, 29 => 93, 28 => 89, 27 => 85,
            26 => 82, 25 => 78, 24 => 74, 23 => 71, 22 => 67,
            21 => 63, 20 => 59, 19 => 56, 18 => 52, 17 => 48,
            16 => 45, 15 => 41, 14 => 38, 13 => 35, 12 => 32,
            11 => 30, 10 => 27, 9 => 24, 8 => 21, 7 => 18,
            6 => 16, 5 => 14, 4 => 11, 3 => 9, 2 => 7, 1 => 5
        ],
        '55-59' => [
            26 => 100, 25 => 96, 24 => 93, 23 => 89, 22 => 85,
            21 => 82, 20 => 78, 19 => 74, 18 => 71, 17 => 67,
            16 => 63, 15 => 59, 14 => 56, 13 => 52, 12 => 48,
            11 => 45, 10 => 41, 9 => 37, 8 => 32, 7 => 28,
            6 => 23, 5 => 19,4 => 14, 3 => 11, 2 => 9, 1 => 7
        ]
    ];
    
    $nilaiAkhir = 0;
    if ($umurPengguna < 25) {
        $nilaiAkhir = isset($nilaiSitUpKakiDitekuk['under_25'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['under_25'][$jumlahSitUpKakiDitekukPria] : 0;
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $nilaiAkhir = isset($nilaiSitUpKakiDitekuk['25-34'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['25-34'][$jumlahSitUpKakiDitekukPria] : 0;
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $nilaiAkhir = isset($nilaiSitUpKakiDitekuk['35-44'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['35-44'][$jumlahSitUpKakiDitekukPria] : 0;
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $nilaiAkhir = isset($nilaiSitUpKakiDitekuk['45-54'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['45-54'][$jumlahSitUpKakiDitekukPria] : 0;
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $nilaiAkhir = isset($nilaiSitUpKakiDitekuk['55-59'][$jumlahSitUpKakiDitekukPria]) ? $nilaiSitUpKakiDitekuk['55-59'][$jumlahSitUpKakiDitekukPria] : 0;
    }

    $dataLamaGarjasPriaSitUp2 = $garjasSitUp2PriaModel->ambilDataGarjasSitUp2OlehId($idGarjasPriaSitUp2);
    
    if ($dataLamaGarjasPriaSitUp2) {
        $dataGarjasPriaSitUp2 = array(
            'Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria' => $jumlahSitUpKakiDitekukPria,
            'Nilai_Sit_Up_Kaki_Di_Tekuk_Pria' => $nilaiAkhir
        );

        $updateDataGarjasPriaSitUp2 = $garjasSitUp2PriaModel->perbaruiGarjasPriaSitUp2($idGarjasPriaSitUp2, $dataGarjasPriaSitUp2);

        if ($updateDataGarjasPriaSitUp2) {
            echo json_encode(["success" => true, "message" => "Data Garjas Pria Sit Up Kaki Ditekuk berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data Garjas Pria Sit Up Kaki Ditekuk."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data Garjas Pria Sit Up Kaki Ditekuk tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

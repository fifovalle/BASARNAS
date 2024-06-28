<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idGarjasPriaPushUp = $_POST['ID_Push_Up_Pria'] ?? '';
    $jumlahPushUpPria = $_POST['Jumlah_Push_Up_Pria'] ?? '';
    $nilaiPushUpPria = $_POST['Nilai_Push_Up_Pria'] ?? '';
    $tanggalPelaksanaanPushUpPria = $_POST['Tanggal_Pelaksanaan_Push_Up_Pria'] ?? '';

    $garjasPushUpPriaModel = new GarjasPushUpPria($koneksi);

    $umurPengguna = $garjasPushUpPriaModel->ambilUmurGarjasPushUpPriaOlehNIP($nipPengguna);

    if ($jumlahPushUpPria == 0) {
        setPesanKesalahan("Nilai push-up tidak boleh 0.");
        header("Location: $akarUrl" . "src/admin/pages/data-garjas-pria-pushup.php");
        exit;
    }

    $nilaiPushUp = [
        'under_25' => [
            '>44' => 100,
            44 => 100, 43 => 96, 42 => 91, 41 => 87, 40 => 83,
            39 => 78, 38 => 74, 37 => 70, 36 => 65, 35 => 61,
            34 => 59, 33 => 57, 32 => 56, 31 => 54, 30 => 52,
            29 => 50, 28 => 49, 27 => 47, 26 => 45, 25 => 43,
            24 => 42, 23 => 40, 22 => 38, 21 => 36, 20 => 35,
            19 => 33, 18 => 31, 17 => 29, 16 => 27, 15 => 26,
            14 => 24, 13 => 22, 12 => 20, 11 => 19, 10 => 17,
            9 => 15, 8 => 13, 7 => 12, 6 => 10, 5 => 8,
            4 => 6, 3 => 5, 2 => 3, 1 => 1, 0 => 0,
        ],
        '25-34' => [
            '>42' => 100,
            42 => 100, 41 => 96, 40 => 91, 39 => 87, 38 => 83,
            37 => 78, 36 => 74, 35 => 70, 34 => 65, 33 => 61,
            32 => 59, 31 => 57, 30 => 56, 29 => 54, 28 => 52,
            27 => 50, 26 => 48, 25 => 46, 24 => 44, 23 => 42,
            22 => 40, 21 => 39, 20 => 37, 19 => 35, 18 => 33,
            17 => 31, 16 => 29, 15 => 27, 14 => 25, 13 => 24,
            12 => 22, 11 => 20, 10 => 18, 9 => 16, 8 => 14,
            7 => 13, 6 => 11, 5 => 9, 4 => 7, 3 => 6,
            2 => 4, 1 => 2, 0 => 0,
        ],
        '35-44' => [
            '>39' => 100,
            39 => 100, 38 => 96, 37 => 91, 36 => 87, 35 => 83,
            34 => 78, 33 => 74, 32 => 70, 31 => 65, 30 => 61,
            29 => 60, 28 => 58, 27 => 56, 26 => 53, 25 => 51,
            24 => 49, 23 => 47, 22 => 44, 21 => 42, 20 => 40,
            19 => 38, 18 => 36, 17 => 34, 16 => 32, 15 => 30,
            14 => 28, 13 => 26, 12 => 24, 11 => 22, 10 => 20,
            9 => 18, 8 => 16, 7 => 14, 6 => 12, 5 => 10,
            4 => 8, 3 => 7, 2 => 5, 1 => 3, 0 => 0,
        ],
        '45-54' => [
            '>33' => 100,
            33 => 100, 32 => 97, 31 => 94, 30 => 91, 29 => 88,
            28 => 85, 27 => 82, 26 => 79, 25 => 76, 24 => 73,
            23 => 70, 22 => 67, 21 => 64, 20 => 61, 19 => 58,
            18 => 55, 17 => 52, 16 => 48, 15 => 45, 14 => 42,
            13 => 39, 12 => 36, 11 => 33, 10 => 29, 9 => 26,
            8 => 23, 7 => 20, 6 => 17, 5 => 14, 4 => 11,
            3 => 9, 2 => 6, 1 => 4, 0 => 0,
        ],
        '55-59' => [
            '>22' => 100,
            22 => 100, 21 => 97, 20 => 94, 19 => 91, 18 => 88,
            17 => 85, 16 => 82, 15 => 79, 14 => 76, 13 => 73,
            12 => 70, 11 => 67, 10 => 64, 9 => 61, 8 => 54,
            7 => 46, 6 => 39, 5 => 31, 4 => 24, 3 => 16,
            2 => 10, 1 => 6, 0 => 0,
        ]
    ];

    $nilaiAkhir = 0;
    if ($umurPengguna < 25) {
        if ($jumlahPushUpPria > 44 && isset($nilaiPushUp['under_25']['>44'])) {
            $nilaiAkhir = $nilaiPushUp['under_25']['>44'];
        } else {
            $nilaiAkhir = isset($nilaiPushUp['under_25'][$jumlahPushUpPria]) ? $nilaiPushUp['under_25'][$jumlahPushUpPria] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($jumlahPushUpPria > 42 && isset($nilaiPushUp['25-34']['>42'])) {
            $nilaiAkhir = $nilaiPushUp['25-34']['>42'];
        } else {
            $nilaiAkhir = isset($nilaiPushUp['25-34'][$jumlahPushUpPria]) ? $nilaiPushUp['25-34'][$jumlahPushUpPria] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($jumlahPushUpPria > 39 && isset($nilaiPushUp['35-44']['>39'])) {
            $nilaiAkhir = $nilaiPushUp['35-44']['>39'];
        } else {
            $nilaiAkhir = isset($nilaiPushUp['35-44'][$jumlahPushUpPria]) ? $nilaiPushUp['35-44'][$jumlahPushUpPria] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($jumlahPushUpPria > 33 && isset($nilaiPushUp['45-54']['>33'])) {
            $nilaiAkhir = $nilaiPushUp['45-54']['>33'];
        } else {
            $nilaiAkhir = isset($nilaiPushUp['45-54'][$jumlahPushUpPria]) ? $nilaiPushUp['45-54'][$jumlahPushUpPria] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($jumlahPushUpPria > 22 && isset($nilaiPushUp['55-59']['>22'])) {
            $nilaiAkhir = $nilaiPushUp['55-59']['>22'];
        } else {
            $nilaiAkhir = isset($nilaiPushUp['55-59'][$jumlahPushUpPria]) ? $nilaiPushUp['55-59'][$jumlahPushUpPria] : 0;
        }
    }

    $dataLamaGarjasPria = $garjasPushUpPriaModel->ambilDataGarjasPriaPushUpOlehId($idGarjasPriaPushUp);

    if ($dataLamaGarjasPria) {
        $dataGarjasPria = [
            'Tanggal_Pelaksanaan_Push_Up_Pria' => $tanggalPelaksanaanPushUpPria,
            'Jumlah_Push_Up_Pria' => $jumlahPushUpPria,
            'Nilai_Push_Up_Pria' => $nilaiAkhir
        ];

        $updateDataGarjasPria = $garjasPushUpPriaModel->perbaruiGarjasPriaPushUp($idGarjasPriaPushUp, $dataGarjasPria);

        if ($updateDataGarjasPria) {
            echo json_encode(["success" => true, "message" => "Data Garjas Pria Push Up berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data Garjas Pria Push Up."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data Garjas Pria Push Up tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idGarjasPriaShuttleRun = $_POST['ID_Shuttle_Run_Pria'] ?? '';
    $tanggalPelaksanaanShuttleRunPria = $_POST['Tanggal_Pelaksanaan_Shuttle_Run_Pria'] ?? '';
    $waktuShuttleRunPria = $_POST['Waktu_Shuttle_Run_Pria'] ?? '';
    $nilaiShuttleRunPria = $_POST['Nilai_Shuttle_Run_Pria'] ?? '';

    $garjasPriaShuttleRunModel = new GarjasPriaShuttleRun($koneksi);

    $umurPengguna = $garjasPriaShuttleRunModel->ambilUmurGarjasShuttleRunPriaOlehNIP($nipPengguna);

    $waktuShuttleRunPria = str_replace(',', '.', $waktuShuttleRunPria);
    $waktuShuttleRunPria = (float) $waktuShuttleRunPria;


    $nilaiShuttleRunPria = [
        'under_25' => [
            '<15.9' => 100,
            15.9 => 100, 16 => 99, 16.1 => 98, 16.2 => 97, 16.3 => 96,
            16.4 => 95, 16.5 => 94, 16.6 => 93, 16.7 => 92, 16.8 => 91,
            16.9 => 90, 17 => 89, 17.1 => 88, 17.2 => 87, 17.3 => 86,
            17.4 => 85, 17.5 => 84, 17.6 => 83, 17.7 => 82, 17.8 => 81,
            17.9 => 80, 18 => 79, 18.1 => 78, 18.2 => 77, 18.3 => 76,
            18.4 => 75, 18.5 => 74, 18.6 => 73, 18.7 => 72, 18.8 => 71,
            18.9 => 70, 19 => 69, 19.1 => 68, 19.2 => 67, 19.3 => 66,
            19.4 => 65, 19.5 => 64, 19.6 => 63, 19.7 => 62, 19.8 => 61,
            19.9 => 60, 20 => 59, 20.1 => 58, 20.2 => 57, 20.3 => 56,
            20.4 => 55, 20.5 => 54, 20.6 => 53, 20.7 => 52, 20.8 => 51,
            20.9 => 50, 21 => 49, 21.1 => 48, 21.2 => 47, 21.3 => 46,
            21.4 => 45, 21.5 => 44, 21.6 => 43, 21.7 => 42, 21.8 => 41,
            21.9 => 40, 22 => 39, 22.1 => 38, 22.2 => 37, 22.3 => 36,
            22.4 => 35, 22.5 => 34, 22.6 => 33, 22.7 => 32, 22.8 => 31,
            22.9 => 30, 23 => 29, 23.1 => 28, 23.2 => 27, 23.3 => 26,
            23.4 => 25, 23.5 => 24, 23.6 => 23, 23.7 => 22, 23.8 => 21,
            23.9 => 20, 24 => 19, 24.1 => 18, 24.2 => 17, 24.3 => 16,
            24.4 => 15, 24.5 => 14, 24.6 => 13, 24.7 => 12, 24.8 => 11,
            24.9 => 10, 25 => 9, 25.1 => 8, 25.2 => 7, 25.3 => 6,
            25.4 => 5, 25.5 => 4, 25.6 => 3, 25.7 => 2, 25.8 => 1,
        ],

        '25-34' => [
            '<16.9' => 100,
            16.9 => 100, 17 => 99, 17.1 => 98, 17.2 => 97, 17.3 => 96,
            17.4 => 95, 17.5 => 94, 17.6 => 93, 17.7 => 92, 17.8 => 91,
            17.9 => 90, 18 => 89, 18.1 => 88, 18.2 => 87, 18.3 => 86,
            18.4 => 85, 18.5 => 84, 18.6 => 83, 18.7 => 82, 18.8 => 81,
            18.9 => 80, 19 => 79, 19.1 => 78, 19.2 => 77, 19.3 => 76,
            19.4 => 75, 19.5 => 74, 19.6 => 73, 19.7 => 72, 19.8 => 71,
            19.9 => 70, 20 => 69, 20.1 => 68, 20.2 => 67, 20.3 => 66,
            20.4 => 65, 20.5 => 64, 20.6 => 63, 20.7 => 62, 20.8 => 61,
            20.9 => 60, 21 => 59, 21.1 => 58, 21.2 => 57, 21.3 => 56,
            21.4 => 55, 21.5 => 54, 21.6 => 53, 21.7 => 52, 21.8 => 51,
            21.9 => 50, 22 => 49, 22.1 => 48, 22.2 => 47, 22.3 => 46,
            22.4 => 45, 22.5 => 44, 22.6 => 43, 22.7 => 42, 22.8 => 41,
            22.9 => 40, 23 => 39, 23.1 => 38, 23.2 => 37, 23.3 => 36,
            23.4 => 35, 23.5 => 34, 23.6 => 33, 23.7 => 32, 23.8 => 31,
            23.9 => 30, 24 => 29, 24.1 => 28, 24.2 => 27, 24.3 => 26,
            24.4 => 25, 24.5 => 24, 24.6 => 23, 24.7 => 22, 24.8 => 21,
            24.9 => 20, 25 => 19, 25.1 => 18, 25.2 => 17, 25.3 => 16,
            25.4 => 15, 25.5 => 14, 25.6 => 13, 25.7 => 12, 25.8 => 11,
            25.9 => 10, 26 => 9, 26.1 => 8, 26.2 => 7, 26.3 => 6,
            26.4 => 5, 26.5 => 4, 26.6 => 3, 26.7 => 2, 26.8 => 1,
        ],

        '35-44' => [
            '<17.4' => 100,
            17.4 => 100, 17.5 => 99, 17.6 => 98, 17.7 => 97, 17.8 => 96,
            17.9 => 95, 18 => 94, 18.1 => 93, 18.2 => 92, 18.3 => 91,
            18.4 => 90, 18.5 => 89, 18.6 => 88, 18.7 => 87, 18.8 => 86,
            18.9 => 85, 19 => 84, 19.1 => 83, 19.2 => 82, 19.3 => 81,
            19.4 => 80, 19.5 => 79, 19.6 => 78, 19.7 => 77, 19.8 => 76,
            19.9 => 75, 20 => 74, 20.1 => 73, 20.2 => 72, 20.3 => 71,
            20.4 => 70, 20.5 => 69, 20.6 => 68, 20.7 => 67, 20.8 => 66,
            20.9 => 65, 21 => 64, 21.1 => 63, 21.2 => 62, 21.3 => 61,
            21.4 => 60, 21.5 => 59, 21.6 => 58, 21.7 => 57, 21.8 => 56,
            21.9 => 55, 22 => 54, 22.1 => 53, 22.2 => 52, 22.3 => 51,
            22.4 => 50, 22.5 => 49, 22.6 => 48, 22.7 => 47, 22.8 => 46,
            22.9 => 45, 23 => 44, 23.1 => 43, 23.2 => 42, 23.3 => 41,
            23.4 => 40, 23.5 => 39, 23.6 => 38, 23.7 => 37, 23.8 => 36,
            23.9 => 35, 24 => 34, 24.1 => 33, 24.2 => 32, 24.3 => 31,
            24.4 => 30, 24.5 => 29, 24.6 => 28, 24.7 => 27, 24.8 => 26,
            24.9 => 25, 25 => 24, 25.1 => 23, 25.2 => 22, 25.3 => 21,
            25.4 => 20, 25.5 => 19, 25.6 => 18, 25.7 => 17, 25.8 => 16,
            25.9 => 15, 26 => 14, 26.1 => 13, 26.2 => 12, 26.3 => 11,
            26.4 => 10, 26.5 => 9, 26.6 => 8, 26.7 => 7, 26.8 => 6,
            26.9 => 5, 27 => 4, 27.1 => 3, 27.2 => 2, 27.3 => 1,
        ],

        '45-54' => [
            '<18.9' => 100,
            18.9 => 100, 19 => 99, 19.1 => 98, 19.2 => 97, 19.3 => 96,
            19.4 => 95, 19.5 => 94, 19.6 => 93, 19.7 => 92, 19.8 => 91,
            19.9 => 90, 20 => 89, 20.1 => 88, 20.2 => 87, 20.3 => 86,
            20.4 => 85, 20.5 => 84, 20.6 => 83, 20.7 => 82, 20.8 => 81,
            20.9 => 80, 21 => 79, 21.1 => 78, 21.2 => 77, 21.3 => 76,
            21.4 => 75, 21.5 => 74, 21.6 => 73, 21.7 => 72, 21.8 => 71,
            21.9 => 70, 22 => 69, 22.1 => 68, 22.2 => 67, 22.3 => 66,
            22.4 => 65, 22.5 => 64, 22.6 => 63, 22.7 => 62, 22.8 => 61,
            22.9 => 60, 23 => 59, 23.1 => 58, 23.2 => 57, 23.3 => 56,
            23.4 => 55, 23.5 => 54, 23.6 => 53, 23.7 => 52, 23.8 => 51,
            23.9 => 50, 24 => 49, 24.1 => 48, 24.2 => 47, 24.3 => 46,
            24.4 => 45, 24.5 => 44, 24.6 => 43, 24.7 => 42, 24.8 => 41,
            24.9 => 40, 25 => 39, 25.1 => 38, 25.2 => 37, 25.3 => 36,
            25.4 => 35, 25.5 => 34, 25.6 => 33, 25.7 => 32, 25.8 => 31,
            25.9 => 30, 26 => 29, 26.1 => 28, 26.2 => 27, 26.3 => 26,
            26.4 => 25, 26.5 => 24, 26.6 => 23, 26.7 => 22, 26.8 => 21,
            26.9 => 20, 27 => 19, 27.1 => 18, 27.2 => 17, 27.3 => 16,
            27.4 => 15, 27.5 => 14, 27.6 => 13, 27.7 => 12, 27.8 => 11,
            27.9 => 10, 28 => 9, 28.1 => 8, 28.2 => 7, 28.3 => 6,
            28.4 => 5, 28.5 => 4, 28.6 => 3, 28.7 => 2, 28.8 => 1,
        ],

        '55-59' => [
            '<20.4' => 100,
            20.4 => 100, 20.5 => 99, 20.6 => 98, 20.7 => 97, 20.8 => 96,
            20.9 => 95, 21 => 94, 21.1 => 93, 21.2 => 92, 21.3 => 91,
            21.4 => 90, 21.5 => 89, 21.6 => 88, 21.7 => 87, 21.8 => 86,
            21.9 => 85, 22 => 84, 22.1 => 83, 22.2 => 82, 22.3 => 81,
            22.4 => 80, 22.5 => 79, 22.6 => 78, 22.7 => 77, 22.8 => 76,
            22.9 => 75, 23 => 74, 23.1 => 73, 23.2 => 72, 23.3 => 71,
            23.4 => 70, 23.5 => 69, 23.6 => 68, 23.7 => 67, 23.8 => 66,
            23.9 => 65, 24 => 64, 24.1 => 63, 24.2 => 62, 24.3 => 61,
            24.4 => 60, 24.5 => 59, 24.6 => 58, 24.7 => 57, 24.8 => 56,
            24.9 => 55, 25 => 54, 25.1 => 53, 25.2 => 52, 25.3 => 51,
            25.4 => 50, 25.5 => 49, 25.6 => 48, 25.7 => 47, 25.8 => 46,
            25.9 => 45, 26 => 44, 26.1 => 43, 26.2 => 42, 26.3 => 41,
            26.4 => 40, 26.5 => 39, 26.6 => 38, 26.7 => 37, 26.8 => 36,
            26.9 => 35, 27 => 34, 27.1 => 33, 27.2 => 32, 27.3 => 31,
            27.4 => 30, 27.5 => 29, 27.6 => 28, 27.7 => 27, 27.8 => 26,
            27.9 => 25, 28 => 24, 28.1 => 23, 28.2 => 22, 28.3 => 21,
            28.4 => 20, 28.5 => 19, 28.6 => 18, 28.7 => 17, 28.8 => 16,
            28.9 => 15, 29 => 14, 29.1 => 13, 29.2 => 12, 29.3 => 11,
            29.4 => 10, 29.5 => 9, 29.6 => 8, 29.7 => 7, 29.8 => 6,
            29.9 => 5, 30 => 4, 30.1 => 3, 30.2 => 2, 30.3 => 1,
        ]
    ];

    $nilaiAkhir = 0;

    if ($umurPengguna < 25) {
        if ($waktuShuttleRunPria < 15.9 && isset($nilaiShuttleRunPria['under_25']['<15.9'])) {
            $nilaiAkhir = $nilaiShuttleRunPria['under_25']['<15.9'];
        } else {
            $nilaiAkhir = isset($nilaiShuttleRunPria['under_25'][$waktuShuttleRunPria]) ? $nilaiShuttleRunPria['under_25'][$waktuShuttleRunPria] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($waktuShuttleRunPria < 16.9 && isset($nilaiShuttleRunPria['25-34']['<16.9'])) {
            $nilaiAkhir = $nilaiShuttleRunPria['25-34']['<16.9'];
        } else {
            $nilaiAkhir = isset($nilaiShuttleRunPria['25-34'][$waktuShuttleRunPria]) ? $nilaiShuttleRunPria['25-34'][$waktuShuttleRunPria] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($waktuShuttleRunPria < 17.4 && isset($nilaiShuttleRunPria['35-44']['<17.4'])) {
            $nilaiAkhir = $nilaiShuttleRunPria['35-44']['<17.4'];
        } else {
            $nilaiAkhir = isset($nilaiShuttleRunPria['35-44'][$waktuShuttleRunPria]) ? $nilaiShuttleRunPria['35-44'][$waktuShuttleRunPria] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($waktuShuttleRunPria < 18.9 && isset($nilaiShuttleRunPria['45-54']['<18.9'])) {
            $nilaiAkhir = $nilaiShuttleRunPria['45-54']['<18.9'];
        } else {
            $nilaiAkhir = isset($nilaiShuttleRunPria['45-54'][$waktuShuttleRunPria]) ? $nilaiShuttleRunPria['45-54'][$waktuShuttleRunPria] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($waktuShuttleRunPria < 20.4 && isset($nilaiShuttleRunPria['55-59']['<20.4'])) {
            $nilaiAkhir = $nilaiShuttleRunPria['55-59']['<20.4'];
        } else {
            $nilaiAkhir = isset($nilaiShuttleRunPria['55-59'][$waktuShuttleRunPria]) ? $nilaiShuttleRunPria['55-59'][$waktuShuttleRunPria] : 0;
        }
    }

    $dataLamaGarjasPriaShuttleRun = $garjasPriaShuttleRunModel->ambilDataGarjasShuttleRunPriaId($idGarjasPriaShuttleRun);

    if ($dataLamaGarjasPriaShuttleRun) {
        $dataGarjasPriaShuttleRun = array(
            'Tanggal_Pelaksanaan_Shuttle_Run_Pria' => $tanggalPelaksanaanShuttleRunPria,
            'Waktu_Shuttle_Run_Pria' => $waktuShuttleRunPria,
            'Nilai_Shuttle_Run_Pria' => $nilaiAkhir
        );

        $updatedataGarjasPriaShuttleRun = $garjasPriaShuttleRunModel->perbaruiGarjasPriaShuttleRun($idGarjasPriaShuttleRun, $dataGarjasPriaShuttleRun);

        if ($updatedataGarjasPriaShuttleRun) {
            echo json_encode(["success" => true, "message" => "Data Garjas Pria Shuttel Run berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data Garjas Pria Shuttel Run."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data Garjas Pria Shuttel Run tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

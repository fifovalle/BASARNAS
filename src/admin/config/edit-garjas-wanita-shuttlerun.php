<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGarjasWanitaShuttleRun = $_POST['ID_Wanita_Shuttle_Run'] ?? '';
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $jumlahShuttleRunWanita = $_POST['Jumlah_Shuttle_Run_Wanita'] ?? '';

    $garjasWanitaShuttleRunModel = new GarjasWanitaShuttleRun($koneksi);
    $umurPengguna = $garjasWanitaShuttleRunModel->ambilUmurGarjasWanitaShuttleRunOlehNIP($nipPengguna);

    $nilaiShuttleRun = [
        'under_25' => [
            38 => 100, 37 => 98, 36 => 96, 35 => 94, 34 => 92,
            33 => 89, 32 => 87, 31 => 85, 30 => 83, 29 => 81,
            28 => 79, 27 => 77, 26 => 75, 25 => 73, 24 => 70,
            23 => 68, 22 => 66, 21 => 64, 20 => 62, 19 => 60,
            18 => 58, 17 => 56, 16 => 54, 14 => 49, 13 => 47,
            12 => 45, 11 => 43, 10 => 41, 9 => 37, 8 => 32,
            7 => 27, 6 => 23, 5 => 19, 4 => 14, 3 => 10, 2 => 5, 1 => 1
        ],
        '25-34' => [
            36 => 100, 35 => 98, 34 => 96, 33 => 94, 32 => 92,
            31 => 89, 30 => 87, 29 => 85, 28 => 83, 27 => 81,
            26 => 79, 25 => 77, 24 => 75, 23 => 73, 22 => 70,
            21 => 68, 20 => 66, 19 => 64, 18 => 62, 17 => 60,
            16 => 58, 15 => 56, 14 => 54, 13 => 52, 12 => 49,
            11 => 47, 10 => 45, 9 => 43, 8 => 41, 7 => 37,
            6 => 32, 5 => 27, 4 => 23, 3 => 19, 2 => 14, 1 => 10
        ],
        '35-44' => [
            34 => 100, 33 => 98, 32 => 96, 31 => 94, 30 => 92,
            29 => 89, 28 => 87, 27 => 85, 26 => 83, 25 => 81,
            24 => 79, 23 => 77, 22 => 75, 21 => 73, 20 => 70,
            19 => 68, 18 => 66, 17 => 64, 16 => 62, 15 => 60,
            14 => 58, 13 => 56, 12 => 54, 11 => 52, 10 => 49,
            9 => 47, 8 => 45, 7 => 43, 6 => 41, 5 => 37, 4 => 32,
            3 => 27, 2 => 23, 1 => 19
        ],
        '45-54' => [
            32 => 100, 31 => 98, 30 => 96, 29 => 94, 28 => 92,
            27 => 89, 26 => 87, 25 => 85, 24 => 83, 23 => 81,
            22 => 79, 21 => 77, 20 => 75, 19 => 73, 18 => 70,
            17 => 68, 16 => 66, 15 => 64, 14 => 62, 13 => 60,
            12 => 58, 11 => 56, 10 => 54, 9 => 52, 8 => 49,
            7 => 47, 6 => 45, 5 => 43, 4 => 41, 3 => 37,
            2 => 34, 1 => 32
        ],
        '55-59' => [
            31 => 100, 30 => 98, 29 => 96, 28 => 94, 27 => 92,
            26 => 89, 25 => 88, 24 => 87, 23 => 85, 22 => 83,
            21 => 81, 20 => 79, 19 => 77, 18 => 75, 17 => 73,
            16 => 70, 15 => 68, 14 => 66, 13 => 64, 12 => 62,
            11 => 60, 10 => 58, 9 => 56, 8 => 54, 7 => 52,
            6 => 49, 5 => 47, 4 => 45, 3 => 43, 2 => 41, 1 => 37
        ]
    ];

    $nilaiAkhir = 0;
    if ($umurPengguna < 25) {
        $nilaiAkhir = isset($nilaiShuttleRun['under_25'][$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['under_25'][$jumlahShuttleRunWanita] : 0;
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $nilaiAkhir = isset($nilaiShuttleRun['25-34'][$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['25-34'][$jumlahShuttleRunWanita] : 0;
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $nilaiAkhir = isset($nilaiShuttleRun['35-44'][$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['35-44'][$jumlahShuttleRunWanita] : 0;
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $nilaiAkhir = isset($nilaiShuttleRun['45-54'][$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['45-54'][$jumlahShuttleRunWanita] : 0;
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $nilaiAkhir = isset($nilaiShuttleRun['55-59'][$jumlahShuttleRunWanita]) ? $nilaiShuttleRun['55-59'][$jumlahShuttleRunWanita] : 0;
    }

    $dataGarjasWanitaShuttleRun = array(
        'NIP_Pengguna' => $nipPengguna,
        'Jumlah_Shuttle_Run_Wanita' => $jumlahShuttleRunWanita,
        'Nilai_Shuttle_Run_Wanita' => $nilaiAkhir
    );
    $updateGarjasWanitaShuttleRun = $garjasWanitaShuttleRunModel->perbaruiGarjasWanitaShuttleRun($idGarjasWanitaShuttleRun, $dataGarjasWanitaShuttleRun);

    if ($updateGarjasWanitaShuttleRun) {
        echo json_encode(array("success" => true, "message" => "Data Garjas Wanita Shuttle Run berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Wanita Shuttle Run."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

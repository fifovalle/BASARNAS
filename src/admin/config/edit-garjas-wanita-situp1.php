<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGarjasWanitaSitUp1 = $_POST['ID_Wanita_Sit_Up_Kaki_Lurus'] ?? '';
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $jumlahSitUp1Wanita = $_POST['Jumlah_Sit_Up_1_Wanita'] ?? '';
    $tanggalPelaksanaanSitUp1Wanita = $_POST['Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita'] ?? '';

    $garjasWanitaSitUp1Model = new GarjasWanitaSitUp1($koneksi);
    $umurPengguna = $garjasWanitaSitUp1Model->ambilUmurGarjasWanitaSitUp1OlehNIP($nipPengguna);

    if ($jumlahSitUp1Wanita == 0) {
        echo json_encode(array("success" => false, "message" => "Nilai sit-up kaki lurus tidak boleh 0."));
        exit;
    }

    $nilaiSitUp1 = [
        'under_25' => [
            46 => 100, 45 => 96, 44 => 93, 43 => 89, 42 => 85,
            41 => 82, 40 => 78, 39 => 74, 38 => 71, 37 => 67,
            36 => 63, 35 => 59, 34 => 56, 33 => 52, 32 => 48,
            31 => 45, 30 => 41, 29 => 40, 28 => 38, 27 => 37,
            26 => 36, 25 => 34, 24 => 33, 23 => 32, 22 => 30,
            21 => 29, 20 => 28, 19 => 26, 18 => 25, 17 => 24,
            16 => 22, 15 => 21, 14 => 20, 13 => 18, 12 => 17,
            11 => 16, 10 => 14, 9 => 13, 8 => 12, 7 => 10,
            6 => 9, 5 => 8, 4 => 6, 3 => 4, 2 => 3, 1 => 1
        ],
        '25-34' => [
            41 => 100, 40 => 96, 39 => 93, 38 => 89, 37 => 85,
            36 => 82, 35 => 78, 34 => 74, 33 => 71, 32 => 67,
            31 => 63, 30 => 59, 29 => 56, 28 => 52, 27 => 48,
            26 => 45, 25 => 41, 24 => 40, 23 => 38, 22 => 37,
            21 => 36, 20 => 34, 19 => 33, 18 => 32, 17 => 30,
            16 => 29, 15 => 28, 14 => 26, 13 => 25, 12 => 24,
            11 => 22, 10 => 21, 9 => 20, 8 => 18, 7 => 17,
            6 => 16, 5 => 14, 4 => 13, 3 => 12, 2 => 10,
            1 => 9
        ],
        '35-44' => [
            36 => 100, 35 => 96, 34 => 93, 33 => 89, 32 => 85,
            31 => 82, 30 => 78, 29 => 74, 28 => 71, 27 => 67,
            26 => 63, 25 => 59, 24 => 56, 23 => 52, 22 => 48,
            21 => 45, 20 => 41, 19 => 40, 18 => 38, 17 => 37,
            16 => 36, 15 => 34, 14 => 33, 13 => 32, 12 => 30,
            11 => 29, 10 => 28, 9 => 26, 8 => 25, 7 => 24,
            6 => 22, 5 => 21, 4 => 20, 3 => 18, 2 => 17,
            1 => 16
        ],
        '45-54' => [
            31 => 100, 30 => 96, 29 => 93, 28 => 89, 27 => 85,
            26 => 82, 25 => 78, 24 => 74, 23 => 71, 22 => 67,
            21 => 63, 20 => 59, 19 => 56, 18 => 52, 17 => 48,
            16 => 45, 15 => 41, 14 => 40, 13 => 38, 12 => 37,
            11 => 36, 10 => 34, 9 => 33, 8 => 32, 7 => 30,
            6 => 29, 5 => 28, 4 => 26, 3 => 25, 2 => 24,
            1 => 22
        ],
        '55-59' => [
            26 => 100, 25 => 96, 24 => 93, 23 => 89, 22 => 85,
            21 => 82, 20 => 78, 19 => 74, 18 => 71, 17 => 67,
            16 => 63, 15 => 59, 14 => 56, 13 => 52, 12 => 48,
            11 => 45, 10 => 41, 9 => 40, 8 => 38, 7 => 37,
            6 => 36, 5 => 34, 4 => 33, 3 => 32, 2 => 30,
            1 => 29
        ]
    ];

    $nilaiAkhir = 0;
    $maksimalSitUp1 = 0;

    if ($umurPengguna < 25) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp1['under_25']));
        $nilaiAkhir = $jumlahSitUp1Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['under_25'][$jumlahSitUp1Wanita]) ? $nilaiSitUp1['under_25'][$jumlahSitUp1Wanita] : 0);
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp1['25-34']));
        $nilaiAkhir = $jumlahSitUp1Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['25-34'][$jumlahSitUp1Wanita]) ? $nilaiSitUp1['25-34'][$jumlahSitUp1Wanita] : 0);
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp1['35-44']));
        $nilaiAkhir = $jumlahSitUp1Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['35-44'][$jumlahSitUp1Wanita]) ? $nilaiSitUp1['35-44'][$jumlahSitUp1Wanita] : 0);
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp1['45-54']));
        $nilaiAkhir = $jumlahSitUp1Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['45-54'][$jumlahSitUp1Wanita]) ? $nilaiSitUp1['45-54'][$jumlahSitUp1Wanita] : 0);
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $maksimalSitUp1 = max(array_keys($nilaiSitUp1['55-59']));
        $nilaiAkhir = $jumlahSitUp1Wanita > $maksimalSitUp1 ? 100 : (isset($nilaiSitUp1['55-59'][$jumlahSitUp1Wanita]) ? $nilaiSitUp1['55-59'][$jumlahSitUp1Wanita] : 0);
    }

    $dataGarjasWanitaSitUp1 = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita' => $tanggalPelaksanaanSitUp1Wanita,
        'Jumlah_Sit_Up_1_Wanita' => $jumlahSitUp1Wanita,
        'Nilai_Sit_Up_1_Wanita' => $nilaiAkhir
    );
    $updateGarjasWanitaSitUp1 = $garjasWanitaSitUp1Model->perbaruiGarjasWanitaSitUp1($idGarjasWanitaSitUp1, $dataGarjasWanitaSitUp1);

    if ($updateGarjasWanitaSitUp1) {
        echo json_encode(array("success" => true, "message" => "Data Garjas Wanita Sit Up Kaki Lurus berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Wanita Sit Up Kaki Lurus."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

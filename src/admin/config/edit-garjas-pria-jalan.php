<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGarjasPriaTesJalan = $_POST['ID_Jalan_Pria'] ?? '';
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $waktuTestJalanPria = $_POST['Waktu_Jalan_Pria'] ?? '';

    $garjasPriaTesJalanModel = new TesJalanKaki5KMPria($koneksi);
    $umurPengguna = $garjasPriaTesJalanModel->ambilUmurTesJalanKaki5KMPriaOlehNIP($nipPengguna);

    $nilaiJalanKaki = [
        'di_bawah_25' => [
            17.0 => 100,
        ],
        '25-34' => [
            19.0 => 100,
        ],
        '35-44' => [
            21.0 => 100,
        ],
        '45-54' => [
            23.0 => 100
        ],
        '55-59' => [
            25.0 => 100
        ]
    ];

    $nilaiAkhir = 0;
    if ($umurPengguna < 25) {
        $nilaiAkhir = isset($nilaiJalanKaki['di_bawah_25'][$waktuTestJalanPria]) ? $nilaiJalanKaki['di_bawah_25'][$waktuTestJalanPria] : 0;
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $nilaiAkhir = isset($nilaiJalanKaki['25-34'][$waktuTestJalanPria]) ? $nilaiJalanKaki['25-34'][$waktuTestJalanPria] : 0;
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $nilaiAkhir = isset($nilaiJalanKaki['35-44'][$waktuTestJalanPria]) ? $nilaiJalanKaki['35-44'][$waktuTestJalanPria] : 0;
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $nilaiAkhir = isset($nilaiJalanKaki['45-54'][$waktuTestJalanPria]) ? $nilaiJalanKaki['45-54'][$waktuTestJalanPria] : 0;
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $nilaiAkhir = isset($nilaiJalanKaki['55-59'][$waktuTestJalanPria]) ? $nilaiJalanKaki['55-59'][$waktuTestJalanPria] : 0;
    }

    $dataGarjasWanitaShuttleRun = array(
        'NIP_Pengguna' => $nipPengguna,
        'Waktu_Jalan_Pria' => $waktuTestJalanPria,
        'Nilai_Jalan_Pria' => $nilaiAkhir
    );
    $updateGarjasPriaTesJalan = $garjasPriaTesJalanModel->perbaruiTesJalanPria($idGarjasPriaTesJalan, $dataGarjasWanitaShuttleRun);

    if ($updateGarjasPriaTesJalan) {
        echo json_encode(array("success" => true, "message" => "Data Garjas Pria Tes Jalan berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Pria Tes Jalan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

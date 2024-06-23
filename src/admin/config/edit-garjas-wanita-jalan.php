<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGarjasWanitaTesJalan = $_POST['ID_Jalan_Wanita'] ?? '';
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $waktuTestJalanWanita = $_POST['Waktu_Jalan_Wanita'] ?? '';

    $garjasWanitaTesJalanModel = new TesJalanKaki5KMWanita($koneksi);
    $umurPengguna = $garjasWanitaTesJalanModel->ambilUmurTesJalanKaki5KMWanitaOlehNIP($nipPengguna);

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
        $nilaiAkhir = isset($nilaiJalanKaki['di_bawah_25'][$waktuTestJalanWanita]) ? $nilaiJalanKaki['di_bawah_25'][$waktuTestJalanWanita] : 0;
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        $nilaiAkhir = isset($nilaiJalanKaki['25-34'][$waktuTestJalanWanita]) ? $nilaiJalanKaki['25-34'][$waktuTestJalanWanita] : 0;
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        $nilaiAkhir = isset($nilaiJalanKaki['35-44'][$waktuTestJalanWanita]) ? $nilaiJalanKaki['35-44'][$waktuTestJalanWanita] : 0;
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        $nilaiAkhir = isset($nilaiJalanKaki['45-54'][$waktuTestJalanWanita]) ? $nilaiJalanKaki['45-54'][$waktuTestJalanWanita] : 0;
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        $nilaiAkhir = isset($nilaiJalanKaki['55-59'][$waktuTestJalanWanita]) ? $nilaiJalanKaki['55-59'][$waktuTestJalanWanita] : 0;
    }

    $dataGarjasWanitaShuttleRun = array(
        'NIP_Pengguna' => $nipPengguna,
        'Waktu_Jalan_Wanita' => $waktuTestJalanWanita,
        'Nilai_Jalan_Wanita' => $nilaiAkhir
    );
    $updateGarjasWanitaTesJalan = $garjasWanitaTesJalanModel->perbaruiTesJalanWanita($idGarjasWanitaTesJalan, $dataGarjasWanitaShuttleRun);

    if ($updateGarjasWanitaTesJalan) {
        echo json_encode(array("success" => true, "message" => "Data Garjas Wanita Tes Jalan berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Wanita Tes Jalan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

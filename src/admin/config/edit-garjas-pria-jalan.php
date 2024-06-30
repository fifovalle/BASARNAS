<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGarjasPriaTesJalan = $_POST['ID_Jalan_Pria'] ?? '';
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $waktuTestJalanPria = $_POST['Waktu_Jalan_Pria'] ?? '';
    $tanggalPelaksanaanTestJalanPria = $_POST['Tanggal_Pelaksanaan_Tes_Jalan_Pria'] ?? '';

    $garjasPriaTesJalanModel = new TesJalanKaki5KMPria($koneksi);
    $umurPengguna = $garjasPriaTesJalanModel->ambilUmurTesJalanKaki5KMPriaOlehNIP($nipPengguna);

    $waktuTestJalanPria = str_replace(',', '.', $waktuTestJalanPria);
    $waktuTestJalanPria = (float) $waktuTestJalanPria;

    if ($waktuTestJalanPria == 0) {
        echo json_encode(array("success" => false, "message" => "Nilai Tes Jalan Pria tidak boleh 0."));
        exit;
    }

    $nilaiJalan = [
        'under_25' => [
            '17' => 100, '17.1' => 99, '17.2' => 99, '17.3' => 99, '17.4' => 98,
            '17.5' => 98, '17.6' => 98, '17.7' => 98, '17.8' => 98, '17.9' => 98,
            '18' => 98, '18.1' => 98, '18.2' => 97, '18.3' => 97, '18.4' => 97,
            '18.5' => 96, '18.6' => 96, '18.7' => 96, '18.8' => 96, '18.9' => 96,
            '19' => 96, '19.1' => 96, '19.2' => 95, '19.3' => 95, '19.4' => 95,
            '19.5' => 94, '19.6' => 94, '19.7' => 94, '19.8' => 94, '19.9' => 94,
            '20' => 94, '20.1' => 94, '20.2' => 93, '20.3' => 93, '20.4' => 93,
            '20.5' => 93,'21' => 92, '21.1' => 92, '21.2' => 92, '21.3' => 92, 
            '21.4' => 91, '21.5' => 91, '21.6' => 91, '21.7' => 91, '21.8' => 91, '21.9' => 91,
            '22' => 91, '22.1' => 90, '22.2' => 90, '22.3' => 90, '22.4' => 89,
            '22.5' => 89, '22.6' => 89, '22.7' => 89, '22.8' => 89, '22.9' => 89,
            '23' => 89, '23.1' => 89, '23.2' => 88, '23.3' => 88, '23.4' => 88,
            '23.5' => 87, '23.6' => 87, '23.7' => 87, '23.8' => 87, '23.9' => 87,
            '24' => 87, '24.1' => 87, '24.2' => 86, '24.3' => 86, '24.4' => 86,
            '24.5' => 85, '24.6' => 85, '24.7' => 85, '24.8' => 85, '24.9' => 85,
            '25' => 85, '25.1' => 85, '25.2' => 85, '25.3' => 84, '25.4' => 84,
            '25.5' => 84, '26' => 83, '26.1' => 83, '26.2' => 83, '26.3' => 82,
            '26.4' => 82, '26.5' => 82, '27' => 81, '27.1' => 81, '27.2' => 81,
            '27.3' => 80, '27.4' => 80, '27.5' => 80, '28' => 80, '28.1' => 79,
            '28.2' => 79, '28.3' => 79, '28.4' => 79, '28.5' => 78, '29' => 78,
            '29.1' => 77, '29.2' => 77, '29.3' => 77, '29.4' => 76, '29.5' => 76,
            '30' => 76, '30.1' => 76, '30.2' => 75, '30.3' => 75, '30.4' => 75,
            '30.5' => 74, '30.6' => 74, '30.7' => 74, '30.8' => 74, '30.9' => 74,
            '31' => 74, '31.1' => 74, '31.2' => 73, '31.3' => 73, '31.4' => 73,
            '31.5' => 72, '31.6' => 72, '31.7' => 72, '31.8' => 72, '31.9' => 72,
            '32' => 72, '32.1' => 72, '32.2' => 72, '32.3' => 71, '32.4' => 71,
            '32.5' => 71, '33' => 70, '33.1' => 70, '33.2' => 70, '33.3' => 69,
            '33.4' => 69, '33.5' => 69, '34' => 68, '34.1' => 68, '34.2' => 68,
            '34.3' => 67, '34.4' => 67, '34.5' => 67, '35' => 67, '35.1' => 66,

        ],
        '25-34' => [
            
        ],
        '35-44' => [
         
        ],
        '45-54' => [
            
        ],
        '55-59' => [
           
        ]
    ];


    $nilaiAkhir = 0;

    if ($umurPengguna < 25) {
        if ($waktuTestJalanPria < 17) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestJalanPria > 51.1) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['under_25'][(string)$waktuTestJalanPria]) ? $nilaiJalan['under_25'][(string)$waktuTestJalanPria] : 0;
        }
    } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
        if ($waktuTestJalanPria < 10.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestJalanPria > 24.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['25-34'][(string)$waktuTestJalanPria]) ? $nilaiJalan['25-34'][(string)$waktuTestJalanPria] : 0;
        }
    } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
        if ($waktuTestJalanPria < 11.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestJalanPria > 25.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['35-44'][(string)$waktuTestJalanPria]) ? $nilaiJalan['35-44'][(string)$waktuTestJalanPria] : 0;
        }
    } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
        if ($waktuTestJalanPria < 12.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestJalanPria > 27.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['45-54'][(string)$waktuTestJalanPria]) ? $nilaiJalan['45-54'][(string)$waktuTestJalanPria] : 0;
        }
    } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
        if ($waktuTestJalanPria < 13.0) {
            $nilaiAkhir = 100;
        } elseif ($waktuTestJalanPria > 26.5) {
            $nilaiAkhir = 1;
        } else {
            $nilaiAkhir = isset($nilaiJalan['55-59'][(string)$waktuTestJalanPria]) ? $nilaiJalan['55-59'][(string)$waktuTestJalanPria] : 0;
        }
    }

    if (!$nilaiAkhir) {
        echo json_encode(array("success" => false, "message" => "Input waktu tidak valid untuk usia pengguna ini."));
        exit;
    }

    $dataGarjasWanitaShuttleRun = array(
        'NIP_Pengguna' => $nipPengguna,
        'Tanggal_Pelaksanaan_Tes_Jalan_Pria' => $tanggalPelaksanaanTestJalanPria,
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

<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idGarjasPriaChinUp = $_POST['ID_Pria_Chin_Up'] ?? '';
    $jumlahChinUpPria = $_POST['Jumlah_Chin_Up_Pria'] ?? '';
    $nilaiChinUp = $_POST['Nilai_Chin_Up_Pria'] ?? '';

    $garjasChinUpPriaModel = new GarjasChinUpPria($koneksi);

    $umurPengguna = $garjasChinUpPriaModel->ambilUmurGarjasChinUpPriaOlehNIP($nipPengguna);

    $nilaiChinUp = [
        'under_25' => [
             20 => 100, 19 => 96, 18 => 92, 17 => 87, 16 => 83,
             15 => 79, 14 => 75, 13 => 70, 12 => 66, 11 => 62,
             10 => 58, 9 => 54, 8 => 49, 7 => 45, 6 => 41,
             5 => 37, 4 => 33, 3 => 28, 2 => 24, 1 => 20
         ],
 
         '25-34' => [
             18 => 100, 17 => 96, 16 => 92, 15 => 88, 14 => 84,
             13 => 81, 12 => 77, 11 => 73, 10 => 69, 9 => 65,
             8 => 58, 7 => 52, 6 => 47, 5 => 41, 4 => 37,
             3 => 33, 2 => 28, 1 => 24
         ],
 
         '35-44' => [
             16 => 100, 15 => 96, 14 => 92, 13 => 88, 12 => 84,
             11 => 81, 10 => 77, 9 => 73, 8 => 69, 7 => 65,
             6 => 58, 5 => 49, 4 => 41, 3 => 37, 2 => 33,
             1 => 28
         ],
 
         '45-54' => [
             14 => 100, 13 => 96, 12 => 91, 11 => 87, 10 => 83,
             9 => 78, 8 => 74, 7 => 70, 6 => 65, 5 => 58,
             4 => 50, 3 => 41, 2 => 37, 1 => 33
         ],
 
        '55-59' => [
             11 => 100, 10 => 96, 9 => 91, 8 => 82, 7 => 77,
             6 => 72, 5 => 65, 4 => 58, 3 => 51, 2 => 41,
             1 => 37
         ]
 
     ];
     
     $nilaiAkhir = 0;
     if ($umurPengguna < 25) {
         $nilaiAkhir = isset($nilaiChinUp['under_25'][$jumlahChinUpPria]) ? $nilaiChinUp['under_25'][$jumlahChinUpPria] : 0;
     } elseif ($umurPengguna >= 25 && $umurPengguna <= 34) {
         $nilaiAkhir = isset($nilaiChinUp['25-34'][$jumlahChinUpPria]) ? $nilaiChinUp['25-34'][$jumlahChinUpPria] : 0;
     } elseif ($umurPengguna >= 35 && $umurPengguna <= 44) {
         $nilaiAkhir = isset($nilaiChinUp['35-44'][$jumlahChinUpPria]) ? $nilaiChinUp['35-44'][$jumlahChinUpPria] : 0;
     } elseif ($umurPengguna >= 45 && $umurPengguna <= 54) {
         $nilaiAkhir = isset($nilaiChinUp['45-54'][$jumlahChinUpPria]) ? $nilaiChinUp['45-54'][$jumlahChinUpPria] : 0;
     } elseif ($umurPengguna >= 55 && $umurPengguna <= 59) {
         $nilaiAkhir = isset($nilaiChinUp['55-59'][$jumlahChinUpPria]) ? $nilaiChinUp['55-59'][$jumlahChinUpPria] : 0;
     }

    $dataLamaGarjasPriaChinUp = $garjasChinUpPriaModel->ambilDataGarjasChinUpPriaId($idGarjasPriaChinUp);
    
    if ($dataLamaGarjasPriaChinUp) {
        $dataGarjasPriaChinUp = array(
            'Jumlah_Chin_Up_Pria' => $jumlahChinUpPria,
            'Nilai_Chin_Up_Pria' => $nilaiAkhir
        );

        $updateDataGarjasPriaChinUp = $garjasChinUpPriaModel->perbaruiGarjasPriaChinUp($idGarjasPriaChinUp, $dataGarjasPriaChinUp);

        if ($updateDataGarjasPriaChinUp) {
            echo json_encode(["success" => true, "message" => "Data Garjas Pria Chin Up berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data Garjas Pria Chin Up."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data Garjas Pria Chin Up tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

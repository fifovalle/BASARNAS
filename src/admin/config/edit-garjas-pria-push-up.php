<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGarjasPriaPushUp = $_POST['ID_Push_Up_Pria'] ?? '';
    $jumlahPushUpPria = $_POST['Jumlah_Push_Up_Pria'] ?? '';
    $nilaiPushUpPria = $_POST['Nilai_Push_Up_Pria'] ?? '';

    $pesanKesalahan = '';

    $garjasPushUpPriaModel = new GarjasPushUpPria($koneksi);
    $dataLamaGarjasPria = $garjasPushUpPriaModel->tampilkangGarjasPriaPushUp($idGarjasPriaPushUp);

    if ($dataLamaGarjasPria) {
        $dataGarjasPria = array(
            'NIP_Pengguna' => $_SESSION['NIP_Pengguna'],
            'ID_Push_Up_Pria' => $idGarjasPriaPushUp,
            'Jumlah_Push_Up_Pria' => $jumlahPushUpPria,
            'Nilai_Push_Up_Pria' => $nilaiPushUpPria
        );

        $updateDataGarjasPria = $garjasPushUpPriaModel->perbaruiGarjasPriaPushUp($idGarjasPriaPushUp, $dataGarjasPria);

        if ($updateDataGarjasPria) {
            echo json_encode(array("success" => true, "message" => "Data Garjas Pria Push Up berhasil diperbarui."));
        } else {
            echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Pria Push Up."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Data Garjas Pria Push Up tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

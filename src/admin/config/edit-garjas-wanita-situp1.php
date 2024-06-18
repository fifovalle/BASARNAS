<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $jumlahSitUp1Wanita = $_POST['Jumlah_Sit_Up_1_Wanita'] ?? '';
    $nilaiSitUp1Wanita = $_POST['Nilai_Sit_Up_1_Wanita'] ?? '';
    
    $garjasWanitaSitUp1Model = new GarjasWanitaSitUp1($koneksi);
 
    $dataGarjasWanitaPushUp = array(
        'NIP_Pengguna' => $nipPengguna,
        'Jumlah_Sit_Up_1_Wanita' => $jumlahSitUp1Wanita,
        'Nilai_Sit_Up_1_Wanita' => $nilaiSitUp1Wanita
    );
    $updateGarjasWanitaSitUp1 = $garjasWanitaSitUp1Model->perbaruiGarjasWanitaSitUp1($idGarjasWanitaSitUp1, $dataGarjasWanitaPushUp);
    if ($updateGarjasWanitaSitUp1) {
        echo json_encode(array("success" => true, "message" => "Data Garjas Wanita Sit Up Kaki Lurus berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Wanita Sit Up Kaki Lurus."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}
?>

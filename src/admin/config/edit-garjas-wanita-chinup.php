<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGarjasWanitaChinUp = $_POST['ID_Wanita_Push_Up'] ?? '';
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $jumlahChinUpWanita = $_POST['Jumlah_Push_Up_Wanita'] ?? '';
    
    $garjasWanitaChinUpModel = new GarjasWanitaChinUp($koneksi);
 
    $dataGarjasWanitaPushUp = array(
        'NIP_Pengguna' => $nipPengguna,
        'Jumlah_Push_Up_Wanita' => $jumlahChinUpWanita,
        'Nilai_Push_Up_Wanita' => $_POST['Nilai_Push_Up_Wanita'] ?? ''
    );
    $updateGarjasWanitaChinUp = $garjasWanitaChinUpModel->perbaruiGarjasWanitaChinUp($idGarjasWanitaChinUp, $dataGarjasWanitaPushUp);
    if ($updateGarjasWanitaChinUp) {
        echo json_encode(array("success" => true, "message" => "Data Garjas Wanita Chin Up berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Wanita Chin Up."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}
?>

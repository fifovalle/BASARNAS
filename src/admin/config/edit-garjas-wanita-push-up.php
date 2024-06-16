<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGarjasWanitaPushUp = $_POST['ID_Wanita_Push_Up'] ?? '';
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $jumlahPushUpWanita = $_POST['Jumlah_Push_Up_Wanita'] ?? '';
    
    $garjasWanitaPushUpModel = new GarjasWanitaPushUp($koneksi);
 
    $dataGarjasWanitaPushUp = array(
        'NIP_Pengguna' => $nipPengguna,
        'Jumlah_Push_Up_Wanita' => $jumlahPushUpWanita,
        'Nilai_Push_Up_Wanita' => $_POST['Nilai_Push_Up_Wanita'] ?? ''
    );
    $updateGarjasWanitaPushUp = $garjasWanitaPushUpModel->perbaruiGarjasWanitaPushUp($idGarjasWanitaPushUp, $dataGarjasWanitaPushUp);
    if ($updateGarjasWanitaPushUp) {
        echo json_encode(array("success" => true, "message" => "Data Garjas Wanita Push Up berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Wanita Push Up."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}
?>

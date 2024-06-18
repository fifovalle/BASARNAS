<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $jumlahSitUp2Wanita = $_POST['Jumlah_Sit_Up_2_Wanita'] ?? '';
    $nilaiSitUp2Wanita = $_POST['Nilai_Sit_Up_2_Wanita'] ?? '';
    
    $garjasWanitaSitUp2Model = new GarjasWanitaSitUp2($koneksi);
 
    $dataGarjasWanitaPushUp = array(
        'NIP_Pengguna' => $nipPengguna,
        'Jumlah_Sit_Up_2_Wanita' => $jumlahSitUp2Wanita,
        'Nilai_Sit_Up_2_Wanita' => $nilaiSitUp2Wanita
    );
    $updateGarjasWanitaSitUp2 = $garjasWanitaSitUp2Model->perbaruiGarjasWanitaSitUp2($idGarjasWanitaSitUp2, $dataGarjasWanitaPushUp);
    if ($updateGarjasWanitaSitUp2) {
        echo json_encode(array("success" => true, "message" => "Data Garjas Wanita Sit Up Kaki Di Tekuk berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data Garjas Wanita Sit Up Kaki Di Tekuk."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}
?>

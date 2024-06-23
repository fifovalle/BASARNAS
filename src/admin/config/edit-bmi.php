<?php
include 'databases.php';

function keteranganBMI($bmi, $umur)
{
    if ($umur < 18) {
        if ($bmi < 5) {
            return "Berat Badan Kurang";
        } elseif ($bmi < 85) {
            return "Berat Badan Normal";
        } elseif ($bmi < 95) {
            return "Berat Badan Lebih";
        } else {
            return "Obesitas";
        }
    } else {
        if ($bmi < 18.5) {
            return "Berat Badan Kurang";
        } elseif ($bmi < 24.9) {
            return "Berat Badan Normal";
        } elseif ($bmi < 29.9) {
            return "Berat Badan Lebih";
        } else {
            return "Obesitas";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $objekBMI = new Bmi($koneksi);
    $idBMI = $_POST['ID_BMI'] ?? '';
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $tinggiPengguna = $_POST['Tinggi_BMI'] ?? '';
    $beratPengguna = $_POST['Berat_BMI'] ?? '';
    $umurPengguna = $objekBMI->cekUmurPengguna($nipPengguna);

    if (empty($nipPengguna) || empty($tinggiPengguna) || empty($beratPengguna)) {
        echo json_encode(["success" => false, "message" => "Semua data harus diisi."]);
    }

    if (empty($pesanKesalahan)) {
        $dataBMI = array(
            'Tinggi_BMI' => $tinggiPengguna,
            'Berat_BMI' => $beratPengguna,
            'Skor' => $objekBMI->hitungBMI($tinggiPengguna, $beratPengguna, $umurPengguna),
            'Keterangan' => keteranganBMI($objekBMI->hitungBMI($tinggiPengguna, $beratPengguna, $umurPengguna), $umurPengguna)
        );

        $updateBMI = $objekBMI->perbaharuiBMI($idBMI, $dataBMI);

        if ($updateBMI) {
            echo json_encode(["success" => true, "message" => "Data BMI berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data BMI."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data BMI tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

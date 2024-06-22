<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipPengguna = $_POST['NIP_Pengguna'] ?? '';
    $idRenangWanita = $_POST['ID_Renang_Wanita'] ?? '';
    $waktuRenangWanita = $_POST['Waktu_Renang_Wanita'] ?? '';
    $namaRenangWanita = $_POST['Nama_Gaya_Renang_Wanita'] ?? '';
    $nilaiRenangWanita = $_POST['Nilai_Renang_Wanita'] ?? '';

    $garjasRenangWanitaModel = new TesRenangWanita($koneksi);

    $umurPengguna = $garjasRenangWanitaModel->ambilUmurGarjasRenangWanitaOlehNIP($nipPengguna);

    $nilaiRenangWanita = [
        'Dada' => [
            '18-25' => [43, 143],
            '26-30' => [46, 146],
            '31-35' => [49, 149],
            '36-40' => [52, 152],
            '41-43' => [55, 155],
            '44-46' => [58, 158],
            '47-49' => [61, 161],
            '50-52' => [64, 164],
            '53-55' => [67, 167],
            '56-58' => [70, 170]
        ],
        'Bebas' => [
            '18-25' => [43, 223],
            '26-30' => [46, 226],
            '31-35' => [49, 229],
            '36-40' => [52, 232],
            '41-43' => [55, 235],
            '44-46' => [58, 238],
            '47-49' => [101, 241],
            '50-52' => [105, 244],
            '53-55' => [108, 247],
            '56-58' => [111, 250]
        ],
        'Lainnya' => [
            '18-25' => [43, 223],
            '26-30' => [46, 226],
            '31-35' => [49, 229],
            '36-40' => [52, 232],
            '41-43' => [55, 235],
            '44-46' => [58, 238],
            '47-49' => [101, 241],
            '50-52' => [105, 244],
            '53-55' => [108, 247],
            '56-58' => [111, 250]
        ]
    ];

    $umurKategori = '';
    if ($umurPengguna >= 18 && $umurPengguna <= 25) {
        $umurKategori = '18-25';
    } elseif ($umurPengguna >= 26 && $umurPengguna <= 30) {
        $umurKategori = '26-30';
    } elseif ($umurPengguna >= 31 && $umurPengguna <= 35) {
        $umurKategori = '31-35';
    } elseif ($umurPengguna >= 36 && $umurPengguna <= 40) {
        $umurKategori = '36-40';
    } elseif ($umurPengguna >= 41 && $umurPengguna <= 43) {
        $umurKategori = '41-43';
    } elseif ($umurPengguna >= 44 && $umurPengguna <= 46) {
        $umurKategori = '44-46';
    } elseif ($umurPengguna >= 47 && $umurPengguna <= 49) {
        $umurKategori = '47-49';
    } elseif ($umurPengguna >= 50 && $umurPengguna <= 52) {
        $umurKategori = '50-52';
    } elseif ($umurPengguna >= 53 && $umurPengguna <= 55) {
        $umurKategori = '53-55';
    } elseif ($umurPengguna >= 56 && $umurPengguna <= 58) {
        $umurKategori = '56-58';
    }

    if ($umurKategori && isset($nilaiRenangWanita[$namaRenangWanita][$umurKategori])) {
        $waktuMax100 = $nilaiRenangWanita[$namaRenangWanita][$umurKategori][0];
        $waktuMin1 = $nilaiRenangWanita[$namaRenangWanita][$umurKategori][1];

        if ($waktuRenangWanita <= $waktuMax100) {
            $nilaiAkhir = 100;
        } elseif ($waktuRenangWanita > $waktuMin1) {
            $nilaiAkhir = 0;
        } else {
            $nilaiAkhir = 100 - (($waktuRenangWanita - $waktuMax100) / ($waktuMin1 - $waktuMax100)) * 100;
        }
    } else {
        $nilaiAkhir = 0;
    }

    $waktuRenangWanitaFormatted = gmdate('i:s', $waktuRenangWanita);

    $dataLamaGarjasRenangWanita = $garjasRenangWanitaModel->getTesRenangWanitaById($idRenangWanita);

    if ($dataLamaGarjasRenangWanita) {
        $dataGarjasRenangWanita = [
            'Waktu_Renang_Wanita' => $waktuRenangWanitaFormatted,
            'Nama_Gaya_Renang_Wanita' => $namaRenangWanita,
            'Nilai_Renang_Wanita' => $nilaiAkhir
        ];

        $updateDataGarjasRenangWanita = $garjasRenangWanitaModel->perbaruiTesRenangWanita($idRenangWanita, $dataGarjasRenangWanita);

        if ($updateDataGarjasRenangWanita) {
            echo json_encode(["success" => true, "message" => "Data Garjas Wanita Renang berhasil diperbarui."]);
        } else {
            echo json_encode(["success" => false, "message" => "Gagal memperbarui data Garjas Wanita Renang."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Data Garjas Wanita Renang tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak valid."]);
}

<?php
include 'databases.php';
function containsXSS($input)
{
    $xssPatterns = [
        "/<script\b[^>]*>(.*?)<\/script>/is",
        "/<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:/i",
        "/<iframe\b[^>]*>(.*?)<\/iframe>/is",
        "/<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:/i",
        "/<object\b[^>]*>(.*?)<\/object>/is",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/<script\b[^>]*>[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i",
        "/<a\b[^>]*href\s*=\s*(?:\"|')(?:javascript:|.*?\"javascript:).*?(?:\"|')/i",
        "/<embed\b[^>]*>(.*?)<\/embed>/is",
        "/<applet\b[^>]*>(.*?)<\/applet>/is",
        "/<!--.*?-->/",
        "/(<script\b[^>]*>(.*?)<\/script>|<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:|<iframe\b[^>]*>(.*?)<\/iframe>|<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:|<object\b[^>]*>(.*?)<\/object>|on[a-zA-Z]+\s*=\s*\"[^\"]*\"|<[^>]*(>|$)(?:<|>)+|<[^>]*script\s*.*?(?:>|$)|<![^>]*-->|eval\s*\((.*?)\)|setTimeout\s*\((.*?)\)|<[^>]*\bstyle\s*=\s*[\"'][^\"']*[;{][^\"']*['\"]|<meta[^>]*http-equiv=[\"']?refresh[\"']?[^>]*url=|<[^>]*src\s*=\s*\"[^>]*\"[^>]*>|expression\s*\((.*?)\))/i"
    ];

    foreach ($xssPatterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }

    return false;
}

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
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $objekBMI = new Bmi($koneksi);
    $idBMI = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'ID_BMI', FILTER_SANITIZE_STRING));
    $nipPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'NIP_Pengguna', FILTER_SANITIZE_STRING));
    $tinggiPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Tinggi_BMI', FILTER_SANITIZE_STRING));
    $beratPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Berat_BMI', FILTER_SANITIZE_STRING));

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

<?php
include 'databases.php';

function mengandungXSS($input)
{
    $polaXSS = [
        "/<script\b[^>]*>(.*?)<\/script>/is",
        "/<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:/i",
        "/<iframe\b[^>]*>(.*?)<\/iframe>/is",
        "/<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:/i",
        "/<object\b[^>]*>(.*?)<\/object>/is",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/<script\b[^>]*>[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i",
        "/<a\b[^>]*href\s*=\s*(?:\"|')(?:javascript:|.*?\"javascript:).*?(?:\"|')/i",
        "/<embed\b[^>]*>(.*?)<\/embed>/is",
        "/<applet\b[^>]*>(.*?)<\/applet>/is",
        "/<!--.*?-->/",
        "/(<script\b[^>]*>(.*?)<\/script>|<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:|<iframe\b[^>]*>(.*?)<\/iframe>|<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:|<object\b[^>]*>(.*?)<\/object>|on[a-zA-Z]+\s*=\s*\"[^\"]*\"|<embed\b[^>]*>(.*?)<\/embed>|<applet\b[^>]*>(.*?)<\/applet>|<!--.*?-->/i"
    ];

    foreach ($polaXSS as $pola) {
        if (preg_match($pola, $input)) {
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

if (isset($_POST['tambah_BMI'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $konfigurasi = HTMLPurifier_Config::createDefault();
    $pemurni = new HTMLPurifier($konfigurasi);
    $objekBMI = new Bmi($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $tinggiPengguna = mysqli_real_escape_string($koneksi, $pemurni->purify($_POST['Tinggi_BMI']));
    $beratPengguna = mysqli_real_escape_string($koneksi, $pemurni->purify($_POST['Berat_BMI']));
    $umurPengguna = $objekBMI->cekUmurPengguna($nipPengguna);

    if (empty($nipPengguna) || empty($tinggiPengguna) || empty($beratPengguna)) {
        $pesanKesalahan .= "Semua field harus diisi. ";
    }

    if (mengandungXSS($nipPengguna) || mengandungXSS($tinggiPengguna) || mengandungXSS($beratPengguna)) {
        $pesanKesalahan .= "Anda menginputkan karakter yang tidak diizinkan. ";
    }

    if (empty($pesanKesalahan)) {
        $dataBMI = array(
            'NIP_Pengguna' => $nipPengguna,
            'Tinggi_BMI' => $tinggiPengguna,
            'Berat_BMI' => $beratPengguna,
            'Skor' => $objekBMI->hitungBMI($tinggiPengguna, $beratPengguna, $umurPengguna),
            'Keterangan' => keteranganBMI($objekBMI->hitungBMI($tinggiPengguna, $beratPengguna, $umurPengguna), $umurPengguna)
        );

        $simpanDataBMI = $objekBMI->tambahBMI($dataBMI);

        if ($simpanDataBMI) {
            setPesanKeberhasilan("Berhasil, data bmi telah ditambahkan.");
        } else {
            setPesanKesalahan("Gagal menyimpan data bmi.");
        }
        header("Location: $akarUrl" . "src/admin/pages/data-bmi.php");
        exit;
    } else {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data-bmi.php");
        exit;
    }
}

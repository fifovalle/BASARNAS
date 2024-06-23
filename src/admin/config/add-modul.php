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

if (isset($_POST['tambah_modul'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $konfigurasi = HTMLPurifier_Config::createDefault();
    $pemurni = new HTMLPurifier($konfigurasi);
    $objekModul = new Modul($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $namaModul = mysqli_real_escape_string($koneksi, $_POST['Nama_Modul']);
    $judulModul = mysqli_real_escape_string($koneksi, $_POST['Judul_Modul']);
    $deskripsiModul = mysqli_real_escape_string($koneksi, $_POST['Deskripsi_Modul']);
    $fileModul = $_FILES['File_Modul'];
    $tmpModul = $fileModul['tmp_name'];
    $namaFileModul = $fileModul['name'];
    $ukuranModul = $fileModul['size'];
    $errorModul = $fileModul['error'];
    $formatModul = ['pdf', 'doc', 'docx'];
    $pesanKesalahan = '';

    if (empty($nipPengguna) || empty($namaModul) || empty($judulModul) || empty($deskripsiModul)) {
        $pesanKesalahan .= "Semua field harus diisi. ";
    }

    if (mengandungXSS($nipPengguna) || mengandungXSS($namaModul) || mengandungXSS($judulModul) || mengandungXSS($deskripsiModul)) {
        $pesanKesalahan .= "Anda menginputkan karakter yang tidak diizinkan. ";
    }

    if ($errorModul === UPLOAD_ERR_OK) {
        if ($ukuranModul <= 5 * 1024 * 1024) {
            $ext = pathinfo($namaFileModul, PATHINFO_EXTENSION);
            if (in_array($ext, $formatModul)) {
                $namaFileModulBaru = uniqid() . '.' . $ext;
                $tujuanModul = '../uploads/' . $namaFileModulBaru;
                if (!move_uploaded_file($tmpModul, $tujuanModul)) {
                    $pesanKesalahan .= "Gagal mengupload file modul. ";
                }
            } else {
                $pesanKesalahan .= "Format file harus PDF, DOC, atau DOCX. ";
            }
        } else {
            $pesanKesalahan .= "Ukuran file terlalu besar. Maksimal 5MB. ";
        }
    } else {
        $pesanKesalahan .= "Terjadi kesalahan dalam mengupload file. ";
    }

    if (empty($pesanKesalahan)) {
        $dataModul = array(
            'NIP_Pengguna' => $nipPengguna,
            'File_Modul' => $namaFileModulBaru,
            'Nama_Modul' => $namaModul,
            'Judul_Modul' => $judulModul,
            'Deskripsi_Modul' => $deskripsiModul
        );

        $simpanDataModul = $objekModul->tambahModul($dataModul);

        if ($simpanDataModul) {
            setPesanKeberhasilan("Berhasil, data modul telah ditambahkan.");
        } else {
            setPesanKesalahan("Gagal menyimpan data modul.");
        }
        header("Location: $akarUrl" . "src/admin/pages/data-modul.php");
        exit;
    } else {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data-modul.php");
        exit;
    }
}

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
        "/(<script\b[^>]*>(.*?)<\/script>|<img\b[^>]*src[\s]*=[\s]*[\"]*javascript:|<iframe\b[^>]*>(.*?)<\/iframe>|<link\b[^>]*href[\s]*=[\s]*[\"]*javascript:/i"
    ];

    foreach ($polaXSS as $pola) {
        if (preg_match($pola, $input)) {
            return true;
        }
    }

    return false;
}

if (isset($_POST['tambah_sertifikat'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $konfigurasi = HTMLPurifier_Config::createDefault();
    $pemurni = new HTMLPurifier($konfigurasi);
    $objekKompetensi = new Kompetensi($koneksi);

    $nipPengguna = mysqli_real_escape_string($koneksi, $_POST['NIP_Pengguna']);
    $namaSertifikat = $pemurni->purify($_POST['Nama_Sertifikat']);
    $tanggalPenerbitan = mysqli_real_escape_string($koneksi, $_POST['Tanggal_Penerbitan_Sertifikat']);
    $tanggalBerakhir = mysqli_real_escape_string($koneksi, $_POST['Tanggal_Berakhir_Sertifikat']);
    $kategoriKompetensi = mysqli_real_escape_string($koneksi, $_POST['Kategori_Kompetensi']);
    $status = mysqli_real_escape_string($koneksi, $_POST['Status']);

    $pesanKesalahan = '';

    if ($nipPengguna == '') {
        $pesanKesalahan = "NIP Pengguna harus diisi.";
    }

    if (empty($namaSertifikat) || empty($tanggalPenerbitan) || empty($tanggalBerakhir) || empty($kategoriKompetensi) || empty($status)) {
        $pesanKesalahan = "Semua field harus diisi.";
    }

    if (mengandungXSS($namaSertifikat)) {
        $pesanKesalahan = "Anda menginputkan karakter yang tidak diizinkan.";
    }

    if (isset($_FILES['File_Sertifikat']) && $_FILES['File_Sertifikat']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['File_Sertifikat']['tmp_name'];
        $namaFile = $_FILES['File_Sertifikat']['name'];
        $ukuranFile = $_FILES['File_Sertifikat']['size'];
        $tipeFile = $_FILES['File_Sertifikat']['type'];
        $fileNameCmps = explode(".", $namaFile);
        $ekstensiFile = strtolower(end($fileNameCmps));

        $ekstensiFileDiizinkan = array('pdf', 'doc', 'docx', 'jpg', 'png');
        if (in_array($ekstensiFile, $ekstensiFileDiizinkan)) {
            $direktoriUnggahFile = '../uploads/';
            $namaFileUnik = uniqid() . '.' . $ekstensiFile;
            $dest_path = $direktoriUnggahFile . $namaFileUnik;

            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                $pesanKesalahan = 'Terjadi kesalahan saat memindahkan file ke direktori unggah.';
            }
        } else {
            $pesanKesalahan = 'Gagal mengunggah. Jenis file yang diizinkan: ' . implode(',', $ekstensiFileDiizinkan);
        }
    } else {
        $pesanKesalahan = 'Pengunggahan file gagal dengan kode kesalahan: ' . $_FILES['File_Sertifikat']['error'];
    }

    if (empty($pesanKesalahan)) {

        $tanggalMulai = new DateTime($tanggalPenerbitan);
        $tanggalAkhir = new DateTime($tanggalBerakhir);
        $interval = $tanggalMulai->diff($tanggalAkhir);
        $masaBerlakuBulan = ($interval->y * 12) + $interval->m;

        $dataKompetensi = array(
            'NIP_Pengguna' => $nipPengguna,
            'Nama_Sertifikat' => $namaSertifikat,
            'Tanggal_Penerbitan_Sertifikat' => $tanggalPenerbitan,
            'Masa Berlaku' => $masaBerlakuBulan,
            'Tanggal_Berakhir_Sertifikat' => $tanggalBerakhir,
            'Kategori_Kompetensi' => $kategoriKompetensi,
            'Status' => $status,
            'File_Sertifikat' => $namaFileUnik
        );

        $simpanDataKompetensi = $objekKompetensi->tambahKompetensi($dataKompetensi);

        if ($simpanDataKompetensi) {
            setPesanKeberhasilan("Berhasil, data kompetensi mahir telah ditambahkan.");
        } else {
            setPesanKesalahan("Gagal menyimpan data kompetensi.");
        }
        header("Location: $akarUrl" . "src/admin/pages/data-advanced-competence.php");
        exit;
    } else {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data-advanced-competence.php");
        exit;
    }
}

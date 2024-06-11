<?php
include 'databases.php';

function containsXSS($input)
{
    $xss_patterns = [
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

    foreach ($xss_patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }

    return false;
}

if (isset($_POST['Simpan'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $tanggalLahirPengguna = $_POST['Tanggal_Lahir_Pengguna'];
    $tanggal_lahir_format = DateTime::createFromFormat('Y-m-d', $tanggalLahirPengguna);
    if ($tanggal_lahir_format === false) {
        $pesanKesalahan .= "Format tanggal lahir tidak valid.";
    } else {
        $tanggal_lahir_database = $tanggal_lahir_format->format('Y-m-d');
    }
    $nipPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'NIP_Pengguna', FILTER_SANITIZE_STRING));
    $namaLengkapPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama_Lengkap_Pengguna', FILTER_SANITIZE_STRING));
    $tanggalLahirPengguna = $tanggal_lahir_database;
    $alamatPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Alamat_Pengguna', FILTER_SANITIZE_EMAIL));
    $noTeleponPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'No_Telepon_Pengguna', FILTER_SANITIZE_STRING));
    $jabatanPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jabatan_Pengguna', FILTER_SANITIZE_STRING));
    $jenisKelaminPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jenis_Kelamin_Pengguna', FILTER_SANITIZE_STRING));
    $kataSandiPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Kata_Sandi_Pengguna', FILTER_SANITIZE_STRING));
    $konfirmasiKataSandiPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Konfirmasi_Kata_Sandi_Pengguna', FILTER_SANITIZE_STRING));
    $obyekPengguna = new Pengguna($koneksi);

    $pesanKesalahan = '';

    $noTeleponPenggunaFormatted = '+62 ' . substr($noTeleponPengguna, 0, 3) . '-' . substr($noTeleponPengguna, 4, 4) . '-' . substr($noTeleponPengguna, 7);

    if (empty($nipPengguna) || empty($namaLengkapPengguna) || empty($alamatPengguna) || empty($kataSandiPengguna) || empty($konfirmasiKataSandiPengguna) || empty($noTeleponPengguna) || empty($jabatanPengguna) || empty($jenisKelaminPengguna) || empty($alamatPengguna)) {
        $pesanKesalahan = "Semua bidang harus diisi.";
    }

    $panjangKataSandi = strlen($kataSandiPengguna) >= 8;
    $persyaratanKataSandi = preg_match('/[A-Z]/', $kataSandiPengguna) && preg_match('/[a-z]/', $kataSandiPengguna) && preg_match('/[0-9]/', $kataSandiPengguna) && preg_match('/[^A-Za-z0-9]/', $kataSandiPengguna);
    $kataSandiPenggunaYangValid = $panjangKataSandi && $persyaratanKataSandi;
    $pesanKesalahan .= (!$kataSandiPenggunaYangValid && empty($pesanKesalahan)) ? "Kata sandi harus memiliki setidaknya 8 karakter dan mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu simbol." : '';
    $kecocokanKataSandi = $kataSandiPengguna === $konfirmasiKataSandiPengguna;
    $pesanKesalahan .= (!$kecocokanKataSandi && empty($pesanKesalahan)) ? "Kata sandi dan konfirmasi kata sandi harus sama." : '';
    $hashKataSandi = password_hash($kataSandiPengguna, PASSWORD_DEFAULT);

    if (!is_numeric($noTeleponPengguna)) {
        $pesanKesalahan .= "Nomor telepon hanya boleh berisi angka. ";
    }

    $fotoPengguna = $_FILES['Foto_Pengguna'];
    $namaFotoPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($fotoPengguna['name']));
    $fotoPenggunaTemp = $fotoPengguna['tmp_name'];
    $ukuranFotoPengguna = $fotoPengguna['size'];
    $errorFotoPengguna = $fotoPengguna['error'];
    $tujuanFotoPengguna = '';
    $ukuranMaksimal = 2 * 1024 * 1024; // 2MB
    if ($ukuranFotoPengguna > $ukuranMaksimal) {
        $pesanKesalahan .= "Ukuran file foto pengguna melebihi batas maksimal (2MB). ";
    }
    $namaFotoPenggunaBaru = time() . '_' . $namaFotoPengguna;
    $tujuanFotoPengguna = '../uploads/' . $namaFotoPenggunaBaru;
    $apakahBerhasilDipindahkan = move_uploaded_file($fotoPenggunaTemp, $tujuanFotoPengguna);
    $pesanKesalahan .= (!$apakahBerhasilDipindahkan && empty($pesanKesalahan)) ? "Gagal mengupload foto pengguna." : '';
    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: $akarUrl" . "src/admin/pages/data-user.php");
        exit;
    }

    $tgl_lahir = new DateTime($tanggalLahirPengguna);
    $tgl_today = new DateTime('now');
    $umur_pengguna = $tgl_today->diff($tgl_lahir)->y;

    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Foto_Pengguna' => $namaFotoPenggunaBaru,
        'Nama_Lengkap_Pengguna' => $namaLengkapPengguna,
        'Tanggal_Lahir_Pengguna' => $tanggalLahirPengguna,
        'Umur_Pengguna' => $umur_pengguna,
        'Alamat_Pengguna' => $alamatPengguna,
        'No_Telepon_Pengguna' => $noTeleponPenggunaFormatted,
        'Jabatan_Pengguna' => $jabatanPengguna,
        'Jenis_Kelamin_Pengguna' => $jenisKelaminPengguna,
        'Kata_Sandi_Pengguna' => $hashKataSandi,
        'Konfirmasi_Kata_Sandi_Pengguna' => $hashKataSandi,
    );

    $simpanDataPengguna = $obyekPengguna->tambahPengguna($dataPengguna);
    if ($simpanDataPengguna) {
        setPesanKeberhasilan("Berhasil, data pengguna baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data pengguna.");
    }
    header("Location: $akarUrl" . "src/admin/pages/data-user.php");
    exit;
}

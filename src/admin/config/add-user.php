<?php
include 'databases.php';

function containsXSS($input)
{
    $xss_patterns = [
        "/<script\b[^>]*>(.*?)<\/script>/is",
        "/<img\b[^>]*src\s*=\s*[\"']?\s*javascript:/i",
        "/<iframe\b[^>]*>(.*?)<\/iframe>/is",
        "/<link\b[^>]*href\s*=\s*[\"']?\s*javascript:/i",
        "/<object\b[^>]*>(.*?)<\/object>/is",
        "/on[a-zA-Z]+\s*=\s*\"[^\"]*\"/i",
        "/<!--.*?-->/",
        "/<a\b[^>]*href\s*=\s*(?:\"|')(?:javascript:|.*?\"javascript:).*?(?:\"|')/i",
        "/<embed\b[^>]*>(.*?)<\/embed>/is",
        "/<applet\b[^>]*>(.*?)<\/applet>/is",
        "/<[^>]*script\s*.*?(?:>|$)/i",
        "/<![^>]*-->/"
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

    $pesanKesalahan = '';

    $tanggalLahirPengguna = $_POST['Tanggal_Lahir_Pengguna'];
    $tanggal_lahir_format = DateTime::createFromFormat('Y-m-d', $tanggalLahirPengguna);

    if ($tanggal_lahir_format === false) {
        $pesanKesalahan .= "Format tanggal lahir tidak valid. ";
    } else {
        $tanggal_lahir_database = $tanggal_lahir_format->format('Y-m-d');
    }

    $nipPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'NIP_Pengguna', FILTER_SANITIZE_STRING));
    $namaLengkapPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama_Lengkap_Pengguna', FILTER_SANITIZE_STRING));
    $noTeleponPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'No_Telepon_Pengguna', FILTER_SANITIZE_STRING));
    $jabatanPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jabatan_Pengguna', FILTER_SANITIZE_STRING));
    $jenisKelaminPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jenis_Kelamin_Pengguna', FILTER_SANITIZE_STRING));
    $kataSandiPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Kata_Sandi_Pengguna', FILTER_SANITIZE_STRING));
    $konfirmasiKataSandiPengguna = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Konfirmasi_Kata_Sandi_Pengguna', FILTER_SANITIZE_STRING));
    $obyekPengguna = new Pengguna($koneksi);

    $cekNipSudahAda = $obyekPengguna->cekNIP($nipPengguna);

    if ($cekNipSudahAda) {
        $pesanKesalahan .= "NIP pengguna sudah ada. ";
    }

    $noTeleponPenggunaFormatted = preg_replace('/\D/', '', $noTeleponPengguna);
    if (strpos($noTeleponPenggunaFormatted, '0') === 0) {
        $noTeleponPenggunaFormatted = '+62' . substr($noTeleponPenggunaFormatted, 1);
    }
    if (strpos($noTeleponPenggunaFormatted, '+62') === 0) {
        $noTeleponPenggunaFormatted = substr($noTeleponPenggunaFormatted, 0, 3) . ' ' . substr($noTeleponPenggunaFormatted, 3, 3) . '-' . substr($noTeleponPenggunaFormatted, 6, 4) . '-' . substr($noTeleponPenggunaFormatted, 10);
    }

    if (empty($nipPengguna) || empty($namaLengkapPengguna) || empty($kataSandiPengguna) || empty($konfirmasiKataSandiPengguna) || empty($noTeleponPengguna) || empty($jabatanPengguna) || empty($jenisKelaminPengguna)) {
        $pesanKesalahan .= "Semua bidang harus diisi. ";
    }

    $panjangKataSandi = strlen($kataSandiPengguna) >= 8;
    $persyaratanKataSandi = preg_match('/[A-Z]/', $kataSandiPengguna) && preg_match('/[a-z]/', $kataSandiPengguna) && preg_match('/[0-9]/', $kataSandiPengguna) && preg_match('/[^A-Za-z0-9]/', $kataSandiPengguna);
    $kataSandiPenggunaYangValid = $panjangKataSandi && $persyaratanKataSandi;
    if (!$kataSandiPenggunaYangValid) {
        $pesanKesalahan .= "Kata sandi harus memiliki setidaknya 8 karakter dan mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu simbol. ";
    }

    $kecocokanKataSandi = $kataSandiPengguna === $konfirmasiKataSandiPengguna;
    if (!$kecocokanKataSandi) {
        $pesanKesalahan .= "Kata sandi dan konfirmasi kata sandi harus sama. ";
    }

    if (!is_numeric($noTeleponPengguna)) {
        $pesanKesalahan .= "Nomor telepon hanya boleh berisi angka. ";
    }

    $fotoPengguna = $_FILES['Foto_Pengguna'];
    $namaFotoPengguna = mysqli_real_escape_string($koneksi, htmlspecialchars($fotoPengguna['name']));
    $fotoPenggunaTemp = $fotoPengguna['tmp_name'];
    $ukuranFotoPengguna = $fotoPengguna['size'];
    $errorFotoPengguna = $fotoPengguna['error'];

    $tujuanFotoPengguna = '';
    $ukuranMaksimal = 2 * 1024 * 1024;
    $apakahUnggahBerhasil = ($errorFotoPengguna === 0 && !empty($namaFotoPengguna)) && ($ukuranFotoPengguna <= $ukuranMaksimal);

    if (!$apakahUnggahBerhasil) {
        $pesanKesalahan .= "Gagal mengupload foto pengguna atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB. ";
    }

    $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
    $formatFoto = strtolower(pathinfo($namaFotoPengguna, PATHINFO_EXTENSION));
    $apakahFormatDisetujui = in_array($formatFoto, $formatYangDisetujui);

    if (!$apakahFormatDisetujui) {
        $pesanKesalahan .= "Format foto harus berupa JPG, JPEG, atau PNG. ";
    }

    $namaFotoPenggunaBaru = '';
    if ($apakahFormatDisetujui) {
        $namaFotoPenggunaBaru = uniqid() . '.' . $formatFoto;
        $tujuanFotoPengguna = '../uploads/' . $namaFotoPenggunaBaru;
        $berhasilDipindahkan = move_uploaded_file($fotoPenggunaTemp, $tujuanFotoPengguna);
        if (!$berhasilDipindahkan) {
            $pesanKesalahan .= "Gagal mengupload foto pengguna. ";
        }
    }

    $tgl_lahir = new DateTime($tanggalLahirPengguna);
    $tgl_today = new DateTime('now');
    $umur_pengguna = $tgl_today->diff($tgl_lahir)->y;

    if ($umur_pengguna < 17) {
        $pesanKesalahan .= "Umur pengguna harus 17 tahun atau lebih. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: " . $akarUrl . "src/admin/pages/data-user.php");
        exit;
    }

    $hashKataSandi = password_hash($kataSandiPengguna, PASSWORD_BCRYPT);

    $dataPengguna = array(
        'NIP_Pengguna' => $nipPengguna,
        'Foto_Pengguna' => $namaFotoPenggunaBaru,
        'Nama_Lengkap_Pengguna' => $namaLengkapPengguna,
        'Tanggal_Lahir_Pengguna' => $tanggalLahirPengguna,
        'Umur_Pengguna' => $umur_pengguna,
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

    header("Location: " . $akarUrl . "src/admin/pages/data-user.php");
    exit;
}

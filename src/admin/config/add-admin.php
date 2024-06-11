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

if (isset($_POST['tambah_admin'])) {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $nipAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'NIP_Admin', FILTER_SANITIZE_STRING));
    $namaLengkapAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama_Lengkap_Admin', FILTER_SANITIZE_STRING));

    // Setelah mengambil tanggal lahir dari formulir HTML
    $tanggalLahirAdmin = $_POST['Tanggal_Lahir_Admin'];

    // Ubah format tanggal lahir
    $tanggal_lahir_format = DateTime::createFromFormat('Y-m-d', $tanggalLahirAdmin);
    if ($tanggal_lahir_format === false) {
        $pesanKesalahan .= "Format tanggal lahir tidak valid.";
    } else {
        $tanggal_lahir_database = $tanggal_lahir_format->format('Y-m-d');
    }

    // Hitung umur dari tanggal lahir
    $tgl_lahir = new DateTime($tanggal_lahir_database);
    $tgl_today = new DateTime('now');
    $umur_admin = $tgl_today->diff($tgl_lahir)->y;

    $alamatAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Alamat_Admin', FILTER_SANITIZE_STRING));
    $kataSandiAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Kata_Sandi_Admin', FILTER_SANITIZE_STRING));
    $konfirmasiKataSandiAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Konfirmasi_Kata_Sandi_Admin', FILTER_SANITIZE_STRING));
    $noTeleponAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nomor_Telepon_Admin', FILTER_SANITIZE_STRING));
    $jenisKelaminAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jenis_Kelamin_Admin', FILTER_SANITIZE_STRING));
    $jabatanAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jabatan_Admin', FILTER_SANITIZE_STRING));
    $pesanKesalahan = '';

    $noTeleponAdminFormatted = '+62 ' . substr($noTeleponAdmin, 0, 3) . '-' . substr($noTeleponAdmin, 3, 4) . '-' . substr($noTeleponAdmin, 7);

    if (
        empty($nipAdmin) || empty($namaLengkapAdmin) || empty($tanggalLahirAdmin) ||
        empty($kataSandiAdmin) || empty($konfirmasiKataSandiAdmin) || empty($noTeleponAdmin) || empty($jenisKelaminAdmin) ||
        empty($alamatAdmin) || empty($jabatanAdmin)
    ) {
        $pesanKesalahan .= "Semua bidang harus diisi. ";
    }

    $panjangKataSandi = strlen($kataSandiAdmin) >= 8;
    $persyaratanKataSandi = preg_match('/[A-Z]/', $kataSandiAdmin) && preg_match('/[a-z]/', $kataSandiAdmin) && preg_match('/[0-9]/', $kataSandiAdmin) && preg_match('/[^A-Za-z0-9]/', $kataSandiAdmin);
    $kataSandiAdminYangValid = $panjangKataSandi && $persyaratanKataSandi;
    if (!$kataSandiAdminYangValid) {
        $pesanKesalahan .= "Kata sandi harus memiliki setidaknya 8 karakter dan mengandung minimal satu huruf besar, satu huruf kecil, satu angka, dan satu simbol. ";
    }

    if ($kataSandiAdmin !== $konfirmasiKataSandiAdmin) {
        $pesanKesalahan .= "Kata sandi dan konfirmasi kata sandi harus sama. ";
    }

    $hashKataSandi = password_hash($kataSandiAdmin, PASSWORD_DEFAULT);

    if (!is_numeric($noTeleponAdmin)) {
        $pesanKesalahan .= "Nomor telepon hanya boleh berisi angka. ";
    }

    $fotoAdmin = $_FILES['Foto_Admin'];
    $namaFotoAdmin = mysqli_real_escape_string($koneksi, htmlspecialchars($fotoAdmin['name']));
    $fotoAdminTemp = $fotoAdmin['tmp_name'];
    $ukuranFotoAdmin = $fotoAdmin['size'];
    $errorFotoAdmin = $fotoAdmin['error'];

    $tujuanFotoAdmin = '';
    $ukuranMaksimal = 2 * 1024 * 1024;
    $apakahaUnggahBerhasil = ($errorFotoAdmin === 0 && !empty($namaFotoAdmin)) && ($ukuranFotoAdmin <= $ukuranMaksimal);

    if (!$apakahaUnggahBerhasil) {
        $pesanKesalahan .= "Gagal mengupload foto admin atau foto tidak diunggah atau ukuran melebihi batas maksimal 2MB. ";
    }

    $formatYangDisetujui = ['jpg', 'jpeg', 'png'];
    $formatFoto = strtolower(pathinfo($namaFotoAdmin, PATHINFO_EXTENSION));
    $apakahFormatDisetujui = in_array($formatFoto, $formatYangDisetujui);

    if (!$apakahFormatDisetujui) {
        $pesanKesalahan .= "Format foto harus berupa JPG, JPEG, atau PNG. ";
    }

    $namaFotoAdminBaru = $apakahFormatDisetujui ? uniqid() . '.' . $formatFoto : '';

    $tujuanFotoAdmin = $apakahFormatDisetujui ? '../uploads/' . $namaFotoAdminBaru : '';

    $apakahBerhasilDipindahkan = $apakahFormatDisetujui ? move_uploaded_file($fotoAdminTemp, $tujuanFotoAdmin) : false;
    if (!$apakahBerhasilDipindahkan) {
        $pesanKesalahan .= "Gagal mengupload foto admin. ";
    }

    if (!empty($pesanKesalahan)) {
        setPesanKesalahan($pesanKesalahan);
        header("Location: " . $akarUrl . "src/admin/pages/data-admin.php");
        exit;
    }

    $dataAdmin = array(
        'NIP_Admin' => $nipAdmin,
        'Foto_Admin' => $namaFotoAdminBaru,
        'Nama_Lengkap_Admin' => $namaLengkapAdmin,
        'Tanggal_Lahir_Admin' => $tanggalLahirAdmin,
        'Umur_Admin' => $umur_admin,
        'Alamat_Admin' => $alamatAdmin,
        'Nomor_Telepon_Admin' => $noTeleponAdminFormatted,
        'Jabatan_Admin' => $jabatanAdmin,
        'Jenis_Kelamin_Admin' => $jenisKelaminAdmin,
        'Kata_Sandi_Admin' => $hashKataSandi,
        'Konfirmasi_Kata_Sandi_Admin' => $konfirmasiKataSandiAdmin,
    );

    $obyekAdmin = new Admin($koneksi);
    $simpanDataAdmin = $obyekAdmin->tambahAdmin($dataAdmin);

    if ($simpanDataAdmin) {
        setPesanKeberhasilan("Berhasil, data admin baru telah ditambahkan.");
    } else {
        setPesanKesalahan("Gagal menyimpan data admin.");
    }
    header("Location: " . $akarUrl . "src/admin/pages/data-admin.php");
    exit;
} else {
    header("Location: " . $akarUrl . "src/admin/pages/data-admin.php");
    exit;
}
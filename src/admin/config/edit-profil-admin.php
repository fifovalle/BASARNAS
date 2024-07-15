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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../../../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $nipAdmin = $_SESSION['NIP_Admin'];
    $namaLengkapAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Nama_Lengkap_Admin', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $peranAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Peran_Admin', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $jabatanAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jabatan_Admin', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $jenisKelaminAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Jenis_Kelamin_Admin', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $nomorTeleponAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'No_Telepon_Admin', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $tanggalLahirAdmin = mysqli_real_escape_string($koneksi, filter_input(INPUT_POST, 'Tanggal_Lahir_Admin', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $pesanKesalahan = '';

    $tanggal_lahir_format = DateTime::createFromFormat('Y-m-d', $tanggalLahirAdmin);
    if ($tanggal_lahir_format === false) {
        $pesanKesalahan .= "Format tanggal lahir tidak valid. ";
    } else {
        $tanggalLahirAdmin = $tanggal_lahir_format->format('Y-m-d');

        $tgl_lahir = new DateTime($tanggalLahirAdmin);
        $tgl_today = new DateTime('now');
        $umurAdmin = $tgl_today->diff($tgl_lahir)->y;
    }

    $nomorTeleponFormatted = preg_replace('/\D/', '', $nomorTeleponAdmin);
    if (strpos($nomorTeleponFormatted, '62') === 0) {
        $nomorTeleponFormatted = '+' . $nomorTeleponFormatted;
    } elseif (strpos($nomorTeleponFormatted, '0') === 0) {
        $nomorTeleponFormatted = '+62' . substr($nomorTeleponFormatted, 1);
    }
    $nomorTeleponFormatted = '' . substr($nomorTeleponFormatted, 0, 3) . ' ' . substr($nomorTeleponFormatted, 3, 3) . '-' . substr($nomorTeleponFormatted, 6, 4) . '-' . substr($nomorTeleponFormatted, 10);

    $dataAdmin = array(
        'NIP_Admin' => $nipAdmin,
        'Nama_Lengkap_Admin' => $namaLengkapAdmin,
        'Tanggal_Lahir_Admin' => $tanggalLahirAdmin,
        'Peran_Admin' => $peranAdmin,
        'Jabatan_Admin' => $jabatanAdmin,
        'Jenis_Kelamin_Admin' => $jenisKelaminAdmin,
        'No_Telepon_Admin' => $nomorTeleponFormatted,
        'Umur_Admin' => $umurAdmin
    );

    $adminModel = new Admin($koneksi);
    $updateDataAdmin = $adminModel->perbaruiProfilAdmin($nipAdmin, $dataAdmin);

    if ($updateDataAdmin) {
        setPesanKeberhasilan("Berhasil, data admin berhasil diperbarui.");
    } else {
        setPesanKesalahan("Gagal memperbarui data admin.");
    }

    header("Location: " . $akarUrl . "src/admin/pages/profile.php");
    exit;
} else {
    header("Location: " . $akarUrl . "src/admin/pages/profile.php");
    exit;
}

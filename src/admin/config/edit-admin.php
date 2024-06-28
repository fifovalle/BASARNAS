<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipAdmin = $_POST['NIP_Admin'] ?? '';
    $namaLengkapAdmin = $_POST['Nama_Lengkap_Admin'] ?? '';
    $perantAdmin = $_POST['Peran_Admin'] ?? '';
    $jabatanAdmin = $_POST['Jabatan_Admin'] ?? '';
    $jenisKelaminAdmin = $_POST['Jenis_Kelamin_Admin'] ?? '';
    $nomorTeleponAdmin = $_POST['No_Telepon_Admin'] ?? '';
    $tanggalLahirAdmin = $_POST['Tanggal_Lahir_Admin'] ?? '';

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

    $nomorTeleponFormatted = $nomorTeleponAdmin;

    $nomorTeleponFormatted = preg_replace('/\D/', '', $nomorTeleponFormatted);

    if (strpos($nomorTeleponFormatted, '0') === 0) {
        $nomorTeleponFormatted = '+62' . substr($nomorTeleponFormatted, 1);
    }

    if (strpos($nomorTeleponFormatted, '+62') === 0) {
        $nomorTeleponFormatted = substr($nomorTeleponFormatted, 0, 3) . ' ' . substr($nomorTeleponFormatted, 3, 3) . '-' . substr($nomorTeleponFormatted, 6, 4) . '-' . substr($nomorTeleponFormatted, 10);
    }

    $adminModel = new Admin($koneksi);

    if (!empty($_FILES['Foto_Admin']['name'])) {
        $fotoAdmin = $_FILES['Foto_Admin'];
        $namaFotoAsli = $fotoAdmin['name'];
        $ekstensi = pathinfo($namaFotoAsli, PATHINFO_EXTENSION);
        $namaFotoBaru = uniqid() . '.' . $ekstensi;
        $tujuanFoto = "../uploads/" . $namaFotoBaru;

        if (!move_uploaded_file($fotoAdmin['tmp_name'], $tujuanFoto)) {
            echo json_encode(array("success" => false, "message" => "Gagal mengunggah foto baru."));
            exit;
        }

        $namaFotoLama = $adminModel->getFotoAdminById($nipAdmin);
        if (!empty($namaFotoLama)) {
            $pathFotoLama = "../uploads/" . $namaFotoLama;
            if (file_exists($pathFotoLama)) {
                unlink($pathFotoLama);
            }
        }
    } else {
        $namaFotoBaru = $adminModel->getFotoAdminById($nipAdmin);
    }

    $dataAdmin = array(
        'NIP_Admin' => $nipAdmin,
        'Nama_Lengkap_Admin' => $namaLengkapAdmin,
        'Tanggal_Lahir_Admin' => $tanggalLahirAdmin,
        'Peran_Admin' => $perantAdmin,
        'Jabatan_Admin' => $jabatanAdmin,
        'Jenis_Kelamin_Admin' => $jenisKelaminAdmin,
        'No_Telepon_Admin' => $nomorTeleponFormatted,
        'Umur_Admin' => $umurAdmin,
        'Foto_Admin' => $namaFotoBaru
    );

    $updateDataAdmin = $adminModel->perbaruiAdmin($nipAdmin, $dataAdmin);

    if ($updateDataAdmin) {
        echo json_encode(array("success" => true, "message" => "Data admin berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data admin."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}

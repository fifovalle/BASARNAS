<?php
include 'databases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nipAdmin = $_POST['NIP_Admin'] ?? '';
    $namaLengkapAdmin = $_POST['Nama_Lengkap_Admin'] ?? '';
    $alamatAdmin = $_POST['Alamat_Admin'] ?? '';
    $jabatanAdmin = $_POST['Jabatan_Admin'] ?? '';
    $jenisKelaminAdmin = $_POST['Jenis_Kelamin_Admin'] ?? '';
    $nomorTeleponAdmin = $_POST['No_Telepon_Admin'] ?? '';
    $tanggalLahirAdmin = $_POST['Tanggal_Lahir_Admin'] ?? '';
    list($tahunLahir, $bulanLahir, $hariLahir) = explode('-', $tanggalLahirAdmin);
    $tahunSekarang = date('Y');
    $umurAdmin = $tahunSekarang - $tahunLahir;
    // Periksa apakah sudah ulang tahun pada tahun ini
    if (date('m') < $bulanLahir || (date('m') == $bulanLahir && date('d') < $hariLahir)) {
        $umurAdmin--;
    }

    $fotoAdmin = $_FILES['Foto_Admin'] ?? null;
    $namaFotoAdmin = $fotoAdmin ? mysqli_real_escape_string($koneksi, htmlspecialchars($fotoAdmin['name'])) : '';
    $fotoAdminTemp = $fotoAdmin ? $fotoAdmin['tmp_name'] : '';
    $ukuranFotoAdmin = $fotoAdmin ? $fotoAdmin['size'] : 0;
    $errorFotoAdmin = $fotoAdmin ? $fotoAdmin['error'] : 0;
    $tujuanFotoAdmin = '';
    $ukuranMaksimal = 2 * 1024 * 1024;

    $pesanKesalahan = '';

    if ($fotoAdmin && $ukuranFotoAdmin > $ukuranMaksimal) {
        $pesanKesalahan .= "Ukuran file foto Admin melebihi batas maksimal (2MB). ";
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $adminModel = new Admin($koneksi);
    $dataLamaAdmin = $adminModel->tampilkanAdmin($nipAdmin);

    if ($fotoAdmin && $errorFotoAdmin === UPLOAD_ERR_OK) {
        $namaFotoAdminBaru = time() . '_' . $namaFotoAdmin;
        $tujuanFotoAdmin = '../uploads/' . $namaFotoAdminBaru;
        $apakahBerhasilDipindahkan = move_uploaded_file($fotoAdminTemp, $tujuanFotoAdmin);

        if ($apakahBerhasilDipindahkan) {
            if (isset($dataLamaAdmin['Foto_Admin']) && !empty($dataLamaAdmin['Foto_Admin'])) {
                $pathFotoLama = '../uploads/' . $dataLamaAdmin['Foto_Admin'];
                if (file_exists($pathFotoLama)) {
                    unlink($pathFotoLama);
                }
            }
        } else {
            $pesanKesalahan .= "Gagal mengupload foto Admin. ";
        }
    }

    if (!empty($pesanKesalahan)) {
        echo json_encode(array("success" => false, "message" => $pesanKesalahan));
        exit;
    }

    $dataAdmin = array(
        'NIP_Admin' => $nipAdmin,
        'Nama_Lengkap_Admin' => $namaLengkapAdmin,
        'Tanggal_Lahir_Admin' => $tanggalLahirAdmin,
        'Alamat_Admin' => $alamatAdmin,
        'Jabatan_Admin' => $jabatanAdmin,
        'Jenis_Kelamin_Admin' => $jenisKelaminAdmin,
        'No_Telepon_Admin' => $nomorTeleponAdmin,
        'Umur_Admin' => $umurAdmin
        );

    if ($fotoAdmin && $errorFotoAdmin === UPLOAD_ERR_OK && $apakahBerhasilDipindahkan) {
        $dataAdmin['Foto_Admin'] = $namaFotoAdminBaru;
    } else {
        $dataAdmin['Foto_Admin'] = $dataLamaAdmin['Foto_Admin'];
    }

    $updateDataAdmin = $adminModel->perbaruiAdmin($nipAdmin, $dataAdmin);

    if ($updateDataAdmin) {
        echo json_encode(array("success" => true, "message" => "Data admin berhasil diperbarui."));
    } else {
        echo json_encode(array("success" => false, "message" => "Gagal memperbarui data admin."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Metode request tidak valid."));
}
?>

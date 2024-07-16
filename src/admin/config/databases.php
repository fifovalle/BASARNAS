<?php
include 'connection.php';

// ===================================ADMIN===================================
class Admin
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahAdmin($data)
    {
        $query = "INSERT INTO admin (NIP_Admin, Foto_Admin, Nama_Lengkap_Admin, Tanggal_Lahir_Admin, Umur_Admin, Peran_Admin, No_Telepon_Admin, Jabatan_Admin, Jenis_Kelamin_Admin, Kata_Sandi_Admin, Konfirmasi_Kata_Sandi_Admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssissssss",
            $this->mengamankanString($data['NIP_Admin']),
            $this->mengamankanString($data['Foto_Admin']),
            $this->mengamankanString($data['Nama_Lengkap_Admin']),
            $this->mengamankanString($data['Tanggal_Lahir_Admin']),
            $this->mengamankanString($data['Umur_Admin']),
            $this->mengamankanString($data['Peran_Admin']),
            $this->mengamankanString($data['No_Telepon_Admin']),
            $this->mengamankanString($data['Jabatan_Admin']),
            $this->mengamankanString($data['Jenis_Kelamin_Admin']),
            $this->mengamankanString($data['Kata_Sandi_Admin']),
            $this->mengamankanString($data['Konfirmasi_Kata_Sandi_Admin']),
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataAdmin()
    {
        $query = "SELECT * FROM admin";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusAdmin($id)
    {
        $query = "SELECT NIP_Admin, Foto_Admin FROM admin WHERE NIP_Admin=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['NIP_Admin'];
        $namaFoto = $row['Foto_Admin'];

        if ($idPemilikFoto != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM admin WHERE NIP_Admin=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            $direktoriFoto = "../uploads/";

            if (file_exists($direktoriFoto . $namaFoto)) {
                if (unlink($direktoriFoto . $namaFoto)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function perbaruiAdmin($nipAdmin, $dataAdmin)
    {
        $sql = "UPDATE admin SET 
                    Foto_Admin = ?, 
                    Nama_Lengkap_Admin = ?, 
                    Tanggal_Lahir_Admin = ?, 
                    Peran_Admin = ?, 
                    Jabatan_Admin = ?, 
                    Jenis_Kelamin_Admin = ?, 
                    No_Telepon_Admin = ?, 
                    Umur_Admin = ? 
                WHERE NIP_Admin = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param(
            "sssssssii",
            $dataAdmin['Foto_Admin'],
            $dataAdmin['Nama_Lengkap_Admin'],
            $dataAdmin['Tanggal_Lahir_Admin'],
            $dataAdmin['Peran_Admin'],
            $dataAdmin['Jabatan_Admin'],
            $dataAdmin['Jenis_Kelamin_Admin'],
            $dataAdmin['No_Telepon_Admin'],
            $dataAdmin['Umur_Admin'],
            $nipAdmin
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiProfilAdmin($nipAdmin, $dataAdmin)
    {
        $sql = "UPDATE admin SET 
                    Nama_Lengkap_Admin = ?, 
                    No_Telepon_Admin = ?, 
                    Jenis_Kelamin_Admin = ?, 
                    Peran_Admin = ? ,
                    Jabatan_Admin = ?,
                    Tanggal_Lahir_Admin = ?,
                    Umur_Admin = ?
                WHERE NIP_Admin = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param(
            "ssssssii",
            $dataAdmin['Nama_Lengkap_Admin'],
            $dataAdmin['No_Telepon_Admin'],
            $dataAdmin['Jenis_Kelamin_Admin'],
            $dataAdmin['Peran_Admin'],
            $dataAdmin['Jabatan_Admin'],
            $dataAdmin['Tanggal_Lahir_Admin'],
            $dataAdmin['Umur_Admin'],
            $nipAdmin
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getFotoAdminById($idAdmin)
    {
        $query = "SELECT Foto_Admin FROM admin WHERE NIP_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idAdmin);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['Foto_Admin'];
        } else {
            return null;
        }
    }
    public function perbaruiFotoAdmin($nipAdmin, $namaFotoBaru)
    {
        $sql = "UPDATE admin SET 
                    Foto_Admin = ? 
                WHERE NIP_Admin = ?";
        $stmt = $this->koneksi->prepare($sql);

        $stmt->bind_param("si", $namaFotoBaru, $nipAdmin);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hitungSemuaAdmin()
    {
        $query = "SELECT COUNT(*) as total FROM admin";
        $hasil = mysqli_query($this->koneksi, $query);
        if ($hasil) {
            $data = mysqli_fetch_assoc($hasil);
            return $data['total'];
        } else {
            return 0;
        }
    }

    public function cekNIP($nip)
    {
        $query = "SELECT COUNT(*) as jumlah FROM admin WHERE NIP_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("s", $nip);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        return $row['jumlah'] > 0;
    }

    public function autentikasiAdmin($nipAdmin, $kataSandi)
    {
        $query = "SELECT * FROM admin WHERE NIP_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipAdmin);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedKataSandi = $row['Kata_Sandi_Admin'];
            if (password_verify($kataSandi, $hashedKataSandi)) {
                return $row;
            }
        }
        return null;
    }

    public function cariAdmin($nipAdmin)
    {
        $query = "SELECT * FROM admin WHERE NIP_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipAdmin);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    function tampilkanAdminDenganSessionNip($nipSessionAdmin)
    {
        $nipSessionAdmin = intval($nipSessionAdmin);
        $query = "SELECT * FROM admin WHERE NIP_Admin = $nipSessionAdmin";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function getNIPAdminById($id)
    {
        $query = "SELECT NIP_Admin FROM admin WHERE NIP_Admin = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $admin = $result->fetch_assoc();
        return $admin['NIP_Admin'] ?? null;
    }
}
// ===================================ADMIN===================================

// ===================================PENGGUNA===================================
class Pengguna
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahPengguna($data)
    {
        $query = "INSERT INTO pengguna (NIP_Pengguna, Foto_Pengguna, Nama_Lengkap_Pengguna, Tanggal_Lahir_Pengguna, Umur_Pengguna, No_Telepon_Pengguna, Jabatan_Pengguna, Jenis_Kelamin_Pengguna, Kata_Sandi_Pengguna, Konfirmasi_Kata_Sandi_Pengguna) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssisssss",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Foto_Pengguna']),
            $this->mengamankanString($data['Nama_Lengkap_Pengguna']),
            $this->mengamankanString($data['Tanggal_Lahir_Pengguna']),
            $this->mengamankanString($data['Umur_Pengguna']),
            $this->mengamankanString($data['No_Telepon_Pengguna']),
            $this->mengamankanString($data['Jabatan_Pengguna']),
            $this->mengamankanString($data['Jenis_Kelamin_Pengguna']),
            $this->mengamankanString($data['Kata_Sandi_Pengguna']),
            $this->mengamankanString($data['Konfirmasi_Kata_Sandi_Pengguna'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataPengguna()
    {
        $query = "SELECT * FROM pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataPenggunaPemula()
    {
        $query = "SELECT * FROM pengguna WHERE Jabatan_Pengguna = 'Pemula'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataPenggunaTerampil()
    {
        $query = "SELECT * FROM pengguna WHERE Jabatan_Pengguna = 'Terampil'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataPenggunaMahir()
    {
        $query = "SELECT * FROM pengguna WHERE Jabatan_Pengguna = 'Mahir'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataPenggunaPenyelia()
    {
        $query = "SELECT * FROM pengguna WHERE Jabatan_Pengguna = 'Penyelia'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataPenggunaWanita()
    {
        $query = "SELECT * FROM pengguna WHERE Jenis_Kelamin_Pengguna = 'Wanita'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanDataPenggunaPria()
    {
        $query = "SELECT * FROM pengguna WHERE Jenis_Kelamin_Pengguna = 'Pria'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }


    public function hapusPengguna($id)
    {
        $query = "SELECT NIP_Pengguna, Foto_Pengguna FROM pengguna WHERE NIP_Pengguna=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['NIP_Pengguna'];
        $namaFoto = $row['Foto_Pengguna'];

        if ($idPemilikFoto != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM pengguna WHERE NIP_Pengguna=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            $direktoriFoto = "../uploads/";

            if (file_exists($direktoriFoto . $namaFoto)) {
                if (unlink($direktoriFoto . $namaFoto)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function perbaruiPengguna($nipPengguna, $dataPengguna)
    {
        $sql = "UPDATE pengguna SET 
                    Foto_Pengguna = ?, 
                    Nama_Lengkap_Pengguna = ?, 
                    Tanggal_Lahir_Pengguna = ?, 
                    Jabatan_Pengguna = ?, 
                    Jenis_Kelamin_Pengguna = ?, 
                    No_Telepon_Pengguna = ?, 
                    Umur_Pengguna = ? 
                WHERE NIP_Pengguna = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param(
            "ssssssii",
            $dataPengguna['Foto_Pengguna'],
            $dataPengguna['Nama_Lengkap_Pengguna'],
            $dataPengguna['Tanggal_Lahir_Pengguna'],
            $dataPengguna['Jabatan_Pengguna'],
            $dataPengguna['Jenis_Kelamin_Pengguna'],
            $dataPengguna['No_Telepon_Pengguna'],
            $dataPengguna['Umur_Pengguna'],
            $nipPengguna
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getFotoPenggunaById($idPengguna)
    {
        $query = "SELECT Foto_Pengguna FROM pengguna WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idPengguna);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['Foto_Pengguna'];
        } else {
            return null;
        }
    }

    public function cekKelaminPenggunaSesuaiNIP($NIP)
    {
        $query = "SELECT Jenis_Kelamin_Pengguna FROM pengguna WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("s", $NIP);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        return $row['Jenis_Kelamin_Pengguna'];
    }

    public function hitungSemuaPengguna()
    {
        $query = "SELECT COUNT(*) as total FROM pengguna";
        $hasil = mysqli_query($this->koneksi, $query);
        if ($hasil) {
            $data = mysqli_fetch_assoc($hasil);
            return $data['total'];
        } else {
            return 0;
        }
    }

    public function cekNIP($nip)
    {
        $query = "SELECT COUNT(*) as jumlah FROM pengguna WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("s", $nip);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        return $row['jumlah'] > 0;
    }

    public function ambilUmurPengguna($nip)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("s", $nip);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        return $row['Umur_Pengguna'];
    }
}
// ===================================PENGGUNA===================================


// ===================================GARJAS PRIA PUSH UP===================================
class GarjasPushUpPria
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataGarjasPriaPushUpBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_pria_push_up LEFT JOIN pengguna ON garjas_pria_push_up.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Push_Up_Pria) = ? AND YEAR(Tanggal_Pelaksanaan_Push_Up_Pria) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahGarjasPushUpPria($data)
    {
        $query = "INSERT INTO garjas_pria_push_up (NIP_Pengguna, Tanggal_Pelaksanaan_Push_Up_Pria, Jumlah_Push_Up_Pria, Nilai_Push_Up_Pria, Status_Pria_Push_Up) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isiis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Push_Up_Pria']),
            $this->mengamankanString($data['Jumlah_Push_Up_Pria']),
            $this->mengamankanString($data['Nilai_Push_Up_Pria']),
            $this->mengamankanString($data['Status_Pria_Push_Up'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasPushUpPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function ambilDataGarjasPriaPushUpOlehId($id)
    {
        $query = "SELECT * FROM garjas_pria_push_up WHERE ID_Push_Up_Pria = '$id'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function tampilkanDataGarjasPriaPushUp()
    {
        $query = "SELECT * FROM garjas_pria_push_up LEFT JOIN pengguna ON garjas_pria_push_up.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasPriaPushUp($id)
    {
        $queryDelete = "DELETE FROM garjas_pria_push_up WHERE ID_Push_Up_Pria=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasPriaPushUp($id, $data)
    {
        $query = "UPDATE garjas_pria_push_up SET Tanggal_Pelaksanaan_Push_Up_Pria=?, Jumlah_Push_Up_Pria=?, Nilai_Push_Up_Pria=?, Status_Pria_Push_Up=? WHERE ID_Push_Up_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "siisi",
            $data['Tanggal_Pelaksanaan_Push_Up_Pria'],
            $data['Jumlah_Push_Up_Pria'],
            $data['Nilai_Push_Up_Pria'],
            $data['Status_Pria_Push_Up'],
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasPriaPushUpJikaDitolak($NIP, $data)
    {
        $query = "UPDATE garjas_pria_push_up SET Tanggal_Pelaksanaan_Push_Up_Pria=?, Jumlah_Push_Up_Pria=?, Nilai_Push_Up_Pria=?, Status_Pria_Push_Up=? WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "siisi",
            $data['Tanggal_Pelaksanaan_Push_Up_Pria'],
            $data['Jumlah_Push_Up_Pria'],
            $data['Nilai_Push_Up_Pria'],
            $data['Status_Pria_Push_Up'],
            $NIP
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cekNipAnggotaPushUpPriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_pria_push_up WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS PRIA PUSH UP===================================


// ===================================GARJAS PRIA SIT UP KAKI LURUS===================================
class GarjasPriaSitUpKakiLurus
{

    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataGarjasPriaSitUpKakiLurusBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_pria_sit_up_kaki_lurus LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria) = ? AND YEAR(Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahGarjasPriaSitUp1($data)
    {
        $query = "INSERT INTO garjas_pria_sit_up_kaki_lurus (NIP_Pengguna, Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria, Jumlah_Sit_Up_Kaki_Lurus_Pria, Nilai_Sit_Up_Kaki_Lurus_Pria) VALUES (?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isii",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria']),
            $this->mengamankanString($data['Jumlah_Sit_Up_Kaki_Lurus_Pria']),
            $this->mengamankanString($data['Nilai_Sit_Up_Kaki_Lurus_Pria'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasSitUpKakiLurusPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function tampilkanDataGarjasPriaSitUp1()
    {
        $query = "SELECT * FROM garjas_pria_sit_up_kaki_lurus LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasPriaSitUp1($id)
    {
        $queryDelete = "DELETE FROM garjas_pria_sit_up_kaki_lurus WHERE ID_Sit_Up_Kaki_Lurus_Pria=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }


    public function cekNipAnggotaSitUp1PriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_pria_sit_up_kaki_lurus WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasSitUp1PriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }


    public function ambilDataGarjasSitUp1OlehId($id)
    {
        $query = "SELECT * FROM garjas_pria_sit_up_kaki_lurus WHERE ID_Sit_Up_Kaki_Lurus_Pria = '$id'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function perbaruiGarjasPriaSitUp1($id, $data)
    {
        $query = "UPDATE garjas_pria_sit_up_kaki_lurus SET Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria=?, Jumlah_Sit_Up_Kaki_Lurus_Pria=?, Nilai_Sit_Up_Kaki_Lurus_Pria=? WHERE ID_Sit_Up_Kaki_Lurus_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "siii",
            $data['Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria'],
            $data['Jumlah_Sit_Up_Kaki_Lurus_Pria'],
            $data['Nilai_Sit_Up_Kaki_Lurus_Pria'],
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS PRIA SIT UP KAKI LURUS===================================

// ===================================GARJAS PRIA SHUTTLE RUN===================================
class GarjasPriaShuttleRun
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataGarjasPriaShuttleRunBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_pria_shuttle_run LEFT JOIN pengguna ON garjas_pria_shuttle_run.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Shuttle_Run_Pria) = ? AND YEAR(Tanggal_Pelaksanaan_Shuttle_Run_Pria) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function tambahGarjasPriaShuttleRun($data)
    {
        $query = "INSERT INTO garjas_pria_shuttle_run (NIP_Pengguna, Tanggal_Pelaksanaan_Shuttle_Run_Pria, Waktu_Shuttle_Run_Pria, Nilai_Shuttle_Run_Pria, Status_Pria_Shuttle_Run) VALUES (?, ?, ?, ?, ?)";

        $NIP_Pengguna = $this->mengamankanString($data['NIP_Pengguna']);
        $Tanggal_Pelaksanaan_Shuttle_Run_Pria = $data['Tanggal_Pelaksanaan_Shuttle_Run_Pria'];
        $Waktu_Shuttle_Run_Pria = $data['Waktu_Shuttle_Run_Pria'];
        $Nilai_Shuttle_Run_Pria = $data['Nilai_Shuttle_Run_Pria'];
        $Status_Pria_Shuttle_Run = $data['Status_Pria_Shuttle_Run'];
        if ($Tanggal_Pelaksanaan_Shuttle_Run_Pria instanceof DateTime) {
            $Tanggal_Pelaksanaan_Shuttle_Run_Pria = $Tanggal_Pelaksanaan_Shuttle_Run_Pria->format('Y-m-d');
        }

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("isdis", $NIP_Pengguna, $Tanggal_Pelaksanaan_Shuttle_Run_Pria, $Waktu_Shuttle_Run_Pria, $Nilai_Shuttle_Run_Pria, $Status_Pria_Shuttle_Run);

        if ($statement->execute()) {
            return true;
        } else {
            echo "Error: " . $statement->error;
            return false;
        }
    }


    public function ambilUmurGarjasShuttleRunPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function cekNipAnggotaShuttleRunPriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_pria_shuttle_run WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataPenggunaGarjasShuttleRunPria()
    {
        $query = "SELECT * FROM pengguna WHERE Jenis_Kelamin_Pengguna = 'Pria'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasPriaShuttleRun($id)
    {
        $queryDelete = "DELETE FROM garjas_pria_shuttle_run WHERE ID_Shuttle_Run_Pria=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }


    public function tampilkanDataGarjasPriaShuttleRun()
    {
        $query = "SELECT * FROM garjas_pria_shuttle_run LEFT JOIN pengguna ON garjas_pria_shuttle_run.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function ambilDataGarjasShuttleRunPriaId($id)
    {
        $query = "SELECT * FROM garjas_pria_shuttle_run WHERE ID_Shuttle_Run_Pria = '$id'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }


    public function perbaruiGarjasPriaShuttleRun($id, $data)
    {
        $query = "UPDATE garjas_pria_shuttle_run SET Tanggal_Pelaksanaan_Shuttle_Run_Pria=?, Waktu_Shuttle_Run_Pria=?, Nilai_Shuttle_Run_Pria=?, Status_Pria_Shuttle_Run=? WHERE ID_Shuttle_Run_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "sdisi",
            $data['Tanggal_Pelaksanaan_Shuttle_Run_Pria'],
            $data['Waktu_Shuttle_Run_Pria'],
            $data['Nilai_Shuttle_Run_Pria'],
            $data['Status_Pria_Shuttle_Run'],
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasPriaShuttleRunJikaDitolak($NIP, $data)
    {
        $query = "UPDATE garjas_pria_shuttle_run SET Tanggal_Pelaksanaan_Shuttle_Run_Pria=?, Waktu_Shuttle_Run_Pria=?, Nilai_Shuttle_Run_Pria=?, Status_Pria_Shuttle_Run=? WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);

        if ($data['Tanggal_Pelaksanaan_Shuttle_Run_Pria'] instanceof DateTime) {
            $data['Tanggal_Pelaksanaan_Shuttle_Run_Pria'] = $data['Tanggal_Pelaksanaan_Shuttle_Run_Pria']->format('Y-m-d');
        }

        $statement->bind_param(
            "sdisi",
            $data['Tanggal_Pelaksanaan_Shuttle_Run_Pria'],
            $data['Waktu_Shuttle_Run_Pria'],
            $data['Nilai_Shuttle_Run_Pria'],
            $data['Status_Pria_Shuttle_Run'],
            $NIP
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS PRIA SHUTTLE RUN===================================


// ===================================GARJAS PRIA FLEXED ARM HANG===================================
class GarjasPriaFlexedArmHang
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataGarjasPriaFlexedArmHangBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_pria_menggantung LEFT JOIN pengguna ON garjas_pria_menggantung.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Pria_Menggantung) = ? AND YEAR(Tanggal_Pelaksanaan_Pria_Menggantung) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahGarjasPriaFlexedArmHang($data)
    {
        $query = "INSERT INTO garjas_pria_menggantung (NIP_Pengguna, Tanggal_Pelaksanaan_Pria_Menggantung, Waktu_Menggantung_Pria, Nilai_Menggantung_Pria, Status_Pria_Menggantung) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isiis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Pria_Menggantung']),
            $this->mengamankanString($data['Waktu_Menggantung_Pria']),
            $this->mengamankanString($data['Nilai_Menggantung_Pria']),
            $this->mengamankanString($data['Status_Pria_Menggantung'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasFlexedArmHangPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function cekNipAnggotaFlexedArmHangPriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_pria_menggantung WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataPenggunaGarjasFlexedArmHangPria()
    {
        $query = "SELECT * FROM pengguna WHERE Jenis_Kelamin_Pengguna = 'Pria'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasPriaFlexedArmHang($id)
    {
        $queryDelete = "DELETE FROM garjas_pria_menggantung WHERE ID_Menggantung_Pria=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }


    public function tampilkanDataGarjasPriaFlexedArmHang()
    {
        $query = "SELECT * FROM garjas_pria_menggantung LEFT JOIN pengguna ON garjas_pria_menggantung.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }


    public function ambilDataGarjasFlexedArmHangPriaId($id)
    {
        $query = "SELECT * FROM garjas_pria_menggantung WHERE ID_Menggantung_Pria = '$id'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function perbaruiGarjasPriaFlexedArmHang($id, $data)
    {
        $query = "UPDATE garjas_pria_menggantung SET Tanggal_Pelaksanaan_Pria_Menggantung=?, Waktu_Menggantung_Pria=?, Nilai_Menggantung_Pria=?, Status_Pria_Menggantung=? WHERE ID_Menggantung_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "siisi",
            $data['Tanggal_Pelaksanaan_Pria_Menggantung'],
            $data['Waktu_Menggantung_Pria'],
            $data['Nilai_Menggantung_Pria'],
            $data['Status_Pria_Menggantung'],
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasPriaFlexedArmHangJikaDitolak($NIP, $data)
    {
        $query = "UPDATE garjas_pria_menggantung SET Tanggal_Pelaksanaan_Pria_Menggantung=?, Waktu_Menggantung_Pria=?, Nilai_Menggantung_Pria=?, Status_Pria_Menggantung=? WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "siisi",
            $data['Tanggal_Pelaksanaan_Pria_Menggantung'],
            $data['Waktu_Menggantung_Pria'],
            $data['Nilai_Menggantung_Pria'],
            $data['Status_Pria_Menggantung'],
            $NIP
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS PRIA FLEXED ARM HANG===================================



// ===================================GARJAS PRIA CHIN UP===================================
class GarjasChinUpPria
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataGarjasPriaChinUpHangBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_pria_chin_up LEFT JOIN pengguna ON garjas_pria_chin_up.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Chin_Up_Pria) = ? AND YEAR(Tanggal_Pelaksanaan_Chin_Up_Pria) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahGarjasPriaChinUp($data)
    {
        $query = "INSERT INTO garjas_pria_chin_up (NIP_Pengguna, Tanggal_Pelaksanaan_Chin_Up_Pria, Jumlah_Chin_Up_Pria, Nilai_Chin_Up_Pria) VALUES (?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isii",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Chin_Up_Pria']),
            $this->mengamankanString($data['Jumlah_Chin_Up_Pria']),
            $this->mengamankanString($data['Nilai_Chin_Up_Pria'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasChinUpPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function cekNipAnggotaChinUpPriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_pria_chin_up WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataPenggunaGarjasChinUpPria()
    {
        $query = "SELECT * FROM pengguna WHERE Jenis_Kelamin_Pengguna = 'Pria'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasPriaChinUp($id)
    {
        $queryDelete = "DELETE FROM garjas_pria_chin_up WHERE ID_Pria_Chin_Up=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }


    public function tampilkanDataGarjasPriaChinUp()
    {
        $query = "SELECT * FROM garjas_pria_chin_up LEFT JOIN pengguna ON garjas_pria_chin_up.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }


    public function ambilDataGarjasChinUpPriaId($id)
    {
        $query = "SELECT * FROM garjas_pria_chin_up WHERE ID_Pria_Chin_Up = '$id'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }


    public function perbaruiGarjasPriaChinUp($id, $data)
    {
        $query = "UPDATE garjas_pria_chin_up SET Tanggal_Pelaksanaan_Chin_Up_Pria=?, Jumlah_Chin_Up_Pria=?, Nilai_Chin_Up_Pria=? WHERE ID_Pria_Chin_Up=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "siii",
            $data['Tanggal_Pelaksanaan_Chin_Up_Pria'],
            $data['Jumlah_Chin_Up_Pria'],
            $data['Nilai_Chin_Up_Pria'],
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS PRIA CHIN UP===================================


// ===================================GARJAS PRIA SIT UP KAKI DITEKUK===================================
class GarjasPriaSitUpKakiDitekuk
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataGarjasPriaSitUp2Bulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_pria_sit_up_kaki_di_tekuk LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_di_tekuk.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk) = ? AND YEAR(Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahGarjasPriaSitUp2($data)
    {
        $query = "INSERT INTO garjas_pria_sit_up_kaki_di_tekuk (NIP_Pengguna, Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk, Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria, Nilai_Sit_Up_Kaki_Di_Tekuk_Pria) VALUES (?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isii",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk']),
            $this->mengamankanString($data['Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria']),
            $this->mengamankanString($data['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasSitUp2PriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function cekNipAnggotaSitUp2PriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_pria_sit_up_kaki_di_tekuk WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataPenggunaGarjasChinUpPria()
    {
        $query = "SELECT * FROM pengguna WHERE Jenis_Kelamin_Pengguna = 'Pria'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasPriaSitUp2($id)
    {
        $queryDelete = "DELETE FROM garjas_pria_sit_up_kaki_di_tekuk WHERE ID_Sit_Up_Kaki_Di_Tekuk_Pria=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }


    public function tampilkanDataGarjasPriaSitUp2()
    {
        $query = "SELECT * FROM garjas_pria_sit_up_kaki_di_tekuk LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_di_tekuk.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function ambilDataGarjasSitUp2OlehId($id)
    {
        $query = "SELECT * FROM garjas_pria_sit_up_kaki_di_tekuk WHERE ID_Sit_Up_Kaki_Di_Tekuk_Pria = '$id'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }


    public function perbaruiGarjasPriaSitUp2($id, $data)
    {
        $query = "UPDATE garjas_pria_sit_up_kaki_di_tekuk SET Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk=?, Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria=?, Nilai_Sit_Up_Kaki_Di_Tekuk_Pria=? WHERE ID_Sit_Up_Kaki_Di_Tekuk_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "siii",
            $data['Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk'],
            $data['Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria'],
            $data['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria'],
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS PRIA SIT UP KAKI DITEKUK===================================

// ===================================GARJAS WANITA PUSH UP===================================
class GarjasWanitaPushUp
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaPushUp($data)
    {
        $query = "INSERT INTO garjas_wanita_push_up (NIP_Pengguna, Tanggal_Pelaksanaan_Push_Up_Wanita, Jumlah_Push_Up_Wanita, Nilai_Push_Up_Wanita, Status_Wanita_Push_Up) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isiis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Push_Up_Wanita']),
            $this->mengamankanString($data['Jumlah_Push_Up_Wanita']),
            $this->mengamankanString($data['Nilai_Push_Up_Wanita']),
            $this->mengamankanString($data['Status_Wanita_Push_Up'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasWanitaPushUpOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }


    public function tampilkanDataGarjasWanitaPushUp()
    {
        $query = "SELECT * FROM garjas_wanita_push_up LEFT JOIN pengguna ON garjas_wanita_push_up.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasWanitaPushUp($id)
    {
        $queryDelete = "DELETE FROM garjas_wanita_push_up WHERE ID_Wanita_Push_Up=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasWanitaPushUp($id, $data)
    {
        $query = "UPDATE garjas_wanita_push_up SET 
                        Tanggal_Pelaksanaan_Push_Up_Wanita=?, 
                        Jumlah_Push_Up_Wanita=?, 
                        Nilai_Push_Up_Wanita=?,
                        Status_Wanita_Push_Up=?
                        WHERE ID_Wanita_Push_Up=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanPushUpWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Push_Up_Wanita']);
        $jumlahPushUpWanita = $this->mengamankanString($data['Jumlah_Push_Up_Wanita']);
        $nilaiPushUpWanita = $this->mengamankanString($data['Nilai_Push_Up_Wanita']);
        $statusPushUpWanita = $this->mengamankanString($data['Status_Wanita_Push_Up']);
        $idWanitaPushUp = $id;

        $statement->bind_param("siisi", $tanggalPelaksanaanPushUpWanita, $jumlahPushUpWanita, $nilaiPushUpWanita, $statusPushUpWanita, $idWanitaPushUp);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasWanitaPushUpJikaDitolak($NIP, $data)
    {
        $query = "UPDATE garjas_wanita_push_up SET 
                        Tanggal_Pelaksanaan_Push_Up_Wanita=?, 
                        Jumlah_Push_Up_Wanita=?, 
                        Nilai_Push_Up_Wanita=?,
                        Status_Wanita_Push_Up=?
                        WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanPushUpWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Push_Up_Wanita']);
        $jumlahPushUpWanita = $this->mengamankanString($data['Jumlah_Push_Up_Wanita']);
        $nilaiPushUpWanita = $this->mengamankanString($data['Nilai_Push_Up_Wanita']);
        $statusPushUpWanita = $this->mengamankanString($data['Status_Wanita_Push_Up']);
        $idWanitaPushUp = $NIP;

        $statement->bind_param("siisi", $tanggalPelaksanaanPushUpWanita, $jumlahPushUpWanita, $nilaiPushUpWanita, $statusPushUpWanita, $idWanitaPushUp);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cekNipAnggotaPushUpWanitaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_wanita_push_up WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataGarjasWanitaPushUpBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_wanita_push_up LEFT JOIN pengguna ON garjas_wanita_push_up.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Push_Up_Wanita) = ? AND YEAR(Tanggal_Pelaksanaan_Push_Up_Wanita) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
// ===================================GARJAS WANITA PUSH UP===================================


// ===================================GARJAS WANITA SIT UP===================================
class GarjasWanitaSitUp1
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaSitUp1($data)
    {
        $query = "INSERT INTO garjas_wanita_sit_up_kaki_lurus (NIP_Pengguna, Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita, Jumlah_Sit_Up_Kaki_Lurus_Wanita, Nilai_Sit_Up_Kaki_Lurus_Wanita) VALUES (?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isii",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita']),
            $this->mengamankanString($data['Jumlah_Sit_Up_1_Wanita']),
            $this->mengamankanString($data['Nilai_Sit_Up_1_Wanita'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasWanitaSitUp1OlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }


    public function tampilkanDataGarjasWanitaSitUp1()
    {
        $query = "SELECT * FROM garjas_wanita_sit_up_kaki_lurus LEFT JOIN pengguna ON garjas_wanita_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasWanitaSitUp1($id)
    {
        $queryDelete = "DELETE FROM garjas_wanita_sit_up_kaki_lurus WHERE ID_Wanita_Sit_Up_Kaki_Lurus=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasWanitaSitUp1($id, $data)
    {
        $query = "UPDATE garjas_wanita_sit_up_kaki_lurus SET 
                    Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita=?, 
                    Jumlah_Sit_Up_Kaki_Lurus_Wanita=?, 
                    Nilai_Sit_Up_Kaki_Lurus_Wanita=? 
                    WHERE ID_Wanita_Sit_Up_Kaki_Lurus=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanSitUp1Wanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita']);
        $jumlahSitUp1Wanita = $this->mengamankanString($data['Jumlah_Sit_Up_1_Wanita']);
        $nilaiSitUp1Wanita = $this->mengamankanString($data['Nilai_Sit_Up_1_Wanita']);
        $idWanitaSitUp1 = $id;

        $statement->bind_param("siii", $tanggalPelaksanaanSitUp1Wanita, $jumlahSitUp1Wanita, $nilaiSitUp1Wanita, $idWanitaSitUp1);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function cekNipAnggotaSitUp1WanitaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_wanita_sit_up_kaki_lurus WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataGarjasWanitaSitUpKakiLurusBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_wanita_sit_up_kaki_lurus LEFT JOIN pengguna ON garjas_wanita_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita) = ? AND YEAR(Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
// ===================================GARJAS WANITA SIT UP===================================

// ===================================GARJAS WANITA SHUTTLE RUN===================================
class GarjasWanitaShuttleRun
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaShuttleRun($data)
    {
        $query = "INSERT INTO garjas_wanita_shuttle_run (NIP_Pengguna, Tanggal_Pelaksanaan_Shuttle_Run_Wanita, Jumlah_Shuttle_Run_Wanita, Nilai_Shuttle_Run_Wanita, Status_Wanita_Shuttle_Run) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Shuttle_Run_Wanita']),
            $this->mengamankanString(floatval($data['Jumlah_Shuttle_Run_Wanita'])),
            $this->mengamankanString($data['Nilai_Shuttle_Run_Wanita']),
            $this->mengamankanString($data['Status_Wanita_Shuttle_Run'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataGarjasWanitaShuttleRunBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_wanita_shuttle_run LEFT JOIN pengguna ON garjas_wanita_shuttle_run.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Shuttle_Run_Wanita) = ? AND YEAR(Tanggal_Pelaksanaan_Shuttle_Run_Wanita) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function ambilUmurGarjasWanitaShuttleRunOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }


    public function tampilkanDataGarjasWanitaShuttleRun()
    {
        $query = "SELECT * FROM garjas_wanita_shuttle_run LEFT JOIN pengguna ON garjas_wanita_shuttle_run.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasWanitaShuttleRun($id)
    {
        $queryDelete = "DELETE FROM garjas_wanita_shuttle_run WHERE ID_Wanita_Shuttle_Run=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasWanitaShuttleRun($id, $data)
    {
        $query = "UPDATE garjas_wanita_shuttle_run SET 
                    Tanggal_Pelaksanaan_Shuttle_Run_Wanita=?, 
                    Jumlah_Shuttle_Run_Wanita=?, 
                    Nilai_Shuttle_Run_Wanita=? ,
                    Status_Wanita_Shuttle_Run=?
                    WHERE ID_Wanita_Shuttle_Run=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanShuttleRunWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Shuttle_Run_Wanita']);
        $jumlahShuttleRunWanita = $this->mengamankanString($data['Jumlah_Shuttle_Run_Wanita']);
        $nilaiShuttleRunWanita = $this->mengamankanString($data['Nilai_Shuttle_Run_Wanita']);
        $shuttleRunWanitaStatus = $this->mengamankanString($data['Status_Wanita_Shuttle_Run']);
        $idWanitaShuttleRun = $id;

        $statement->bind_param("ssisi", $tanggalPelaksanaanShuttleRunWanita, $jumlahShuttleRunWanita, $nilaiShuttleRunWanita, $shuttleRunWanitaStatus, $idWanitaShuttleRun);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasWanitaShuttleRunJikaDitolak($NIP, $data)
    {
        $query = "UPDATE garjas_wanita_shuttle_run SET 
                    Tanggal_Pelaksanaan_Shuttle_Run_Wanita=?, 
                    Jumlah_Shuttle_Run_Wanita=?, 
                    Nilai_Shuttle_Run_Wanita=? ,
                    Status_Wanita_Shuttle_Run=?
                    WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanShuttleRunWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Shuttle_Run_Wanita']);
        $jumlahShuttleRunWanita = $this->mengamankanString($data['Jumlah_Shuttle_Run_Wanita']);
        $nilaiShuttleRunWanita = $this->mengamankanString($data['Nilai_Shuttle_Run_Wanita']);
        $shuttleRunWanitaStatus = $this->mengamankanString($data['Status_Wanita_Shuttle_Run']);
        $idWanitaShuttleRun = $NIP;

        $statement->bind_param("ssisi", $tanggalPelaksanaanShuttleRunWanita, $jumlahShuttleRunWanita, $nilaiShuttleRunWanita, $shuttleRunWanitaStatus, $idWanitaShuttleRun);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cekNipAnggotaShuttleRunWanitaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_wanita_shuttle_run WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS WANITA SHUTTLE RUN===================================

// ===================================GARJAS WANITA CHIN UP===================================
class GarjasWanitaChinUp
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaChinUp($data)
    {
        $query = "INSERT INTO garjas_wanita_chin_up (NIP_Pengguna, Tanggal_Pelaksanaan_Chin_Up_Wanita, Jumlah_Chin_Up_Wanita, Nilai_Chin_Up_Wanita) VALUES (?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isdi",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Chin_Up_Wanita']),
            $this->mengamankanString($data['Jumlah_Chin_Up_Wanita']),
            $this->mengamankanString($data['Nilai_Chin_Up_Wanita'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataGarjasWanitaChinningBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_wanita_chin_up LEFT JOIN pengguna ON garjas_wanita_chin_up.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Chin_Up_Wanita) = ? AND YEAR(Tanggal_Pelaksanaan_Chin_Up_Wanita) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function ambilUmurGarjasWanitaChinUpOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function tampilkanDataGarjasWanitaChinUp()
    {
        $query = "SELECT * FROM garjas_wanita_chin_up LEFT JOIN pengguna ON garjas_wanita_chin_up.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasWanitaChinUp($id)
    {
        $queryDelete = "DELETE FROM garjas_wanita_chin_up WHERE ID_Wanita_Chin_Up=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasWanitaChinUp($id, $data)
    {
        $query = "UPDATE garjas_wanita_chin_up SET 
                    Tanggal_Pelaksanaan_Chin_Up_Wanita=?, 
                    Jumlah_Chin_Up_Wanita=?, 
                    Nilai_Chin_Up_Wanita=? 
                    WHERE ID_Wanita_Chin_Up=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanChinUpWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Chin_Up_Wanita']);
        $jumlahChinUpWanita = $this->mengamankanString($data['Jumlah_Chin_Up_Wanita']);
        $nilaiChinUpWanita = $this->mengamankanString($data['Nilai_Chin_Up_Wanita']);
        $idWanitaChinUp = $id;

        $statement->bind_param("siii", $tanggalPelaksanaanChinUpWanita, $jumlahChinUpWanita, $nilaiChinUpWanita, $idWanitaChinUp);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function cekNipAnggotaChinUpWanitaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_wanita_chin_up WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS WANITA CHIN UP===================================

// ===================================GARJAS WANITA SIT UP DI TEKUK===================================
class GarjasWanitaSitUp2
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaSitUp2($data)
    {
        $query = "INSERT INTO garjas_wanita_sit_up_kaki_di_tekuk (NIP_Pengguna, Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita, Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita, Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita) VALUES (?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isii",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita']),
            $this->mengamankanString($data['Jumlah_Sit_Up_2_Wanita']),
            $this->mengamankanString($data['Nilai_Sit_Up_2_Wanita'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataGarjasWanitaSitUp2Bulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM garjas_wanita_sit_up_kaki_di_tekuk LEFT JOIN pengguna ON garjas_wanita_sit_up_kaki_di_tekuk.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita) = ? AND YEAR(Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function ambilUmurGarjasWanitaSitUp2OlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }


    public function tampilkanDataGarjasWanitaSitUp2()
    {
        $query = "SELECT * FROM garjas_wanita_sit_up_kaki_di_tekuk LEFT JOIN pengguna ON garjas_wanita_sit_up_kaki_di_tekuk.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function hapusDataGarjasWanitaSitUp2($id)
    {
        $queryDelete = "DELETE FROM garjas_wanita_sit_up_kaki_di_tekuk WHERE ID_Wanita_Sit_Up_Kaki_Di_Tekuk=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiGarjasWanitaSitUp2($id, $data)
    {
        $query = "UPDATE garjas_wanita_sit_up_kaki_di_tekuk SET 
                    Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita=?, 
                    Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita=?, 
                    Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita=? 
                    WHERE ID_Wanita_Sit_Up_Kaki_Di_Tekuk=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanSitUp2Wanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita']);
        $jumlahSitUp2Wanita = $this->mengamankanString($data['Jumlah_Sit_Up_2_Wanita']);
        $nilaiSitUp2Wanita = $this->mengamankanString($data['Nilai_Sit_Up_2_Wanita']);
        $idWanitaSitUp2 = $id;

        $statement->bind_param("siii", $tanggalPelaksanaanSitUp2Wanita, $jumlahSitUp2Wanita, $nilaiSitUp2Wanita, $idWanitaSitUp2);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cekNipAnggotaSitUp2WanitaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM garjas_wanita_sit_up_kaki_di_tekuk WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================GARJAS WANITA SIT UP DI TEKUK===================================


// ===================================TES RENANG PRIA===================================
class TesRenangPria
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataTesRenangPriaBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM tes_renang_pria LEFT JOIN pengguna ON tes_renang_pria.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Tes_Renang_Pria) = ? AND YEAR(Tanggal_Pelaksanaan_Tes_Renang_Pria) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahTesRenangPria($data)
    {
        $query = "INSERT INTO tes_renang_pria (NIP_Pengguna, Tanggal_Pelaksanaan_Tes_Renang_Pria, Waktu_Renang_Pria, Nama_Gaya_Renang_Pria, Nilai_Renang_Pria, Status_Renang_Pria) VALUES (?, ?, ?, ?, ?, ?)";


        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Renang_Pria']),
            $this->mengamankanString($data['Waktu_Renang_Pria']),
            $this->mengamankanString($data['Nama_Gaya_Renang_Pria']),
            $this->mengamankanString($data['Nilai_Renang_Pria']),
            $this->mengamankanString($data['Status_Renang_Pria']),
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurGarjasRenangPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function tampilkanDataTesRenangPria()
    {
        $query = "SELECT * FROM tes_renang_pria LEFT JOIN pengguna ON tes_renang_pria.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function perbaruiTesRenangPria($id, $data)
    {
        $query = "UPDATE tes_renang_pria SET 
                    Tanggal_Pelaksanaan_Tes_Renang_Pria=?,
                    Nama_Gaya_Renang_Pria=?,
                    Waktu_Renang_Pria=?, 
                    Nilai_Renang_Pria=?,
                    Status_Renang_Pria=?
                    WHERE ID_Renang_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanRenangPria = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Renang_Pria']);
        $namaRenangPria = $this->mengamankanString($data['Nama_Gaya_Renang_Pria']);
        $waktuRenangPria = $this->mengamankanString($data['Waktu_Renang_Pria']);
        $nilaiRenangPria = $this->mengamankanString($data['Nilai_Renang_Pria']);
        $statusRenangPria = $this->mengamankanString($data['Status_Renang_Pria']);
        $idRenangPria = $id;

        $statement->bind_param("sssisi", $tanggalPelaksanaanRenangPria, $namaRenangPria, $waktuRenangPria, $nilaiRenangPria, $statusRenangPria, $idRenangPria);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTesRenangPriaById($idRenangPria)
    {
        $sql = "SELECT * FROM tes_renang_pria WHERE ID_Renang_Pria = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("i", $idRenangPria);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();

        return $data;
    }

    public function hapusTesRenangPria($idRenangPria)
    {
        $queryDelete = "DELETE FROM tes_renang_pria WHERE ID_Renang_Pria=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $idRenangPria);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurTesRenangPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function sudahAdaNilaiRenangPria($nipPengguna)
    {
        $query = "SELECT COUNT(*) as count FROM tes_renang_pria WHERE NIP_Pengguna = ?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("s", $nipPengguna);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function cekNipAnggotaTesRenangPriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM tes_renang_pria WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiTesRenangPriaJikaDiTolak($NIP, $data)
    {
        $query = "UPDATE tes_renang_pria SET 
                    Tanggal_Pelaksanaan_Tes_Renang_Pria=?, 
                    Nama_Gaya_Renang_Pria=?,
                    Waktu_Renang_Pria=?, 
                    Nilai_Renang_Pria=?,
                    Status_Renang_Pria=?
                    WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanRenangPria = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Renang_Pria']);
        $namaRenangPria = $this->mengamankanString($data['Nama_Gaya_Renang_Pria']);
        $waktuRenangPria = $this->mengamankanString($data['Waktu_Renang_Pria']);
        $nilaiRenangPria = $this->mengamankanString($data['Nilai_Renang_Pria']);
        $statusRenangPria = $this->mengamankanString($data['Status_Renang_Pria']);
        $idRenangPria = $NIP;

        $statement->bind_param("sssisi", $tanggalPelaksanaanRenangPria, $namaRenangPria, $waktuRenangPria, $nilaiRenangPria, $statusRenangPria, $idRenangPria);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================TES RENANG PRIA===================================

// ===================================TES RENANG WANITA===================================
class TesRenangWanita
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataTesRenangWanitaBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM tes_renang_wanita LEFT JOIN pengguna ON tes_renang_wanita.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Tes_Renang_Wanita) = ? AND YEAR(Tanggal_Pelaksanaan_Tes_Renang_Wanita) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahTesRenangWanita($data)
    {
        $query = "INSERT INTO tes_renang_wanita (NIP_Pengguna, Tanggal_Pelaksanaan_Tes_Renang_Wanita, Waktu_Renang_Wanita, Nama_Gaya_Renang_Wanita, Nilai_Renang_Wanita, Status_Renang_Wanita) VALUES (?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Renang_Wanita']),
            $this->mengamankanString($data['Waktu_Renang_Wanita']),
            $this->mengamankanString($data['Nama_Gaya_Renang_Wanita']),
            $this->mengamankanString($data['Nilai_Renang_Wanita']),
            $this->mengamankanString($data['Status_Renang_Wanita'])

        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataTesRenangWanita()
    {
        $query = "SELECT * FROM tes_renang_wanita LEFT JOIN pengguna ON tes_renang_wanita.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function perbaruiTesRenangWanita($id, $data)
    {
        $query = "UPDATE tes_renang_wanita SET 
                    Tanggal_Pelaksanaan_Tes_Renang_Wanita=?,
                    Nama_Gaya_Renang_Wanita=?,
                    Waktu_Renang_Wanita=?, 
                    Nilai_Renang_Wanita=?,
                    Status_Renang_Wanita=? 
                    WHERE ID_Renang_Wanita=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanRenangWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Renang_Wanita']);
        $namaRenangWanita = $this->mengamankanString($data['Nama_Gaya_Renang_Wanita']);
        $waktuRenangWanita = $this->mengamankanString($data['Waktu_Renang_Wanita']);
        $nilaiRenangWanita = $this->mengamankanString($data['Nilai_Renang_Wanita']);
        $statusRenangWanita = $this->mengamankanString($data['Status_Renang_Wanita']);
        $idRenangWanita = $id;

        $statement->bind_param("sssisi", $tanggalPelaksanaanRenangWanita, $namaRenangWanita, $waktuRenangWanita, $nilaiRenangWanita, $statusRenangWanita, $idRenangWanita);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTesRenangWanitaById($idRenangWanita)
    {
        $sql = "SELECT * FROM tes_renang_wanita WHERE ID_Renang_Wanita = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("i", $idRenangWanita);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();

        return $data;
    }

    public function hapusTesRenangWanita($idRenangWanita)
    {
        $queryDelete = "DELETE FROM tes_renang_wanita WHERE ID_Renang_Wanita=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $idRenangWanita);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function cekNipAnggotaTesRenangWanitaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM tes_renang_wanita WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function sudahAdaNilaiRenangWanita($nipPengguna)
    {
        $query = "SELECT COUNT(*) as count FROM tes_renang_wanita WHERE NIP_Pengguna = ?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("s", $nipPengguna);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function ambilUmurGarjasRenangWanitaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function perbaruiTesRenangWanitaJikaDiTolak($NIP, $data)
    {
        $query = "UPDATE tes_renang_wanita SET 
        Tanggal_Pelaksanaan_Tes_Renang_Wanita=?,
        Nama_Gaya_Renang_Wanita=?,
        Waktu_Renang_Wanita=?, 
        Nilai_Renang_Wanita=?,
        Status_Renang_Wanita=? 
        WHERE ID_Renang_Wanita=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanRenangWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Renang_Wanita']);
        $namaRenangWanita = $this->mengamankanString($data['Nama_Gaya_Renang_Wanita']);
        $waktuRenangWanita = $this->mengamankanString($data['Waktu_Renang_Wanita']);
        $nilaiRenangWanita = $this->mengamankanString($data['Nilai_Renang_Wanita']);
        $statusRenangWanita = $this->mengamankanString($data['Status_Renang_Wanita']);
        $idRenangWanita = $NIP;
        $statement->bind_param("ssisi", $tanggalPelaksanaanRenangWanita, $namaRenangWanita, $waktuRenangWanita, $nilaiRenangWanita, $statusRenangWanita, $idRenangWanita);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================TES RENANG WANITA===================================

// ===================================TES LARI PRIA===================================
class TesLariPria
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataTesLariPriaPriaBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM tes_lari_pria LEFT JOIN pengguna ON tes_lari_pria.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Tes_Lari_Pria) = ? AND YEAR(Tanggal_Pelaksanaan_Tes_Lari_Pria) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahTesLariPria($data)
    {
        $query = "INSERT INTO tes_lari_pria (NIP_Pengguna, Tanggal_Pelaksanaan_Tes_Lari_Pria, Waktu_Lari_Pria, Nilai_Lari_Pria, Status_Lari_Pria) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Lari_Pria']),
            $this->mengamankanString($data['Waktu_Lari_Pria']),
            $this->mengamankanString($data['Nilai_Lari_Pria']),
            $this->mengamankanString($data['Status_Lari_Pria'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurTesLariPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function tampilkanDataTesLariPria()
    {
        $query = "SELECT * FROM tes_lari_pria LEFT JOIN pengguna ON tes_lari_pria.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function perbaruiTesLariPria($id, $data)
    {
        $query = "UPDATE tes_lari_pria SET 
                    Tanggal_Pelaksanaan_Tes_Lari_Pria=?, 
                    Waktu_Lari_Pria=?, 
                    Nilai_Lari_Pria=?,
                    Status_Lari_Pria=?
                    WHERE ID_Lari_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanLariPria = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Lari_Pria']);
        $waktuLariPria = $this->mengamankanString($data['Waktu_Lari_Pria']);
        $nilaiLariPria = $this->mengamankanString($data['Nilai_Lari_Pria']);
        $statusLariPria = $this->mengamankanString($data['Status_Lari_Pria']);
        $idLariPria = $id;

        $statement->bind_param("ssisi", $tanggalPelaksanaanLariPria, $waktuLariPria, $nilaiLariPria, $statusLariPria, $idLariPria);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiTesLariPriaJikaDiTolak($NIP, $data)
    {
        $query = "UPDATE tes_lari_pria SET 
                    Tanggal_Pelaksanaan_Tes_Lari_Pria=?, 
                    Waktu_Lari_Pria=?, 
                    Nilai_Lari_Pria=?,
                    Status_Lari_Pria=?
                    WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanLariPria = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Lari_Pria']);
        $waktuLariPria = $this->mengamankanString($data['Waktu_Lari_Pria']);
        $nilaiLariPria = $this->mengamankanString($data['Nilai_Lari_Pria']);
        $statusLariPria = $this->mengamankanString($data['Status_Lari_Pria']);
        $idLariPria = $NIP;

        $statement->bind_param("ssisi", $tanggalPelaksanaanLariPria, $waktuLariPria, $nilaiLariPria, $statusLariPria, $idLariPria);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTesLariPriaById($idLariPria)
    {
        $sql = "SELECT * FROM tes_lari_pria WHERE ID_Lari_Pria = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("i", $idLariPria);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();

        return $data;
    }

    public function hapusTesLariPria($idLariPria)
    {
        $queryDelete = "DELETE FROM tes_lari_pria WHERE ID_Lari_Pria=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $idLariPria);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }
    public function cekNipAnggotaTesLariPriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM tes_lari_pria WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================TES LARI PRIA===================================

// ===================================TES LARI WANITA===================================
class TesLariWanita
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataTesLariWanitaBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM tes_lari_wanita LEFT JOIN pengguna ON tes_lari_wanita.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Tes_Lari_Wanita) = ? AND YEAR(Tanggal_Pelaksanaan_Tes_Lari_Wanita) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tambahTesLariWanita($data)
    {
        $query = "INSERT INTO tes_lari_wanita (NIP_Pengguna, Tanggal_Pelaksanaan_Tes_Lari_Wanita, Waktu_Lari_Wanita, Nilai_Lari_Wanita, Status_Lari_Wanita) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Lari_Wanita']),
            $this->mengamankanString($data['Waktu_Lari_Wanita']),
            $this->mengamankanString($data['Nilai_Lari_Wanita']),
            $this->mengamankanString($data['Status_Lari_Wanita'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurTesLariWanitaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function tampilkanDataTesLariWanita()
    {
        $query = "SELECT * FROM tes_lari_wanita LEFT JOIN pengguna ON tes_lari_wanita.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function perbaruiTesLariWanita($id, $data)
    {
        $query = "UPDATE tes_lari_wanita SET 
                    Tanggal_Pelaksanaan_Tes_Lari_Wanita=?, 
                    Waktu_Lari_Wanita=?, 
                    Nilai_Lari_Wanita=?,
                    Status_Lari_Wanita=?
                    WHERE ID_Lari_Wanita=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanLariWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Lari_Wanita']);
        $waktuLariWanita = $this->mengamankanString($data['Waktu_Lari_Wanita']);
        $nilaiLariWanita = $this->mengamankanString($data['Nilai_Lari_Wanita']);
        $statusLariWanita = $this->mengamankanString($data['Status_Lari_Wanita']);
        $idLariWanita = $id;
        $statement->bind_param("ssisi", $tanggalPelaksanaanLariWanita, $waktuLariWanita, $nilaiLariWanita, $statusLariWanita, $idLariWanita);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiTesLariWanitaJikaDiTolak($NIP, $data)
    {
        $query = "UPDATE tes_lari_wanita SET 
                    Tanggal_Pelaksanaan_Tes_Lari_Wanita=?, 
                    Waktu_Lari_Wanita=?, 
                    Nilai_Lari_Wanita=?,
                    Status_Lari_Wanita=?
                    WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanLariWanita = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Lari_Wanita']);
        $waktuLariWanita = $this->mengamankanString($data['Waktu_Lari_Wanita']);
        $nilaiLariWanita = $this->mengamankanString($data['Nilai_Lari_Wanita']);
        $statusLariWanita = $this->mengamankanString($data['Status_Lari_Wanita']);
        $idLariWanita = $NIP;
        $statement->bind_param("ssisi", $tanggalPelaksanaanLariWanita, $waktuLariWanita, $nilaiLariWanita, $statusLariWanita, $idLariWanita);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTesLariWanitaById($idLariWanita)
    {
        $sql = "SELECT * FROM tes_lari_wanita WHERE ID_Lari_Wanita = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("i", $idLariWanita);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();

        return $data;
    }

    public function hapusTesLariWanita($idLariWanita)
    {
        $queryDelete = "DELETE FROM tes_lari_wanita WHERE ID_Lari_Wanita=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $idLariWanita);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }
    public function cekNipAnggotaTesLariWanitaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM tes_lari_wanita WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================TES LARI WANITA===================================

// ===================================TES JALAN KAKI PRIA 5KM===================================
class TesJalanKaki5KMPria
{

    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataTesJalanKaki5KMPriaBulan($bulan, $tahun)
    {
        $sql = "SELECT * FROM tes_jalan_pria LEFT JOIN pengguna ON tes_jalan_pria.NIP_Pengguna = pengguna.NIP_Pengguna WHERE MONTH(Tanggal_Pelaksanaan_Tes_Jalan_Pria) = ? AND YEAR(Tanggal_Pelaksanaan_Tes_Jalan_Pria) = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param("ii", $bulan, $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function tampilkanDataTesJalanKaki5KMPria()
    {
        $query = "SELECT tes_jalan_pria.*, pengguna.*
                  FROM tes_jalan_pria
                  LEFT JOIN pengguna ON tes_jalan_pria.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tambahTesJalanKaki5KMPria($data)
    {
        $query = "INSERT INTO tes_jalan_pria (NIP_Pengguna, Tanggal_Pelaksanaan_Tes_Jalan_Pria, Waktu_Jalan_Pria, Nilai_Jalan_Pria, Status_Jalan_Pria) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issis",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Jalan_Pria']),
            $this->mengamankanString($data['Waktu_Jalan_Pria']),
            $this->mengamankanString($data['Nilai_Jalan_Pria']),
            $this->mengamankanString($data['Status_Jalan_Pria'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ambilUmurTesJalanKaki5KMPriaOlehNIP($NIP)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = '$NIP'";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['Umur_Pengguna'];
        } else {
            return null;
        }
    }

    public function hapusTesJalanKaki5KMPria($id)
    {
        $queryDelete = "DELETE FROM tes_jalan_pria WHERE ID_Jalan_Pria=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function cekNipAnggotaTesJalanKaki5KMPriaSudahAda($nipPengguna)
    {
        $query = "SELECT COUNT(*) as total FROM tes_jalan_pria WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        $total = $row['total'];

        if ($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiTesJalanPria($id, $data)
    {
        $query = "UPDATE tes_jalan_pria SET 
                    Tanggal_Pelaksanaan_Tes_Jalan_Pria=?, 
                    Waktu_Jalan_Pria=?, 
                    Nilai_Jalan_Pria=?,
                    Status_Jalan_Pria=?
                    WHERE ID_Jalan_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanJalanPria = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Jalan_Pria']);
        $waktuJalanPria = $this->mengamankanString($data['Waktu_Jalan_Pria']);
        $nilaiJalanPria = $this->mengamankanString($data['Nilai_Jalan_Pria']);
        $statusJalanPria = $this->mengamankanString($data['Status_Jalan_Pria']);
        $idJalanPria = $id;

        $statement->bind_param("ssisi", $tanggalPelaksanaanJalanPria, $waktuJalanPria, $nilaiJalanPria, $statusJalanPria, $idJalanPria);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiTesJalanPriaJikaDitolak($NIP, $data)
    {
        $query = "UPDATE tes_jalan_pria SET 
                    Tanggal_Pelaksanaan_Tes_Jalan_Pria=?, 
                    Waktu_Jalan_Pria=?, 
                    Nilai_Jalan_Pria=?,
                    Status_Jalan_Pria=?
                    WHERE NIP_Pengguna=?";

        $statement = $this->koneksi->prepare($query);
        $tanggalPelaksanaanJalanPria = $this->mengamankanString($data['Tanggal_Pelaksanaan_Tes_Jalan_Pria']);
        $waktuJalanPria = $this->mengamankanString($data['Waktu_Jalan_Pria']);
        $nilaiJalanPria = $this->mengamankanString($data['Nilai_Jalan_Pria']);
        $statusJalanPria = $this->mengamankanString($data['Status_Jalan_Pria']);
        $idJalanPria = $NIP;

        $statement->bind_param("ssisi", $tanggalPelaksanaanJalanPria, $waktuJalanPria, $nilaiJalanPria, $statusJalanPria, $idJalanPria);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================TES JALAN KAKI PRIA 5KM===================================

// ===================================KOMPETENSI===================================
class Kompetensi
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahKompetensi($data)
    {
        $query = "INSERT INTO kompetensi (
            NIP_Pengguna, 
            Nama_Sertifikat, 
            Tanggal_Penerbitan_Sertifikat, 
            Masa_Berlaku,
            Tanggal_Berakhir_Sertifikat, 
            Kategori_Kompetensi, 
            Status, 
            File_Sertifikat
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "sssissss",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Nama_Sertifikat']),
            $this->mengamankanString($data['Tanggal_Penerbitan_Sertifikat']),
            $this->mengamankanString($data['Masa Berlaku']),
            $this->mengamankanString($data['Tanggal_Berakhir_Sertifikat']),
            $this->mengamankanString($data['Kategori_Kompetensi']),
            $this->mengamankanString($data['Status']),
            $this->mengamankanString($data['File_Sertifikat'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanKompetensiPemula()
    {
        $query = "SELECT kompetensi.*, pengguna.* FROM kompetensi LEFT JOIN pengguna ON kompetensi.NIP_Pengguna = pengguna.NIP_Pengguna WHERE kompetensi.Kategori_Kompetensi = 'Pemula'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanKompetensiTerampil()
    {
        $query = "SELECT kompetensi.*, pengguna.* FROM kompetensi LEFT JOIN pengguna ON kompetensi.NIP_Pengguna = pengguna.NIP_Pengguna WHERE kompetensi.Kategori_Kompetensi = 'Terampil'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanKompetensiMahir()
    {
        $query = "SELECT kompetensi.*, pengguna.* FROM kompetensi LEFT JOIN pengguna ON kompetensi.NIP_Pengguna = pengguna.NIP_Pengguna WHERE kompetensi.Kategori_Kompetensi = 'Mahir'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanKompetensiPenyelia()
    {
        $query = "SELECT kompetensi.*, pengguna.* FROM kompetensi LEFT JOIN pengguna ON kompetensi.NIP_Pengguna = pengguna.NIP_Pengguna WHERE kompetensi.Kategori_Kompetensi = 'Penyelia'";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tampilkanKompetensiPemulaOlehID($id)
    {
        $query = "SELECT * FROM kompetensi WHERE ID_Kompetensi = ?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function hapusKompetensi($id)
    {
        $query = "SELECT ID_Kompetensi, File_Sertifikat FROM kompetensi WHERE ID_Kompetensi=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['ID_Kompetensi'];
        $namaFoto = $row['File_Sertifikat'];

        if ($idPemilikFoto != $id) {
            return false;
        }

        $queryDelete = "DELETE FROM kompetensi WHERE ID_Kompetensi=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            $direktoriFoto = "../uploads/";

            if (file_exists($direktoriFoto . $namaFoto)) {
                if (unlink($direktoriFoto . $namaFoto)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function perbaruiKompetensi($id, $dataKompetensi)
    {
        $sql = "UPDATE kompetensi SET
                Nama_Sertifikat = ?,
                Tanggal_Penerbitan_Sertifikat = ?,
                Tanggal_Berakhir_Sertifikat = ?,
                Kategori_Kompetensi = ?,
                Status = ?,
                File_Sertifikat = ?
                WHERE ID_Kompetensi = ?";
        $stmt = $this->koneksi->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param(
            "ssssssi",
            $dataKompetensi['Nama_Sertifikat'],
            $dataKompetensi['Tanggal_Penerbitan_Sertifikat'],
            $dataKompetensi['Tanggal_Berakhir_Sertifikat'],
            $dataKompetensi['Kategori_Kompetensi'],
            $dataKompetensi['Status'],
            $dataKompetensi['File_Sertifikat'],
            $id
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================KOMPETENSI===================================

// ===================================MODUL===================================
class Modul
{

    private $koneksi;

    public function __construct($database)
    {
        $this->koneksi = $database;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataModul()
    {
        $query = "SELECT * FROM modul";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tambahModul($data)
    {
        $query = "INSERT INTO modul (
            File_Modul, Nama_Modul, Judul_Modul, Tanggal_Terbit_Modul, Deskripsi_Modul
            ) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "sssss",
            $this->mengamankanString($data['File_Modul']),
            $this->mengamankanString($data['Nama_Modul']),
            $this->mengamankanString($data['Judul_Modul']),
            $this->mengamankanString($data['Tanggal_Terbit_Modul']),
            $this->mengamankanString($data['Deskripsi_Modul'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusModul($idModul)
    {
        $query = "SELECT ID_Modul, File_Modul FROM modul WHERE ID_Modul=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idModul);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $idPemilikFoto = $row['ID_Modul'];
        $namaFoto = $row['File_Modul'];

        if ($idPemilikFoto != $idModul) {
            return false;
        }

        $queryDelete = "DELETE FROM modul WHERE ID_Modul=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $idModul);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            $direktoriFoto = "../uploads/";

            if (file_exists($direktoriFoto . $namaFoto)) {
                if (unlink($direktoriFoto . $namaFoto)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function perbaruiModul($id, $data)
    {
        $sql = "UPDATE modul SET
                File_Modul = ?,
                Nama_Modul = ?,
                Judul_Modul = ?,
                Tanggal_Terbit_Modul = ?,
                Deskripsi_Modul = ?
                WHERE ID_Modul = ?";
        $stmt = $this->koneksi->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param(
            "sssssi",
            $data['File_Modul'],
            $data['Nama_Modul'],
            $data['Judul_Modul'],
            $data['Tanggal_Terbit_Modul'],
            $data['Deskripsi_Modul'],
            $id
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getFileModulOlehID($idModul)
    {
        $query = "SELECT File_Modul FROM modul WHERE ID_Modul = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idModul);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['File_Modul'];
        } else {
            return null;
        }
    }
}
// ===================================MODUL===================================

// ===================================ABSENSI===================================
class Absensi
{

    private $koneksi;

    public function __construct($database)
    {
        $this->koneksi = $database;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataAbsensi()
    {
        $query = "SELECT * FROM absensi LEFT JOIN pengguna ON absensi.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tambahAbsensi($data)
    {
        $query = "INSERT INTO absensi (
            NIP_Pengguna, Tanggal_Absensi, Hari_Absensi, Jam_Absen, Status_Absensi
            ) VALUES (?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issss",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Absensi']),
            $this->mengamankanString($data['Hari_Absensi']),
            $this->mengamankanString($data['Jam_Absen']),
            $this->mengamankanString($data['Status_Absensi'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusAbsensi($idAbsensi)
    {
        $query = "DELETE FROM absensi WHERE ID_Absensi=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idAbsensi);
        $isDeleted = $statement->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaruiAbsensi($id, $data)
    {
        $sql = "UPDATE absensi SET
                NIP_Pengguna = ?,
                Tanggal_Absensi = ?,
                Hari_Absensi = ?,
                Jam_Absen = ?,
                Status_Absensi = ?
                WHERE ID_Absensi = ?";
        $stmt = $this->koneksi->prepare($sql);

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param(
            "issssi",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tanggal_Absensi']),
            $this->mengamankanString($data['Hari_Absensi']),
            $this->mengamankanString($data['Jam_Absen']),
            $this->mengamankanString($data['Status_Absensi']),
            $id
        );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================ABSENSI===================================


// ===================================BMI===================================
class Bmi
{
    private $koneksi;

    public function __construct($database)
    {
        $this->koneksi = $database;
    }

    private function mengamankanString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tampilkanDataBMI()
    {
        $query = "SELECT * FROM bmi LEFT JOIN pengguna ON bmi.NIP_Pengguna = pengguna.NIP_Pengguna";
        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function tambahBMI($data)
    {
        $query = "INSERT INTO bmi (
            NIP_Pengguna, Tanggal_Pemeriksaan, Tinggi_BMI, Berat_BMI, Skor, Keterangan
            ) VALUES (?, NOW(), ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "issss",
            $this->mengamankanString($data['NIP_Pengguna']),
            $this->mengamankanString($data['Tinggi_BMI']),
            $this->mengamankanString($data['Berat_BMI']),
            $this->mengamankanString($data['Skor']),
            $this->mengamankanString($data['Keterangan'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function hitungBMI($tinggi_cm, $berat, $umur)
    {
        $tinggi_m = $tinggi_cm / 100;

        return $berat / ($tinggi_m * $tinggi_m) * ($umur >= 18 ? 1 : 0.9);
    }

    public function cekUmurPengguna($nip)
    {
        $query = "SELECT Umur_Pengguna FROM pengguna WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("s", $nip);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        return $row['Umur_Pengguna'];
    }

    public function hapusBMI($id)
    {
        $queryDelete = "DELETE FROM bmi WHERE ID_BMI=?";
        $statementDelete = $this->koneksi->prepare($queryDelete);
        $statementDelete->bind_param("i", $id);
        $isDeleted = $statementDelete->execute();

        if ($isDeleted) {
            return true;
        } else {
            return false;
        }
    }

    public function perbaharuiBMI($id, $data)
    {
        $query = "UPDATE bmi SET Tinggi_BMI=?, Tanggal_Pemeriksaan=NOW(), Berat_BMI=?, Skor=?, Keterangan=? WHERE ID_BMI=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iiisi",
            $data['Tinggi_BMI'],
            $data['Berat_BMI'],
            $data['Skor'],
            $data['Keterangan'],
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
// ===================================BMI===================================

// ===================================TotalGarjasPria===================================
class TotalGarjasPria
{
    private $koneksi;

    public function __construct($database)
    {
        $this->koneksi = $database;
    }

    public function hitungData()
    {
        $query = "
        SELECT g.NIP_Pengguna,
               COALESCE(g.Nilai_Chin_Up_Pria, 0) AS Nilai_Chin_Up_Pria,
               COALESCE(g.Nilai_Menggantung_Pria, 0) AS Nilai_Menggantung_Pria,
               COALESCE(g.Nilai_Push_Up_Pria, 0) AS Nilai_Push_Up_Pria,
               COALESCE(g.Nilai_Shuttle_Run_Pria, 0) AS Nilai_Shuttle_Run_Pria,
               COALESCE(g.Nilai_Sit_Up_Kaki_Di_Tekuk_Pria, 0) AS Nilai_Sit_Up_Kaki_Di_Tekuk_Pria,
               COALESCE(g.Nilai_Sit_Up_Kaki_Lurus_Pria, 0) AS Nilai_Sit_Up_Kaki_Lurus_Pria,
               p.Nama_Lengkap_Pengguna
        FROM (
            SELECT NIP_Pengguna,
                   SUM(Nilai_Chin_Up_Pria) AS Nilai_Chin_Up_Pria,
                   SUM(Nilai_Menggantung_Pria) AS Nilai_Menggantung_Pria,
                   SUM(Nilai_Push_Up_Pria) AS Nilai_Push_Up_Pria,
                   SUM(Nilai_Shuttle_Run_Pria) AS Nilai_Shuttle_Run_Pria,
                   SUM(Nilai_Sit_Up_Kaki_Di_Tekuk_Pria) AS Nilai_Sit_Up_Kaki_Di_Tekuk_Pria,
                   SUM(Nilai_Sit_Up_Kaki_Lurus_Pria) AS Nilai_Sit_Up_Kaki_Lurus_Pria
            FROM (
                SELECT NIP_Pengguna, Nilai_Chin_Up_Pria, 0 AS Nilai_Menggantung_Pria, 0 AS Nilai_Push_Up_Pria, 0 AS Nilai_Shuttle_Run_Pria, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Pria, 0 AS Nilai_Sit_Up_Kaki_Lurus_Pria FROM garjas_pria_chin_up
                UNION ALL
                SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Pria, Nilai_Menggantung_Pria, 0 AS Nilai_Push_Up_Pria, 0 AS Nilai_Shuttle_Run_Pria, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Pria, 0 AS Nilai_Sit_Up_Kaki_Lurus_Pria FROM garjas_pria_menggantung
                UNION ALL
                SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Pria, 0 AS Nilai_Menggantung_Pria, Nilai_Push_Up_Pria, 0 AS Nilai_Shuttle_Run_Pria, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Pria, 0 AS Nilai_Sit_Up_Kaki_Lurus_Pria FROM garjas_pria_push_up
                UNION ALL
                SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Pria, 0 AS Nilai_Menggantung_Pria, 0 AS Nilai_Push_Up_Pria, Nilai_Shuttle_Run_Pria, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Pria, 0 AS Nilai_Sit_Up_Kaki_Lurus_Pria FROM garjas_pria_shuttle_run
                UNION ALL
                SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Pria, 0 AS Nilai_Menggantung_Pria, 0 AS Nilai_Push_Up_Pria, 0 AS Nilai_Shuttle_Run_Pria, Nilai_Sit_Up_Kaki_Di_Tekuk_Pria, 0 AS Nilai_Sit_Up_Kaki_Lurus_Pria FROM garjas_pria_sit_up_kaki_di_tekuk
                UNION ALL
                SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Pria, 0 AS Nilai_Menggantung_Pria, 0 AS Nilai_Push_Up_Pria, 0 AS Nilai_Shuttle_Run_Pria, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Pria, Nilai_Sit_Up_Kaki_Lurus_Pria FROM garjas_pria_sit_up_kaki_lurus
            ) AS g
            GROUP BY NIP_Pengguna
        ) AS g
        LEFT JOIN pengguna AS p ON g.NIP_Pengguna = p.NIP_Pengguna
    ";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            $totalNilai = 0;
            $jumlahBaris = 0;
            $nipAlreadyAdded = [];

            while ($baris = $result->fetch_assoc()) {
                if (!in_array($baris['NIP_Pengguna'], $nipAlreadyAdded)) {
                    $totalNilai += $baris['Nilai_Chin_Up_Pria'];
                    $totalNilai += $baris['Nilai_Menggantung_Pria'];
                    $totalNilai += $baris['Nilai_Push_Up_Pria'];
                    $totalNilai += $baris['Nilai_Shuttle_Run_Pria'];
                    $totalNilai += $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria'];
                    $totalNilai += $baris['Nilai_Sit_Up_Kaki_Lurus_Pria'];
                    $jumlahBaris++;
                    $nipAlreadyAdded[] = $baris['NIP_Pengguna'];
                }
                $baris['Total_Nilai_Garjas_Pria'] = round($baris['Nilai_Chin_Up_Pria'] + $baris['Nilai_Menggantung_Pria'] + $baris['Nilai_Push_Up_Pria'] + $baris['Nilai_Shuttle_Run_Pria'] + $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria'] + $baris['Nilai_Sit_Up_Kaki_Lurus_Pria'], 1);
                $data[] = $baris;
            }

            $jumlahFieldNilai = 6;
            $rataRataNilai = $jumlahBaris > 0 ? $totalNilai / $jumlahFieldNilai : 0;

            return [
                'data' => $data,
                'totalNilai' => $totalNilai,
                'rataRataNilai' => round($rataRataNilai, 1)
            ];
        } else {
            return [
                'data' => [],
                'totalNilai' => 0,
                'rataRataNilai' => 0
            ];
        }
    }


    public function tampilkanDataTotalGarjasPria()
    {
        $query = "
        SELECT 
            pengguna.*, 
            garjas_pria_menggantung.*, 
            garjas_pria_push_up.*, 
            garjas_pria_chin_up.*, 
            garjas_pria_shuttle_run.*, 
            garjas_pria_sit_up_kaki_di_tekuk.*, 
            garjas_pria_sit_up_kaki_lurus.*
        FROM pengguna
        LEFT JOIN garjas_pria_menggantung ON pengguna.NIP_Pengguna = garjas_pria_menggantung.NIP_Pengguna
        LEFT JOIN garjas_pria_push_up ON pengguna.NIP_Pengguna = garjas_pria_push_up.NIP_Pengguna
        LEFT JOIN garjas_pria_chin_up ON pengguna.NIP_Pengguna = garjas_pria_chin_up.NIP_Pengguna
        LEFT JOIN garjas_pria_shuttle_run ON pengguna.NIP_Pengguna = garjas_pria_shuttle_run.NIP_Pengguna
        LEFT JOIN garjas_pria_sit_up_kaki_di_tekuk ON pengguna.NIP_Pengguna = garjas_pria_sit_up_kaki_di_tekuk.NIP_Pengguna
        LEFT JOIN garjas_pria_sit_up_kaki_lurus ON pengguna.NIP_Pengguna = garjas_pria_sit_up_kaki_lurus.NIP_Pengguna
    ";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $totalNilaiGarjas = 0;

                // Menghitung total nilai garjas dari setiap jenis
                $totalNilaiGarjas += isset($baris['Nilai_Menggantung_Pria']) ? $baris['Nilai_Menggantung_Pria'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Push_Up_Pria']) ? $baris['Nilai_Push_Up_Pria'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Chin_Up_Pria']) ? $baris['Nilai_Chin_Up_Pria'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Shuttle_Run_Pria']) ? $baris['Nilai_Shuttle_Run_Pria'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria']) ? $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Sit_Up_Kaki_Lurus_Pria']) ? $baris['Nilai_Sit_Up_Kaki_Lurus_Pria'] : 0;

                $jumlahFieldNilai = 6;
                $rataRataNilai = $jumlahFieldNilai > 0 ? $totalNilaiGarjas / $jumlahFieldNilai : 0;

                $rataRataBulat = round($rataRataNilai, 1);

                $baris['Total_Nilai_Garjas_Pria'] = $rataRataBulat;
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }
}
// ===================================TotalGarjasPria===================================

// ===================================TotalGarjasWanita===================================
class TotalGarjasWanita
{
    private $koneksi;

    public function __construct($database)
    {
        $this->koneksi = $database;
    }

    public function hitungDataWanita()
    {
        $query = "
            SELECT g.NIP_Pengguna,
                   COALESCE(g.Nilai_Chin_Up_Wanita, 0) AS Nilai_Chin_Up_Wanita,
                   COALESCE(g.Nilai_Push_Up_Wanita, 0) AS Nilai_Push_Up_Wanita,
                   COALESCE(g.Nilai_Shuttle_Run_Wanita, 0) AS Nilai_Shuttle_Run_Wanita,
                   COALESCE(g.Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita, 0) AS Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita,
                   COALESCE(g.Nilai_Sit_Up_Kaki_Lurus_Wanita, 0) AS Nilai_Sit_Up_Kaki_Lurus_Wanita,
                   p.Nama_Lengkap_Pengguna,
                   p.NIP_Pengguna,
                   p.Tanggal_Lahir_Pengguna,
                   p.Jabatan_Pengguna,
                   p.Jenis_Kelamin_Pengguna,
                   p.No_Telepon_Pengguna
            FROM (
                SELECT NIP_Pengguna,
                       SUM(Nilai_Chin_Up_Wanita) AS Nilai_Chin_Up_Wanita,
                       SUM(Nilai_Push_Up_Wanita) AS Nilai_Push_Up_Wanita,
                       SUM(Nilai_Shuttle_Run_Wanita) AS Nilai_Shuttle_Run_Wanita,
                       SUM(Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita) AS Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita,
                       SUM(Nilai_Sit_Up_Kaki_Lurus_Wanita) AS Nilai_Sit_Up_Kaki_Lurus_Wanita
                FROM (
                    SELECT NIP_Pengguna, Nilai_Chin_Up_Wanita, 0 AS Nilai_Push_Up_Wanita, 0 AS Nilai_Shuttle_Run_Wanita, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita, 0 AS Nilai_Sit_Up_Kaki_Lurus_Wanita FROM garjas_wanita_chin_up
                    UNION ALL
                    SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Wanita, Nilai_Push_Up_Wanita, 0 AS Nilai_Shuttle_Run_Wanita, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita, 0 AS Nilai_Sit_Up_Kaki_Lurus_Wanita FROM garjas_wanita_push_up
                    UNION ALL
                    SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Wanita, 0 AS Nilai_Push_Up_Wanita, Nilai_Shuttle_Run_Wanita, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita, 0 AS Nilai_Sit_Up_Kaki_Lurus_Wanita FROM garjas_wanita_shuttle_run
                    UNION ALL
                    SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Wanita, 0 AS Nilai_Push_Up_Wanita, 0 AS Nilai_Shuttle_Run_Wanita, Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita, 0 AS Nilai_Sit_Up_Kaki_Lurus_Wanita FROM garjas_wanita_sit_up_kaki_di_tekuk
                    UNION ALL
                    SELECT NIP_Pengguna, 0 AS Nilai_Chin_Up_Wanita, 0 AS Nilai_Push_Up_Wanita, 0 AS Nilai_Shuttle_Run_Wanita, 0 AS Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita, Nilai_Sit_Up_Kaki_Lurus_Wanita FROM garjas_wanita_sit_up_kaki_lurus
                ) AS g
                GROUP BY NIP_Pengguna
            ) AS g
            LEFT JOIN pengguna AS p ON g.NIP_Pengguna = p.NIP_Pengguna
        ";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            $totalNilai = 0;
            $jumlahBaris = 0;
            $nipAlreadyAdded = [];

            while ($baris = $result->fetch_assoc()) {
                if (!in_array($baris['NIP_Pengguna'], $nipAlreadyAdded)) {
                    $totalNilai += $baris['Nilai_Chin_Up_Wanita'];
                    $totalNilai += $baris['Nilai_Push_Up_Wanita'];
                    $totalNilai += $baris['Nilai_Shuttle_Run_Wanita'];
                    $totalNilai += $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita'];
                    $totalNilai += $baris['Nilai_Sit_Up_Kaki_Lurus_Wanita'];
                    $jumlahBaris++;
                    $nipAlreadyAdded[] = $baris['NIP_Pengguna'];
                }
                $baris['Total_Nilai_Garjas_Wanita'] = round($baris['Nilai_Chin_Up_Wanita'] + $baris['Nilai_Push_Up_Wanita'] + $baris['Nilai_Shuttle_Run_Wanita'] + $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita'] + $baris['Nilai_Sit_Up_Kaki_Lurus_Wanita'], 1);
                $data[] = $baris;
            }

            $jumlahFieldNilai = 5;
            $rataRataNilai = $jumlahBaris > 0 ? $totalNilai / $jumlahFieldNilai : 0;

            return [
                'data' => $data,
                'totalNilai' => $totalNilai,
                'rataRataNilai' => round($rataRataNilai, 1)
            ];
        } else {
            return [
                'data' => [],
                'totalNilai' => 0,
                'rataRataNilai' => 0
            ];
        }
    }


    public function tampilkanDataTotalGarjasWanita()
    {
        $query = "
        SELECT 
            pengguna.*,
            pengguna.NIP_Pengguna,
            garjas_wanita_push_up.*, 
            garjas_wanita_chin_up.*, 
            garjas_wanita_shuttle_run.*, 
            garjas_wanita_sit_up_kaki_di_tekuk.*, 
            garjas_wanita_sit_up_kaki_lurus.*
        FROM pengguna
        LEFT JOIN garjas_wanita_push_up ON pengguna.NIP_Pengguna = garjas_wanita_push_up.NIP_Pengguna
        LEFT JOIN garjas_wanita_chin_up ON pengguna.NIP_Pengguna = garjas_wanita_chin_up.NIP_Pengguna
        LEFT JOIN garjas_wanita_shuttle_run ON pengguna.NIP_Pengguna = garjas_wanita_shuttle_run.NIP_Pengguna
        LEFT JOIN garjas_wanita_sit_up_kaki_di_tekuk ON pengguna.NIP_Pengguna = garjas_wanita_sit_up_kaki_di_tekuk.NIP_Pengguna
        LEFT JOIN garjas_wanita_sit_up_kaki_lurus ON pengguna.NIP_Pengguna = garjas_wanita_sit_up_kaki_lurus.NIP_Pengguna
    ";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            $data = [];
            while ($baris = $result->fetch_assoc()) {
                $totalNilaiGarjas = 0;

                $totalNilaiGarjas += isset($baris['Nilai_Push_Up_Wanita']) ? $baris['Nilai_Push_Up_Wanita'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Chin_Up_Wanita']) ? $baris['Nilai_Chin_Up_Wanita'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Shuttle_Run_Wanita']) ? $baris['Nilai_Shuttle_Run_Wanita'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita']) ? $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita'] : 0;
                $totalNilaiGarjas += isset($baris['Nilai_Sit_Up_Kaki_Lurus_Wanita']) ? $baris['Nilai_Sit_Up_Kaki_Lurus_Wanita'] : 0;

                $jumlahFieldNilai = 5;
                $rataRataNilai = $jumlahFieldNilai > 0 ? $totalNilaiGarjas / $jumlahFieldNilai : 0;

                $rataRataBulat = round($rataRataNilai, 1);

                $baris['Total_Nilai_Garjas_Wanita'] = $rataRataBulat;
                $data[] = $baris;
            }
            return $data;
        } else {
            return null;
        }
    }
}
// ===================================TotalGarjasWanita===================================
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

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahAdmin($data)
    {
        $query = "INSERT INTO admin (NIP_Admin, Foto_Admin, Nama_Lengkap_Admin, Tanggal_Lahir_Admin, Umur_Admin, Alamat_Admin, No_Telepon_Admin, Jabatan_Admin, Jenis_Kelamin_Admin, Kata_Sandi_Admin, Konfirmasi_Kata_Sandi_Admin) VALUES (?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssissssss",
            $this->escapeString($data['NIP_Admin']),
            $this->escapeString($data['Foto_Admin']),
            $this->escapeString($data['Nama_Lengkap_Admin']),
            $this->escapeString($data['Tanggal_Lahir_Admin']),
            $this->escapeString($data['Umur_Admin']),
            $this->escapeString($data['Alamat_Admin']),
            $this->escapeString($data['Nomor_Telepon_Admin']),
            $this->escapeString($data['Jabatan_Admin']),
            $this->escapeString($data['Jenis_Kelamin_Admin']),
            $this->escapeString($data['Kata_Sandi_Admin']),
            $this->escapeString($data['Konfirmasi_Kata_Sandi_Admin']),
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

    public function tampilkanAdmin($nipAdmin)
    {
        $query = "SELECT * FROM admin WHERE NIP_Admin = ?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipAdmin);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    public function perbaruiAdmin($nipAdmin, $dataAdmin)
    {
        $sql = "UPDATE Admin SET 
                    Foto_Admin = ?, 
                    Nama_Lengkap_Admin = ?, 
                    Tanggal_Lahir_Admin = ?, 
                    Alamat_Admin = ?, 
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
            $dataAdmin['Alamat_Admin'],
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

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahPengguna($data)
    {
        $query = "INSERT INTO pengguna (NIP_Pengguna, Foto_Pengguna, Nama_Lengkap_Pengguna, Tanggal_Lahir_Pengguna, Umur_Pengguna, Alamat_Pengguna, No_Telepon_Pengguna, Jabatan_Pengguna, Jenis_Kelamin_Pengguna, Kata_Sandi_Pengguna, Konfirmasi_Kata_Sandi_Pengguna) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "isssissssss",
            $this->escapeString($data['NIP_Pengguna']),
            $this->escapeString($data['Foto_Pengguna']),
            $this->escapeString($data['Nama_Lengkap_Pengguna']),
            $this->escapeString($data['Tanggal_Lahir_Pengguna']),
            $this->escapeString($data['Umur_Pengguna']),
            $this->escapeString($data['Alamat_Pengguna']),
            $this->escapeString($data['No_Telepon_Pengguna']),
            $this->escapeString($data['Jabatan_Pengguna']),
            $this->escapeString($data['Jenis_Kelamin_Pengguna']),
            $this->escapeString($data['Kata_Sandi_Pengguna']),
            $this->escapeString($data['Konfirmasi_Kata_Sandi_Pengguna'])
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

    public function tampilkanPengguna($nipPengguna)
    {
        $query = "SELECT * FROM pengguna WHERE NIP_Pengguna = ?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipPengguna);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
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
                    Alamat_Pengguna = ?, 
                    Jabatan_Pengguna = ?, 
                    Jenis_Kelamin_Pengguna = ?, 
                    No_Telepon_Pengguna = ?, 
                    Umur_Pengguna = ? 
                WHERE NIP_Pengguna = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param(
            "sssssssii",
            $dataPengguna['Foto_Pengguna'],
            $dataPengguna['Nama_Lengkap_Pengguna'],
            $dataPengguna['Tanggal_Lahir_Pengguna'],
            $dataPengguna['Alamat_Pengguna'],
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

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasPushUpPria($data)
    {
        $query = "INSERT INTO garjas_pria_push_up (NIP_Pengguna, Jumlah_Push_Up_Pria, Nilai_Push_Up_Pria) VALUES (?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['NIP_Pengguna']),
            $this->escapeString($data['Jumlah_Push_Up_Pria']),
            $this->escapeString($data['Nilai_Push_Up_Pria'])
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

    public function tampilkanDataGarjasPriaPushUp()
    {
        $query = "SELECT garjas_pria_push_up.ID_Push_Up_Pria, garjas_pria_push_up.NIP_Pengguna,
                         pengguna.Nama_Lengkap_Pengguna, pengguna.Tanggal_Lahir_Pengguna, 
                         pengguna.Umur_Pengguna, pengguna.Alamat_Pengguna, 
                         pengguna.No_Telepon_Pengguna, pengguna.Jabatan_Pengguna, 
                         pengguna.Jenis_Kelamin_Pengguna, pengguna.Foto_Pengguna,
                         garjas_pria_push_up.Jumlah_Push_Up_Pria, garjas_pria_push_up.Nilai_Push_Up_Pria
                  FROM garjas_pria_push_up
                  LEFT JOIN pengguna ON garjas_pria_push_up.NIP_Pengguna = pengguna.NIP_Pengguna";

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
        $query = "UPDATE garjas_pria_push_up SET Jumlah_Push_Up_Pria=?, Nilai_Push_Up_Pria=? WHERE ID_Push_Up_Pria=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['Jumlah_Push_Up_Pria']),
            $this->escapeString($data['Nilai_Push_Up_Pria']),
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanGarjasPriaPushUp($id)
    {
        $query = "SELECT garjas_pria_push_up.ID_Push_Up_Pria, garjas_pria_push_up.NIP_Pengguna,
                        pengguna.Nama_Lengkap_Pengguna, pengguna.Tanggal_Lahir_Pengguna, 
                        pengguna.Umur_Pengguna, pengguna.Alamat_Pengguna, 
                        pengguna.No_Telepon_Pengguna, pengguna.Jabatan_Pengguna, 
                        pengguna.Jenis_Kelamin_Pengguna, pengguna.Foto_Pengguna,
                        garjas_pria_push_up.Jumlah_Push_Up_Pria, garjas_pria_push_up.Nilai_Push_Up_Pria
                FROM garjas_pria_push_up
                LEFT JOIN pengguna ON garjas_pria_push_up.NIP_Pengguna = pengguna.NIP_Pengguna
                WHERE garjas_pria_push_up.ID_Push_Up_Pria = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
// ===================================GARJAS PRIA PUSH UP===================================


// ===================================GARJAS PRIA SIT UP KAKI LURUS===================================
class GarjasPriaSitUpKakiLurus{

    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasPriaSitUp1($data)
    {
        $query = "INSERT INTO garjas_pria_sit_up_kaki_lurus (NIP_Pengguna, Jumlah_Sit_Up_Kaki_Lurus_Pria, Nilai_Sit_Up_Kaki_Lurus_Pria) VALUES (?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['NIP_Pengguna']),
            $this->escapeString($data['Jumlah_Sit_Up_Kaki_Lurus_Pria']),
            $this->escapeString($data['Nilai_Sit_Up_Kaki_Lurus_Pria'])
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
        $query = "SELECT garjas_pria_sit_up_kaki_lurus.ID_Sit_Up_Kaki_Lurus_Pria, garjas_pria_sit_up_kaki_lurus.NIP_Pengguna,
                        pengguna.Nama_Lengkap_Pengguna, pengguna.Tanggal_Lahir_Pengguna, 
                        pengguna.Umur_Pengguna, pengguna.Alamat_Pengguna, 
                        pengguna.No_Telepon_Pengguna, pengguna.Jabatan_Pengguna, 
                        pengguna.Jenis_Kelamin_Pengguna, pengguna.Foto_Pengguna,
                        garjas_pria_sit_up_kaki_lurus.Jumlah_Sit_up_Kaki_lurus_Pria, garjas_pria_sit_up_kaki_lurus.Nilai_Sit_Up_Kaki_Lurus_Pria
                FROM garjas_pria_sit_up_kaki_lurus
                LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna";

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

    public function tampilkanGarjasPriaSitUp1($id)
    {
        $query = "SELECT garjas_pria_sit_up_kaki_lurus.ID_Sit_Up_Kaki_Lurus_Pria, garjas_pria_sit_up_kaki_lurus.NIP_Pengguna,
                        pengguna.Nama_Lengkap_Pengguna, pengguna.Tanggal_Lahir_Pengguna, 
                        pengguna.Umur_Pengguna, pengguna.Alamat_Pengguna, 
                        pengguna.No_Telepon_Pengguna, pengguna.Jabatan_Pengguna, 
                        pengguna.Jenis_Kelamin_Pengguna, pengguna.Foto_Pengguna,
                        garjas_pria_sit_up_kaki_lurus.Jumlah_Sit_up_Kaki_lurus_Pria, garjas_pria_sit_up_kaki_lurus.Nilai_Sit_Up_Kaki_Lurus_Pria
                FROM garjas_pria_sit_up_kaki_lurus
                LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna
                WHERE garjas_pria_sit_up_kaki_lurus.ID_Sit_Up_Kaki_Lurus_Pria = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }


}
// ===================================GARJAS PRIA SIT UP KAKI LURUS===================================

// ===================================GARJAS WANITA PUSH UP===================================
class GarjasWanitaPushUp
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaPushUp($data)
    {
        $query = "INSERT INTO garjas_wanita_push_up (NIP_Pengguna, Jumlah_Push_Up_Wanita, Nilai_Push_Up_Wanita) VALUES (?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['NIP_Pengguna']),
            $this->escapeString($data['Jumlah_Push_Up_Wanita']),
            $this->escapeString($data['Nilai_Push_Up_Wanita'])
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
        $query = "SELECT garjas_wanita_push_up.ID_Wanita_Push_Up, garjas_wanita_push_up.NIP_Pengguna, pengguna.Nama_Lengkap_Pengguna, pengguna.Umur_Pengguna, garjas_wanita_push_up.Jumlah_Push_Up_Wanita, garjas_wanita_push_up.Nilai_Push_Up_Wanita
                  FROM garjas_wanita_push_up
                  LEFT JOIN pengguna ON garjas_wanita_push_up.NIP_Pengguna = pengguna.NIP_Pengguna";
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
        $query = "UPDATE garjas_wanita_push_up SET Jumlah_Push_Up_Wanita=?, Nilai_Push_Up_Wanita=? WHERE ID_Wanita_Push_Up=?";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['Jumlah_Push_Up_Wanita']),
            $this->escapeString($data['Nilai_Push_Up_Wanita']),
            $id
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
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

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaSitUp1($data)
    {
        $query = "INSERT INTO garjas_wanita_sit_up_kaki_lurus (NIP_Pengguna, Jumlah_Sit_Up_Kaki_Lurus_Wanita, Nilai_Sit_Up_Kaki_Lurus_Wanita) VALUES (?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['NIP_Pengguna']),
            $this->escapeString($data['Jumlah_Sit_Up_1_Wanita']),
            $this->escapeString($data['Nilai_Sit_Up_1_Wanita'])
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
        $query = "SELECT garjas_wanita_sit_up_kaki_lurus.ID_Wanita_Sit_Up_Kaki_Lurus, garjas_wanita_sit_up_kaki_lurus.NIP_Pengguna,
                         pengguna.Nama_Lengkap_Pengguna, pengguna.Tanggal_Lahir_Pengguna, 
                         pengguna.Umur_Pengguna, pengguna.Alamat_Pengguna, 
                         pengguna.No_Telepon_Pengguna, pengguna.Jabatan_Pengguna, 
                         pengguna.Jenis_Kelamin_Pengguna, pengguna.Foto_Pengguna,
                         garjas_wanita_sit_up_kaki_lurus.Jumlah_Sit_Up_Kaki_Lurus_Wanita, garjas_wanita_sit_up_kaki_lurus.Nilai_Sit_Up_Kaki_Lurus_Wanita
                  FROM garjas_wanita_sit_up_kaki_lurus
                  LEFT JOIN pengguna ON garjas_wanita_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna";
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

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaShuttleRun($data)
    {
        $query = "INSERT INTO garjas_wanita_shuttle_run (NIP_Pengguna, Jumlah_Shuttle_Run_Wanita, Nilai_Shuttle_Run_Wanita) VALUES (?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['NIP_Pengguna']),
            $this->escapeString($data['Jumlah_Shuttle_Run_Wanita']),
            $this->escapeString($data['Nilai_Shuttle_Run_Wanita'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
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
        $query = "SELECT garjas_wanita_shuttle_run.ID_Wanita_Shuttle_Run, garjas_wanita_shuttle_run.NIP_Pengguna,
                         pengguna.Nama_Lengkap_Pengguna, pengguna.Tanggal_Lahir_Pengguna, 
                         pengguna.Umur_Pengguna, pengguna.Alamat_Pengguna, 
                         pengguna.No_Telepon_Pengguna, pengguna.Jabatan_Pengguna, 
                         pengguna.Jenis_Kelamin_Pengguna, pengguna.Foto_Pengguna,
                         garjas_wanita_shuttle_run.Jumlah_Shuttle_Run_Wanita, garjas_wanita_shuttle_run.Nilai_Shuttle_Run_Wanita
                  FROM garjas_wanita_shuttle_run
                  LEFT JOIN pengguna ON garjas_wanita_shuttle_run.NIP_Pengguna = pengguna.NIP_Pengguna";
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

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaChinUp($data)
    {
        $query = "INSERT INTO garjas_wanita_chin_up (NIP_Pengguna, Jumlah_Chin_Up_Wanita, Nilai_Chin_Up_Wanita) VALUES (?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['NIP_Pengguna']),
            $this->escapeString($data['Jumlah_Chin_Up_Wanita']),
            $this->escapeString($data['Nilai_Chin_Up_Wanita'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
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
        $query = "SELECT garjas_wanita_chin_up.ID_Wanita_Chin_Up, garjas_wanita_chin_up.NIP_Pengguna,
                         pengguna.Nama_Lengkap_Pengguna, pengguna.Tanggal_Lahir_Pengguna, 
                         pengguna.Umur_Pengguna, pengguna.Alamat_Pengguna, 
                         pengguna.No_Telepon_Pengguna, pengguna.Jabatan_Pengguna, 
                         pengguna.Jenis_Kelamin_Pengguna, pengguna.Foto_Pengguna,
                         garjas_wanita_chin_up.Jumlah_Chin_Up_Wanita, garjas_wanita_chin_up.Nilai_Chin_Up_Wanita
                  FROM garjas_wanita_chin_up
                  LEFT JOIN pengguna ON garjas_wanita_chin_up.NIP_Pengguna = pengguna.NIP_Pengguna";
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

    private function escapeString($string)
    {
        return htmlspecialchars(mysqli_real_escape_string($this->koneksi, $string));
    }

    public function tambahGarjasWanitaSitUp2($data)
    {
        $query = "INSERT INTO garjas_wanita_sit_up_kaki_di_tekuk (NIP_Pengguna, Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita, Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita) VALUES (?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "iii",
            $this->escapeString($data['NIP_Pengguna']),
            $this->escapeString($data['Jumlah_Sit_Up_2_Wanita']),
            $this->escapeString($data['Nilai_Sit_Up_2_Wanita'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
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


    public function tampilkanDataGarjasPriaSitUpKakiLurus()
{
    $query = "SELECT garjas_pria_sit_up_kaki_lurus.ID_Sit_Up_Kaki_Lurus_Pria, garjas_pria_sit_up_kaki_lurus.NIP_Pengguna,
                     pengguna.Nama_Lengkap_Pengguna, pengguna.Tanggal_Lahir_Pengguna, 
                     pengguna.Umur_Pengguna, pengguna.Alamat_Pengguna, 
                     pengguna.No_Telepon_Pengguna, pengguna.Jabatan_Pengguna, 
                     pengguna.Jenis_Kelamin_Pengguna, pengguna.Foto_Pengguna,
                     garjas_pria_sit_up_kaki_lurus.Jumlah_Sit_up_Kaki_lurus_Pria, garjas_pria_sit_up_kaki_lurus.Nilai_Sit_Up_Kaki_Lurus_Pria
              FROM garjas_pria_sit_up_kaki_lurus
              LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna";

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
}
// ===================================GARJAS WANITA SIT UP DI TEKUK===================================
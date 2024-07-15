<?php
include 'connection.php';

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

    public function cariPengguna($nipPengguna)
    {
        $query = "SELECT * FROM pengguna WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
        return null;
    }


    public function autentikasiPengguna($nipPengguna, $kataSandiPengguna)
    {
        $query = "SELECT * FROM pengguna WHERE NIP_Pengguna = ?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $nipPengguna);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedKataSandiPengguna = $row['Kata_Sandi_Pengguna'];
            if (password_verify($kataSandiPengguna, $hashedKataSandiPengguna)) {
                return $row;
            }
        }
        return null;
    }

    function tampilkanPenggunaDenganSessionNip($nipSessionPengguna)
    {
        $nipSessionPengguna = intval($nipSessionPengguna);
        $query = "SELECT * FROM pengguna WHERE NIP_Pengguna = $nipSessionPengguna";
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

    public function tampilkanKompetensiDenganSessionNip($nipSessionPengguna)
    {
        $query = "SELECT kompetensi.*, pengguna.* 
                  FROM kompetensi 
                  LEFT JOIN pengguna ON kompetensi.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanModulSesuaiNIPHariSenin($tanggalSenin)
    {
        $query = "SELECT * FROM modul
                 WHERE modul.Tanggal_Terbit_Modul = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("s", $tanggalSenin);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanBMIDenganSessionNip($nipSessionPengguna)
    {
        $query = "SELECT bmi.*, pengguna.* 
                  FROM bmi 
                  LEFT JOIN pengguna ON bmi.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tambahKompetensiSesuaiNip($data)
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

    public function tampilkanKompetensi()
    {
        $query = "SELECT kompetensi.*, pengguna.* FROM kompetensi LEFT JOIN pengguna ON kompetensi.NIP_Pengguna = pengguna.NIP_Pengguna";
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

    public function tampilkanLariDenganSessionNipPria($nipSessionPengguna)
    {
        $query = "SELECT tes_lari_pria.*, pengguna.* 
                  FROM tes_lari_pria 
                  LEFT JOIN pengguna ON tes_lari_pria.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanLariDenganSessionNipWanita($nipSessionPengguna)
    {
        $query = "SELECT tes_lari_wanita.*, pengguna.* 
                  FROM tes_lari_wanita 
                  LEFT JOIN pengguna ON tes_lari_wanita.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanRenangDenganSessionNipPria($nipSessionPengguna)
    {
        $query = "SELECT tes_renang_pria.*, pengguna.* 
                  FROM tes_renang_pria 
                  LEFT JOIN pengguna ON tes_renang_pria.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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
    public function tampilkanRenangDenganSessionNipWanita($nipSessionPengguna)
    {
        $query = "SELECT tes_renang_wanita.*, pengguna.* 
                  FROM tes_renang_wanita 
                  LEFT JOIN pengguna ON tes_renang_wanita.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanJalanKakiDenganSessionNipPria($nipSessionPengguna)
    {
        $query = "SELECT tes_jalan_pria.*, pengguna.* 
                  FROM tes_jalan_pria 
                  LEFT JOIN pengguna ON tes_jalan_pria.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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
    public function tampilkanJalanKakiDenganSessionNipWanita($nipSessionPengguna)
    {
        $query = "SELECT tes_jalan_wanita.*, pengguna.* 
                  FROM tes_jalan_wanita 
                  LEFT JOIN pengguna ON tes_jalan_wanita.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanPushUpDenganSessionNipPria($nipSessionPengguna)
    {
        $query = "SELECT garjas_pria_push_up.*, pengguna.* 
                  FROM garjas_pria_push_up 
                  LEFT JOIN pengguna ON garjas_pria_push_up.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanPushUpDenganSessionNipWanita($nipSessionPengguna)
    {
        $query = "SELECT garjas_wanita_push_up.*, pengguna.* 
                  FROM garjas_wanita_push_up 
                  LEFT JOIN pengguna ON garjas_wanita_push_up.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanSitUp1DenganSessionNipPria($nipSessionPengguna)
    {
        $query = "SELECT garjas_pria_sit_up_kaki_lurus.*, pengguna.* 
                  FROM garjas_pria_sit_up_kaki_lurus 
                  LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanSitUp1DenganSessionNipWanita($nipSessionPengguna)
    {
        $query = "SELECT garjas_wanita_sit_up_kaki_lurus.*, pengguna.* 
                  FROM garjas_wanita_sit_up_kaki_lurus 
                  LEFT JOIN pengguna ON garjas_wanita_sit_up_kaki_lurus.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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



    public function tampilkanSitUp2DenganSessionNipPria($nipSessionPengguna)
    {
        $query = "SELECT garjas_pria_sit_up_kaki_di_tekuk.*, pengguna.* 
                  FROM garjas_pria_sit_up_kaki_di_tekuk 
                  LEFT JOIN pengguna ON garjas_pria_sit_up_kaki_di_tekuk.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanSitUp2DenganSessionNipWanita($nipSessionPengguna)
    {
        $query = "SELECT garjas_wanita_sit_up_kaki_di_tekuk.*, pengguna.* 
                  FROM garjas_wanita_sit_up_kaki_di_tekuk 
                  LEFT JOIN pengguna ON garjas_wanita_sit_up_kaki_di_tekuk.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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


    public function tampilkanChinUpDenganSessionNipPria($nipSessionPengguna)
    {
        $query = "SELECT garjas_pria_chin_up.*, pengguna.* 
                  FROM garjas_pria_chin_up 
                  LEFT JOIN pengguna ON garjas_pria_chin_up.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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


    public function tampilkanChinUpDenganSessionNipWanita($nipSessionPengguna)
    {
        $query = "SELECT garjas_wanita_chin_up.*, pengguna.* 
                  FROM garjas_wanita_chin_up 
                  LEFT JOIN pengguna ON garjas_wanita_chin_up.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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


    public function tampilkanShuttleRunDenganSessionNipPria($nipSessionPengguna)
    {
        $query = "SELECT garjas_pria_shuttle_run.*, pengguna.* 
                  FROM garjas_pria_shuttle_run 
                  LEFT JOIN pengguna ON garjas_pria_shuttle_run.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function tampilkanShuttleRunDenganSessionNipWanita($nipSessionPengguna)
    {
        $query = "SELECT garjas_wanita_shuttle_run.*, pengguna.* 
                  FROM garjas_wanita_shuttle_run 
                  LEFT JOIN pengguna ON garjas_wanita_shuttle_run.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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


    public function tampilkanFlexedArmHangDenganSessionNip($nipSessionPengguna)
    {
        $query = "SELECT garjas_pria_menggantung.*, pengguna.* 
                  FROM garjas_pria_menggantung 
                  LEFT JOIN pengguna ON garjas_pria_menggantung.NIP_Pengguna = pengguna.NIP_Pengguna 
                  WHERE pengguna.NIP_Pengguna = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $nipSessionPengguna);
        $stmt->execute();
        $result = $stmt->get_result();

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

    public function generateRandomCaptchaPengguna($length = 7)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $captcha = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $captcha .= $characters[mt_rand(0, $max)];
        }

        return $captcha;
    }

    public function perbaruiPengguna($nipPengguna, $dataPengguna)
    {
        $sql = "UPDATE pengguna SET 
                    Nama_Lengkap_Pengguna = ?, 
                    Tanggal_Lahir_Pengguna = ?, 
                    Jenis_Kelamin_Pengguna = ?, 
                    No_Telepon_Pengguna = ?, 
                    Umur_Pengguna = ? 
                WHERE NIP_Pengguna = ?";
        $stmt = $this->koneksi->prepare($sql);
        $stmt->bind_param(
            "ssssii",
            $dataPengguna['Nama_Lengkap_Pengguna'],
            $dataPengguna['Tanggal_Lahir_Pengguna'],
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

    public function perbaruiFotoPengguna($nipPengguna, $namaFotoBaru)
    {
        $sql = "UPDATE pengguna SET 
                    Foto_Pengguna = ? 
                WHERE NIP_Pengguna = ?";
        $stmt = $this->koneksi->prepare($sql);

        $stmt->bind_param("si", $namaFotoBaru, $nipPengguna);

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
}

// ===================================PENGGUNA===================================

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

        return $statement->execute();
    }

    public function hapusAbsensi($idAbsensi)
    {
        $query = "DELETE FROM absensi WHERE ID_Absensi=?";
        $statement = $this->koneksi->prepare($query);
        $statement->bind_param("i", $idAbsensi);
        return $statement->execute();
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

        return $stmt->execute();
    }

    public function getAbsensiByNIPAndDate($nip, $tanggal)
    {
        $query = "SELECT * FROM absensi WHERE NIP_Pengguna = ? AND Tanggal_Absensi = ?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("is", $nip, $tanggal);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateAbsensi($data, $nip, $tanggal)
    {
        $query = "UPDATE absensi SET 
              Jam_Absen = IFNULL(?, Jam_Absen), 
              Status_Absensi = ?,
              Hari_Absensi = ? 
              WHERE NIP_Pengguna = ? AND Tanggal_Absensi = ?";
        $stmt = $this->koneksi->prepare($query);
        $jamAbsen = isset($data['Jam_Absen']) ? $this->mengamankanString($data['Jam_Absen']) : null;
        $statusAbsensi = $this->mengamankanString($data['Status_Absensi']);
        $hariAbsensi = $this->mengamankanString($data['Hari_Absensi']);
        $nip = (int)$nip;

        $stmt->bind_param(
            "sssis",
            $jamAbsen,
            $statusAbsensi,
            $hariAbsensi,
            $nip,
            $tanggal
        );
        return $stmt->execute();
    }
}

// ===================================ABSENSI===================================


// ===================================HITUNG NILAI AKHIR===================================
class NilaiAkhir
{

    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function hitungDataSesuaiNIP($nipPengguna, $jenisKelamin)
    {
        if ($jenisKelamin === 'Pria') {
            $query = "
        SELECT g.NIP_Pengguna,
               COALESCE(g.Nilai_Chin_Up_Pria, 0) AS Nilai_Chin_Up_Pria,
               COALESCE(g.Nilai_Menggantung_Pria, 0) AS Nilai_Menggantung_Pria,
               COALESCE(g.Nilai_Push_Up_Pria, 0) AS Nilai_Push_Up_Pria,
               COALESCE(g.Nilai_Shuttle_Run_Pria, 0) AS Nilai_Shuttle_Run_Pria,
               COALESCE(g.Nilai_Sit_Up_Kaki_Di_Tekuk_Pria, 0) AS Nilai_Sit_Up_Kaki_Di_Tekuk_Pria,
               COALESCE(g.Nilai_Sit_Up_Kaki_Lurus_Pria, 0) AS Nilai_Sit_Up_Kaki_Lurus_Pria,
               COALESCE(t.Nilai_Lari_Pria, 0) AS tes_lari,
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
        LEFT JOIN tes_lari_pria AS t ON g.NIP_Pengguna = t.NIP_Pengguna
        WHERE g.NIP_Pengguna = ?
        ";
        } else {
            $query = "
        SELECT g.NIP_Pengguna,
               COALESCE(g.Nilai_Chin_Up_Wanita, 0) AS Nilai_Chin_Up_Wanita,
               COALESCE(g.Nilai_Push_Up_Wanita, 0) AS Nilai_Push_Up_Wanita,
               COALESCE(g.Nilai_Shuttle_Run_Wanita, 0) AS Nilai_Shuttle_Run_Wanita,
               COALESCE(g.Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita, 0) AS Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita,
               COALESCE(g.Nilai_Sit_Up_Kaki_Lurus_Wanita, 0) AS Nilai_Sit_Up_Kaki_Lurus_Wanita,
               COALESCE(t.Nilai_Lari_Wanita, 0) AS tes_lari,
               p.Nama_Lengkap_Pengguna
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
        LEFT JOIN tes_lari_wanita AS t ON g.NIP_Pengguna = t.NIP_Pengguna
        WHERE g.NIP_Pengguna = ?
        ";
        }

        try {
            $stmt = $this->koneksi->prepare($query);
            $stmt->bind_param("s", $nipPengguna);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $data = [];
                $totalNilai = 0;
                $totalTesLari = 0;
                $jumlahBaris = 0;
                $nipAlreadyAdded = [];

                while ($baris = $result->fetch_assoc()) {
                    if (!in_array($baris['NIP_Pengguna'], $nipAlreadyAdded)) {
                        if ($jenisKelamin === 'Pria') {
                            $totalNilai += $baris['Nilai_Chin_Up_Pria']
                                + $baris['Nilai_Menggantung_Pria']
                                + $baris['Nilai_Push_Up_Pria']
                                + $baris['Nilai_Shuttle_Run_Pria']
                                + $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria']
                                + $baris['Nilai_Sit_Up_Kaki_Lurus_Pria'];

                            $data[] = [
                                'NIP_Pengguna' => $baris['NIP_Pengguna'],
                                'Nilai_Chin_Up_Pria' => $baris['Nilai_Chin_Up_Pria'],
                                'Nilai_Push_Up_Pria' => $baris['Nilai_Push_Up_Pria'],
                                'Nilai_Shuttle_Run_Pria' => $baris['Nilai_Shuttle_Run_Pria'],
                                'Nilai_Sit_Up_Kaki_Di_Tekuk_Pria' => $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Pria'],
                                'Nilai_Sit_Up_Kaki_Lurus_Pria' => $baris['Nilai_Sit_Up_Kaki_Lurus_Pria'],
                                'Nilai_Menggantung_Pria' => $baris['Nilai_Menggantung_Pria'],
                                'tes_lari' => $baris['tes_lari'],
                                'Nama_Lengkap_Pengguna' => $baris['Nama_Lengkap_Pengguna']
                            ];

                            $jumlahBaris = 6;
                        } else {
                            $totalNilai += $baris['Nilai_Chin_Up_Wanita']
                                + $baris['Nilai_Push_Up_Wanita']
                                + $baris['Nilai_Shuttle_Run_Wanita']
                                + $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita']
                                + $baris['Nilai_Sit_Up_Kaki_Lurus_Wanita'];

                            $data[] = [
                                'NIP_Pengguna' => $baris['NIP_Pengguna'],
                                'Nilai_Chin_Up_Wanita' => $baris['Nilai_Chin_Up_Wanita'],
                                'Nilai_Push_Up_Wanita' => $baris['Nilai_Push_Up_Wanita'],
                                'Nilai_Shuttle_Run_Wanita' => $baris['Nilai_Shuttle_Run_Wanita'],
                                'Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita' => $baris['Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita'],
                                'Nilai_Sit_Up_Kaki_Lurus_Wanita' => $baris['Nilai_Sit_Up_Kaki_Lurus_Wanita'],
                                'tes_lari' => $baris['tes_lari'],
                                'Nama_Lengkap_Pengguna' => $baris['Nama_Lengkap_Pengguna']
                            ];
                            $jumlahBaris = 5;
                        }

                        if ($baris['tes_lari'] !== NULL) {
                            $totalTesLari += $baris['tes_lari'];
                        }
                        $nipAlreadyAdded[] = $baris['NIP_Pengguna'];
                    }
                }

                $rataRataNilai = $jumlahBaris > 0 ? $totalNilai / $jumlahBaris : 0;
                $rataRataNilai = round($rataRataNilai, 1);

                $nilaiTotal = ($totalTesLari + $rataRataNilai) / 2;
                $nilaiTotal = round($nilaiTotal, 1);


                return [
                    'data' => $data,
                    'totalNilai' => $totalNilai,
                    'rataRataNilai' => $rataRataNilai,
                    'totalTesLari' => $totalTesLari,
                    'nilaiTotal' => $nilaiTotal
                ];
            } else {
                return [
                    'data' => [],
                    'totalNilai' => 0,
                    'rataRataNilai' => 0,
                    'totalTesLari' => 0,
                    'nilaiTotal' => 0
                ];
            }
        } catch (Exception $e) {
            error_log('Error executing query: ' . $e->getMessage());
            return [
                'data' => [],
                'totalNilai' => 0,
                'rataRataNilai' => 0,
                'totalTesLari' => 0,
                'nilaiTotal' => 0
            ];
        }
    }
}
// ===================================HITUNG NILAI AKHIR===================================

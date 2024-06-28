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
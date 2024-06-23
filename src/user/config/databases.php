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
}

// ===================================PENGGUNA===================================
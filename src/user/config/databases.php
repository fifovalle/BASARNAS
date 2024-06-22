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
}

// ===================================PENGGUNA===================================
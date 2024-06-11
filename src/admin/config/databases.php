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
        $query = "INSERT INTO admin (Foto, Nama_Depan_Admin, Nama_Belakang_Admin, Nama_Pengguna_Admin, Email_Admin, Kata_Sandi, Konfirmasi_Kata_Sandi, No_Telepon_Admin, Jenis_Kelamin_Admin, Peran_Admin, Alamat_Admin, Status_Verifikasi_Admin, Token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement = $this->koneksi->prepare($query);
        $statement->bind_param(
            "sssssssssissi",
            $this->escapeString($data['Foto']),
            $this->escapeString($data['Nama_Depan_Admin']),
            $this->escapeString($data['Nama_Belakang_Admin']),
            $this->escapeString($data['Nama_Pengguna_Admin']),
            $this->escapeString($data['Email_Admin']),
            $this->escapeString($data['Kata_Sandi']),
            $this->escapeString($data['Konfirmasi_Kata_Sandi']),
            $this->escapeString($data['No_Telepon_Admin']),
            $this->escapeString($data['Jenis_Kelamin_Admin']),
            $this->escapeString($data['Peran_Admin']),
            $this->escapeString($data['Alamat_Admin']),
            $this->escapeString($data['Status_Verifikasi_Admin']),
            $this->escapeString($data['Token'])
        );

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

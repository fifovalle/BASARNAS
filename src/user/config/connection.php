<?php
session_start();
$urlSekarang = $_SERVER['REQUEST_URI'];
$akarUrl = "/BASARNAS/";

$namaserver = "localhost";
$namapengguna = "root";
$katasandi = "";
$database = "basarnas";
$koneksi = new mysqli($namaserver, $namapengguna, $katasandi, $database);

function apakahAktif($lokasi)
{
    global $urlSekarang, $akarUrl;
    $urlRelative = str_replace($akarUrl, '', $urlSekarang);
    return $urlRelative === $lokasi;
}

$_SESSION['gagal'] = $_SESSION['gagal'] ?? '';

function setPesanKesalahan($pesan_kesalahan)
{
    $_SESSION['gagal'] = $pesan_kesalahan;
}
function setPesanKeberhasilan($pesan_keberhasilan)
{
    $_SESSION['berhasil'] = $pesan_keberhasilan;
}

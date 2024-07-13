<?php
session_start();

$urlSekarang = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
$urlSekarang .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$akarUrl = "http://localhost/BASARNAS/";

$namaserver = "localhost";
$namapengguna = "root";
$katasandi = "";
$database = "basarnas_simore";
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

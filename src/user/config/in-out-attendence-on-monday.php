<?php
include 'databases.php';

if (isset($_POST['presensi_hadir']) || isset($_POST['presensi_selesai'])) {
    $nipPengguna = $_SESSION['NIP_Pengguna'];

    $timezone = new DateTimeZone('Asia/Bangkok');
    $waktuSekarang = new DateTime('now', $timezone);
    $jamSekarang = $waktuSekarang->format('H:i');
    $tanggalAbsensi = $waktuSekarang->format('Y-m-d');
    $hariAbsensi = 'Senin';
    $jamAbsen = $waktuSekarang->format('H:i:s');

    $statusAbsensi = '';
    $pesanBerhasil = '';
    $pesanGagal = '';
    $validAbsensi = false;
    $isUpdate = false;

    $absensiModel = new Absensi($koneksi);

    $absensiHariIni = $absensiModel->getAbsensiByNIPAndDate($nipPengguna, $tanggalAbsensi);

    if (isset($_POST['presensi_hadir'])) {
        if ($jamSekarang >= '06:30' && $jamSekarang <= '09:00') {
            $statusAbsensi = 'Hadir Pagi';
            $pesanBerhasil = "Anda berhasil melakukan absen pagi.";
            $validAbsensi = true;

            if ($absensiHariIni) {
                $isUpdate = true;
                $dataAbsensi = [
                    'Jam_Absen' => $jamAbsen,
                    'Status_Absensi' => ($absensiHariIni['Status_Absensi'] == 'Hadir Sore') ? 'Hadir' : 'Hadir Pagi',
                    'Hari_Absensi' => $hariAbsensi
                ];
            } else {
                $dataAbsensi = [
                    'NIP_Pengguna' => $nipPengguna,
                    'Tanggal_Absensi' => $tanggalAbsensi,
                    'Hari_Absensi' => $hariAbsensi,
                    'Jam_Absen' => $jamAbsen,
                    'Status_Absensi' => 'Hadir Pagi'
                ];
            }
        } else {
            $pesanGagal = "Absensi pagi tidak berhasil karena melewati waktu absen.";
        }
    } elseif (isset($_POST['presensi_selesai'])) {
        if ($jamSekarang >= '18:00' && $jamSekarang <= '20:00') {
            $statusAbsensi = 'Hadir Sore';
            $pesanBerhasil = "Anda berhasil melakukan absen sore.";
            $validAbsensi = true;

            if ($absensiHariIni) {
                $isUpdate = true;
                $dataAbsensi = [
                    'Jam_Absen' => $jamAbsen,
                    'Status_Absensi' => ($absensiHariIni['Status_Absensi'] == 'Hadir Pagi') ? 'Hadir' : 'Hadir Sore',
                    'Hari_Absensi' => $hariAbsensi
                ];
            } else {
                $dataAbsensi = [
                    'NIP_Pengguna' => $nipPengguna,
                    'Tanggal_Absensi' => $tanggalAbsensi,
                    'Hari_Absensi' => $hariAbsensi,
                    'Jam_Absen' => $jamAbsen,
                    'Status_Absensi' => 'Hadir Sore'
                ];
            }
        } else {
            $pesanGagal = "Absensi sore tidak berhasil karena melewati waktu absen.";
        }
    }

    if ($validAbsensi) {
        if ($isUpdate) {
            $simpanDataAbsensi = $absensiModel->updateAbsensi($dataAbsensi, $nipPengguna, $tanggalAbsensi);
        } else {
            $simpanDataAbsensi = $absensiModel->tambahAbsensi($dataAbsensi);
        }

        $simpanDataAbsensi ? setPesanKeberhasilan($pesanBerhasil) : setPesanKesalahan("Gagal menyimpan data absensi.");
    } else {
        setPesanKesalahan($pesanGagal);
    }

    header("Location: " . $akarUrl . "src/user/pages/pembelajaran.php");
    exit;
}

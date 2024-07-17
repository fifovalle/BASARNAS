<?php
require_once('../../../vendor/tecnickcom/tcpdf/tcpdf.php');
include('../config/databases.php');

class MYPDF extends TCPDF
{
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

function getNamaBulan($bulan)
{
    $namaBulan = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
        '04' => 'April', '05' => 'Mei', '06' => 'Juni',
        '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];
    return $namaBulan[$bulan];
}

$namaBulan = getNamaBulan($month);

$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Basarnas');
$pdf->SetTitle('Laporan Bulanan');
$pdf->SetSubject('Laporan Data Garjas Pria (Flexed Arm Hang)');

$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('helvetica', '', 10);

$pdf->AddPage();

$GarjasPriaMenggantungModel = new GarjasPriaFlexedArmHang($koneksi);
$GarjasPriaMenggantungInfo = $GarjasPriaMenggantungModel->tampilkanDataGarjasPriaFlexedArmHangBulan($month, $year);

$html = '
<style>
    .header-laporan{
        width: 5100%;
    }
    h1 {
        text-align: center;
        color: #4CAF50;
        font-family: Arial, sans-serif;
        margin-bottom: 20px;
    }
    .style-table {
        border-collapse: collapse;
        font-size: 12px;
        min-width: 400px;
        padding: 8px;
        font-weight: bold;
    }
    .style-table .header {
        background-color: #5dbb63;
        color: #ffffff;
        text-align: center;
    }
    .style-table .body {
        background-color: #f3f3f3;
        color: #000;
        text-align: center;
    }
    table th{
        border:1px solid white;
    }
</style>
<img class="header-laporan" src="../../user/assets/img/kepala-laporan-pria.png">
<hr style="color: #000">
<h1>Laporan Pria (Flexed Arm Hang) Bulan ' . $namaBulan . ' Tahun ' . $year . '</h1>
<table class="style-table">
<tr class="header">
    <th>NO</th>
    <th>NIP</th>
    <th>Tanggal Pelaksanaan</th>
    <th>Nama</th>
    <th>Umur</th>
    <th>Waktu</th>
    <th>Nilai</th>
</tr>';

if (!empty($GarjasPriaMenggantungInfo)) {
    $nomor = 1;
    foreach ($GarjasPriaMenggantungInfo as $garjasMenggantungPria) {
        $html .= '<tr class="body">
        <td>' . $nomor++ . '</td>
        <td>' . $garjasMenggantungPria['NIP_Pengguna'] . '</td>
        <td>' . $garjasMenggantungPria['Tanggal_Pelaksanaan_Pria_Menggantung'] . '</td>
        <td>' . $garjasMenggantungPria['Nama_Lengkap_Pengguna'] . '</td>
        <td>' . $garjasMenggantungPria['Umur_Pengguna'] . '</td>
        <td>' . $garjasMenggantungPria['Waktu_Menggantung_Pria'] . '</td>
        <td>' . $garjasMenggantungPria['Nilai_Menggantung_Pria'] . '</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="7" style="text-align: center; color: red;">Tidak ada data!</td></tr>';
}

$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('laporan_pria_flexed_arm_hang_bulanan_' . $namaBulan . '_' . $year . '.pdf', 'I');

<?php
require_once('../../../vendor/tecnickcom/tcpdf/tcpdf.php');
include('../config/databases.php');

class MYPDF extends TCPDF
{
    public function Header()
    {
        $image_file = '../../../user/assets/img/logo.png';
        $this->Image($image_file, 10, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 15, 'Laporan Data Garjas Pria (Lari 2400 M) Bulanan', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(10);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
$pdf->SetSubject('Laporan Data Garjas Pria (Lari 2400 M)');

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

$GarjasPriaLariModel = new TesLariPria($koneksi);
$GarjasPriaLariInfo = $GarjasPriaLariModel->tampilkanDataTesLariPriaPriaBulan($month, $year);

$html = '
<style>
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
<img class="header-invoice" src="" alt="">
<hr style="color: #999">
<h1>Laporan Bulan ' . $namaBulan . ' Tahun ' . $year . '</h1>
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

if (!empty($GarjasPriaLariInfo)) {
    $nomor = 1;
    foreach ($GarjasPriaLariInfo as $garjasLariPria) {
        $html .= '<tr class="body">
        <td>' . $nomor++ . '</td>
        <td>' . $garjasLariPria['NIP_Pengguna'] . '</td>
        <td>' . $garjasLariPria['Tanggal_Pelaksanaan_Tes_Lari_Pria'] . '</td>
        <td>' . $garjasLariPria['Nama_Lengkap_Pengguna'] . '</td>
        <td>' . $garjasLariPria['Umur_Pengguna'] . '</td>
        <td>' . $garjasLariPria['Waktu_Lari_Pria'] . '</td>
        <td>' . $garjasLariPria['Nilai_Lari_Pria'] . '</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="7" style="text-align: center; color: red;">Tidak ada data!</td></tr>';
}

$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

$capText = 'Dicetak pada: ' . date('d') . ' ' . $namaBulan . ' ' . $year;
$pdf->SetFont('times', 'B', 10);
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(10, -30);
$pdf->Cell(0, 10, $capText, 0, 1, 'L');

$pdf->Output('laporan_pria_lari_2400m_bulanan_' . $namaBulan . '_' . $year . '.pdf', 'I');

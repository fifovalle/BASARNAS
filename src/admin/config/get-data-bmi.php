<?php
include 'databases.php';

$bmiModel = new Bmi($koneksi);

$bmi = isset($_GET['bmi_id']) ? $_GET['bmi_id'] : null;
$dataBMI = $bmiModel->tampilkanDataBMI($bmi);

$bmiDitemukan = null;

foreach ($dataBMI as $bmiSaja) {
    $bmiDitemukan = $bmiSaja['ID_BMI'] == $bmi ? $bmiSaja : null;
    if ($bmiDitemukan) {
        break;
    }
}

echo json_encode($bmiDitemukan);

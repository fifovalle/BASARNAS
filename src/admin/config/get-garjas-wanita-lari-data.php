<?php
include 'databases.php';

$garjasTestLariWanitaModel = new TesLariWanita($koneksi);

$garjasTestLariWanitaID = isset($_GET['test_wanita_lari_id']) ? $_GET['test_wanita_lari_id'] : null;
$dataGarjasTestLariWanita = $garjasTestLariWanitaModel->tampilkanDataTesLariWanita($garjasTestLariWanitaID);

$garjasTestLariWanitaDitemukan = null;

foreach ($dataGarjasTestLariWanita as $garjasTestLariWanita) {
    $garjasTestLariWanitaDitemukan = $garjasTestLariWanita['ID_Lari_Wanita'] == $garjasTestLariWanitaID ? $garjasTestLariWanita : null;
    if ($garjasTestLariWanitaDitemukan) {
        break;
    }
}

echo json_encode($garjasTestLariWanitaDitemukan);


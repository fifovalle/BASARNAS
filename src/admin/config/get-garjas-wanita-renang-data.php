<?php
include 'databases.php';

$garjasTestRenangWanitaModel = new TesRenangWanita($koneksi);

$garjasTestRenangWanitaID = isset($_GET['test_wanita_renang_id']) ? $_GET['test_wanita_renang_id'] : null;
$dataGarjasTestRenangWanita = $garjasTestRenangWanitaModel->tampilkanDataTesRenangWanita($garjasTestRenangWanitaID);

$garjasTestRenangWanitaDitemukan = null;

foreach ($dataGarjasTestRenangWanita as $garjasTestRenangWanita) {
    $garjasTestRenangWanitaDitemukan = $garjasTestRenangWanita['ID_Renang_Wanita'] == $garjasTestRenangWanitaID ? $garjasTestRenangWanita : null;
    if ($garjasTestRenangWanitaDitemukan) {
        break;
    }
}

echo json_encode($garjasTestRenangWanitaDitemukan);

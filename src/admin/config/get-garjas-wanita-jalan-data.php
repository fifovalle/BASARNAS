<?php
include 'databases.php';

$garjasTestJalanWanitaModel = new TesJalanKaki5KMWanita($koneksi);

$garjasTestJalanWanitaID = isset($_GET['test_wanita_jalan_id']) ? $_GET['test_wanita_jalan_id'] : null;
$dataGarjasTestJalanWanita = $garjasTestJalanWanitaModel->tampilkanDataTesJalanKaki5KMWanita($garjasTestJalanWanitaID);

$garjasTestJalanWanitaDitemukan = null;

foreach ($dataGarjasTestJalanWanita as $garjasTestJalanWanita) {
    $garjasTestJalanWanitaDitemukan = $garjasTestJalanWanita['ID_Jalan_Wanita'] == $garjasTestJalanWanitaID ? $garjasTestJalanWanita : null;
    if ($garjasTestJalanWanitaDitemukan) {
        break;
    }
}

echo json_encode($garjasTestJalanWanitaDitemukan);

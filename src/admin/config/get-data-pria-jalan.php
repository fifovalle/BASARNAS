<?php
include 'databases.php';

$tesJalanPriaModel = new TesJalanKaki5KMPria($koneksi);

$priaJalan5KM = isset($_GET['pria_jalan_id']) ? $_GET['pria_jalan_id'] : null;
$dataPriaJalan5KM = $tesJalanPriaModel->tampilkanDataTesJalanKaki5KMPria($priaJalan5KM);

$priaJalanDitemukan = null;

foreach ($dataPriaJalan5KM as $priaJalan) {
    $priaJalanDitemukan = $priaJalan['ID_Tes_Jalan_Pria'] == $priaJalan5KM ? $priaJalan : null;
    if ($priaJalanDitemukan) {
        break;
    }
}

echo json_encode($priaJalanDitemukan);

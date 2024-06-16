<?php
include '../config/databases.php';

$garjasSitUp1PriaModel = new GarjasPriaSitUpKakiLurus($koneksi);
$garjasPriaSitUp1ID = isset($_GET['garjas_pria_situp_id']) ? $_GET['garjas_pria_situp_id'] : null;

if ($garjasPriaSitUp1ID) {
    $dataGarjasPriaSitUp1 = $garjasSitUp1PriaModel->tampilkanGarjasPriaSitUp1($garjasPriaSitUp1ID);

    if ($dataGarjasPriaSitUp1) {
        echo json_encode($dataGarjasPriaSitUp1);
    } else {
        echo json_encode(array("success" => false, "message" => "Garjas Pria Sit up kaki lurus dengan ID tersebut tidak ditemukan."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID Garjas Pria Sit up kaki lurus tidak diberikan."));
}
?>

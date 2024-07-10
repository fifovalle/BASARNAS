<?php
include '../config/databases.php';

$idSessionPengguna = $_SESSION['NIP_Pengguna'];
if (!isset($_SESSION['NIP_Pengguna'])) {
	setPesanKesalahan("Silahkan login terlebih dahulu!");
	header("Location: " . $akarUrl . "src/user/pages/login.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include('../partials/header.php');
	?>
	<link rel="stylesheet" href="../assets/css/nilai-akhir.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-nilaiakhir">
		<h1 class="nilaiakhir-title text-center">NILAI AKHIR AKUMULASI TEST</h1>
		<div class="table-responsive-sm">
			<table class="table">
				<thead class="table-header text-center">
					<tr>
						<th>Nomor</th>
						<th>Nilai Lari</th>
						<th>Nilai Garjas B</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center">
					<?php
					$nipSessionPengguna = $_SESSION['NIP_Pengguna'];
					$jenisKelamin = $_SESSION['Jenis_Kelamin_Pengguna'];
					$nilaiAkhirModel = new NilaiAkhir($koneksi);
					$nilaiAkhirInfo = $nilaiAkhirModel->hitungDataSesuaiNIP($nipSessionPengguna, $jenisKelamin);
					$nomorUrut = 0;
					if (!empty($nilaiAkhirInfo['data'])) {
						foreach ($nilaiAkhirInfo['data'] as $nilaiAkhir) {
					?>
							<tr>
								<td><?= ++$nomorUrut ?></td>
								<td><?= $nilaiAkhirInfo['totalTesLari'] ?></td>
								<td><?= $nilaiAkhirInfo['rataRataNilai'] ?></td>
								<td><?= $nilaiAkhirInfo['nilaiTotal'] ?></td>
							</tr>
					<?php
						}
					} else {
						echo "<tr><td colspan='5' class='text-center text-danger fw-bold'>Tidak ada nilai yang ditemukan!</td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</section>
	<?php
	include('../partials/footer.php');
	?>
	<script src="../assets/js/navbar.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
	<script src="../assets/js/notif-monday.js"></script>
	<script src="../assets/js/notif-wednesday.js"></script>
	<!-- ALERT -->
	<?php
	include('../partials/alert.php');
	?>
</body>

</html>
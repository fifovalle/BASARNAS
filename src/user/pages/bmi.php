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
	<link rel="stylesheet" href="../assets/css/bmi.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-bmi">
		<h1 class="bmi-title text-center">BODY MASS INDEX (BMI)</h1>
		<div class="dropdown">
			<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				Sort By Month
			</button>
			<ul class="dropdown-menu text-center">
				<li><a class="dropdown-item" href="#">Januari</a></li>
				<li><a class="dropdown-item" href="#">Februari</a></li>
				<li><a class="dropdown-item" href="#">Maret</a></li>
				<li><a class="dropdown-item" href="#">April</a></li>
				<li><a class="dropdown-item" href="#">Mei</a></li>
				<li><a class="dropdown-item" href="#">Juni</a></li>
				<li><a class="dropdown-item" href="#">Juli</a></li>
				<li><a class="dropdown-item" href="#">Agustus</a></li>
				<li><a class="dropdown-item" href="#">September</a></li>
				<li><a class="dropdown-item" href="#">Oktober</a></li>
				<li><a class="dropdown-item" href="#">November</a></li>
				<li><a class="dropdown-item" href="#">Desember</a></li>
			</ul>
		</div>
		<div class="table-responsive-sm">
			<table class="table">
				<thead class="table-header text-center">
					<tr>
						<th>Nomor</th>
						<th>Tanggal Pemeriksaan</th>
						<th>Umur</th>
						<th>Tinggi (cm)</th>
						<th>Berat (kg)</th>
						<th>Score</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center">
					<?php
					$nipSessionPengguna = $_SESSION['NIP_Pengguna'];
					$bmiModel = new Pengguna($koneksi);
					$bmiInfo = $bmiModel->tampilkanBMIDenganSessionNip($nipSessionPengguna);
					$nomorUrut = 0;
					if (!empty($bmiInfo)) {
						foreach ($bmiInfo as $bmi) {
					?>
							<tr>
								<td><?= ++$nomorUrut ?></td>
								<td><?= $bmi['Tanggal_Pemeriksaan'] ?></td>
								<td><?= $bmi['Umur_Pengguna'] ?></td>
								<td><?= $bmi['Tinggi_BMI'] ?></td>
								<td><?= $bmi['Berat_BMI'] ?></td>
								<td><?= $bmi['Skor'] ?></td>
								<td>
									<?php
									echo $bmi['Keterangan'] == "Berat Badan Kurang"
										? "<span class='badge bg-danger'>Kurus</span>"
										: ($bmi['Keterangan'] == "Berat Badan Normal"
											? "<span class='badge bg-success'>Ideal</span>"
											: ($bmi['Keterangan'] == "Berat Badan Lebih"
												? "<span class='badge bg-primary'>Gemuk</span>"
												: "<span class='badge bg-warning'>Obesitas</span>"));
									?>
								</td>
							</tr>
					<?php
						}
					} else {
						echo "<tr><td colspan='9' class='text-center text-danger fw-bold'>Tidak ada data bmi yang ditemukan!</td></tr>";
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
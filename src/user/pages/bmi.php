<?php
include '../config/databases.php';

$idSesiPengguna = $_SESSION['NIP_Pengguna'];
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

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-bmi">
		<h1 class="bmi-title text-center">BODY MASS INDEX (BMI)</h1>
		<div class="dropdown" id="dropdownBulan">
			<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				Pilih Bulan
			</button>
			<ul class="dropdown-menu text-center">
				<li><a class="dropdown-item" href="#" data-bulan="01">Januari</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="02">Februari</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="03">Maret</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="04">April</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="05">Mei</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="06">Juni</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="07">Juli</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="08">Agustus</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="09">September</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="10">Oktober</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="11">November</a></li>
				<li><a class="dropdown-item" href="#" data-bulan="12">Desember</a></li>
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
						<th>Skor</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center" id="bmiTabelBody">
					<?php
					$nipSesiPengguna = $_SESSION['NIP_Pengguna'];
					$bmiModel = new Pengguna($koneksi);
					$bmiInfo = $bmiModel->tampilkanBMIDenganSessionNip($nipSesiPengguna);
					$nomorUrut = 0;
					if (!empty($bmiInfo)) {
						foreach ($bmiInfo as $bmi) {
							$bulanPemeriksaan = date('m', strtotime($bmi['Tanggal_Pemeriksaan']));
					?>
							<tr class="bmi-baris" data-bulan="<?= $bulanPemeriksaan ?>">
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
						echo "<tr id='barisTidakAdaData'><td colspan='7' class='text-center text-danger fw-bold'>Tidak ada data bmi yang ditemukan!</td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</section>
	<?php
	include('../partials/footer.php');
	?>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
	<script src="../assets/js/navbar.js"></script>
	<script src="../assets/js/notif-monday.js"></script>
	<script src="../assets/js/notif-wednesday.js"></script>
	<!-- ALERT -->
	<?php
	include('../partials/alert.php');
	?>
	<script>
		$(document).ready(function() {
			$('#dropdownBulan .dropdown-item').on('click', function() {
				let bulan = $(this).data('bulan');
				let jumlahBaris = 0;

				$('.bmi-baris').each(function() {
					let bulanBaris = $(this).data('bulan');
					if (bulanBaris == bulan) {
						$(this).show();
						jumlahBaris++;
					} else {
						$(this).hide();
					}
				});

				$('#barisTidakAdaData').remove();

				if (jumlahBaris == 0) {
					$('#bmiTabelBody').append("<tr id='barisTidakAdaData'><td colspan='7' class='text-center text-danger fw-bold'>Tidak ada data bmi yang ditemukan!</td></tr>");
				}
			});
		});
	</script>
</body>

</html>
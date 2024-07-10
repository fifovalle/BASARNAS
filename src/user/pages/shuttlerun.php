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
	<link rel="stylesheet" href="../assets/css/shuttlerun.css">
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-samapta">
		<h1 class="samapta-title text-center">SAMAPTA (Shuttle Run)
		</h1>
		<div class="btn-group">
			<div class="dropdown pe-2">
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
		</div>
		<div class="table-responsive-sm">
			<table class="table">
				<thead class="table-header text-center">
					<tr>
						<th>Nomor</th>
						<th>Tanggal Pelaksanaan</th>
						<th>Waktu (detik)</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center" id="shuttlerunTabelBody">
					<?php
					$nipSessionPengguna = $_SESSION['NIP_Pengguna'];
					$shuttleRunModel = new Pengguna($koneksi);
					$queryJenisKelamin = "SELECT Jenis_Kelamin_Pengguna FROM pengguna WHERE NIP_Pengguna = ?";
					$stmtJenisKelamin = $koneksi->prepare($queryJenisKelamin);
					$stmtJenisKelamin->bind_param("i", $nipSessionPengguna);
					$stmtJenisKelamin->execute();
					$resultJenisKelamin = $stmtJenisKelamin->get_result();
					$pengguna = $resultJenisKelamin->fetch_assoc();
					$jenisKelamin = $pengguna['Jenis_Kelamin_Pengguna'];
					$nomorUrut = 0;
					if ($jenisKelamin == 'Pria') {
						$shuttleRunInfo = $shuttleRunModel->tampilkanShuttleRunDenganSessionNipPria($nipSessionPengguna);
						$waktuField = 'Waktu_Shuttle_Run_Pria';
						$nilaiField = 'Nilai_Shuttle_Run_Pria';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Shuttle_Run_Pria';
					} elseif ($jenisKelamin == 'Wanita') {
						$shuttleRunInfo = $shuttleRunModel->tampilkanShuttleRunDenganSessionNipWanita($nipSessionPengguna);
						$waktuField = 'Waktu_Shuttle_Run_Wanita';
						$nilaiField = 'Nilai_Shuttle_Run_Wanita';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Shuttle_Run_Wanita';
					} else {
						$shuttleRunInfo = null;
					}

					if (!empty($shuttleRunInfo)) {
						foreach ($shuttleRunInfo as $shuttleRun) {
							$nomorUrut++;
					?>
							<tr class="shuttlerun-baris" data-bulan="<?php echo date('m', strtotime($shuttleRun[$tanggalPelaksanaanField])); ?>">
								<td><?php echo $nomorUrut; ?></td>
								<td><?php echo htmlspecialchars($shuttleRun[$tanggalPelaksanaanField]); ?></td>
								<td><?php echo htmlspecialchars($shuttleRun[$waktuField]); ?></td>
								<td><?php echo htmlspecialchars($shuttleRun[$nilaiField]); ?></td>
							</tr>
					<?php
						}
					} else {
						echo '<tr id="barisTidakAdaData"><td colspan="4" class="text-center text-danger fw-bold">Tidak ada data Shuttle Run.</td></tr>';
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
	<script>
		$(document).ready(function() {
			$('.dropdown-item').on('click', function() {
				let bulan = $(this).data('bulan');
				let jumlahBaris = 0;

				$('.shuttlerun-baris').each(function() {
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
					$('#shuttlerunTabelBody').append("<tr id='barisTidakAdaData'><td colspan='4' class='text-center text-danger fw-bold'>Tidak ada data Shuttle Run yang ditemukan!</td></tr>");
				}
			});

		});
	</script>
</body>

</html>
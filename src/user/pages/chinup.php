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
	<link rel="stylesheet" href="../assets/css/chinup.css">
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-samapta">
		<h1 class="samapta-title text-center">SAMAPTA (Chin Up)
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
						<th>Jumlah Chin Up</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center" id="chinUpTabelBody">
					<?php
					$nipSessionPengguna = $_SESSION['NIP_Pengguna'];
					$chinUpModel = new Pengguna($koneksi);
					$queryJenisKelamin = "SELECT Jenis_Kelamin_Pengguna FROM pengguna WHERE NIP_Pengguna = ?";
					$stmtJenisKelamin = $koneksi->prepare($queryJenisKelamin);
					$stmtJenisKelamin->bind_param("i", $nipSessionPengguna);
					$stmtJenisKelamin->execute();
					$resultJenisKelamin = $stmtJenisKelamin->get_result();
					$pengguna = $resultJenisKelamin->fetch_assoc();
					$jenisKelamin = $pengguna['Jenis_Kelamin_Pengguna'];
					$nomorUrut = 0;
					if ($jenisKelamin == 'Pria') {
						$chinUpInfo = $chinUpModel->tampilkanChinUpDenganSessionNipPria($nipSessionPengguna);
						$jumlahField = 'Jumlah_Chin_Up_Pria';
						$nilaiField = 'Nilai_Chin_Up_Pria';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Chin_Up_Pria';
					} elseif ($jenisKelamin == 'Wanita') {
						$chinUpInfo = $chinUpModel->tampilkanChinUpDenganSessionNipWanita($nipSessionPengguna);
						$jumlahField = 'Jumlah_Chin_Up_Wanita';
						$nilaiField = 'Nilai_Chin_Up_Wanita';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Chin_Up_Wanita';
					} else {
						$chinUpInfo = null;
					}

					if (!empty($chinUpInfo)) {
						foreach ($chinUpInfo as $chinUp) {
							$nomorUrut++;
					?>
							<tr>
							<tr class="chinUp-baris" data-bulan="<?php echo date('m', strtotime($chinUp[$tanggalPelaksanaanField])); ?>">
								<td><?php echo $nomorUrut; ?></td>
								<td><?php echo htmlspecialchars($chinUp[$tanggalPelaksanaanField]); ?></td>
								<td><?php echo htmlspecialchars($chinUp[$jumlahField]); ?></td>
								<td><?php echo htmlspecialchars($chinUp[$nilaiField]); ?></td>
							</tr>
					<?php
						}
					} else {
						echo '<tr id="barisTidakAdaData"><td colspan="5" style="text-align: center; color: red; font-weight: bold;">Tidak ada data Chin Up.</td></tr>';
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

				$('.chinUp-baris').each(function() {
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
					$('#chinUpTabelBody').append("<tr id='barisTidakAdaData'><td colspan='5' class='text-center text-danger fw-bold'>Tidak ada data Chin Up.</td></tr>");
				}
			});

		});
	</script>
</body>

</html>
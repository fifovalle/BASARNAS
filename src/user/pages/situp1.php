<?php
include '../config/databases.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include('../partials/header.php');
	?>
	<link rel="stylesheet" href="../assets/css/situp1.css">
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-samapta">
		<h1 class="samapta-title text-center">SAMAPTA (Sit Up Kaki Lurus)
		</h1>
		<div class="btn-group">
			<div class="dropdown pe-2">
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
			<div class="dropdown ps-2">
				<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
					Sort By Year
				</button>
				<ul class="dropdown-menu text-center">
					<li><a class="dropdown-item" href="#">2024</a></li>
					<li><a class="dropdown-item" href="#">2025</a></li>
					<li><a class="dropdown-item" href="#">2026</a></li>
				</ul>
			</div>
		</div>
		<div class="table-responsive-sm">
			<table class="table">
				<thead class="table-header text-center">
					<tr>
						<th>Nomor</th>
						<th>Tanggal Pelaksanaan</th>
						<th>Kegiatan</th>
						<th>Jumlah Sit Up</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center">
					<?php
					$nipSessionPengguna = $_SESSION['NIP_Pengguna'];
					$sitUp1Model = new Pengguna($koneksi);
					$queryJenisKelamin = "SELECT Jenis_Kelamin_Pengguna FROM pengguna WHERE NIP_Pengguna = ?";
					$stmtJenisKelamin = $koneksi->prepare($queryJenisKelamin);
					$stmtJenisKelamin->bind_param("i", $nipSessionPengguna);
					$stmtJenisKelamin->execute();
					$resultJenisKelamin = $stmtJenisKelamin->get_result();
					$pengguna = $resultJenisKelamin->fetch_assoc();
					$jenisKelamin = $pengguna['Jenis_Kelamin_Pengguna'];
					$nomorUrut = 0;
					if ($jenisKelamin == 'Pria') {
						$sitUp1Info = $sitUp1Model->tampilkanSitUp1DenganSessionNipPria($nipSessionPengguna);
						$jumlahField = 'Jumlah_Sit_Up_Kaki_Lurus_Pria';
						$nilaiField = 'Nilai_Sit_Up_Kaki_Lurus_Pria';
					} elseif ($jenisKelamin == 'Wanita') {
						$sitUp1Info = $sitUp1Model->tampilkanSitUp1DenganSessionNipWanita($nipSessionPengguna);
						$jumlahField = 'Jumlah_Sit_Up_Kaki_Lurus_Wanita';
						$nilaiField = 'Nilai_Sit_Up_Kaki_Lurus_Wanita';
					} else {
						$sitUp1Info = null;
					}

					if (!empty($sitUp1Info)) {
						foreach ($sitUp1Info as $sitUp1) {
							$nomorUrut++;
					?>
							<tr>
								<td><?php echo $nomorUrut; ?></td>
								<td>2024-06-08</td>
								<td>Sit Up Kaki Lurus</td>
								<td><?php echo htmlspecialchars($sitUp1[$jumlahField]); ?></td>
								<td><?php echo htmlspecialchars($sitUp1[$nilaiField]); ?></td>
							</tr>
					<?php
						}
					} else {
						echo '<tr><td colspan="5" style="text-align: center; color: red; font-weight: bold;">Tidak ada data Sit Up Kaki Lurus.</td></tr>';
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
</body>

</html>
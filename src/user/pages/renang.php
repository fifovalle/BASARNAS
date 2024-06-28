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
	<link rel="stylesheet" href="../assets/css/renang.css">
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-samapta">
		<h1 class="samapta-title text-center">SAMAPTA (Renang 50 M)
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
						<th>Nama Gaya Renang</th>
						<th>Waktu Renang</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center">
					<?php
					$nipSessionPengguna = $_SESSION['NIP_Pengguna'];
					$renangModel = new Pengguna($koneksi);
					$queryJenisKelamin = "SELECT Jenis_Kelamin_Pengguna FROM pengguna WHERE NIP_Pengguna = ?";
					$stmtJenisKelamin = $koneksi->prepare($queryJenisKelamin);
					$stmtJenisKelamin->bind_param("i", $nipSessionPengguna);
					$stmtJenisKelamin->execute();
					$resultJenisKelamin = $stmtJenisKelamin->get_result();
					$pengguna = $resultJenisKelamin->fetch_assoc();
					$jenisKelamin = $pengguna['Jenis_Kelamin_Pengguna'];
					$nomorUrut = 0;
					if ($jenisKelamin == 'Pria') {
						$renangInfo = $renangModel->tampilkanRenangDenganSessionNipPria($nipSessionPengguna);
						$gayaField = 'Nama_Gaya_Renang_Pria';
						$waktuField = 'Waktu_Renang_Pria';
						$nilaiField = 'Nilai_Renang_Pria';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Tes_Renang_Pria';
					} elseif ($jenisKelamin == 'Wanita') {
						$renangInfo = $renangModel->tampilkanRenangDenganSessionNipWanita($nipSessionPengguna);
						$gayaField = 'Nama_Gaya_Renang_Wanita';
						$waktuField = 'Waktu_Renang_Wanita';
						$nilaiField = 'Nilai_Renang_Wanita';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Tes_Renang_Wanita';
					} else {
						$renangInfo = null;
					}

					if (!empty($renangInfo)) {
						foreach ($renangInfo as $renang) {
							$nomorUrut++;
					?>
							<tr>
								<td>1</td>
								<td><?php echo htmlspecialchars($renang[$tanggalPelaksanaanField]); ?></td>
								<td><?php echo htmlspecialchars($renang[$gayaField]); ?></td>
								<td><?php echo htmlspecialchars($renang[$waktuField]); ?></td>
								<td><?php echo htmlspecialchars($renang[$nilaiField]); ?></td>
							</tr>
					<?php
						}
					} else {
						echo '<tr><td colspan="5" style="text-align: center; color: red; font-weight: bold;">Tidak ada data renang.</td></tr>';
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
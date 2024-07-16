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
		<h1 class="samapta-title text-center">SAMAPTA (Renang 50 M)</h1>
		<div class="d-flex align-items-center">
			<div class="dropdown pe-2" id="dropdownBulan">
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
			<button class="btn btn-round ms-auto tombol-tambah" data-bs-toggle="modal" data-bs-target="#tambahGarjasRenang">
				<i class="fa fa-plus"></i>
				Tambah Data
			</button>
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
				<tbody class="table-group-divider text-center" id="renangTabelBody">
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
						$statusField = 'Status_Renang_Pria';
					} elseif ($jenisKelamin == 'Wanita') {
						$renangInfo = $renangModel->tampilkanRenangDenganSessionNipWanita($nipSessionPengguna);
						$gayaField = 'Nama_Gaya_Renang_Wanita';
						$waktuField = 'Waktu_Renang_Wanita';
						$nilaiField = 'Nilai_Renang_Wanita';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Tes_Renang_Wanita';
						$statusField = 'Status_Renang_Wanita';
					} else {
						$renangInfo = null;
					}

					if (!empty($renangInfo)) {
						foreach ($renangInfo as $renang) {
							$bulan = date('m', strtotime($renang[$tanggalPelaksanaanField]));
							$nomorUrut++;
							if (isset($renang[$statusField])) {
								if ($renang[$statusField] == 'Ditolak') {
									echo '<tr id="barisDitolak"><td colspan="5" style="text-align: center; color: red; font-weight: bold;">Data Anda telah ditolak, silahkan ajukan ulang.</td></tr>';
								} elseif ($renang[$statusField] == 'Ditinjau') {
									echo '<tr id="barisDitinjau"><td colspan="5" style="text-align: center; color: red; font-weight: bold;">Data Anda sedang ditinjau oleh admin.</td></tr>';
								} else {
					?>
									<tr class="renang-baris" data-bulan="<?php echo $bulan; ?>">
										<td><?php echo $nomorUrut; ?></td>
										<td><?php echo htmlspecialchars($renang[$tanggalPelaksanaanField]); ?></td>
										<td><?php echo htmlspecialchars($renang[$gayaField]); ?></td>
										<td><?php echo htmlspecialchars($renang[$waktuField]); ?></td>
										<td><?php echo htmlspecialchars($renang[$nilaiField]); ?></td>
										<td><?php echo htmlspecialchars($renang[$statusField]); ?></td>
									</tr>
					<?php
								}
							}
						}
					} else {
						echo '<tr id="barisTidakAdaData"><td colspan="10" style="text-align: center; color: red; font-weight: bold;">Tidak ada data renang.</td></tr>';
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
			$('#dropdownBulan .dropdown-item').on('click', function() {
				let bulan = $(this).data('bulan');
				let jumlahBaris = 0;

				$('.renang-baris').each(function() {
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
					$('#renangTabelBody').append(
						"<tr id='barisTidakAdaData'><td colspan='5' class='text-center text-danger fw-bold'>Tidak ada data renang.</td></tr>"
					);
				}
			});

		});
	</script>
	<!-- MODALS START -->
	<?php include('../partials/modal-add-garjas-renang.php'); ?>
	<!-- MODALS END -->
</body>

</html>
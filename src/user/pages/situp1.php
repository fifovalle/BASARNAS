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
	<link rel="stylesheet" href="../assets/css/situp1.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-samapta">
		<h1 class="samapta-title text-center">SAMAPTA (Sit Up Kaki Lurus)
		</h1>
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
			<button class="btn btn-round ms-auto tombol-tambah" data-bs-toggle="modal" data-bs-target="#tambahGarjasSitUp1">
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
						<th>Jumlah Sit Up</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center" id="situp1TabelBody">
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
					$statusField = '';
					if ($jenisKelamin == 'Pria') {
						$sitUp1Info = $sitUp1Model->tampilkanSitUp1DenganSessionNipPria($nipSessionPengguna);
						$jumlahField = 'Jumlah_Sit_Up_Kaki_Lurus_Pria';
						$nilaiField = 'Nilai_Sit_Up_Kaki_Lurus_Pria';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria';
						$statusField = 'Status_Pria_Sit_Up_Kaki_Lurus';
					} elseif ($jenisKelamin == 'Wanita') {
						$sitUp1Info = $sitUp1Model->tampilkanSitUp1DenganSessionNipWanita($nipSessionPengguna);
						$jumlahField = 'Jumlah_Sit_Up_Kaki_Lurus_Wanita';
						$nilaiField = 'Nilai_Sit_Up_Kaki_Lurus_Wanita';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita';
						$statusField = 'Status_Wanita_Sit_Up_Kaki_Lurus';
					} else {
						$sitUp1Info = null;
					}

					if (!empty($sitUp1Info)) {
						foreach ($sitUp1Info as $sitUp1) {
							if (isset($sitUp1[$statusField])) {
								if ($sitUp1[$statusField] == 'Ditolak') {
									echo '<tr id="barisDitolak"><td colspan="4" style="text-align: center; color: red; font-weight: bold;">Data anda telah ditolak silahkan ajukan ulang.</td></tr>';
								} elseif ($sitUp1[$statusField] == 'Ditinjau') {
									echo '<tr id="barisDitinjau"><td colspan="4" style="text-align: center; color: red; font-weight: bold;">Data anda sedang ditinjau oleh admin.</td></tr>';
								} else {
									$nomorUrut++;
					?>
									<tr class="situp1-baris" data-bulan="<?php echo date('m', strtotime($sitUp1[$tanggalPelaksanaanField])); ?>">
										<td><?php echo $nomorUrut; ?></td>
										<td><?php echo htmlspecialchars($sitUp1[$tanggalPelaksanaanField]); ?></td>
										<td><?php echo htmlspecialchars($sitUp1[$jumlahField]); ?></td>
										<td><?php echo htmlspecialchars($sitUp1[$nilaiField]); ?></td>
									</tr>
					<?php
								}
							}
						}
					} else {
						echo '<tr id="barisTidakAdaData"><td colspan="5" style="text-align: center; color: red; font-weight: bold;">Tidak ada data Sit Up Kaki Lurus.</td></tr>';
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
	<!-- ALERT -->
	<?php
	include('../partials/alert.php');
	?>
	<script>
		$(document).ready(function() {
			$('.dropdown-item').on('click', function() {
				let bulan = $(this).data('bulan');
				let jumlahBaris = 0;

				$('.situp1-baris').each(function() {
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
					$('#situp1TabelBody').append("<tr id='barisTidakAdaData'><td colspan='5' class='text-center text-danger fw-bold'>Tidak ada data Sit Up Kaki Lurus.</td></tr>");
				}
			});

		});
	</script>
	<!-- MODALS START -->
	<?php include('../partials/modal-add-garjas-situp1.php'); ?>
	<!-- MODALS END -->
</body>

</html>
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
		<h1 class="samapta-title text-center">SAMAPTA (Sit Up Kaki Ditekuk)
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
			<button class="btn btn-round ms-auto tombol-tambah" data-bs-toggle="modal" data-bs-target="#tambahGarjasSitUp2">
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
				<tbody class="table-group-divider text-center" id="situp2TabelBody">
					<?php
					$nipSessionPengguna = $_SESSION['NIP_Pengguna'];
					$sitUp2Model = new Pengguna($koneksi);
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
						$sitUp2Info = $sitUp2Model->tampilkanSitUp2DenganSessionNipPria($nipSessionPengguna);
						$jumlahField = 'Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria';
						$nilaiField = 'Nilai_Sit_Up_Kaki_Di_Tekuk_Pria';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk';
						$statusField = 'Status_Pria_Sit_Up_Kaki_Ditekuk';
					} elseif ($jenisKelamin == 'Wanita') {
						$sitUp2Info = $sitUp2Model->tampilkanSitUp2DenganSessionNipWanita($nipSessionPengguna);
						$jumlahField = 'Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita';
						$nilaiField = 'Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita';
						$tanggalPelaksanaanField = 'Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita';
						$statusField = 'Status_Wanita_Sit_Up_Kaki_Ditekuk';
					} else {
						$sitUp2Info = null;
					}

					if (!empty($sitUp2Info)) {
						foreach ($sitUp2Info as $sitUp2) {
							if (isset($sitUp2[$statusField])) {
								if ($sitUp2[$statusField] == 'Ditolak') {
									echo '<tr id="barisTidakAdaData"><td colspan="4" style="text-align: center; color: red; font-weight: bold;">Data anda telah ditolak silahkan ajukan ulang.</td></tr>';
								} elseif ($sitUp2[$statusField] == 'Ditinjau') {
									echo '<tr id="barisTidakAdaData"><td colspan="4" style="text-align: center; color: red; font-weight: bold;">Data anda sedang ditinjau oleh admin.</td></tr>';
								} else {
									$nomorUrut++;
					?>
									<tr>
									<tr class="situp2-baris" data-bulan="<?php echo date('m', strtotime($sitUp2[$tanggalPelaksanaanField])); ?>">
										<td><?php echo $nomorUrut; ?></td>
										<td><?php echo htmlspecialchars($sitUp2[$tanggalPelaksanaanField]); ?></td>
										<td><?php echo htmlspecialchars($sitUp2[$jumlahField]); ?></td>
										<td><?php echo htmlspecialchars($sitUp2[$nilaiField]); ?></td>
									</tr>
					<?php
								}
							}
						}
					} else {
						echo '<tr id="barisTidakAdaData"><td colspan="5" style="text-align: center; color: red; font-weight: bold;">Tidak ada data Sit Up Kaki Ditekuk.</td></tr>';
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

				$('.situp2-baris').each(function() {
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
					$('#situp2TabelBody').append("<tr id='barisTidakAdaData'><td colspan='5' class='text-center text-danger fw-bold'>Tidak ada data Sit Up Kaki Ditekuk.</td></tr>");
				}
			});

		});
	</script>
	<!-- MODALS START -->
	<?php include('../partials/modal-add-garjas-situp2.php'); ?>
	<!-- MODALS END -->
</body>

</html>
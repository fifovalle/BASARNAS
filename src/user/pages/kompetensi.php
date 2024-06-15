<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include('../partials/header.php');
	?>
	<link rel="stylesheet" href="../assets/css/kompetensi.css">
</head>

<body>
	<?php
	include('../partials/navbar.php');
	?>
	<section class="table-kompetensi">
		<h1 class="kompetensi-title text-center">Kompetensi</h1>
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
						<th>Nama Sertifikat</th>
						<th>Tanggal Penerbitan Sertifikat</th>
						<th>Tanggal Berakhir Sertifikat</th>
						<th>Masa Berlaku</th>
						<th>Kategori Kompetensi</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody class="table-group-divider text-center">
					<tr>
						<td>1</td>
						<td>Sertifikat Diving</td>
						<td>2024-06-08</td>
						<td>2025-06-08</td>
						<td>12 bulan</td>
						<td>Rescuer Pemula</td>
						<td>
							<i class="bi bi-check-circle-fill" style="color: green; font-size: 20px;"></i>
							<i class=" d-none bi bi-x-circle-fill" style="color: red; font-size: 20px;"></i>
						</td>
						<td>
							<div class="btn-group ">
								<div class="btn btn-secondary bg-transparent border border-0 p-0 pe-2" data-bs-toggle="modal" data-bs-target="#previewSertifikatKompetensi">
									<i class="bi bi-eye" style="color: black; font-size: 20px; -webkit-text-stroke-width: 0.8px;"></i>
								</div>
								<div class="btn btn-secondary bg-transparent border border-0 p-0 ps-2">
									<i class="bi bi-cloud-download" style="color: black; font-size: 20px; -webkit-text-stroke-width: 0.8px;"></i>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="8">
							<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#inputSertifikatKompetensi"><i class='bx bx-file pe-2'></i>Tambahkan Sertifikat</button>
							<div class="modal fade" id="inputSertifikatKompetensi" tabindex="-1" aria-labelledby="inputSertifikatKompetensiLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content w-100">
										<div class="modal-header">
											<h1 class="modal-title fs-5" id="inputSertifikatKompetensiLabel">Tambahkan Sertifikat Kompetensi Anda</h1>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form class="form-control" method="post" action="">
											<div class="modal-body text-start">
												<div class="mb-3">
													<label for="inputNamaSertifikat" class="form-label">Nama Sertifikat</label>
													<input type="text" class="form-control" id="inputNamaSertifikat" name="inputNamaSertifikat" placeholder="Masukkan Nama Sertifikat">
												</div>
												<div class="mb-3">
													<label for="inputTanggalPembuatanSertifikat" class="form-label">Tanggal Pembuatan Sertifikat</label>
													<input type="date" class="form-control" id="inputTanggalPembuatanSertifikat" name="inputTanggalPembuatanSertifikat" placeholder="...">
												</div>
												<div class="mb-3">
													<label for="inputTanggalBerakhirSertifikat" class="form-label">Tanggal Berakhir Sertifikat</label>
													<input type="date" class="form-control" id="inputTanggalBerakhirSertifikat" name="inputTanggalBerakhirSertifikat" placeholder="...">
												</div>
												<div class="mb-3">
													<label for="inputMasaBerlakuSertifikat" class="form-label">Masa Berlaku Sertifikat</label>
													<input type="number" class="form-control" id="inputMasaBerlakuSertifikat" name="inputMasaBerlakuSertifikat" placeholder="Masukan Masa Berlaku Sertifikat (dalam hitungan bulan)">
												</div>
												<div class="mb-3">
													<label for="inputKategoriKompetensi" class="form-label">Kategori Kompetensi</label>
													<select class="form-select" aria-label="Default select example">
														<option selected>Pilih Kategori Kompetensi</option>
														<option value="1">Pemula</option>
														<option value="2">Mahir</option>
														<option value="3">Terampil</option>
													</select>
												</div>
												<div class="mb-3">
													<label for="inputFileSertifikat" class="form-label text-start">File Sertifikat</label>
													<div class="upload-file">
														<div class="file-upload-form text-center">
															<label for="file" class="file-upload-label">
																<div class="file-upload-design">
																	<svg viewBox="0 0 640 512" height="1em">
																		<path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"></path>
																	</svg>
																	<p>Drag and Drop</p>
																	<p>or</p>
																	<span class="browse-button">Browse file</span>
																</div>
																<input id="file" type="file" />
															</label>
														</div>
													</div>
													<div class="box-file-upload w-100" style="display: none;">
														<p class="text-start my-2"></p>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>
	<?php
	include('../partials/footer.php');
	?>
	<script src="../assets/js/navbar.js"></script>
	<script src="../assets/js/kompetensi.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
	<div class="modal fade" id="previewSertifikatKompetensi" tabindex="-1" aria-labelledby="previewSertifikatKompetensiLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content w-100">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="previewSertifikatKompetensiLabel">Preview Sertifikat Anda</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-center">
					<img src="../assets/img/tester.jpg" class="img-fluid" alt="...">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
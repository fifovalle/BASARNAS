<div class="modal fade" id="tambahGarjasPriaChinUp" tabindex="-1" aria-labelledby="tambahGarjasPriaChinUpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaChinUpLabel">Tambah Nilai Garjas Pria Chin Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-garjas-pria-chin-up.php" method="post" enctype="multipart/form-data">
                    <?php
                    $garjasPriaShuttleRunModel = new GarjasPriaShuttleRun($koneksi);
                    $garjasPriaShuttleRunInfo = $garjasPriaShuttleRunModel->tampilkanDataPenggunaGarjasShuttleRunPria();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPenggunaPria" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPenggunaPria" class="form-select">
                            <option selected>Pilih NIP Pengguna</option>
                            <?php foreach ($garjasPriaShuttleRunInfo as $garjasPriaShuttleRun) : ?>
                                <option value="<?php echo $garjasPriaShuttleRun['NIP_Pengguna']; ?>"><?php echo $garjasPriaShuttleRun['NIP_Pengguna'] . ' - ' . $garjasPriaShuttleRun['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanChinUpAdmin" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanChinUpAdmin" name="Tanggal_Pelaksanaan_Chin_Up_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJumlahChinUpAdmin" class="form-label">Jumlah Chin Up</label>
                        <input type="number" class="form-control" id="tambahJumlahChinUpAdmin" name="Jumlah_Chin_Up_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
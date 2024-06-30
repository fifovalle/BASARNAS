<div class="modal fade" id="tambahGarjasWanitaShuttleRun" tabindex="-1" aria-labelledby="tambahGarjasWanitaShuttleRunLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasWanitaShuttleRunLabel">Tambah Nilai Garjas Wanita Shuttle Run</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-garjas-wanita-shuttlerun.php" method="post" enctype="multipart/form-data">
                    <?php
                    $penggunaWanitaModel = new Pengguna($koneksi);
                    $penggunaWanitaInfo = $penggunaWanitaModel->tampilkanDataPenggunaWanita();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPenggunaWanita" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPenggunaWanita" class="form-select">
                            <option selected disabled>Pilih NIP Pengguna</option>
                            <?php foreach ($penggunaWanitaInfo as $penggunaWanita) : ?>
                                <option value="<?php echo $penggunaWanita['NIP_Pengguna']; ?>"><?php echo $penggunaWanita['NIP_Pengguna'] . ' - ' . $penggunaWanita['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanShuttleRunWanita" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" step="any" class="form-control" id="tambahTanggalPelaksanaanShuttleRunWanita" name="Tanggal_Pelaksanaan_Shuttle_Run_Wanita">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuShuttleRunWanita" class="form-label">Waktu Shuttle Run</label>
                        <input type="number" step="any" min="0" class="form-control" id="tambahWaktuShuttleRunWanita" name="Jumlah_Shuttle_Run_Wanita">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
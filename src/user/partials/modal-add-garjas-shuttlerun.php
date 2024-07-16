<div class="modal fade" id="tambahGarjasShuttleRun" tabindex="-1" aria-labelledby="tambahGarjasShuttleRunLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasShuttleRunLabel">Tambah Nilai Garjas Shuttle Run</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-garjas-user-shuttle-run.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanShuttleRun" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanShuttleRun" name="Tanggal_Pelaksanaan_Shuttle_Run">
                    </div>
                    <div class="mb-3">
                        <label for="inputBilanganDesimal">Waktu Shuttle Run</label>
                        <input type="text" class="form-control" id="inputBilanganDesimal" name="Waktu_Shuttle_Run">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
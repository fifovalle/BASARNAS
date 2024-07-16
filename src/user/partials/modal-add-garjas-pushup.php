<div class="modal fade" id="tambahGarjasPushUp" tabindex="-1" aria-labelledby="tambahGarjasPushUpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPushUpLabel">Tambah Nilai Garjas Push Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-garjas-user-push-up.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanPushUpPengguna" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanPushUpPengguna" name="Tanggal_Pelaksanaan_Push_Up">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJumlahPushUpAdmin" class="form-label">Jumlah Push Up</label>
                        <input type="number" class="form-control" id="tambahJumlahPushUpAdmin" name="Jumlah_Push_Up">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
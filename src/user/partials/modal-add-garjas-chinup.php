<div class="modal fade" id="tambahGarjasChinUp" tabindex="-1" aria-labelledby="tambahGarjasChinUpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasChinUpLabel">Tambah Nilai Garjas Chin Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-tes-user-chinup.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanChinUp" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanChinUp" name="Tanggal_Pelaksanaan_Chin_Up">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJumlahChinUp" class="form-label">Jumlah Chin Up</label>
                        <input type="number" class="form-control" id="tambahJumlahChinUp" name="Jumlah_Chin_Up">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
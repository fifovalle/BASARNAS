<div class="modal fade" id="tambahGarjasSitUp1" tabindex="-1" aria-labelledby="tambahGarjasSitUp1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasSitUp1Label">Tambah Nilai Garjas Sit Up Kaki Lurus</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-tes-situp1-user.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanSitUp1" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanSitUp1" name="Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJumlahSitUp1" class="form-label">Jumlah Sit Up</label>
                        <input type="number" class="form-control" id="tambahJumlahSitUp1" name="Jumlah_Sit_Up_Kaki_Lurus">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
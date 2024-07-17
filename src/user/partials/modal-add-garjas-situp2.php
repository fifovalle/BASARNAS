<div class="modal fade" id="tambahGarjasSitUp2" tabindex="-1" aria-labelledby="tambahGarjasSitUp2Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasSitUp2Label">Tambah Nilai Garjas Sit Up Kaki Ditekuk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-garjas-user-situp2.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanSitUp2" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanSitUp2" name="Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJumlahSitUp2" class="form-label">Jumlah Sit Up</label>
                        <input type="number" class="form-control" id="tambahJumlahSitUp2" name="Jumlah_Sit_Up_Kaki_Di_Tekuk">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
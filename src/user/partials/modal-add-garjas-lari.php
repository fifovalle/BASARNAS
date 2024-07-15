<div class="modal fade" id="tambahGarjasLari" tabindex="-1" aria-labelledby="tambahGarjasLariLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasLariLabel">Tambah Nilai Garjas Lari 2400 M</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-tes-lari-user.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanLari" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanLari" name="Tanggal_Pelaksanaan_Tes_Lari">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuLari" class="form-label">Waktu Lari</label>
                        <input type="number" min="0" step="any" class="form-control" id="tambahWaktuLari" name="Waktu_Lari">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
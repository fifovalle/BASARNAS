<div class="modal fade" id="tambahGarjasJalan" tabindex="-1" aria-labelledby="tambahGarjasJalanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasJalanLabel">Tambah Nilai Garjas Jalan Kaki 5 KM</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-tes-user-jalan.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanJalan" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanJalan" name="Tanggal_Pelaksanaan_Tes_Jalan">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuJalan" class="form-label">Waktu Jalan</label>
                        <input type="number" min="0" step="any" class="form-control" id="tambahWaktuJalan" name="Waktu_Jalan">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
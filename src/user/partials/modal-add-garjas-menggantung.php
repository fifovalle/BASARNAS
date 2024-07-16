<div class="modal fade" id="tambahGarjasMenggantung" tabindex="-1" aria-labelledby="tambahGarjasMenggantungLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasMenggantungLabel">Tambah Nilai Garjas Flexed Arm Hang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-tes-user-menggantung.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanMenggantung" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanMenggantung" name="Tanggal_Pelaksanaan_Tes_Menggantung">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuMenggantung" class="form-label">Waktu Flexed Arm Hang</label>
                        <input type="number" class="form-control" id="tambahWaktuMenggantung" name="Waktu_Menggantung">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
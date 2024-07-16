<div class="modal fade" id="tambahGarjasRenang" tabindex="-1" aria-labelledby="tambahGarjasRenangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasRenangLabel">Tambah Nilai Garjas Renang 2400 M</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../admin/config/add-tes-renang-user.php" method="post">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="text" value="<?php echo $_SESSION['NIP_Pengguna']; ?>" class="form-control" id="tambahNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanRenang" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanRenang" name="Tanggal_Pelaksanaan_Tes_Renang">
                    </div>
                    <div class="mb-3">
                        <label for="tambahGayaRenang" class="form-label">Gaya Renang</label>
                        <select name="Gaya_Renang" id="tambahGayaRenang" class="form-select">
                            <option selected disabled>Pilih Gaya Renang</option>
                            <option value="Dada">Dada</option>
                            <option value="Bebas">Bebas</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuRenang" class="form-label">Waktu Renang</label>
                        <input type="time" min="0" step="any" class="form-control" id="tambahWaktuRenang" name="Waktu_Renang">
                    </div>
                    <button type="submit" class="btn tombol-tambah" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
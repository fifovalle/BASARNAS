<div class="modal fade" id="tambahGarjasWanitaRenang" tabindex="-1" aria-labelledby="tambahGarjasWanitaRenangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasWanitaRenangLabel">Tambah Nilai Garjas Wanita Renang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-tes-renang-wanita.php" method="post" enctype="multipart/form-data">
                    <?php
                    $penggunaWanitaModel = new Pengguna($koneksi);
                    $penggunaWanitaInfo = $penggunaWanitaModel->tampilkanDataPenggunaWanita();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPenggunaWanita" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPenggunaWanita" class="form-select">
                            <option selected>Pilih NIP Pengguna</option>
                            <?php foreach ($penggunaWanitaInfo as $penggunaWanita) : ?>
                                <option value="<?php echo $penggunaWanita['NIP_Pengguna']; ?>"><?php echo $penggunaWanita['NIP_Pengguna'] . ' - ' . $penggunaWanita['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanRenangWanita" class="form-label">Waktu Renang</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanRenangWanita" name="Tanggal_Pelaksanaan_Tes_Renang_Wanita">
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
                        <label for="tambahWaktuRenangWanita" class="form-label">Waktu Renang</label>
                        <input type="time" step="any" class="form-control" id="tambahWaktuRenangWanita" name="Waktu_Renang_Wanita">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
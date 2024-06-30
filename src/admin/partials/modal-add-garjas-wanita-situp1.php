<div class="modal fade" id="tambahGarjasWanitaSitUp1" tabindex="-1" aria-labelledby="tambahGarjasWanitaSitUp1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasWanitaSitUp1Label">Tambah Nilai Garjas Wanita Sit Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-garjas-wanita-situp1.php" method="post">
                    <?php
                    $penggunaWanitaModel = new Pengguna($koneksi);
                    $penggunaWanitaInfo = $penggunaWanitaModel->tampilkanDataPenggunaWanita();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPenggunaWanita" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPenggunaWanita" class="form-select">
                            <option selected disabled>Pilih NIP Pengguna</option>
                            <?php foreach ($penggunaWanitaInfo as $penggunaWanita) : ?>
                                <option value="<?php echo $penggunaWanita['NIP_Pengguna']; ?>"><?php echo $penggunaWanita['NIP_Pengguna'] . ' - ' . $penggunaWanita['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanSitUp1PenggunaWanita" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanSitUp1PenggunaWanita" name="Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJumlahSitUp1PenggunaWanita" class="form-label">Jumlah Sit Up</label>
                        <input type="number" min="0" class="form-control" id="tambahJumlahSitUp1PenggunaWanita" name="Jumlah_Sit_Up_1_Wanita">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
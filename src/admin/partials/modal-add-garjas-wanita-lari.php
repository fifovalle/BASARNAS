<div class="modal fade" id="tambahGarjasWanitaLari" tabindex="-1" aria-labelledby="tambahGarjasWanitaLariLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasWanitaLariLabel">Tambah Nilai Garjas Wanita Lari 2400 M</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-tes-lari-wanita.php" method="post" enctype="multipart/form-data">
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
                        <label for="tambahTanggalPelaksanaanLariWanita" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanLariWanita" name="Tanggal_Pelaksanaan_Tes_Lari_Wanita">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuLariWanita" class="form-label">Waktu Lari</label>
                        <input type="number" min="0" step="any" class="form-control" id="tambahWaktuLariWanita" name="Waktu_Lari_Wanita">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
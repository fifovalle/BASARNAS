<div class="modal fade" id="tambahGarjasPriaRenang" tabindex="-1" aria-labelledby="tambahGarjasPriaRenangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaRenangLabel">Tambah Nilai Garjas Pria Renang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-tes-renang-pria.php" method="post">
                    <?php
                    $penggunaPriaModel = new Pengguna($koneksi);
                    $penggunaPriaInfo = $penggunaPriaModel->tampilkanDataPenggunaPria();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPenggunaPria" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPenggunaPria" class="form-select">
                            <option selected>Pilih NIP Pengguna</option>
                            <?php foreach ($penggunaPriaInfo as $penggunaPria) : ?>
                                <option value="<?php echo $penggunaPria['NIP_Pengguna']; ?>"><?php echo $penggunaPria['NIP_Pengguna'] . ' - ' . $penggunaPria['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanRenangAdmin" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanRenangAdmin" name="Tanggal_Pelaksanaan_Tes_Renang_Pria">
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
                        <label for="tambahWaktuRenangAdmin" class="form-label">Waktu Renang</label>
                        <input type="time" step="any" class="form-control" id="tambahWaktuRenangAdmin" name="Waktu_Renang">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
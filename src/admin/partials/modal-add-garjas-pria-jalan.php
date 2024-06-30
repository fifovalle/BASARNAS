<div class="modal fade" id="tambahGarjasPriaJalan" tabindex="-1" aria-labelledby="tambahGarjasPriaJalanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaJalanLabel">Tambah Nilai Garjas Pria Jalan Kaki 5 KM</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-pria-jalan.php" method="post">
                    <?php
                    $penggunaPriaModel = new Pengguna($koneksi);
                    $penggunaPriaInfo = $penggunaPriaModel->tampilkanDataPenggunaPria();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPenggunaPria" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPenggunaPria" class="form-select">
                            <option selected disabled>Pilih NIP Pengguna</option>
                            <?php foreach ($penggunaPriaInfo as $penggunaPria) : ?>
                                <option value="<?php echo $penggunaPria['NIP_Pengguna']; ?>"><?php echo $penggunaPria['NIP_Pengguna'] . ' - ' . $penggunaPria['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanJalan" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanJalan" name="Tanggal_Pelaksanaan_Tes_Jalan_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuJalan" class="form-label">Waktu Jalan</label>
                        <input type="number" min="0" step="any" class="form-control" id="tambahWaktuJalan" name="Waktu_Jalan_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahGarjasPriaPushUp" tabindex="-1" aria-labelledby="tambahGarjasPriaPushUpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaPushUpLabel">Tambah Nilai Garjas Pria Push Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-garjas-pria-push-up.php" method="post">
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
                        <label for="tambahTanggalPelaksanaanPushUpPengguna" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanPushUpPengguna" name="Tanggal_Pelaksanaan_Push_Up_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJumlahPushUpAdmin" class="form-label">Jumlah Push Up</label>
                        <input type="number" class="form-control" id="tambahJumlahPushUpAdmin" name="Jumlah_Push_Up_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
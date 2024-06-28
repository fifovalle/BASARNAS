<div class="modal fade" id="tambahGarjasPriaFlexedArmHang" tabindex="-1" aria-labelledby="tambahGarjasPriaFlexedArmHangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaFlexedArmHangLabel">Tambah Nilai Garjas Pria Flexed Arm Hang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-garjas-pria-flexed-arm-hang.php" method="post" enctype="multipart/form-data">
                    <?php
                    $penggunaPriaModel = new Pengguna($koneksi);
                    $penggunaPriaInfo = $penggunaPriaModel->tampilkanDataPenggunaPria();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPAdmin" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPAdmin" class="form-select">
                            <option selected>Pilih NIP Pengguna</option>
                            <?php foreach ($penggunaPriaInfo as $penggunaPria) : ?>
                                <option value="<?php echo $penggunaPria['NIP_Pengguna']; ?>"><?php echo $penggunaPria['NIP_Pengguna'] . ' - ' . $penggunaPria['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahtanggalPelaksanaanFlexedArmHangPengguna" class="form-label">Waktu Flexed Arm Hang</label>
                        <input type="date" class="form-control" id="tambahtanggalPelaksanaanFlexedArmHangPengguna" name="Tanggal_Pelaksanaan_Pria_Menggantung">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuFlexedArmHangAdmin" class="form-label">Waktu Flexed Arm Hang</label>
                        <input type="number" class="form-control" id="tambahWaktuFlexedArmHangAdmin" name="Waktu_Menggantung_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
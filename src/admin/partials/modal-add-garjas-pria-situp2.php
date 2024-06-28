<div class="modal fade" id="tambahGarjasPriaSitUp2" tabindex="-1" aria-labelledby="tambahGarjasPriaSitUp2Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaSitUp2Label">Tambah Nilai Garjas Pria Sit Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-garjas-pria-situp2.php" method="post" enctype="multipart/form-data">
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
                        <label for="tambahTanggalPelaksanaanSitUp2Pengguna" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanSitUp2Pengguna" name="Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJumlahSitUp2Admin" class="form-label">Jumlah Sit Up</label>
                        <input type="number" class="form-control" id="tambahJumlahSitUp2Admin" name="Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
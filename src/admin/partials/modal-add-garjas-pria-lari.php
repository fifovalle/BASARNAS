<div class="modal fade" id="tambahGarjasPriaLari" tabindex="-1" aria-labelledby="tambahGarjasPriaLariLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaLariLabel">Tambah Nilai Garjas Pria Lari 2400 M</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-tes-lari-pria.php" method="post" enctype="multipart/form-data">
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
                        <label for="tambahTanggalPelaksanaanLariPria" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanLariPria" name="Tanggal_Pelaksanaan_Tes_Lari_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuLariPria" class="form-label">Waktu Lari</label>
                        <input type="number" min="0" step="any" class="form-control" id="tambahWaktuLariPria" name="Waktu_Lari_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
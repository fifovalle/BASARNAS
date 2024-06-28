<div class="modal fade" id="tambahKompetensiPemula" tabindex="-1" aria-labelledby="tambahKompetensiPemulaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahKompetensiPemulaLabel">Tambah Kompetensi Pemula</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-beginner-competence.php" method="post" enctype="multipart/form-data">
                    <?php
                    $penggunaModel = new Pengguna($koneksi);
                    $penggunaInfo = $penggunaModel->tampilkanDataPenggunaPemula();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPengguna" class="form-select">
                            <?php if (empty($penggunaInfo)) : ?>
                                <option selected value="">Tidak ada NIP Pengguna tersedia</option>
                            <?php else : ?>
                                <option selected>Pilih NIP Pengguna</option>
                                <?php foreach ($penggunaInfo as $pengguna) : ?>
                                    <option value="<?php echo htmlspecialchars($pengguna['NIP_Pengguna']); ?>">
                                        <?php echo htmlspecialchars($pengguna['NIP_Pengguna']) . ' - ' . htmlspecialchars($pengguna['Nama_Lengkap_Pengguna']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahFileSertifikat" class="form-label">File Sertifikat</label>
                        <input type="file" class="form-control" id="tambahFileSertifikat" name="File_Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="tambahNamaSertifikat" class="form-label">Nama Sertifikat</label>
                        <input type="text" class="form-control" id="tambahNamaSertifikat" name="Nama_Sertifikat" placeholder="Masukkan Nama Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPenerbitan" class="form-label">Tanggal Penerbitan Sertifikat</label>
                        <input type="date" class="form-control" id="tambahTanggalPenerbitan" name="Tanggal_Penerbitan_Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalBerakhir" class="form-label">Tanggal Berakhir Sertifikat</label>
                        <input type="date" class="form-control" id="tambahTanggalBerakhir" name="Tanggal_Berakhir_Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="tambahKategoriKompetensi" class="form-label">Jabatan Kompetensi</label>
                        <select class="form-select" name="Kategori_Kompetensi" id="tambahKategoriKompetensi">
                            <option selected>Pilih Jabatan Kompetensi</option>
                            <option value="Pemula">Pemula</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahStatus" class="form-label">Status</label>
                        <select class="form-select" name="Status" id="tambahStatus">
                            <option selected>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_sertifikat">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
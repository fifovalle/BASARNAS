<div class="modal fade" id="tambahModul" tabindex="-1" aria-labelledby="tambahModulLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModulLabel">Tambah Modul</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-modul.php" method="post" enctype="multipart/form-data">
                    <?php
                    $penggunaModel = new Pengguna($koneksi);
                    $penggunaInfo = $penggunaModel->tampilkanDataPengguna();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPengguna" class="form-select">
                            <?php if (empty($penggunaInfo)) : ?>
                                <option selected>Tidak ada NIP Pengguna tersedia</option>
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
                        <label for="tambahFileModul" class="form-label">File Modul</label>
                        <input type="file" class="form-control" id="tambahFileModul" name="File_Modul">
                    </div>
                    <div class="mb-3">
                        <label for="tambahNamaModul" class="form-label">Nama Modul</label>
                        <input type="text" class="form-control" id="tambahNamaModul" name="Nama_Modul">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJudulModul" class="form-label">Judul Modul</label>
                        <input type="text" class="form-control" id="tambahJudulModul" name="Judul_Modul">
                    </div>
                    <div class="mb-3">
                        <label for="tambahDeskripsiModul" class="form-label">Deskripsi Modul</label>
                        <textarea name="Deskripsi_Modul" id="tambahDeskripsiModul" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_modul">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
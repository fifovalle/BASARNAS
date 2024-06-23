<div class="modal fade" id="tambahBMI" tabindex="-1" aria-labelledby="tambahBMILabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahBMILabel">Tambah BMI</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-bmi.php" method="post">
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
                        <label for="tambahTinggiBMI" class="form-label">Tinggi (cm)</label>
                        <input type="number" class="form-control" id="tambahTinggiBMI" name="Tinggi_BMI">
                    </div>
                    <div class="mb-3">
                        <label for="tambahBeratBMI" class="form-label">Berat (kg)</label>
                        <input type="number" class="form-control" id="tambahBeratBMI" name="Berat_BMI">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah_BMI">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
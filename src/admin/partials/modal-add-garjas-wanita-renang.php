<div class="modal fade" id="tambahGarjasWanitaRenang" tabindex="-1" aria-labelledby="tambahGarjasWanitaRenangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasWanitaRenangLabel">Tambah Nilai Garjas Wanita Renang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/" method="post" enctype="multipart/form-data">
                    <?php
                    $penggunaWanitaModel = new Pengguna($koneksi);
                    $penggunaWanitaInfo = $penggunaWanitaModel->tampilkanDataPenggunaWanita();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPAdmin" class="form-label">NIP</label>
                        <select name="NIP_Admin" id="tambahNIPAdmin" class="form-select">
                            <option selected>Pilih NIP Pengguna</option>
                            <?php foreach ($penggunaWanitaInfo as $penggunaWanita) : ?>
                                <option value="<?php echo $penggunaWanita['NIP_Pengguna']; ?>"><?php echo $penggunaWanita['NIP_Pengguna'] . ' - ' . $penggunaWanita['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuRenangAdmin" class="form-label">Waktu Renang</label>
                        <input type="number" class="form-control" id="tambahWaktuRenangAdmin" name="Nomor_Telepon_Admin">
                    </div>
                    <button type="button" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
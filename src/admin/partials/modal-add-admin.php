<div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="tambahAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahAdminLabel">Tambah Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-admin.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tambahNIPAdmin" class="form-label">NIP</label>
                        <input type="number" class="form-control" placeholder="Masukan NIP" id="tambahNIPAdmin" name="NIP_Admin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahFotoAdmin" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="tambahFotoAdmin" name="Foto_Admin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahNamaAdmin" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Lengkap" id="tambahNamaAdmin" name="Nama_Lengkap_Admin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalLahirAdmin" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tambahTanggalLahirAdmin" name="Tanggal_Lahir_Admin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahPeranAdmin" class="form-label">Peran Admin</label>
                        <select name="Peran_Admin" id="tambahPeranAdmin" class="form-select">
                            <?php if ($_SESSION['Peran_Admin'] === 'Super Admin') : ?>
                                <option value="SuperAdmin" selected>Super Admin</option>
                                <option value="Admin">Admin</option>
                            <?php elseif ($_SESSION['Peran_Admin'] === 'Admin') : ?>
                                <option value="Admin" selected>Admin</option>
                            <?php else : ?>
                                <option selected disabled>Pilih Peran</option>
                                <option value="SuperAdmin">Super Admin</option>
                                <option value="Admin">Admin</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tambahJabatanAdmin" class="form-label">Jabatan</label>
                        <select name="Jabatan_Admin" id="tambahJabatanAdmin" class="form-select">
                            <option selected disabled>Pilih Jabatan</option>
                            <option value="Pemula">Pemula</option>
                            <option value="Terampil">Terampil</option>
                            <option value="Mahir">Mahir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahJenisKelaminAdmin" class="form-label">Jenis Kelamin</label>
                        <select name="Jenis_Kelamin_Admin" id="tambahJenisKelaminAdmin" class="form-select">
                            <option selected disabled>Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahNomorTelpAdmin" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" placeholder="Masukan Nomor Telepon" id="tambahNomorTelpAdmin" name="No_Telepon_Admin">
                    </div>
                    <div class="mb-3" style="position:relative;">
                        <label for="tambahKataSandiAdmin" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" placeholder="***********" id="tambahKataSandiAdmin" name="Kata_Sandi_Admin">
                        <i class="bi bi-eye" id="toggleKataSandiAdmin" style="position:absolute; top: 70%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                    <div class="mb-3" style="position:relative;">
                        <label for="tambahKonfirmasiKataSandiAdmin" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" placeholder="***********" id="tambahKonfirmasiKataSandiAdmin" name="Konfirmasi_Kata_Sandi_Admin">
                        <i class="bi bi-eye" id="toggleKonfirmasiKataSandiAdmin" style="position:absolute; top: 70%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                    <button type="submit" class="btn btn-primary" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahPengguna" tabindex="-1" aria-labelledby="tambahPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahPenggunaLabel">Tambah Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-user.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tambahNIPPengguna" class="form-label">NIP</label>
                        <input type="number" class="form-control" placeholder="Masukan NIP" id="tambahNIPPengguna" name="NIP_Pengguna">
                    </div>
                    <div class="mb-3">
                        <label for="tambahFotoPengguna" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="tambahFotoPengguna" name="Foto_Pengguna">
                    </div>
                    <div class="mb-3">
                        <label for="tambahNamaPengguna" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Lengkap" id="tambahNamaPengguna" name="Nama_Lengkap_Pengguna">
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalLahirPengguna" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tambahTanggalLahirPengguna" name="Tanggal_Lahir_Pengguna">
                    </div>
                    <div class="mb-3">
                        <label for="tambahJabatanPengguna" class="form-label">Jabatan</label>
                        <select name="Jabatan_Pengguna" id="tambahJabatanPengguna" class="form-select">
                            <option value="Pemula">Pemula</option>
                            <option value="Terampil">Terampil</option>
                            <option value="Mahir">Mahir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahJenisKelaminPengguna" class="form-label">Jenis Kelamin</label>
                        <select name="Jenis_Kelamin_Pengguna" id="tambahJenisKelaminPengguna" class="form-select">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahNomorTelpPengguna" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" placeholder="Masukan Nomor Telepon" id="tambahNomorTelpPengguna" name="No_Telepon_Pengguna">
                    </div>
                    <div class="mb-3" style="position:relative;">
                        <label for="tambahKataSandiPengguna" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" placeholder="***********" id="tambahKataSandiPengguna" name="Kata_Sandi_Pengguna">
                        <i class="bi bi-eye" id="toggleKataSandiPengguna" style="position:absolute; top: 70%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                    <div class="mb-3" style="position:relative;">
                        <label for="tambahKonfirmasiKataSandiPengguna" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" placeholder="***********" id="tambahKonfirmasiKataSandiPengguna" name="Konfirmasi_Kata_Sandi_Pengguna">
                        <i class="bi bi-eye" id="toggleKonfirmasiKataSandiPengguna" style="position:absolute; top: 70%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                    <button type="submit" class="btn btn-primary" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
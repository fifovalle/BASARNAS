<div class="modal fade" id="suntingAdmin" tabindex="-1" aria-labelledby="suntingAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingAdminLabel">Sunting Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="suntingNIPAdmin" name="NIP_Admin">
                    </div>
                    <div class="mb-3">
                        <label for="suntingFotoAdmin" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="suntingFotoAdmin" name="Foto_Admin">
                    </div>
                    <div class="mb-3">
                        <label for="suntingNamaAdmin" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="suntingNamaAdmin" name="Nama_Lengkap_Admin">
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalLahirAdmin" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="suntingTanggalLahirAdmin" name="Tanggal_Lahir_Admin">
                    </div>
                    <div class="mb-3">
                        <label for="suntingPeranAdmin" class="form-label">Peran Admin</label>
                        <select name="Peran_Admin" id="suntingPeranAdmin" class="form-select">
                            <option selected disabled>Pilih Peran</option>
                            <option value="Super Admin">Super Admin</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingJabatanAdmin" class="form-label">Jabatan</label>
                        <select id="suntingJabatanAdmin" name="Jabatan_Admin" class="form-select">
                            <option selected>Pilih Jabatan</option>
                            <option value="Pemula">Pemula</option>
                            <option value="Terampil">Terampil</option>
                            <option value="Mahir">Mahir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingJenisKelaminAdmin" class="form-label">Jenis Kelamin</label>
                        <select id="suntingJenisKelaminAdmin" name="Jenis_Kelamin_Admin" class="form-select">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingNomorTelpAdmin" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="suntingNomorTelpAdmin" name="No_Telepon_Admin">
                    </div>
                    <button type="button" id="tombolSimpanAdmin" name="Simpan" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
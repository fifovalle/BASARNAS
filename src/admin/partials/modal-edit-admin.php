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
                        <label for="suntingNIPAdmin" class="form-label">NIP</label>
                        <input type="number" class="form-control" id="suntingNIPAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="suntingFotoAdmin" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="suntingFotoAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="suntingNamaAdmin" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="suntingNamaAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalLahirAdmin" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="suntingTanggalLahirAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="suntingAlamatAdmin" class="form-label">Alamat</label>
                        <textarea id="suntingAlamatAdmin" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="suntingJabatanAdmin" class="form-label">Jabatan</label>
                        <select id="suntingJabatanAdmin" class="form-select">
                            <option selected>Pilih Jabatan</option>
                            <option value="Satu">Satu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingJenisKelaminAdmin" class="form-label">Jenis Kelamin</label>
                        <select id="suntingJenisKelaminAdmin" class="form-select">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingNomorTelpAdmin" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" id="suntingNomorTelpAdmin">
                    </div>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
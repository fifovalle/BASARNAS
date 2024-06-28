<div class="modal fade" id="suntingPengguna" tabindex="-1" aria-labelledby="suntingPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingPenggunaLabel">Sunting Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna">
                    </div>
                    <div class="mb-3">
                        <label for="suntingFotoPengguna" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="suntingFotoPengguna" name="Foto_Pengguna">
                    </div>
                    <div class="mb-3">
                        <label for="suntingNamaPengguna" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="suntingNamaPengguna" name="Nama_Lengkap_Pengguna">
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalLahirPengguna" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="suntingTanggalLahirPengguna" name="Tanggal_Lahir_Pengguna">
                    </div>
                    <div class="mb-3">
                        <label for="suntingJabatanPengguna" class="form-label">Jabatan</label>
                        <select id="suntingJabatanPengguna" name="Jabatan_Pengguna" class="form-select">
                            <option value="Pemula">Pemula</option>
                            <option value="Terampil">Terampil</option>
                            <option value="Mahir">Mahir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingJenisKelaminPengguna" class="form-label">Jenis Kelamin</label>
                        <select id="suntingJenisKelaminPengguna" name="Jenis_Kelamin_Pengguna" class="form-select">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingNomorTelpPengguna" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="suntingNomorTelpPengguna" name="No_Telepon_Pengguna">
                    </div>
                    <button type="button" id="tombolSimpanPengguna" name="Simpan" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
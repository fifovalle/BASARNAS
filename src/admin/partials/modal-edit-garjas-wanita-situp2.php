<div class="modal fade" id="suntingGarjasWanitaSitUp2" tabindex="-1" aria-labelledby="suntingGarjasWanitaSitUp2Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasWanitaSitUp2Label">Sunting Nilai Garjas Wanita Sit Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="suntingNIPAdmin" class="form-label">NIP</label>
                        <select name="NIP_Admin" id="suntingNIPAdmin" class="form-select">
                            <option selected>Pilih NIP Pengguna</option>
                            <option value="Satu">Satu</option>
                            <option value="Satu">Satu</option>
                            <option value="Satu">Satu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingJabatanAdmin" class="form-label">Jabatan</label>

                    </div>
                    <div class="mb-3">
                        <label for="suntingNamaAdmin" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="suntingNamaAdmin" name="Nama_Lengkap_Admin" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="suntingJumlahSitUp2Admin" class="form-label">Jumlah Sit Up</label>
                        <input type="number" class="form-control" id="suntingJumlahSitUp2Admin" name="Nomor_Telepon_Admin">
                    </div>
                    <button type="button" class="btn btn-primary" name="sunting_admin">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
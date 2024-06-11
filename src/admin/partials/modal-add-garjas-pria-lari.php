<div class="modal fade" id="tambahGarjasPriaLari" tabindex="-1" aria-labelledby="tambahGarjasPriaLariLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaLariLabel">Tambah Nilai Garjas Pria Lari 2400 M</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tambahNIPAdmin" class="form-label">NIP</label>
                        <select name="NIP_Admin" id="tambahNIPAdmin" class="form-select">
                            <option selected>Pilih NIP Pengguna</option>
                            <option value="Satu">Satu</option>
                            <option value="Satu">Satu</option>
                            <option value="Satu">Satu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahJabatanAdmin" class="form-label">Jabatan</label>

                    </div>
                    <div class="mb-3">
                        <label for="tambahNamaAdmin" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="tambahNamaAdmin" name="Nama_Lengkap_Admin" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuLariAdmin" class="form-label">Waktu Lari</label>
                        <input type="number" class="form-control" id="tambahWaktuLariAdmin" name="Nomor_Telepon_Admin">
                    </div>
                    <button type="button" class="btn btn-primary" name="tambah_admin">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
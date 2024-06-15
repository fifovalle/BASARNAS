<div class="modal fade" id="tambahGarjasPriaJalan" tabindex="-1" aria-labelledby="tambahGarjasPriaJalanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaJalanLabel">Tambah Nilai Garjas Pria Jalan Kaki 5 KM</h1>
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
                        <label for="tambahWaktuJalanAdmin" class="form-label">Waktu Jalan</label>
                        <input type="number" class="form-control" id="tambahWaktuJalanAdmin" name="Nomor_Telepon_Admin">
                    </div>
                    <button type="button" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
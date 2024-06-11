<div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="tambahAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahAdminLabel">Tambah Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tambahNIPAdmin" class="form-label">NIP</label>
                        <input type="number" class="form-control" id="tambahNIPAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahFotoAdmin" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="tambahFotoAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahNamaAdmin" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="tambahNamaAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalLahirAdmin" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tambahTanggalLahirAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahAlamatAdmin" class="form-label">Alamat</label>
                        <textarea id="tambahAlamatAdmin" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tambahJabatanAdmin" class="form-label">Jabatan</label>
                        <select id="tambahJabatanAdmin" class="form-select">
                            <option selected>Pilih Jabatan</option>
                            <option value="Satu">Satu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahNomorTelpAdmin" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" id="tambahNomorTelpAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahKataSandiAdmin" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="tambahKataSandiAdmin">
                    </div>
                    <div class="mb-3">
                        <label for="tambahKonfirmasiKataSandiAdmin" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" id="tambahKonfirmasiKataSandiAdmin">
                    </div>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
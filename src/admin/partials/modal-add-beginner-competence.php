<div class="modal fade" id="tambahKompetensiPemula" tabindex="-1" aria-labelledby="tambahKompetensiPemulaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahKompetensiPemulaLabel">Tambah Kompetensi Pemula</h1>
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
                        <label for="tambahNamaSertifikat" class="form-label">Nama Sertifikat</label>
                        <input type="text" class="form-control" id="tambahNamaSertifikat" name="Nama_Sertifikat" placeholder="Masukkan Nama Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPenerbitan" class="form-label">Tanggal Penerbitan Sertifikat</label>
                        <input type="date" class="form-control" id="tambahTanggalPenerbitan" name="Tanggal_Penerbitan_Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalBerakhir" class="form-label">Tanggal Berakhir Sertifikat</label>
                        <input type="date" class="form-control" id="tambahTanggalBerakhir" name="Tanggal_Berakhir_Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="tambahKategoriKompetensi" class="form-label">Kategori Kompetensi</label>
                        <select class="form-select" name="Kategori_Kompetensi" id="tambahKategoriKompetensi">
                            <option selected>Pilih Kategori Kompetensi</option>
                            <option value="Pemula">Pemula</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahStatus" class="form-label">Status</label>
                        <select class="form-select" name="Status" id="tambahStatus">
                            <option selected>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" name="tambah_sertifikat">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
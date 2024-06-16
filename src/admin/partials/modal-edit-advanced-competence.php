<div class="modal fade" id="suntingKompetensiMahir" tabindex="-1" aria-labelledby="suntingKompetensiMahirLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingKompetensiMahirLabel">Sunting Kompetensi Mahir</h1>
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
                        <label for="suntingFileSertifikat" class="form-label">File Sertifikat</label>
                        <input type="file" class="form-control" id="suntingFileSertifikat" name="File_Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="suntingNamaSertifikat" class="form-label">Nama Sertifikat</label>
                        <input type="text" class="form-control" id="suntingNamaSertifikat" name="Nama_Sertifikat" placeholder="Masukkan Nama Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPenerbitan" class="form-label">Tanggal Penerbitan Sertifikat</label>
                        <input type="date" class="form-control" id="suntingTanggalPenerbitan" name="Tanggal_Penerbitan_Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalBerakhir" class="form-label">Tanggal Berakhir Sertifikat</label>
                        <input type="date" class="form-control" id="suntingTanggalBerakhir" name="Tanggal_Berakhir_Sertifikat">
                    </div>
                    <div class="mb-3">
                        <label for="suntingKategoriKompetensi" class="form-label">Kategori Kompetensi</label>
                        <select class="form-select" name="Kategori_Kompetensi" id="suntingKategoriKompetensi">
                            <option selected>Pilih Kategori Kompetensi</option>
                            <option value="Mahir">Mahir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingStatus" class="form-label">Status</label>
                        <select class="form-select" name="Status" id="suntingStatus">
                            <option selected>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" name="sunting_sertifikat">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
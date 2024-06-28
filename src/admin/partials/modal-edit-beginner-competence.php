<div class="modal fade" id="suntingKompetensiPemula" tabindex="-1" aria-labelledby="suntingKompetensiPemulaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingKompetensiPemulaLabel">Sunting Kompetensi Pemula</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="suntingIDKompetensi" name="ID_Kompetensi">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" disabled>
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
                        <label for="suntingKategoriKompetensi" class="form-label">Jabatan Kompetensi</label>
                        <select class="form-select" name="Kategori_Kompetensi" id="suntingKategoriKompetensi">
                            <option selected>Pilih Jabatan Kompetensi</option>
                            <option value="Pemula">Pemula</option>
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
                    <button type="submit" class="btn btn-primary" id="tombolSuntingPemula">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
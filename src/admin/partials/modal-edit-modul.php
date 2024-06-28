<div class="modal fade" id="suntingModul" tabindex="-1" aria-labelledby="suntingModulLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingModulLabel">Sunting Modul</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="suntingIDModul" name="ID_Modul">
                    <div class="mb-3">
                        <label for="suntingFileModul" class="form-label">File Modul</label>
                        <input type="file" class="form-control" id="suntingFileModul" name="File_Modul">
                    </div>
                    <div class="mb-3">
                        <label for="suntingNamaModul" class="form-label">Nama Modul</label>
                        <input type="text" class="form-control" id="suntingNamaModul" name="Nama_Modul">
                    </div>
                    <div class="mb-3">
                        <label for="suntingJudulModul" class="form-label">Judul Modul</label>
                        <input type="text" class="form-control" id="suntingJudulModul" name="Judul_Modul">
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalTerbitModul" class="form-label">Tanggal Terbit Modul</label>
                        <input type="date" class="form-control" id="suntingTanggalTerbitModul" name="Tanggal_Terbit_Modul">
                    </div>
                    <div class="mb-3">
                        <label for="suntingDeskripsiModul" class="form-label">Deskripsi Modul</label>
                        <textarea name="Deskripsi_Modul" id="suntingDeskripsiModul" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanModul">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
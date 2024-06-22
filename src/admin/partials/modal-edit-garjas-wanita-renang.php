<div class="modal fade" id="suntingGarjasWanitaRenang" tabindex="-1" aria-labelledby="suntingGarjasWanitaRenangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasWanitaRenangLabel">Sunting Nilai Garjas Wanita Renang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="SuntingGarjasPriaRenangID" name="ID_Renang_Pria" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingGayaRenang" class="form-label">Gaya Renang</label>
                        <select name="Gaya_Renang" id="suntingGayaRenang" class="form-select">
                            <option selected>Pilih Gaya Renang</option>
                            <option value="Dada">Dada</option>
                            <option value="Bebas">Bebas</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingWaktuTestRenangPria" class="form-label">Waktu Renang</label>
                        <input type="number" class="form-control" id="suntingWaktuTestRenangPria" name="Waktu_Renang_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanWaktuTestRenangPria" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
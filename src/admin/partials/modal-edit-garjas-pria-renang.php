<div class="modal fade" id="suntingGarjasPriaRenang" tabindex="-1" aria-labelledby="suntingGarjasPriaRenangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasPriaRenangLabel">Sunting Nilai Garjas Pria Renang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="suntingGarjasPriaRenangID" name="ID_Renang_Pria" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPelaksanaanTestRenangPria" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="suntingTanggalPelaksanaanTestRenangPria" name="Tanggal_Pelaksanaan_Tes_Renang_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="suntingGayaRenangPria" class="form-label">Gaya Renang</label>
                        <select name="Nama_Gaya_Renang_Pria" id="suntingGayaRenangPria" class="form-select">
                            <option selected>Pilih Gaya Renang</option>
                            <option value="Dada">Dada</option>
                            <option value="Bebas">Bebas</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingWaktuTestRenangPria" class="form-label">Waktu Renang</label>
                        <input type="time" class="form-control" id="suntingWaktuTestRenangPria" name="Waktu_Renang_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasPriaTestRenang">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="suntingGarjasWanitaRenang" tabindex="-1" aria-labelledby="suntingGarjasWanitaRenangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasWanitaRenangLabel">Sunting Nilai Garjas Wanita Renang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="SuntingGarjasWanitaRenangID" name="ID_Renang_Wanita" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPelaksanaanTestRenangWanita" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="suntingTanggalPelaksanaanTestRenangWanita" name="Tanggal_Pelaksanaan_Tes_Renang_Wanita">
                    </div>
                    <div class="mb-3">
                        <label for="suntingGayaRenang" class="form-label">Gaya Renang</label>
                        <select name="Nama_Gaya_Renang_Wanita" id="suntingGayaRenang" class="form-select">
                            <option selected>Pilih Gaya Renang</option>
                            <option value="Dada">Dada</option>
                            <option value="Bebas">Bebas</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="suntingWaktuTestRenangWanita" class="form-label">Waktu Renang</label>
                        <input type="time" class="form-control" id="suntingWaktuTestRenangWanita" name="Waktu_Renang_Wanita">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanWaktuTestRenangWanita">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
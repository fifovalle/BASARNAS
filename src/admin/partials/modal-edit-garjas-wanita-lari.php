<div class="modal fade" id="suntingGarjasWanitaLari" tabindex="-1" aria-labelledby="suntingGarjasWanitaLariLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasWanitaLariLabel">Sunting Nilai Garjas Wanita Lari 2400 M</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="SuntingGarjasWanitaLariID" name="ID_Lari_Wanita" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPelaksanaanGarjasWanitaLari" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="suntingTanggalPelaksanaanGarjasWanitaLari" name="Tanggal_Pelaksanaan_Tes_Lari_Wanita">
                    </div>
                    <div class="mb-3">
                        <label for="suntingWaktuGarjasWanitaLari" class="form-label">Waktu Lari</label>
                        <input type="number" class="form-control" id="suntingWaktuGarjasWanitaLari" name="Waktu_Lari_Wanita">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasWanitaLari" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
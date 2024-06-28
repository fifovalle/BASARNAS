<div class="modal fade" id="suntingGarjasPriaLari" tabindex="-1" aria-labelledby="suntingGarjasPriaLariLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasPriaLariLabel">Sunting Nilai Garjas Pria Lari 2400 M</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="SuntingGarjasPriaLariID" name="ID_Lari_Pria" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPelaksanaanGarjasPriaLari" class="form-label">Waktu Lari</label>
                        <input type="date" class="form-control" id="suntingTanggalPelaksanaanGarjasPriaLari" name="Tanggal_Pelaksanaan_Tes_Lari_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="suntingWaktuGarjasPriaLari" class="form-label">Waktu Lari</label>
                        <input type="number" class="form-control" id="suntingWaktuGarjasPriaLari" name="Waktu_Lari_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasPriaLari" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
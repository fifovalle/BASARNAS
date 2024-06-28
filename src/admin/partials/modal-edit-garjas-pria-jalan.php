<div class="modal fade" id="suntingGarjasPriaJalan" tabindex="-1" aria-labelledby="suntingGarjasPriaJalanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasPriaJalanLabel">Sunting Nilai Garjas Pria Jalan 5 KM</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="SuntingGarjasPriaJalanID" name="ID_Jalan_Pria" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPelaksanaanGarjasPriaJalan" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="suntingTanggalPelaksanaanGarjasPriaJalan" name="Tanggal_Pelaksanaan_Tes_Jalan_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="suntingWaktuGarjasPriaJalan" class="form-label">Waktu Jalan</label>
                        <input type="number" class="form-control" id="suntingWaktuGarjasPriaJalan" name="Waktu_Jalan_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasPriaJalan" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
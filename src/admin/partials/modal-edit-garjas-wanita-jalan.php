<div class="modal fade" id="suntingGarjasWanitaJalan" tabindex="-1" aria-labelledby="suntingGarjasWanitaJalanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasWanitaJalanLabel">Sunting Nilai Garjas Wanita Jalan 5 KM</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="SuntingGarjasWanitaJalanID" name="ID_Jalan_Wanita" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingWaktuGarjasWanitaJalan" class="form-label">Waktu Jalan</label>
                        <input type="number" class="form-control" id="suntingWaktuGarjasWanitaJalan" name="Waktu_Jalan_Wanita">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasWanitaJalan" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
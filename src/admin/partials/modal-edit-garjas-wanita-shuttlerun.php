<div class="modal fade" id="suntingGarjasWanitaShuttleRun" tabindex="-1" aria-labelledby="suntingGarjasWanitaShuttleRunLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasWanitaShuttleRunLabel">Sunting Nilai Garjas Wanita Shuttle Run</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="SuntingGarjasWanitaShuttleRunID" name="ID_Wanita_Shuttle_Run" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPelaksanaanShuttleRunGarjasWanita" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="suntingTanggalPelaksanaanShuttleRunGarjasWanita" name="Tanggal_Pelaksanaan_Shuttle_Run_Wanita">
                    </div>
                    <div class="mb-3">
                        <label for="suntingJumlahShuttleRunGarjasWanita" class="form-label">Waktu Shuttle Run</label>
                        <input type="number" min="0" step="any" class="form-control" id="suntingJumlahShuttleRunGarjasWanita" name="Jumlah_Shuttle_Run_Wanita">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasWanitaShuttleRun" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="suntingGarjasPriaShuttleRun" tabindex="-1" aria-labelledby="suntingGarjasPriaShuttleRunLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasPriaShuttleRunLabel">Sunting Nilai Garjas Pria Shuttle Run</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="editGarjasPriaShuttleRunPriaID" name="ID_Shuttle_Run_Pria" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPelaksanaanShuttleRunPengguna" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="suntingTanggalPelaksanaanShuttleRunPengguna" name="Tanggal_Pelaksanaan_Shuttle_Run_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="suntingWaktuShuttleRunAdmin" class="form-label">Waktu Shuttle Run</label>
                        <input type="text" class="form-control" id="suntingWaktuShuttleRunAdmin" name="Waktu_Shuttle_Run_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="suntingStatusShuttleRunAdmin" class="form-label">Status</label>
                        <select name="Status_Pria_Shuttle_Run" class="form-control" id="suntingStatusShuttleRunAdmin">
                            <option value="">Pilih Status</option>
                            <option value="Ditinjau">Ditinjau</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasPriaShuttleRun">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
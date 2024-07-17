<div class="modal fade" id="suntingGarjasWanitaChinUp" tabindex="-1" aria-labelledby="suntingGarjasWanitaChinUpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasWanitaChinUpLabel">Sunting Nilai Garjas Wanita Chin Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="SuntingGarjasWanitaChinUpID" name="ID_Wanita_Chin_Up" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTanggalPelaksanaanChinUpGarjasWanita" class="form-label">Tanggal Pelaksanaan Chin Up</label>
                        <input type="date" class="form-control" id="suntingTanggalPelaksanaanChinUpGarjasWanita" name="Tanggal_Pelaksanaan_Chin_Up_Wanita">
                    </div>
                    <div class="mb-3">
                        <label for="suntingJumlahChinUpGarjasWanita" class="form-label">Jumlah Chin Up</label>
                        <input type="number" class="form-control" id="suntingJumlahChinUpGarjasWanita" name="Jumlah_Chin_Up_Wanita">
                    </div>
                    <div class="mb-3">
                        <label for="suntingStatusChinUpGarjasWanita" class="form-label">Status</label>
                        <select name="Status_Wanita_Chin_Up" class="form-control" id="suntingStatusChinUpGarjasWanita">
                            <option value="">Pilih Status</option>
                            <option value="Ditinjau">Ditinjau</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasWanitaChinUp" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
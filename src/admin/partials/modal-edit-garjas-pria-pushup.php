<div class="modal fade" id="suntingGarjasPriaPushUp" tabindex="-1" aria-labelledby="suntingGarjasPriaPushUpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingGarjasPriaPushUpLabel">Sunting Nilai Garjas Pria Push Up</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" id="editGarjasPriaPushUpID" name="ID_Push_Up_Pria" autocomplete="off">
                    <div class="mb-3">
                        <label for="suntingNIPPengguna" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPengguna" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingJumlahPushUpGarjasPria" class="form-label">Jumlah Push Up</label>
                        <input type="number" class="form-control" id="suntingJumlahPushUpGarjasPria" name="Jumlah_Push_Up_Pria">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanGarjasPriaPushUp" name="Simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

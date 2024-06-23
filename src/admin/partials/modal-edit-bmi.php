<div class="modal fade" id="suntingBMI" tabindex="-1" aria-labelledby="suntingBMILabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="suntingBMILabel">Sunting BMI</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="idBMI" name="ID_BMI">
                    <div class="mb-3">
                        <label for="suntingNIPPenggunaBMI" class="form-label">NIP dan Nama Anggota</label>
                        <input type="text" class="form-control" id="suntingNIPPenggunaBMI" name="NIP_Pengguna" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="suntingTinggiBMI" class="form-label">Tinggi (cm)</label>
                        <input type="number" class="form-control" id="suntingTinggiBMI" name="Tinggi_BMI">
                    </div>
                    <div class="mb-3">
                        <label for="suntingBeratBMI" class="form-label">Berat (kg)</label>
                        <input type="number" class="form-control" id="suntingBeratBMI" name="Berat_BMI">
                    </div>
                    <button type="submit" class="btn btn-primary" id="tombolSimpanBMI" name="sunting_BMI">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
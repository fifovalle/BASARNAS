<div class="modal fade" id="tambahGarjasPriaLari" tabindex="-1" aria-labelledby="tambahGarjasPriaLariLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahGarjasPriaLariLabel">Tambah Nilai Garjas Pria Lari 2400 M</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../config/add-tes-lari-pria.php" method="post" enctype="multipart/form-data">
                    <?php
                    $penggunaPriaModel = new Pengguna($koneksi);
                    $penggunaPriaInfo = $penggunaPriaModel->tampilkanDataPenggunaPria();
                    ?>
                    <div class="mb-3">
                        <label for="tambahNIPPenggunaPria" class="form-label">NIP</label>
                        <select name="NIP_Pengguna" id="tambahNIPPenggunaPria" class="form-select">
                            <option selected disabled>Pilih NIP Pengguna</option>
                            <?php foreach ($penggunaPriaInfo as $penggunaPria) : ?>
                                <option value="<?php echo $penggunaPria['NIP_Pengguna']; ?>"><?php echo $penggunaPria['NIP_Pengguna'] . ' - ' . $penggunaPria['Nama_Lengkap_Pengguna']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tambahTanggalPelaksanaanLariPria" class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tambahTanggalPelaksanaanLariPria" name="Tanggal_Pelaksanaan_Tes_Lari_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="tambahWaktuLariPria" class="form-label">Waktu Lari</label>
                        <input type="number" min="0" step="any" class="form-control" id="tambahWaktuLariPria" name="Waktu_Lari_Pria">
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="distance" class="form-label">Total Jarak (km)</label>
                        <input type="text" class="form-control" id="distance" name="distance" readonly>
                    </div>
                    <div id="map" style="height: 400px;"></div>
                    <button type="submit" class="btn btn-primary" name="tambah_nilai">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const map = L.map('map').setView([-6.200000, 106.816666], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let marker;
        let path = [];
        let totalDistance = 0;
        const polyline = L.polyline([], {
            color: 'red'
        }).addTo(map);
        let startTime, timerInterval;

        function startTimer() {
            startTime = new Date().getTime();
            timerInterval = setInterval(updateTime, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
        }

        function updateTime() {
            const currentTime = new Date().getTime();
            const elapsedTime = Math.floor((currentTime - startTime) / 1000);
            document.getElementById('tambahWaktuLariPria').value = elapsedTime;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const {
                    latitude,
                    longitude
                } = position.coords;
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                map.setView([latitude, longitude], 13);
                marker = L.marker([latitude, longitude]).addTo(map);
            });

            navigator.geolocation.watchPosition(position => {
                const {
                    latitude,
                    longitude
                } = position.coords;
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                if (marker) {
                    marker.setLatLng([latitude, longitude]);
                } else {
                    marker = L.marker([latitude, longitude]).addTo(map);
                    map.setView([latitude, longitude], 13);
                }

                path.push([latitude, longitude]);
                polyline.setLatLngs(path);

                if (path.length > 1) {
                    const lastPoint = path[path.length - 2];
                    const currentPoint = path[path.length - 1];
                    totalDistance += calculateDistance(lastPoint[0], lastPoint[1], currentPoint[0], currentPoint[1]);
                }

                document.getElementById('distance').value = (totalDistance / 1000).toFixed(2);
                startTimer();
            }, showError, {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Geolokasi Tidak Didukung',
                text: 'Geolocation tidak didukung oleh browser ini.'
            });
        }

        $('#tambahGarjasPriaLari').on('shown.bs.modal', function() {
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        });

        $('#tambahGarjasPriaLari').on('hidden.bs.modal', function() {
            stopTimer();
        });
    });

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371e3;
        const φ1 = lat1 * Math.PI / 180;
        const φ2 = lat2 * Math.PI / 180;
        const Δφ = (lat2 - lat1) * Math.PI / 180;
        const Δλ = (lon2 - lon1) * Math.PI / 180;

        const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const d = R * c;
        return d;
    }

    function showError(error) {
        let message = '';
        switch (error.code) {
            case error.PERMISSION_DENIED:
                message = 'Pengguna menolak permintaan GPS.';
                break;
            case error.POSITION_UNAVAILABLE:
                message = 'Informasi lokasi tidak tersedia.';
                break;
            case error.TIMEOUT:
                message = 'Permintaan untuk mendapatkan lokasi pengguna melampaui batas waktu.';
                break;
            case error.UNKNOWN_ERROR:
                message = 'Terjadi kesalahan yang tidak diketahui.';
                break;
        }
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: message
        });
    }
</script>
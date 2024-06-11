<div class="modal fade" id="lihatPengguna" tabindex="-1" aria-labelledby="lihatPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="lihatPenggunaLabel">Info Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php
                    $penggunaModel = new Pengguna($koneksi);
                    $penggunaInfo = $penggunaModel->tampilkanDataPengguna();
                    ?>
                    <?php if (!empty($penggunaInfo)) : ?>
                        <?php foreach ($penggunaInfo as $pengguna) : ?>
                            <div class="col-6 text-center">
                                <img src="../uploads/<?php echo $pengguna['Foto_Pengguna']; ?>" alt="Pengguna Photo" class="img-fluid rounded mb-3" style="width: 150px; height: 150px;">
                                <h3><?php echo $pengguna['Nama_Lengkap_Pengguna']; ?></h3>
                                <p class="text-muted"><?php echo $pengguna['NIP_Pengguna']; ?></p>
                            </div>
                            <div class="col-6">
                                <h4>Info Selengkapnya</h4>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Nama Lengkap:</th>
                                        <td><?php echo $pengguna['Nama_Lengkap_Pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir:</th>
                                        <td><?php echo $pengguna['Tanggal_Lahir_Pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat:</th>
                                        <td><?php echo $pengguna['Alamat_Pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jabatan:</th>
                                        <td><?php echo $pengguna['Jabatan_Pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin:</th>
                                        <td><?php echo $pengguna['Jenis_Kelamin_Pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon:</th>
                                        <td><?php echo $pengguna['No_Telepon_Pengguna']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Umur:</th>
                                        <td><?php echo $pengguna['Umur_Pengguna']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center text-danger fw-bold ">Tidak Ada Data Pengguna!</td>
                        </tr>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
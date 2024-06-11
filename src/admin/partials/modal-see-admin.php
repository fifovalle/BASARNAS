<div class="modal fade" id="lihatAdmin" tabindex="-1" aria-labelledby="lihatAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="lihatAdminLabel">Info Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $adminModel = new Admin($koneksi);
            $adminInfo = $adminModel->tampilkanDataAdmin();
            ?>
            <div class="modal-body">
                <div class="row">
                    <?php if (!empty($adminInfo)) : ?>
                        <?php foreach ($adminInfo as $admin) : ?>
                            <div class="col-6 text-center ">
                                <img src="../uploads/<?php echo $admin['Foto_Admin']; ?>" alt="Admin Photo" class="img-fluid rounded mb-3">
                                <h3>Nama Admin</h3>
                                <p class="text-muted">NIP Admin</p>
                            </div>
                            <div class="col-6">
                                <h4>Info Selengkapnya</h4>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Nama Lengkap:</th>
                                        <td><?php echo $admin['Nama_Lengkap_Admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir:</th>
                                        <td><?php echo $admin['Tanggal_Lahir_Admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat:</th>
                                        <td><?php echo $admin['Alamat_Admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jabatan:</th>
                                        <td><?php echo $admin['Jabatan_Admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin:</th>
                                        <td><?php echo $admin['Jenis_Kelamin_Admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon:</th>
                                        <td><?php echo $admin['Nomor_Telepon_Admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Umur:</th>
                                        <td><?php echo $admin['Umur_Admin']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center text-danger fw-bold ">Tidak Ada Data Admin!</td>
                        </tr>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach ($datas as $a => $update) : ?>
    <div class="modal fade" id="modal-lg-<?= $update['id_transaksi']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Paket Makeup</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Admin/updatePaket/<?= $update['id_transaksi']; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="foto_lama" value="<?= $update['Foto_Paket']; ?>">
                    <div class="modal-body" style="display: flex; justify-content:space-between;">
                        <div class="right-content" style="width: 55%;">
                            <table>
                                <tr>
                                    <td>Nama Paket</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="nama_paket" class="form-control <?= ($validasi->hasError('nama_paket')) ? 'is-invalid' : ''; ?>" value="<?= ($validasi->hasError('nama_paket')) ? old('nama_paket') : $update['Nama_Paket']; ?>">
                                        <span class="error invalid-feedback"><?= $validasi->getError('nama_paket'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Deskripsi Paket</td>
                                    <td>:</td>
                                    <td>
                                        <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control <?= ($validasi->hasError('deskripsi')) ? 'is-invalid' : ''; ?>"><?= ($validasi->hasError('deskripsi')) ? old('deskripsi_paket') : $update['Deskripsi_Paket']; ?></textarea>
                                        <span class="error invalid-feedback"><?= $validasi->getError('deskripsi'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga Paket</td>
                                    <td>:</td>
                                    <td><input type=" text" name="harga_paket" class="form-control <?= ($validasi->hasError('harga_paket')) ? 'is-invalid' : ''; ?>" value="<?= ($validasi->hasError('harga_paket')) ? old('harga_paket') : $update['Harga_Paket']; ?>">
                                        <span class="error invalid-feedback"><?= $validasi->getError('harga_paket'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gambar Paket</td>
                                    <td>:</td>
                                    <td>
                                        <input type="file" name="paket_foto" id="gambar-<?= $update['id_paket']; ?>" onchange="updatePreview(<?= $update['id_paket']; ?>)">
                                    </td>
                                </tr>
                            </table>
                            <?php if ($validasi->hasError('paket_foto')) : ?>
                                <p style="padding-left: 26%; color: red; font-size: 80%;"><?= $validasi->getError('paket_foto'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="left-content" style="width: 45%;">
                            <img src="/assets/foto/<?= $update['Foto_Paket']; ?>" alt="" style="width: 100%;" class="img-preview-<?= $update['id_paket']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        function updatePreview(id) {
            const poster = document.querySelector("#gambar-" + id);
            const imgPreview = document.querySelector(".img-preview-" + id);

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(poster.files[0]);

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
<?php endforeach ?>
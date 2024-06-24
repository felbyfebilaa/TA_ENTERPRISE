<?php foreach ($galeri as $a => $update) : ?>
    <div class="modal fade" id="modal-lg-<?= $update['id_galeri']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update galeri</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Admin/updateGaleri/<?= $update['id_galeri']; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="foto_lama" value="<?= $update['foto_galeri']; ?>">
                    <div class="modal-body" style="display: flex; justify-content:space-between;">
                        <div class="right-content" style="width: 55%;">
                            <table>
                                <tr>
                                    <td>Nama Galeri</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="nama_galeri" class="form-control <?= ($validasi->hasError('nama_galeri')) ? 'is-invalid' : ''; ?>" value="<?= ($validasi->hasError('nama_galeri')) ? old('nama_galeri') : $update['nama_galeri']; ?>">
                                        <span class="error invalid-feedback"><?= $validasi->getError('nama_galeri'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>:</td>
                                    <td>
                                        <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control <?= ($validasi->hasError('deskripsi')) ? 'is-invalid' : ''; ?>"><?= ($validasi->hasError('deskripsi')) ? old('deskripsi') : $update['deskripsi']; ?></textarea>
                                        <span class="error invalid-feedback"><?= $validasi->getError('deskripsi'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gambar Paket</td>
                                    <td>:</td>
                                    <td>
                                        <input type="file" name="foto_galeri" id="gambar-<?= $update['id_galeri']; ?>" onchange="updatePreview(<?= $update['id_galeri']; ?>)">
                                    </td>
                                </tr>
                            </table>
                            <?php if ($validasi->hasError('foto_galeri')) : ?>
                                <p style="padding-left: 26%; color: red; font-size: 80%;"><?= $validasi->getError('foto_galeri'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="left-content" style="width: 45%;">
                            <img src="/assets/fotoGaleri/<?= $update['foto_galeri']; ?>" alt="" style="width: 100%;" class="img-preview-<?= $update['id_galeri']; ?>">
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
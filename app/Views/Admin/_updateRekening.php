<?php foreach ($rekenings as $index => $values) : ?>
    <div class="modal fade" id="modal-lg-<?= $values['id']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Paket MakeUp</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Admin/updateRekening/<?= $values['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body" style="display: flex; justify-content:space-between;">
                        <table>
                            <tr>
                                <td>Nama Rekening</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="nama_rekening" class="form-control <?= ($validasi->hasError('nama_rekening')) ? 'is-invalid' : ''; ?>" value="<?= ($validasi->hasError('nama_rekening')) ? old('nama_rekening') : $values['nama_rekening']; ?>">
                                    <span class="error invalid-feedback"><?= $validasi->getError('nama_rekening'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Atas Nama</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="atas_nama" class="form-control <?= ($validasi->hasError('atas_nama')) ? 'is-invalid' : ''; ?>" value="<?= ($validasi->hasError('atas_nama')) ? old('atas_nama') : $values['atas_nama']; ?>">
                                    <span class="error invalid-feedback"><?= $validasi->getError('atas_nama'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>No Rekening</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="no_rekening" class="form-control <?= ($validasi->hasError('no_rekening')) ? 'is-invalid' : ''; ?>" value="<?= ($validasi->hasError('no_rekening')) ? old('no_rekening') : $values['no_rekening']; ?>">
                                    <span class="error invalid-feedback"><?= $validasi->getError('no_rekening'); ?></span>
                                </td>
                            </tr>
                        </table>
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
<?php endforeach; ?>
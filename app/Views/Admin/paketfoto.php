<?= $this->extend('/Admin/Layout/template'); ?>
<?= $this->section('content'); ?>
<style>
    .table>tbody>tr * {
        vertical-align: middle;
    }

    .alert-success {
        background-color: #28a7459c !important;
    }
</style>
<div class="row">
    <div class="col-4 mb-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            Tambah Paket
        </button>
    </div>
</div>
<div class="row">
    <div class="col">
        <?php if (session()->get('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Paket Makeup</h3>
            </div>
            <!-- ./card-header -->
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Nama Paket</th>
                            <th>Harga Paket</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($pakets as $p => $paket) :
                            $desc = nl2br($paket['Deskripsi_Paket']);
                            $harga = "Rp " . number_format($paket['Harga_Paket'], 0, ',', '.');
                        ?>
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td><?= $id++; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg-<?= $paket['id_paket']; ?>">
                                        Update
                                    </button>
                                    <br>
                                    <form action="/paket/<?= $paket['id_paket']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('anda yakin?'); "> Hapus</button>
                                    </form>
                                </td>
                                <td><?= $paket['Nama_Paket']; ?></td>
                                <td><?= $harga; ?></td>
                                <td>
                                    <img src="/assets/foto/<?= $paket['Foto_Paket']; ?>" alt="" height="100" width="100" style="object-fit: contain;">
                                </td>
                            </tr>
                            <tr class="expandable-body">
                                <td colspan="5">
                                    <p>
                                        <?= $desc; ?>
                                    </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Paket Makeup</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Admin/insertPaket" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="display: flex; justify-content:space-between;">
                    <div class="right-content" style="width: 55%;">
                        <table>
                            <tr>
                                <td>Nama Paket</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="nama_paket" class="form-control <?= ($validasi->hasError('nama_paket')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_paket'); ?>">
                                    <span class="error invalid-feedback"><?= $validasi->getError('nama_paket'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Deskripsi Paket</td>
                                <td>:</td>
                                <td>
                                    <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control <?= ($validasi->hasError('deskripsi')) ? 'is-invalid' : ''; ?>"><?= old('deskripsi'); ?></textarea>
                                    <span class="error invalid-feedback"><?= $validasi->getError('deskripsi'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Harga Paket</td>
                                <td>:</td>
                                <td><input type=" text" name="harga_paket" class="form-control <?= ($validasi->hasError('harga_paket')) ? 'is-invalid' : ''; ?>" value="<?= old('harga_paket'); ?>">
                                    <span class="error invalid-feedback"><?= $validasi->getError('harga_paket'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Gambar Paket</td>
                                <td>:</td>
                                <td>
                                    <input type="file" name="paket_foto" id="gambar" onchange="previewImg()">
                                </td>
                            </tr>
                        </table>
                        <?php if ($validasi->hasError('paket_foto')) : ?>
                            <p style="padding-left: 26%; color: red; font-size: 80%;"><?= $validasi->getError('paket_foto'); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="left-content" style="width: 45%;">
                        <img src="" alt="" style="width: 100%;" class="img-preview">
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
<?php require '_updatePaket.php' ?>
<?= $this->endSection(); ?>